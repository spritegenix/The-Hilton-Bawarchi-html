<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer autoload file
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Check if form is submitted via POST method
    // Sanitize inputs
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $message_body = htmlspecialchars($_POST['message']);

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'mail.hiltonbawarchi.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'info@hiltonbawarchi.com';
        $mail->Password   = '.*#rUMf^we0_';
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;

        // Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('info@hiltonbawarchi.com');
        $mail->addReplyTo($email, $name);

        // Content
        $mail->isHTML(false);
        $mail->Subject = 'Form submission for Query';
        $mail->Body    = "Name: $name\n\nEmail: $email\n\nPhone: $phone\n\nMessage: $message_body";

        // Send email
        $mail->send();
        echo "Mail Sent. Thank you $name, we will contact you shortly.";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Form submission not detected";
}
?>
