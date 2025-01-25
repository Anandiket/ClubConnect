<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the committee_ID is set in the session
    if (!isset($_SESSION['id'])) {
        echo "Committee ID not set in session.";
        exit;
    }

    // Retrieve the committee_ID from session
    $committee_id = $_SESSION['committee_ID'];

    // Validate and sanitize inputs (optional but recommended)
    $committee_id = filter_var($committee_id, FILTER_SANITIZE_NUMBER_INT);

    $action_type = $_POST['action_type'];
    $coordinator_id = isset($_POST['coordinator_id']) ? $_POST['coordinator_id'] : '';

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database_name = "committee";

    // Create connection
    $link = mysqli_connect($servername, $username, $password, $database_name);

    // Check connection
    if (!$link) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    // if ($action_type == 'update' || $action_type == 'insert') {
    //     // Validate required fields for update and insert actions
    //     $required_fields = ["coordinator_name", "coordinator_department", "email", "contact_no","photo"];
    //     foreach ($required_fields as $field) {
    //         if (empty($_POST[$field])) {
    //             header("Location: coordinatorform.php?l_id=1&committee_ID=" . urlencode($committee_id) . "&f_id=1&error=Please fill in all the required fields.");
    //             exit;
    //         }
    //     }
    // }

    // Handle different actions
    if ($action_type == 'update') {
        // Update the existing record
        $coordinator_name = htmlspecialchars($_POST["coordinator_name"]);
        $department = htmlspecialchars($_POST["coordinator_department"]);
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        $contact_no = htmlspecialchars($_POST["contact_no"]);
        $photo = isset($_FILES['photo']['tmp_name']) ? $_FILES['photo']['tmp_name'] : '';
        $imageFileType = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));

        if (!empty($photo)) {
            $check = getimagesize($photo);
            if ($check !== false) {
                $photoContent = file_get_contents($photo);
            } else {
                echo "File is not an image.";
                exit;
            }
        } else {
            // Fetch the existing photo if no new photo is uploaded
            $sql_member = "SELECT photo FROM coordinator WHERE coordinator_id = ?";
            $stmt_member = mysqli_prepare($link, $sql_member);
            mysqli_stmt_bind_param($stmt_member, "i", $coordinator_id);
            mysqli_stmt_execute($stmt_member);
            $result_member = mysqli_stmt_get_result($stmt_member);
            if ($row_member = mysqli_fetch_assoc($result_member)) {
                $photoContent = $row_member['photo'];
            }
        }

        $sql_update = "UPDATE coordinator SET coordinator_name=?, department=?, email=?, contact_no=?, photo=? WHERE coordinator_id=?";
        if ($stmt_update = mysqli_prepare($link, $sql_update)) {
            mysqli_stmt_bind_param($stmt_update, "sssssi", $coordinator_name, $department, $email, $contact_no, $photoContent, $coordinator_id);
            if (mysqli_stmt_execute($stmt_update)) {
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . mysqli_error($link);
            }
            mysqli_stmt_close($stmt_update);
        }

    } else if ($action_type == 'delete') {
        // Delete the existing record
        $sql_delete = "DELETE FROM coordinator WHERE coordinator_id=?";
        if ($stmt_delete = mysqli_prepare($link, $sql_delete)) {
            mysqli_stmt_bind_param($stmt_delete, "i", $coordinator_id);
            if (mysqli_stmt_execute($stmt_delete)) {
                echo "Record deleted successfully";
            } else {
                echo "Error deleting record: " . mysqli_error($link);
            }
            mysqli_stmt_close($stmt_delete);
        }

    } else if ($action_type == 'insert') {
        // Insert a new record
        $coordinator_name = htmlspecialchars($_POST["coordinator_name"]);
        $department = htmlspecialchars($_POST["coordinator_department"]);
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        $contact_no = htmlspecialchars($_POST["contact_no"]);
        $photo = isset($_FILES['photo']['tmp_name']) ? $_FILES['photo']['tmp_name'] : '';
        $imageFileType = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));

        if (!empty($photo)) {
            $check = getimagesize($photo);
            if ($check !== false) {
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                    header("Location: coordinatorform.php?l_id=1&committee_ID=" . urlencode($committee_id) . "&f_id=1&error=Sorry, only JPG, JPEG, PNG and GIF files are allowed.");
                    exit;
                }
                $photoContent = file_get_contents($photo);
            } else {
                header("Location: coordinatorform.php?l_id=1&committee_ID=" . urlencode($committee_id) . "&f_id=1&error=File is not an image.");
                exit;
            }
        }

        $sql_insert = "INSERT INTO coordinator (committee_id, coordinator_name, department, email, contact_no, photo) VALUES (?, ?, ?, ?, ?, ?)";
        if ($stmt_insert = mysqli_prepare($link, $sql_insert)) {
            mysqli_stmt_bind_param($stmt_insert, "isssss", $committee_id, $coordinator_name, $department, $email, $contact_no, $photoContent);
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
    header("Location: committeepg.php?l_id=1&f_id=1");
    exit;
}
?>