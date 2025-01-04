<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer autoload file
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

if (isset($_POST['submit'])) { // Check if form is submitted
    // Sanitize inputs
    $name = htmlspecialchars($_POST['name1']);
    $email = htmlspecialchars($_POST['email1']);
    $phone = htmlspecialchars($_POST['phone1']);
    $persons = htmlspecialchars($_POST['persons1']);
    $date = htmlspecialchars($_POST['datepicker']);
    $time = htmlspecialchars($_POST['time1']);

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'mail.hiltonbawarchi.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'info@hiltonbawarchi.com';
        $mail->Password = '.*#rUMf^we0_';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        // Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('info@hiltonbawarchi.com');
        $mail->addReplyTo($email, $name);

        // Content
        $mail->isHTML(false);
        $mail->Subject = 'Form submission For Booking';
        $mail->Body = "Name: $name\n\nEmail: $email\n\nPhone: $phone\n\nNo. of Persons: $persons\n\nReservation Date: $date\n\nReservation Time: $time";

        // Send email to the recipient
        $mail->send();

        // Reset the recipients for the second email
       $mail->clearAddresses(); // Clear recipient addresses
    $mail->clearReplyTos(); // Clear reply-to addresses
    $mail->clearCCs(); // Clear CC addresses
    $mail->clearBCCs(); // Clear BCC addresses
    $mail->Subject = ''; // Clear subject
    $mail->Body = ''; // Clear body
    $mail->AltBody = ''; // Clear alternative body

    // Reset other settings as needed

    // Now set up the second email
    $mail->setFrom('info@hiltonbawarchi.com', 'Hilton Bawarchi');
    $mail->addAddress($email, $name);
    $mail->isHTML(false);
    $mail->Subject = 'Thank you for your reservation';
    $mail->Body = "Dear $name,\n\nThank you for your reservation. You ave reserved a table on $date at $time for $persons. ";

    // Send email to the sender
    $mail->send();

    echo "Mail Sent. Thank you $name,  
You have reserved a Table, please check your mail for table details. If you haven't received the confirmation email in your inbox check inside spam folder or junk emails, we sincerely apologize for any inconvenience caused. Please feel free to contact us via email or phone at your earliest convenience. ";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
} else {
    echo "Form submission not detected";
}
?>