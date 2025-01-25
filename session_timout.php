<?php


// Define the session timeout duration (e.g., 1800 seconds = 30 minutes)
$session_timeout = 1800; 

// Check if the last activity timestamp is set
if (isset($_SESSION['last_activity'])) {
    // Calculate the session duration
    $session_duration = time() - $_SESSION['last_activity'];

    // Check if the session has expired
    if ($session_duration > $session_timeout) {
        // Destroy the session
        session_unset();
        session_destroy();

        // Redirect to login page or any other page
        header("Location: convenorloginpage.php?l_id=1");
        exit();
    }
}

// Update the last activity timestamp
$_SESSION['last_activity'] = time();
?>
