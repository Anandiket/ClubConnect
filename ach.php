<?php
session_start();

if (!isset($_SESSION['id'])) {
    echo "Committee ID not set in session.";
    exit;
}

$committee_ID = $_SESSION['committee_ID'];
$committee_ID = filter_var($committee_ID, FILTER_SANITIZE_NUMBER_INT);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["committee_ID"])) {
        $committee_ID = $_POST["committee_ID"];
    } else {
        echo "Committee ID is missing.";
        exit;
    }

    $action_type = $_POST['action_type'];
    $achievement_id = isset($_POST["achievement_id"]) ? $_POST["achievement_id"] : '';

    $servername = "localhost";
    $database_name = "committee";
    $username = "root";
    $password = "";

    $link = mysqli_connect($servername, $username, $password, $database_name);

    if (!$link) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    if ($action_type == 'update' || $action_type == 'insert') {
        $required_fields = ["name", "desc", "date", "student"];
        foreach ($required_fields as $field) {
            if (empty($_POST[$field])) {
                echo "Please fill in all the required fields.";
                exit;
            }
        }
    }

    if ($action_type == 'update') {
        $achievement_name = $_POST["name"];
        $achievement_desc = $_POST["desc"];
        $achievement_date = $_POST["date"];
        $achievement_student = $_POST["student"];

        $sql_update = "UPDATE achievements SET achievement_name = ?, achievement_desc = ?, achievements_date = ?, committee_ID = ?, achievement_student = ? WHERE achievement_ID = ?";
        if ($stmt_update = mysqli_prepare($link, $sql_update)) {
            mysqli_stmt_bind_param($stmt_update, "sssssi", $achievement_name, $achievement_desc, $achievement_date, $committee_ID, $achievement_student, $achievement_id);
            if (mysqli_stmt_execute($stmt_update)) {
                echo "Record updated successfully";

                // Handle deletion of existing photos
                if (isset($_POST["delete_photos"])) {
                    $delete_photos = $_POST["delete_photos"];
                    foreach ($delete_photos as $photo_id) {
                        $sql_delete_photo = "DELETE FROM photos WHERE photo_id = ?";
                        if ($stmt_delete_photo = mysqli_prepare($link, $sql_delete_photo)) {
                            mysqli_stmt_bind_param($stmt_delete_photo, "i", $photo_id);
                            mysqli_stmt_execute($stmt_delete_photo);
                            mysqli_stmt_close($stmt_delete_photo);
                        }
                    }
                }

                // Handle multiple file uploads
                if (isset($_FILES["achievement_photos"])) {
                    $photo_files = $_FILES["achievement_photos"]["tmp_name"];
                    foreach ($photo_files as $photo) {
                        if (!empty($photo)) {
                            $check = getimagesize($photo);
                            if ($check !== false) {
                                $achievement_photo_content = file_get_contents($photo);

                                $sql_insert_photo = "INSERT INTO photos (achievement_id, photo) VALUES (?, ?)";
                                if ($stmt_insert_photo = mysqli_prepare($link, $sql_insert_photo)) {
                                    mysqli_stmt_bind_param($stmt_insert_photo, "is", $achievement_id, $achievement_photo_content);
                                    mysqli_stmt_execute($stmt_insert_photo);
                                    mysqli_stmt_close($stmt_insert_photo);
                                }
                            } else {
                                header("Location: achievementsform.php?f_id=2&l_id=1&committee_id=$committee_ID&error=One of the files is not an image.");
                                exit;
                            }
                        }
                    }
                }
            } else {
                echo "Error updating record: " . mysqli_error($link);
            }
            mysqli_stmt_close($stmt_update);
        } else {
            echo "Error preparing update statement: " . mysqli_error($link);
        }
    } elseif ($action_type == 'delete') {
        $sql_delete = "DELETE FROM achievements WHERE achievement_ID = ?";
        if ($stmt_delete = mysqli_prepare($link, $sql_delete)) {
            mysqli_stmt_bind_param($stmt_delete, "i", $achievement_id);
            if (mysqli_stmt_execute($stmt_delete)) {
                echo "Record deleted successfully";
            } else {
                echo "Error deleting record: " . mysqli_error($link);
            }
            mysqli_stmt_close($stmt_delete);
        } else {
            echo "Error preparing delete statement: " . mysqli_error($link);
        }
    } else if ($action_type == 'insert') {
        $achievement_name = $_POST["name"];
        $achievement_desc = $_POST["desc"];
        $achievement_date = $_POST["date"];
        $achievement_student = $_POST["student"];

        $sql_insert = "INSERT INTO achievements (committee_ID, achievement_name, achievement_desc, achievements_date, achievement_student) VALUES (?, ?, ?, ?, ?)";
        if ($stmt_insert = mysqli_prepare($link, $sql_insert)) {
            mysqli_stmt_bind_param($stmt_insert, "sssss", $committee_ID, $achievement_name, $achievement_desc, $achievement_date, $achievement_student);
            if (mysqli_stmt_execute($stmt_insert)) {
                $new_achievement_id = mysqli_insert_id($link);

                // Handle multiple file uploads
                if (isset($_FILES["achievement_photos"])) {
                    $photo_files = $_FILES["achievement_photos"]["tmp_name"];
                    foreach ($photo_files as $photo) {
                        if (!empty($photo)) {
                            $check = getimagesize($photo);
                            if ($check !== false) {
                                $achievement_photo_content = file_get_contents($photo);

                                $sql_insert_photo = "INSERT INTO photos (achievement_id, photo) VALUES (?, ?)";
                                if ($stmt_insert_photo = mysqli_prepare($link, $sql_insert_photo)) {
                                    mysqli_stmt_bind_param($stmt_insert_photo, "is", $new_achievement_id, $achievement_photo_content);
                                    mysqli_stmt_execute($stmt_insert_photo);
                                    mysqli_stmt_close($stmt_insert_photo);
                                }
                            } else {
                                header("Location: achievementsform.php?f_id=2&l_id=1&committee_id=$committee_ID&error=One of the files is not an image.");
                                exit;
                            }
                        }
                    }
                }

                echo "New record inserted successfully";
            } else {
                echo "Error inserting record: " . mysqli_error($link);
            }
            mysqli_stmt_close($stmt_insert);
        } else {
            echo "Error preparing insert statement: " . mysqli_error($link);
        }
    }

    mysqli_close($link);
    header("Location: committeepg.php?l_id=1&f_id=3");
    exit;
}
?>

