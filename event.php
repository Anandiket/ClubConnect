<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the committee_ID is set in the session
    if (!isset($_SESSION['id'])) {
        echo "Committee ID not set in session.";
        exit;
    }

    // Retrieve the committee_ID from session
    $committee_ID = $_SESSION['committee_ID'];

    // Validate and sanitize inputs (optional but recommended)
    $committee_ID = filter_var($committee_ID, FILTER_SANITIZE_NUMBER_INT);
    $action_type = $_POST["action_type"];
    $event_id = isset($_POST["event_id"]) ? $_POST["event_id"] : null;

    // Database connection parameters
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

    if ($action_type == 'update' || $action_type == 'insert') {
        // Validate required fields for update and insert actions
        $required_fields = ["eventName", "eventDescription", "eventDate", "RpersonName", "CoordinatorName", "RpersonContact", "RpersonEmail", "academicYear", "link", "time", "venue", "type", "mode"];
        foreach ($required_fields as $field) {
            if (empty($_POST[$field])) {
                header("Location: expform.php?f_id=2&l_id=1&committee_id=$committee_ID&error=Please fill in all the required fields.");
                exit;
            }
        }
    }

    $eventName = $_POST["eventName"];
    $eventDescription = $_POST["eventDescription"];
    $eventDate = isset($_POST["eventDate"]) ? date("Y-m-d", strtotime($_POST["eventDate"])) : null;
    $RpersonName = $_POST["RpersonName"];
    $CoordinatorName = $_POST["CoordinatorName"];
    $RpersonContact = $_POST["RpersonContact"];
    $RpersonEmail = $_POST["RpersonEmail"];
    $academicYear = $_POST["academicYear"];
    $r_link = $_POST["link"];
    $time = $_POST["time"];
    $venue = $_POST["venue"];
    $type = $_POST["type"];
    $mode = $_POST["mode"];
    $photo = isset($_FILES['photo']['tmp_name']) ? $_FILES['photo']['tmp_name'] : '';

    if ($action_type === 'update' && $event_id) {
        if (!empty($photo)) {
            $check = getimagesize($photo);
            if ($check !== false) {
                $photoContent = file_get_contents($photo);
            } else {
                header("Location: expform.php?f_id=2&l_id=1&committee_id=$committee_ID&error=File is not an image.");
                exit;
            }
        } else {
            $sql_event = "SELECT photo FROM events WHERE event_id = ?";
            $stmt_event = mysqli_prepare($link, $sql_event);
            mysqli_stmt_bind_param($stmt_event, "i", $event_id);
            mysqli_stmt_execute($stmt_event);
            $result_event = mysqli_stmt_get_result($stmt_event);

            $photoContent = '';
            if ($row_event = mysqli_fetch_assoc($result_event)) {
                $photoContent = $row_event['photo'];
            }
            mysqli_stmt_close($stmt_event);
        }

        // Update the existing record
        $sql_update = "UPDATE events SET eventName = ?, RpersonName = ?, CoordinatorName = ?, RpersonContact = ?, RpersonEmail = ?, e_desc = ?, event_date = ?, academicYear = ?, time = ?, venue = ?, type = ?, mode = ?, photo = ?, link = ?, committee_ID = ? WHERE Event_ID = ?";
        if ($stmt_update = mysqli_prepare($link, $sql_update)) {
            mysqli_stmt_bind_param($stmt_update, "ssssssssssssssii", $eventName, $RpersonName, $CoordinatorName, $RpersonContact, $RpersonEmail, $eventDescription, $eventDate, $academicYear, $time, $venue, $type, $mode, $photoContent, $r_link, $committee_ID, $event_id);
            if (mysqli_stmt_execute($stmt_update)) {
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . mysqli_error($link);
            }
            mysqli_stmt_close($stmt_update);
        }
    } elseif ($action_type === 'delete' && $event_id) {

        $sql_delete_photo = "DELETE FROM photos WHERE event_id = ?";
                        if ($stmt_delete_photo = mysqli_prepare($link, $sql_delete_photo)) {
                            mysqli_stmt_bind_param($stmt_delete_photo, "i", $event_id);
                            if (mysqli_stmt_execute($stmt_delete_photo)) {
                               echo "Photo with ID $event_id deleted successfully<br>";
                            } else {
                                echo "Error deleting photo with ID $event_id: " . mysqli_error($link) . "<br>";
                            }
                            mysqli_stmt_close($stmt_delete_photo);
                        } else {
                            echo "Error preparing delete photo statement: " . mysqli_error($link) . "<br>";
                        }
        // Delete the existing record
        $sql_delete = "DELETE FROM events WHERE event_id = ?";
        if ($stmt_delete = mysqli_prepare($link, $sql_delete)) {
            mysqli_stmt_bind_param($stmt_delete, "i", $event_id);
            if (mysqli_stmt_execute($stmt_delete)) {
                echo "Record deleted successfully";
            } else {
                echo "Error deleting record: " . mysqli_error($link);
            }
            mysqli_stmt_close($stmt_delete);
        }
        

    } else {
        $photoContent = null;
        if (!empty($photo)) {
            $check = getimagesize($photo);
            if ($check !== false) {
                $photoContent = file_get_contents($photo);
            } else {
                header("Location: expform.php?f_id=2&l_id=1&committee_id=$committee_ID&error=File is not an image.");
                exit;
            }
        }

        // Insert a new record
        $sql_insert = "INSERT INTO events (eventName, RpersonName, CoordinatorName, RpersonContact, RpersonEmail, e_desc, event_date, academicYear, time, venue, type, mode, photo, link, committee_ID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        if ($stmt_insert = mysqli_prepare($link, $sql_insert)) {
            mysqli_stmt_bind_param($stmt_insert, "ssssssssssssssi", $eventName, $RpersonName, $CoordinatorName, $RpersonContact, $RpersonEmail, $eventDescription, $eventDate, $academicYear, $time, $venue, $type, $mode, $photoContent, $r_link, $committee_ID);
            if (mysqli_stmt_execute($stmt_insert)) {
                echo "New record inserted successfully";
            } else {
                echo "Error inserting record: " . mysqli_error($link);
            }
            mysqli_stmt_close($stmt_insert);
        }
    }

    // Close connection
    mysqli_close($link);

    // Redirect to the desired page after form submission
    header("Location: committeepg.php?f_id=2&l_id=1");
    exit;
}
