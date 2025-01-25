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
    $member_id = isset($_POST['member_id']) ? $_POST['member_id'] : '';

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

    // Define validation function for required fields
    function validate_required_fields($fields) {
        foreach ($fields as $field) {
            if (empty($_POST[$field])) {
                header("Location: memberform.php?f_id=2&l_id=1&committee_id=$committee_ID&error=Please fill in all the required fields.");
                exit;
            }
        }
    }

    if ($action_type == 'update' || $action_type == 'insert') {
        // Validate required fields for update and insert actions
        $required_fields = ["member_name", "department", "year", "division", "position","role", "tenure_year", "contact_no"];
        validate_required_fields($required_fields);
    }

    if ($action_type == 'update') {
        // Update the existing record
        $member_name = $_POST["member_name"];
        $department = $_POST["department"];
        $year = $_POST["year"];
        $division = $_POST["division"];
        $position = $_POST["position"];
        $role = $_POST["role"];
        $tenure_year = htmlspecialchars($_POST["tenure_year"]);
        $contact_no = htmlspecialchars($_POST["contact_no"]);
        $photo = isset($_FILES['photo']['tmp_name']) ? $_FILES['photo']['tmp_name'] : '';
        $imageFileType = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));

        if (!empty($photo)) {
            $check = getimagesize($photo);
            if ($check !== false) {
                $photoContent = file_get_contents($photo);
            } else {
                header("Location: memberform.php?f_id=2&l_id=1&committee_id=$committee_ID&error=File is not an image.");
                exit;
            }
        } else {
            // SQL query to select member details including photo
            $sql_member = "SELECT photo FROM members WHERE member_id = ?";
            $stmt_member = mysqli_prepare($link, $sql_member);
            mysqli_stmt_bind_param($stmt_member, "i", $member_id);
            mysqli_stmt_execute($stmt_member);
            $result_member = mysqli_stmt_get_result($stmt_member);
            if ($row_member = mysqli_fetch_assoc($result_member)) {
                $photoContent = $row_member['photo'];
            } else {
                $photoContent = null;
            }
        }

        $sql_update = "UPDATE members SET member_name=?, department=?, year=?, division=?, position=?, role=?, contact_no=?, tenure_year=?, photo=? WHERE member_id=?";
        if ($stmt_update = mysqli_prepare($link, $sql_update)) {
            mysqli_stmt_bind_param($stmt_update, "sssssssssi", $member_name, $department, $year, $division, $position, $role, $contact_no, $tenure_year, $photoContent, $member_id);
            if (mysqli_stmt_execute($stmt_update)) {
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . mysqli_error($link);
            }
            mysqli_stmt_close($stmt_update);
        }

    } else if ($action_type == 'delete') {
        // Delete the existing record
        $sql_delete = "DELETE FROM members WHERE member_id=?";
        if ($stmt_delete = mysqli_prepare($link, $sql_delete)) {
            mysqli_stmt_bind_param($stmt_delete, "i", $member_id);
            if (mysqli_stmt_execute($stmt_delete)) {
                echo "Record deleted successfully";
            } else {
                echo "Error deleting record: " . mysqli_error($link);
            }
            mysqli_stmt_close($stmt_delete);
        }

    } else if ($action_type == 'insert') {
        // Insert a new record
        $member_name = $_POST["member_name"];
        $department = $_POST["department"];
        $year = $_POST["year"];
        $division = $_POST["division"];
        $position = $_POST["position"];
        $role = $_POST["role"];
        $tenure_year = htmlspecialchars($_POST["tenure_year"]);
        $contact_no = htmlspecialchars($_POST["contact_no"]);
        $photo = isset($_FILES['photo']['tmp_name']) ? $_FILES['photo']['tmp_name'] : '';
        $imageFileType = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));

        if (!empty($photo)) {
            $check = getimagesize($photo);
            if ($check !== false) {
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                    header("Location: memberform.php?l_id=1&committee_ID=" . urlencode($committee_id) . "&f_id=4&error=Sorry, only JPG, JPEG, PNG and GIF files are allowed.");
                    exit;
                }
                $photoContent = file_get_contents($photo);
            } else {
                header("Location: memberform.php?l_id=1&committee_ID=" . urlencode($committee_id) . "&f_id=4&error=File is not an image.");
                exit;
            }
        } else {
            $photoContent = null;
        }

        $sql_insert = "INSERT INTO members (committee_id, member_name, department, year, division, position, role, contact_no, tenure_year, photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        if ($stmt_insert = mysqli_prepare($link, $sql_insert)) {
            mysqli_stmt_bind_param($stmt_insert, "ssssssssss", $committee_id, $member_name, $department, $year, $division, $position,$role, $contact_no, $tenure_year, $photoContent);
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
    header("Location: committeepg.php?l_id=1&f_id=4");
    exit;
}
?>
