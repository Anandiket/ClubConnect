<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

   


    if (!isset($_SESSION['committee_ID'])) {
        echo "Committee ID not set in session.";
        exit;
    }

    $committee_ID = $_SESSION['committee_ID'];
    $committee_ID = filter_var($committee_ID, FILTER_SANITIZE_NUMBER_INT);
    $action_type = $_POST["action_type"];
    $event_id = isset($_POST["event_id"]) ? $_POST["event_id"] : null;

    $servername = "localhost";
    $database_name = "committee";
    $username = "root";
    $password = "";

    $link = mysqli_connect($servername, $username, $password, $database_name);
    if (!$link) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
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

    if ($action_type === 'update' && $event_id) {
        $sql_update = "UPDATE events SET eventName = ?, RpersonName = ?, CoordinatorName = ?, RpersonContact = ?, RpersonEmail = ?, e_desc = ?, event_date = ?, academicYear = ?, time = ?, venue = ?, type = ?, mode = ?, link = ?, committee_ID = ? WHERE Event_ID = ?";
        if ($stmt_update = mysqli_prepare($link, $sql_update)) {
            mysqli_stmt_bind_param($stmt_update, "sssssssssssssii", $eventName, $RpersonName, $CoordinatorName, $RpersonContact, $RpersonEmail, $eventDescription, $eventDate, $academicYear, $time, $venue, $type, $mode, $r_link, $committee_ID, $event_id);
            if (mysqli_stmt_execute($stmt_update)) {
                echo "Record updated successfully<br>";
            } else {
                echo "Error updating record: " . mysqli_error($link) . "<br>";
            }
            mysqli_stmt_close($stmt_update);
        } else {
            echo "Error preparing update statement: " . mysqli_error($link) . "<br>";
        }
    } elseif ($action_type === 'delete' && $event_id) {
        $sql_delete = "DELETE FROM events WHERE Event_ID = ?";
        if ($stmt_delete = mysqli_prepare($link, $sql_delete)) {
            mysqli_stmt_bind_param($stmt_delete, "i", $event_id);
            if (mysqli_stmt_execute($stmt_delete)) {
                echo "Record deleted successfully<br>";
            } else {
                echo "Error deleting record: " . mysqli_error($link) . "<br>";
            }
            mysqli_stmt_close($stmt_delete);
        } else {
            echo "Error preparing delete statement: " . mysqli_error($link) . "<br>";
        }
    } elseif ($action_type === 'past' && $event_id) {
        $duration = $_POST["duration"];
        $beneficiary = $_POST["beneficiary"];
        $no_students = $_POST["no_students"];
        $no_faculty = $_POST["no_faculty"];
        $summary = $_POST["summary"];
    
        $sql_update_past = "UPDATE events SET duration = ?, updated = 1, beneficiary = ?, no_students = ?, no_faculty = ?, summary = ? WHERE Event_ID = ?";
        if ($stmt_update_past = mysqli_prepare($link, $sql_update_past)) {
            mysqli_stmt_bind_param($stmt_update_past, "ssiisi", $duration, $beneficiary, $no_students, $no_faculty, $summary, $event_id);
            if (mysqli_stmt_execute($stmt_update_past)) {
                echo "Past event data updated successfully<br>";
    
                // Handle deletion of existing photos
                if (isset($_POST["delete_photos"])) {
                    $delete_photos = $_POST["delete_photos"];
                    foreach ($delete_photos as $photo_id) {
                        $sql_delete_photo = "DELETE FROM photos WHERE photo_id = ?";
                        if ($stmt_delete_photo = mysqli_prepare($link, $sql_delete_photo)) {
                            mysqli_stmt_bind_param($stmt_delete_photo, "i", $photo_id);
                            if (mysqli_stmt_execute($stmt_delete_photo)) {
                                echo "Photo with ID $photo_id deleted successfully<br>";
                            } else {
                                echo "Error deleting photo with ID $photo_id: " . mysqli_error($link) . "<br>";
                            }
                            mysqli_stmt_close($stmt_delete_photo);
                        } else {
                            echo "Error preparing delete photo statement: " . mysqli_error($link) . "<br>";
                        }
                    }
                }
    
                // Handle multiple file uploads
                if (isset($_FILES["event_photos"])) {
                    $photo_files = $_FILES["event_photos"]["tmp_name"];
                    $photo_count = count($photo_files);
    
                    for ($i = 0; $i < $photo_count; $i++) {
                        if (!empty($photo_files[$i])) {
                            $check = getimagesize($photo_files[$i]);
                            if ($check !== false) {
                                $photoContent = file_get_contents($photo_files[$i]);
    
                                $sql_insert_photo = "INSERT INTO photos (event_id, photo) VALUES (?, ?)";
                                if ($stmt_insert_photos = mysqli_prepare($link, $sql_insert_photo)) {
                                    mysqli_stmt_bind_param($stmt_insert_photos, "is", $event_id, $photoContent);
                                    if (mysqli_stmt_execute($stmt_insert_photos)) {
                                        echo "Photo $i uploaded successfully for event ID $event_id<br>";
                                    } else {
                                        echo "Error inserting photo $i: " . mysqli_error($link) . "<br>";
                                    }
                                    mysqli_stmt_close($stmt_insert_photos);
                                } else {
                                    echo "Error preparing insert photo statement for photo $i: " . mysqli_error($link) . "<br>";
                                }
                            } else {
                                echo "One of the files is not an image. Photo $i is invalid.<br>";
                                header("Location: past_eventform.php?f_id=2&l_id=1&committee_id=$committee_ID&error=One of the files is not an image.");
                                exit;
                            }
                        }
                    }
                } else {
                    echo "No photos uploaded.<br>";
                }
            } else {
                echo "Error updating past data: " . mysqli_error($link) . "<br>";
            }
            mysqli_stmt_close($stmt_update_past);
        } else {
            echo "Error preparing update statement: " . mysqli_error($link) . "<br>";
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Assume these values are coming from your form
        $label = $_POST['title']; // make sure this is set correctly
        $content = $_POST['content']; // your array of others
        
           
    
            if (!empty($label) && !empty($content)) {
                $sql_insert = "INSERT INTO others (event_id, label, content) VALUES (?, ?, ?)";
        if ($stmt_insert = mysqli_prepare($link, $sql_insert)) {
            mysqli_stmt_bind_param($stmt_insert, "iss", $event_id, $label, $content);
            if (mysqli_stmt_execute($stmt_insert)) {
                echo "New record inserted successfully";
            } else {
                echo "Error inserting record: " . mysqli_error($link);
            }
            mysqli_stmt_close($stmt_insert);
        }
        }
    
    }
    

    mysqli_close($link);
    header("Location: committeepg.php?f_id=2&l_id=1");
    exit;
}
?>
