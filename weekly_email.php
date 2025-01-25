<?php
/*
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

// Connect to your database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "committee";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get committee_ID from the session
$committee_ID = $_SESSION['committee_ID']; 

// Get email of the convenor from the committees table
$email_query = "SELECT email FROM committees WHERE committee_ID='$committee_ID'";
$email_result = $conn->query($email_query);
if ($email_result->num_rows > 0) {
    $email_row = $email_result->fetch_assoc();
    $email = $email_row['email'];

    // Check if there are events past the date without a report created
    $current_date = date('Y-m-d');
    $event_query = "SELECT * FROM events WHERE committee_ID='$committee_ID' AND event_date < '$current_date' AND updated = 0";
    $event_result = $conn->query($event_query);

    if ($event_result->num_rows > 0) {
        // Email exists, generate verification link and send email
        $verification_link = "https://grouper-ample-labrador.ngrok-free.app/code/abc.php?email=" . urlencode($email); // Change this URL to your verification page
        $message = "Please click the following link to create the event report: " . $verification_link;
        $subject = "Event Report Reminder";
        
        $mail = new PHPMailer();
        $mail->IsSMTP();

        $mail->SMTPDebug  = 0;  
        $mail->SMTPAuth   = TRUE;
        $mail->SMTPSecure = "tls";
        $mail->Port       = 587;
        $mail->Host       = "smtp.gmail.com";
        $mail->Username   = "clubconnect2024@gmail.com";
        $mail->Password   = "irck xtfp nlvb ylmq"; // App password

        $mail->IsHTML(true);
        $mail->AddAddress($email, "$email");
        $mail->SetFrom("clubconnect2024@gmail.com", "Club Connect");
        $mail->Subject = $subject;
        $content = $message;

        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Reminder email sent to: " . $email;
        }
    }
}

$conn->close();
*/
?>
