<?php

// //require 'mail.php';
// use PHPMailer\PHPMailer\PHPMailer;
//   use PHPMailer\PHPMailer\Exception;
//   require 'Exception.php';
//   require 'PHPMailer.php';
//   require 'SMTP.php';

// // Check if email is provided
// if(isset($_POST['email'])) {
//     $email = $_POST['email'];
     
    
//     // Connect to your database
//     $servername = "localhost";
//     $username = "root";
//     $password = "";
//     $dbname = "committee";

//     $conn = new mysqli($servername, $username, $password, $dbname);

//     // Check connection
//     if ($conn->connect_error) {
//         die("Connection failed: " . $conn->connect_error);
//     }

//     // Check if email exists in the database
//     $sql = "SELECT * FROM committees WHERE email='$email'";
//     $result = $conn->query($sql);
//     $conveynorname = "SELECT convenerName FROM committees WHERE email='$email'";
//     if ($result->num_rows > 0) {
//         // Email exists, generate verification link and send email
//         $verification_link = "http://localhost/Code/reset_page.php?email=" . urlencode($email);  // Change this URL to your verification page
//         $message = "Please click the following link to reset you password: " . $verification_link;
//         $subject = "Reset Password";
//         $headers = "From: clubconnect2024@gmail.com\r\n"; // Replace with your Gmail address
        
//         $mail = new PHPMailer();
//         $mail->IsSMTP();

//         $mail->SMTPDebug  = 0;  
//         $mail->SMTPAuth   = TRUE;
//         $mail->SMTPSecure = "tls";
//         $mail->Port       = 587;
//         $mail->Host       = "smtp.gmail.com";
//         //$mail->Host       = "smtp.mail.yahoo.com";
//         $mail->Username   = "clubconnect2024@gmail.com";
//         $mail->Password   = "irck xtfp nlvb ylmq";//new app password

//         $mail->IsHTML(true);
//         $mail->AddAddress($email, "$email");
//         $mail->SetFrom("clubconnect2024@gmmail.com", "Club Connect");
//         //$mail->AddReplyTo("reply-to-email", "reply-to-name");
//         //$mail->AddCC("cc-recipient-email", "cc-recipient-name");
//         $mail->Subject = $subject;
//         $content = $message;

//         $mail->MsgHTML($content); 
//         if(!$mail->Send()) {
//             header("Location: reset.php?error=Error while sending Email.");
//             //echo "<pre>";
//             //var_dump($mail);
//             return false;
//         } else {
//             header("Location: reset.php?error=Email sent successfully");
//             return true;
//         }
//         // Send email
//         if($mail->Send()) {
//         echo "Email sent successfully to $email";
//         } else {
//         header("Location: reset.php?error=Failed to send an email");
//         exit();
//          }  
// } else {
//         // Email does not exist in the database
//         header("Location: reset.php?error=Email address not found");
//         exit();
//     }

//     $conn->close();
// } else {
//     // Redirect if email is not provided
//     header("Location: reset.php?error=Email address is required");
//     exit();
// }


?>
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

// Check if email is provided
if(isset($_POST['email'])) {
    $email = $_POST['email'];
     
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

    // Check if email exists in the database
    $sql = "SELECT * FROM committees WHERE email='$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // Email exists, generate verification link and send email
        $verification_link = " https://delicate-close-oyster.ngrok-free.app/code/reset_page.php?email=" . urlencode($email);  // Change this URL to your verification page
        $message = "Please click the following link to reset your password: " . $verification_link;
        $subject = "Reset Password";
        
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;  
        $mail->SMTPAuth = TRUE;
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;
        $mail->Host = "smtp.gmail.com";
        $mail->Username = "clubconnect2024@gmail.com";
        $mail->Password = "irck xtfp nlvb ylmq"; // new app password

        $mail->IsHTML(true);
        $mail->AddAddress($email, "$email");
        $mail->SetFrom("clubconnect2024@gmail.com", "Club Connect");
        $mail->Subject = $subject;
        $mail->MsgHTML($message); 

        if(!$mail->Send()) {
            header("Location: reset.php?error=Error while sending Email.");
            return false;
        } else {
            header("Location: reset.php?error=Email sent successfully");
            return true;
        }
    } else {
        // Email does not exist in the database
        header("Location: reset.php?error=Email address not found");
        exit();
    }

    $conn->close();
} else {
    // Redirect if email is not provided
    header("Location: reset.php?error=Email address is required");
    exit();
}
?>
