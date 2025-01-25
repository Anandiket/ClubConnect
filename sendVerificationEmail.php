<?php
session_start(); // Start the session

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "committee";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


function sendVerificationEmail($email, $subject, $message) {
    $mail = new PHPMailer();
    $mail->IsSMTP();

    $mail->SMTPDebug  = 0;  
    $mail->SMTPAuth   = TRUE;
    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;
    $mail->Host       = "smtp.gmail.com";
    $mail->Username   = "clubconnect2024@gmail.com";
    $mail->Password   = "irck xtfp nlvb ylmq"; // new app password

    $mail->IsHTML(true);
    $mail->AddAddress($email, "$email");
    $mail->SetFrom("clubconnect2024@gmail.com", "Club Connect");
    $mail->Subject = $subject;
    $mail->MsgHTML($message);

    if (!$mail->Send()) {
        return "Error while sending Email to $email.";
    } else {
        return "Email sent successfully to $email.";
    }
}

// Initialize the message variable
$error = '';

// Check if email is provided
if (isset($_POST['email'])) {
    $email = $_POST['email'];

    // Check if email exists in the database
    $sql = "SELECT * FROM committees WHERE email='$email'";
    $result = $conn->query($sql);    

    // Replace with actual email addresses
    $subject = "Email Verification";
    $message = "Please click the following link to verify your email address: [verification_link]";

    $verification_link = " https://3bc1-202-177-250-26.ngrok-free.app/code/abc.php?email=" . urlencode($email);
    $personalized_message = str_replace("[verification_link]", $verification_link, $message);

    // Call the function and store the result in the message variable
    if ($result->num_rows > 0) {
        $error = sendVerificationEmail($email, $subject, $personalized_message);
    } else {
        $error = "Email address $email not found in the database.";
    }

    // Redirect to the frontend page
    header("Location: signup.php?error=" . urlencode($error));
    exit();
}

$current_date = date("Y-m-d");

// Query to get past events with pending reports
$sql = "SELECT * FROM events WHERE event_date < '$current_date' AND updated = 0";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $committee_ID = $row['committee_ID'];
        
        // Fetch the committee email
        $sql_email = "SELECT email FROM committees WHERE committee_ID = '$committee_ID'";
        $email_result = $conn->query($sql_email);
        
        if ($email_result->num_rows > 0) {
            $email_row = $email_result->fetch_assoc();
            $email = $email_row['email'];
            
            $event_name = $row['eventName'];
            $last_reminder_sent = $row['reminder_date'];
            $event_date = $row['event_date'];

            // Send an email reminder if it's the first reminder or weekly interval has passed
            if (is_null($last_reminder_sent) || (strtotime($last_reminder_sent) < strtotime('-1 week'))) {
                $subject = "Reminder: Report Required for Event - $event_name";
                $message = "The event '$event_name', which took place on $event_date, requires a report.";
                $personalized_message = $message;

                // Send email
                $email_status = sendVerificationEmail($email, $subject, $personalized_message);

                // Update the 'last_reminder_sent' field in the database
                $update_sql = "UPDATE events SET reminder_date = '$current_date' WHERE event_id = " . $row['Event_ID'];
                $conn->query($update_sql);
            }
        }
    }
}

$conn->close();

?>