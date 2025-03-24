<?php
require __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function send_email($to, $subject, $body) {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP(); // Use SMTP
        $mail->Host = 'smtp.gmail.com'; // SMTP server (e.g., Gmail)
        $mail->Port = 587; // Port for TLS
        $mail->SMTPSecure = 'tls'; // Encryption
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'noreply.elearningapp@gmail.com'; // Your email address
        $mail->Password = 'qskdmcqphyzmxvpu'; // Your email password or app password

        // Recipients
        $mail->setFrom('noreply.elearningapp@gmail.com', 'Roy Medical'); // Sender email and name
        $mail->addAddress($to); // Recipient email

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = $subject; // Email subject
        $mail->Body = $body; // Email body

        // SMTP options
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => false
            )
        );

        // Send email
        if ($mail->send()) {
            return true; // Email sent successfully
        } else {
            return false; // Failed to send email
        }
    } catch (Exception $e) {
        error_log("Email sending failed: " . $mail->ErrorInfo);
        return false;
    }
}
?>