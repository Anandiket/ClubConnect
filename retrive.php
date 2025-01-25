<?php

include "db_connection.php";
if (isset($_GET['committee_ID'])) {
  $committee_id = $_GET['committee_ID'];
} else { 
  session_start();
// Check if the committee_ID is set in the session
if (!isset($_SESSION['id'])) {
    echo "Committee ID not set in session.";
    exit;
}

// Retrieve the committee_ID from session
$committee_id = $_SESSION['committee_ID'];

// Validate and sanitize inputs (optional but recommended)
$committee_id = filter_var($committee_id, FILTER_SANITIZE_NUMBER_INT);
}

if (isset($_GET['f_id'])) {
  $f_id = $_GET['f_id'];
} else {
  echo "Feild ID not specified.";
  exit;
}
if (isset($_GET['l_id'])) {
  $l_id = $_GET['l_id'];
}  else {
  echo "Login ID not specified.";
  exit;
}

$sql_committees = "SELECT * FROM committees WHERE committee_ID = ?";

// Prepare and bind parameter
$stmt = mysqli_prepare($conn, $sql_committees);
mysqli_stmt_bind_param($stmt, "i", $committee_id);
mysqli_stmt_execute($stmt);
$result_committees = mysqli_stmt_get_result($stmt);

// Check for committee existence
if (mysqli_num_rows($result_committees) === 1) {
  $row = mysqli_fetch_assoc($result_committees);
  $committee_name = $row["committeeName"];
  $dept_id = $row['dept_id'];
} else {
  echo "No committee found for ID: " . $committee_id;
  exit;
}

// Prepare SQL statement for descriptions
$sql = "SELECT * FROM descriptions WHERE committee_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $committee_id);
$stmt->execute();
$result = $stmt->get_result();

if (mysqli_num_rows($result) === 1) {
  $row = mysqli_fetch_assoc($result);
  $objective = $row["objective"];
  $mission = $row["misson"];
  $more_desc = $row["more"];
  $des_id = $row['des_id'];
  $logo_image = base64_encode($row["logo"]);
}

$committee_achievements = [];
$sql_achievements = "SELECT * FROM achievements WHERE committee_ID = ? AND achievements_date <= CURDATE() ORDER BY achievements_date DESC";
$stmt_achievements = mysqli_prepare($conn, $sql_achievements);
mysqli_stmt_bind_param($stmt_achievements, "i", $committee_id);
mysqli_stmt_execute($stmt_achievements);
$result_achievements = mysqli_stmt_get_result($stmt_achievements);

while ($row = mysqli_fetch_assoc($result_achievements)) {
    $achievement_id = $row['achievement_ID'];
    
    // Retrieve photos for the current achievement
    $sql_photos = "SELECT photo FROM photos WHERE achievement_id = ?";
    $stmt_photos = mysqli_prepare($conn, $sql_photos);
    mysqli_stmt_bind_param($stmt_photos, "i", $achievement_id);
    mysqli_stmt_execute($stmt_photos);
    $result_photos = mysqli_stmt_get_result($stmt_photos);
    
    $photos = [];
    while ($photo_row = mysqli_fetch_assoc($result_photos)) {
        $photos[] = base64_encode($photo_row['photo']);
    }
    
    $row['photo'] = $photos;
    $committee_achievements[] = $row;

    mysqli_stmt_close($stmt_photos);
}

mysqli_stmt_close($stmt_achievements);
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';
$event_filter = isset($_GET['event_filter']) ? $_GET['event_filter'] : 'all';
$sql_events = "SELECT * FROM events WHERE committee_ID = ?";
$params = [$committee_id];
$types = "i";

if ($event_filter == 'upcoming') {
    $sql_events .= " AND event_date >= CURDATE()";
} elseif ($event_filter == 'past') {
    $sql_events .= " AND event_date < CURDATE()";
} elseif ($event_filter == 'all') {
    // No additional condition for 'all', we will separate events later in the script
}

// Add condition for start date if provided
if (!empty($start_date)) {
    $sql_events .= " AND event_date >= ?";
    $params[] = $start_date;
    $types .= "s";
}

// Add condition for end date if provided
if (!empty($end_date)) {
    $sql_events .= " AND event_date <= ?";
    $params[] = $end_date;
    $types .= "s";
}

// Add ordering
$sql_events .= " ORDER BY event_date";

$stmt_events = mysqli_prepare($conn, $sql_events);

