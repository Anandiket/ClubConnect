<?php

session_start();

if (!isset($_SESSION['id'])) {
    echo "Committee ID not set in session.";
    exit;
}

// Retrieve the committee_ID from session
$committee_ID = $_SESSION['committee_ID'];

// Validate and sanitize inputs (optional but recommended)
$committee_ID = filter_var($committee_ID, FILTER_SANITIZE_NUMBER_INT);


$servername = "localhost";
$database_name = "committee";
$username = "root";
$password = "";

// Create connection
$link = mysqli_connect($servername, $username, $password, $database_name);

// Check connection
if (!$link) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
  // Check if committee_ID is set and not empty
    
    $objective = $_POST["objective"];
    $about_us = $_POST["about_us"];
    $more_desc = $_POST["more_desc"];
    $logo = isset($_FILES['logo']['tmp_name']) ? $_FILES['logo']['tmp_name'] : '';
    $imageFileType = strtolower(pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION));
 
    if (!empty($logo)) {
        $check = getimagesize($logo);
        if ($check !== false) {
            $logoContent = file_get_contents($logo);
        } else {
            header("Location: descriptionform.php?f_id=2&l_id=1&committee_id=$committee_ID &error=File is not an image.");
            exit;
        }
} else {
    // Assuming $member_id is already defined

// SQL query to select member details including photo
$sql_member = "SELECT logo FROM descriptions WHERE committee_ID = ?";
$stmt_member = mysqli_prepare($link, $sql_member);
mysqli_stmt_bind_param($stmt_member, "i", $committee_ID);
mysqli_stmt_execute($stmt_member);
$result_member = mysqli_stmt_get_result($stmt_member);
if ($row_member = mysqli_fetch_assoc($result_member)) {
$existing_logo = $row_member['logo'];
} 
$logoContent = $existing_logo;
}


    // Database connection parameters


    // Check if a row with the provided committee_ID already exists
    $sql_check = "SELECT * FROM descriptions WHERE committee_ID = ?";
    if ($stmt_check = mysqli_prepare($link, $sql_check)) {
        mysqli_stmt_bind_param($stmt_check, "s", $committee_ID);
        mysqli_stmt_execute($stmt_check);
        mysqli_stmt_store_result($stmt_check);
        
        if (mysqli_stmt_num_rows($stmt_check) > 0) {
            // Update the existing row
            $sql_update = "UPDATE descriptions SET objective = ?, misson = ?, more = ?, logo= ? WHERE committee_ID = ?";
            if ($stmt_update = mysqli_prepare($link, $sql_update)) {
                mysqli_stmt_bind_param($stmt_update, "ssssi", $objective, $about_us, $more_desc, $logoContent, $committee_ID);
                if (mysqli_stmt_execute($stmt_update)) {
                    echo "Record updated successfully";
                } else {
                    echo "Error updating record: " . mysqli_error($link);
                }
                mysqli_stmt_close($stmt_update);
            }
        } else {
            // Insert a new row
            $sql_insert = "INSERT INTO descriptions (misson, objective, more, logo, committee_ID) VALUES (?, ?, ?, ?, ?)";
            if ($stmt_insert = mysqli_prepare($link, $sql_insert)) {
                mysqli_stmt_bind_param($stmt_insert, "ssssi",$about_us ,$objective , $more_desc, $logoContent, $committee_ID);
                if (mysqli_stmt_execute($stmt_insert)) {
                    echo "New record inserted successfully";
                } else {
                    echo "Error inserting record: " . mysqli_error($link);
                }
                mysqli_stmt_close($stmt_insert);
            }
        }
        mysqli_stmt_close($stmt_check);
    } else {
        echo "ERROR: Could not prepare query: $sql_check. " . mysqli_error($link);
    }

    // Close connection
    mysqli_close($link);
    // Redirect to the desired page after form submission
    header("Location: committeepg.php?l_id=1&f_id=1");
    exit;
}
else {
    echo "Failed submission";
}
?>