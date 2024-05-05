<?php

//fetching data from the contact form
$firstname = $_POST["name"];
$email_address =  $_POST["email"];
$subject = $_POST["subject"];
$text_message =  $_POST["message"];


// Include PHPMailer autoload file
require_once 'phpmailer/src/Exception.php';
require_once 'phpmailer/src/PHPMailer.php';
require_once 'phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Create a new PHPMailer instance
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP(); // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->Username = 'odongogavan@gmail.com';// SMTP username  
    //$mail->Password = 'ymunnfzdxezgxply'; // SMTP password
    $mail->Password = 'xkdtncbrxmfzlqmf'; // SMTP password
    $mail->SMTPSecure = 'ssl';
    //$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port = 465; // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    // Recipients   

    $mail->setFrom('odongogavan@gmail.com'); // Sender's email and name
    $mail->addAddress($email_address); // Add a recipient

    // Content
    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body = $text_message;

    // Send email
    if ($mail->send()) {
        echo '
        <script>
        Alert("Email sent successfully");
        window.location.href="index.html";
        </script>';

    } else {
        echo 'Email sending failed. Error: ' . $mail->ErrorInfo;
    }
} catch (Exception $e) {
    echo "Email sending failed. Error: {$mail->ErrorInfo}";
}
?>