// Bind parameters dynamically
mysqli_stmt_bind_param($stmt_events, $types, ...$params);

mysqli_stmt_execute($stmt_events);
$result_events = mysqli_stmt_get_result($stmt_events);
$today = date('Y-m-d');
$events = [];
while ($row = mysqli_fetch_assoc($result_events)) {
     if($row['event_date'] < $today ){
    $event_id = $row['Event_ID'];
    
    // Retrieve photos for the current achievement
    $sql_photos = "SELECT photo FROM photos WHERE event_id = ?";
    $stmt_photos = mysqli_prepare($conn, $sql_photos);
    mysqli_stmt_bind_param($stmt_photos, "i", $event_id);
    mysqli_stmt_execute($stmt_photos);
    $result_photos = mysqli_stmt_get_result($stmt_photos);
    
    $photos = [];
    while ($photo_row = mysqli_fetch_assoc($result_photos)) {
        $photos[] = base64_encode($photo_row['photo']);
    }
    
    $row['photo'] = $photos;

    mysqli_stmt_close($stmt_photos);
  }
  
    $events[] = $row;
}

mysqli_stmt_close($stmt_events);

// Separate upcoming and past events if filter is 'all'
$upcoming_events = [];
$past_events = [];
$current_date = date('Y-m-d');

if ($event_filter == 'all') {
    foreach ($events as $event) {
        if ($event['event_date'] >= $current_date) {
            $upcoming_events[] = $event;
        } else {
            $past_events[] = $event;
        }
    }
} elseif ($event_filter == 'upcoming') {
    $upcoming_events = $events;
} elseif ($event_filter == 'past') {
    $past_events = $events;
}

// Fetch committee members sorted by position and name
$committee_members = [];
$sql_members = "SELECT * FROM members WHERE committee_ID = ? ORDER BY CASE WHEN position IN ('Chairperson', 'Secretary', 'Head', 'Member', 'Others') THEN 0 ELSE 1 END, FIELD(position, 'Chairperson', 'Secretary', 'Head', 'Member', 'Others'), member_name ASC";$stmt_members = mysqli_prepare($conn, $sql_members);
mysqli_stmt_bind_param($stmt_members, "i", $committee_id);
mysqli_stmt_execute($stmt_members);
$result_members = mysqli_stmt_get_result($stmt_members);

while ($row = mysqli_fetch_assoc($result_members)) {
    $committee_members[] = $row;
}

mysqli_stmt_close($stmt_members);



// 1. Number of members with position 'Member'
$sql_count_members = "SELECT COUNT(*) as count FROM members WHERE role != 'Core' AND committee_ID = ?";

$stmt_count_members = mysqli_prepare($conn, $sql_count_members);
mysqli_stmt_bind_param($stmt_count_members, "i", $committee_id);
mysqli_stmt_execute($stmt_count_members);
$result_count_members = mysqli_stmt_get_result($stmt_count_members);
$row_count_members = mysqli_fetch_assoc($result_count_members);
$num_members = $row_count_members['count'];
mysqli_stmt_close($stmt_count_members);

// 2. Number of members without position 'Member'
$sql_count_non_members = "SELECT COUNT(*) as count FROM members WHERE role = 'Core' AND committee_ID = ?";
$stmt_count_non_members = mysqli_prepare($conn, $sql_count_non_members);
mysqli_stmt_bind_param($stmt_count_non_members, "i", $committee_id);
mysqli_stmt_execute($stmt_count_non_members);
$result_count_non_members = mysqli_stmt_get_result($stmt_count_non_members);
$row_count_non_members = mysqli_fetch_assoc($result_count_non_members);
$num_non_members = $row_count_non_members['count'];
mysqli_stmt_close($stmt_count_non_members);

$committee_coordinators = [];
$sql_coordinators = "SELECT * FROM coordinator WHERE committee_ID = ?";
$stmt_coordinators = mysqli_prepare($conn, $sql_coordinators);
mysqli_stmt_bind_param($stmt_coordinators, "i", $committee_id);
mysqli_stmt_execute($stmt_coordinators);
$result_coordinators = mysqli_stmt_get_result($stmt_coordinators);

while ($row_coordinators = mysqli_fetch_assoc($result_coordinators)) {
  $committee_coordinators[] = $row_coordinators;
}
mysqli_stmt_close($stmt_coordinators);

mysqli_stmt_close($stmt);
mysqli_close($conn);

?>

