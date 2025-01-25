<?php
// Include database connection
include "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dept_id = $_POST["dept_id"];
    $action = $_POST["action"];
    $committee_ID = $_POST["committee_ID"] ?? null;

    if ($action === "insert" ) {
        // Sanitize and validate input
        $dept_id = $_POST["dept_id"];
        $committeeName = htmlspecialchars($_POST["committeeName"]);
        $convenerName = htmlspecialchars($_POST["convenerName"]);
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        $contactNo = htmlspecialchars($_POST["contactNo"]);
        $department = htmlspecialchars($_POST["department"]);

        // Prepare SQL statement to insert into committees table
        $sql_committees = "INSERT INTO committees (committeeName, convenerName, email, contactNo, department, dept_id) VALUES (?, ?, ?, ?, ?, ?)";

        // Prepare and bind parameters for committees table
        $stmt_committees = $conn->prepare($sql_committees);
        $stmt_committees->bind_param("sssssi", $committeeName, $convenerName, $email, $contactNo, $department, $dept_id);

        // Execute statement for committees table
        if ($stmt_committees->execute()) {
            // Fetch the committee ID
            $committee_ID = $stmt_committees->insert_id;

            // Prepare SQL statement to insert into users table
            $email_check_query = $conn->prepare("SELECT id FROM users WHERE email = ?");
            $email_check_query->bind_param("s", $email);
            $email_check_query->execute();
            $email_check_result = $email_check_query->get_result();

            if ($email_check_result->num_rows == 0) {
                // Email does not exist, insert into users table
                $sql_users = "INSERT INTO users (email) VALUES (?)";
                $stmt_users = $conn->prepare($sql_users);
                $stmt_users->bind_param("s", $email);
                $stmt_users->execute();
                $user_id = $stmt_users->insert_id;
                $stmt_users->close();
            } else {
                // Email exists, get the user_id
                $row = $email_check_result->fetch_assoc();
                $user_id = $row['id'];
            }

            $email_check_query->close();

            // Insert into convener table regardless
            $sql_convener = "INSERT INTO convenor (user_id, committee_ID) VALUES (?, ?)";
            $stmt_convener = $conn->prepare($sql_convener);
            $stmt_convener->bind_param("ii", $user_id, $committee_ID);
            $stmt_convener->execute();
            $stmt_convener->close();

            $conn->close();
            // Redirect upon successful insertion
            header("Location: addnew.php?l_id=2&dept_id=". $dept_id);
            exit();
        } else {
            // Handle insertion error for committees table
            echo "Error: " . $sql_committees . "<br>" . $conn->error;
        }
    }elseif ($action === "update" && $committee_ID) {
        // Sanitize and validate input
        $dept_id = $_POST["dept_id"];
        $committeeName = ($_POST["committeeName"]);
        $convenerName = ($_POST["convenerName"]);
        $email = $_POST["email"];
        $contactNo = ($_POST["contactNo"]);
        $department = ($_POST["department"]);
    
        // Fetch the current email associated with the committee_ID
        $sql_fetch_old_email = "SELECT email FROM committees WHERE committee_ID = ?";
        $stmt_fetch_old_email = $conn->prepare($sql_fetch_old_email);
        $stmt_fetch_old_email->bind_param("i", $committee_ID);
        $stmt_fetch_old_email->execute();
        $stmt_fetch_old_email->bind_result($old_email);
        $stmt_fetch_old_email->fetch();
        $stmt_fetch_old_email->close();
    
        // Check if the user exists based on the fetched old_email
        $sql_check_user = "SELECT id FROM users WHERE email = ?";
        $stmt_check_user = $conn->prepare($sql_check_user);
        $stmt_check_user->bind_param("s", $old_email);
        $stmt_check_user->execute();
        $stmt_check_user->store_result();
    
        // If user exists, bind the result to a variable
        $user_id = null;
        if ($stmt_check_user->num_rows > 0) {
            $stmt_check_user->bind_result($user_id);
            $stmt_check_user->fetch();
        }
    
        // Update the committees table
        $sql_update = "UPDATE committees SET committeeName=?, convenerName=?, email=?, contactNo=?, department=? WHERE committee_ID=?";
        $stmt_update = $conn->prepare($sql_update);
        if ($stmt_update) {
            $stmt_update->bind_param("sssssi", $committeeName, $convenerName, $email, $contactNo, $department, $committee_ID);
            if ($stmt_update->execute()) {
                echo "Committee record updated successfully.";
    
                // If the user exists, update the email in the users table
                if ($user_id) {
                    $sql_update_user = "UPDATE users SET email = ?, user_name = ? WHERE id = ?";
                    $stmt_update_user = $conn->prepare($sql_update_user);
                    $stmt_update_user->bind_param("ssi", $email, $convenerName, $user_id);
                    if ($stmt_update_user->execute()) {
                        echo "User record updated successfully.";
                    } else {
                        echo "Error updating user record: " . $stmt_update_user->error;
                    }
                    $stmt_update_user->close();
                }
            } else {
                echo "Error updating committee record: " . $stmt_update->error;
            }
            $stmt_update->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    
        $stmt_check_user->close();  
    
    } elseif ($action === "delete" && $committee_ID) {
        // Delete related data from child tables first
        $dept_id = $_POST["dept_id"];
        $sql_delete_convenor = "DELETE FROM convenor WHERE committee_ID = ?";
        $stmt_delete_convenor = $conn->prepare($sql_delete_convenor);
        $stmt_delete_convenor->bind_param("i", $committee_ID);
        $stmt_delete_convenor->execute();
        $stmt_delete_convenor->close();

        $sql_delete_events = "DELETE FROM events WHERE committee_ID = ?";
        $stmt_delete_events = $conn->prepare($sql_delete_events);
        $stmt_delete_events->bind_param("i", $committee_ID);
        $stmt_delete_events->execute();
        $stmt_delete_events->close();

        $sql_delete_achievement = "DELETE FROM achievements WHERE committee_ID = ?";
        $stmt_delete_achievement = $conn->prepare($sql_delete_achievement);
        $stmt_delete_achievement->bind_param("i", $committee_ID);
        $stmt_delete_achievement->execute();
        $stmt_delete_achievement->close();

        $sql_delete_members = "DELETE FROM members WHERE committee_ID = ?";
        $stmt_delete_members = $conn->prepare($sql_delete_members);
        $stmt_delete_members->bind_param("i", $committee_ID);
        $stmt_delete_members->execute();
        $stmt_delete_members->close();

        $sql_delete_descriptions = "DELETE FROM descriptions WHERE committee_ID = ?";
        $stmt_delete_descriptions = $conn->prepare($sql_delete_descriptions);
        $stmt_delete_descriptions->bind_param("i", $committee_ID);
        $stmt_delete_descriptions->execute();
        $stmt_delete_descriptions->close();

        // Finally, delete from the committees table
        $sql_delete_committee = "DELETE FROM committees WHERE committee_ID = ?";
        $stmt_delete_committee = $conn->prepare($sql_delete_committee);
        $stmt_delete_committee->bind_param("i", $committee_ID);

        if ($stmt_delete_committee->execute()) {
            // Deletion successful
            $stmt_delete_committee->close();
            $conn->close();
            header("Location: addnew.php?l_id=2&dept_id=" . $dept_id);
            exit();
        } else {
            // Handle deletion error for committees table
            echo "Error: " . $sql_delete_committee . "<br>" . $conn->error;
        }
    } else {
        echo "Invalid action.";
    }

    header("Location: addnew.php?l_id=2&dept_id=" . $dept_id);
}
?>