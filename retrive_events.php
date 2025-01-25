<?php
include "db_connection.php";
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';
$event_filter = isset($_GET['event_filter']) ? $_GET['event_filter'] : 'all';
$committee_id = isset($_GET['committee_ID']) ? $_GET['committee_ID'] : '';

$sql_events = "SELECT e.*, c.committeeName FROM events e JOIN committees c ON e.committee_ID = c.committee_ID";
$params = [];
$types = "";

$conditions = [];

// Add filter conditions
if ($event_filter == 'upcoming') {
    $conditions[] = "e.event_date >= CURDATE()";
} elseif ($event_filter == 'past') {
    $conditions[] = "e.event_date < CURDATE()";
}

if (!empty($start_date)) {
    $conditions[] = "e.event_date >= ?";
    $params[] = $start_date;
    $types .= "s";
}

if (!empty($end_date)) {
    $conditions[] = "e.event_date <= ?";
    $params[] = $end_date;
    $types .= "s";
}

if (!empty($committee_id)) {
    $conditions[] = "e.committee_ID = ?";
    $params[] = $committee_id;
    $types .= "i";
}

// Add conditions to the SQL query
if (!empty($conditions)) {
    $sql_events .= " WHERE " . implode(" AND ", $conditions);
}

// Add ordering
$sql_events .= " ORDER BY e.event_date";

$stmt_events = mysqli_prepare($conn, $sql_events);

// Bind parameters dynamically
if (!empty($params)) {
    mysqli_stmt_bind_param($stmt_events, $types, ...$params);
}

mysqli_stmt_execute($stmt_events);
$result_events = mysqli_stmt_get_result($stmt_events);

$events = [];
while ($row = mysqli_fetch_assoc($result_events)) {
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
?>