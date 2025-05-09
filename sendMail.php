<?php
// Import PHPMailer classes
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Use PHPMailer namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = $_POST['name'];
    $email   = $_POST['email'];
    $message = $_POST['message'];

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();                                    
        $mail->Host       = 'smtp.gmail.com';               
        $mail->SMTPAuth   = true;                            
        $mail->Username   = 'apophiaron85@gmail.com';          // <-- Your Gmail address here
        $mail->Password   = 'slpazwdglyhdjcuk';             // <-- Your Gmail App Password (not your normal password!)
        $mail->SMTPSecure = 'tls';                           
        $mail->Port       = 587;                             

        // Sender and recipient settings
        $mail->setFrom($email, $name);                       // Email from form
        $mail->addAddress('apophiaron85@gmail.com');         // Your receiving email

        // Email content
        $mail->isHTML(true);                                
        $mail->Subject = 'Message from Contact Form';
        $mail->Body    = "
            <h2>New Contact Form Message</h2>
            <p><b>Name:</b> {$name}</p>
            <p><b>Email:</b> {$email}</p>
            <p><b>Message:</b><br>{$message}</p>
        ";

        $mail->send();
        echo "Message sent successfully!";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
