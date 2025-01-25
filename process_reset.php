<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Include your database connection file
    include 'db_connection.php';

    // Retrieve the form data
    $email = $_POST['email'];
    $hashed_email = urlencode($email);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Input validation
    if (empty($password) || empty($confirm_password)) {
        header("Location: reset_page.php?error=All fields are required&email=" . ($hashed_email));
        exit();
    }
    if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $password)) {
        header("Location: reset_page.php?error=Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character&email=" . ($hashed_email));
        exit();
    }
    if ($password !== $confirm_password) {
        header("Location: reset_page.php?error=Passwords do not match&email=" . ($hashed_email));
        exit();
    }

    // Hash the new password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Prepare SQL statement to update the password
    $sql = "UPDATE users SET password = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        header("Location: welcome1.php?error=Error preparing statement&email=" . ($hashed_email));
        exit();
    }

    $stmt->bind_param("ss", $password, $email);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: welcome1.php?message=Password has been reset successfully");
    } else {
        header("Location: reset_page.php?error=Error updating password&email=" . ($hashed_email));
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    header("Location: reset_page.php?error=Invalid request method");
    exit();
}
?>
