<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load PHPMailer library
        // require APPPATH . 'application\libraries\phpmailer\vendor\autoload.php';
        require_once APPPATH . 'libraries/phpmailer/vendor/autoload.php';
    }
    public function test_email_send() {
        $receiver_email = 'itseley09@gmail.com';
        $receiver_name = 'Lorenz Angelooo';
        $subject = 'FAMCO RETAIL';
        $body = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>' . $subject . '</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    padding: 20px;
                }
                .container {
                    max-width: 1000px;
                    margin: 0 auto;
                    background-color: #fff;
                    padding: 20px;
                    border-radius: 5px;
                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                }
                h1 {
                    color: #007bff;
                    display: flex; /* Make the container a flexbox */
                    align-items: center; /* Center content vertically */
                }
                img {
                    width: 50px; /* Adjust the width of the image */
                    margin-right: 10px; /* Add some space between the image and text */
                }
                p {
                    color: #666;
                }
            </style>
        </head>
        <body>
            <div class="container">
            <h1>' . $subject . '</h1>

                <p>Hello, ' . $receiver_name . ',</p>
                <p>This is the body of the email from FAMCO RETAIL.</p>
                <p>You can customize this email template as needed.</p>
            </div>
        </body>
        </html>
        ';
        
    
        $this->email_send($receiver_email, $receiver_name, $subject, $body);
    }
    

    public function email_send($receiver_email, $receiver_name, $subject, $body) {
        // Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;  // Enable verbose debug output
            $mail->isSMTP();                        // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';   // Set the SMTP server to send through
            $mail->SMTPAuth   = true;               // Enable SMTP authentication
            $mail->Username   = 'bpanmh.online@gmail.com';  // SMTP username
            $mail->Password   = 'mahvzdymnyxtfqct';          // SMTP password
            $mail->SMTPSecure = 'tls';              // Enable TLS encryption
            $mail->Port       = 587;                // TCP port to connect to

            // Recipients
            $mail->setFrom('bpanmh.online@gmail.com', 'Famco Test Temporary');
            $mail->addAddress($receiver_email, $receiver_name);

            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->AltBody = $body;

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }



}



