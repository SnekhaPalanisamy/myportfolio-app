<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

// Allow CORS for local Angular app
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, OPTIONS");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

$data = json_decode(file_get_contents("php://input"));

$name = htmlspecialchars($data->name);
$email = htmlspecialchars($data->email);
$message = htmlspecialchars($data->message);

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // Gmail SMTP server
    $mail->SMTPAuth = true;
  $mail->Username = getenv('MAIL_USERNAME');
  $mail->Password = getenv('MAIL_PASSWORD');  // Your Gmail App Password
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

  $mail->setFrom(getenv('MAIL_FROM') ?: $email, 'Contact Form');
  $mail->addAddress(getenv('MAIL_TO') ?: 'default@example.com'); // Your destination email
    $mail->addReplyTo($email, $name);

    $mail->isHTML(false);
    $mail->Subject = "New Portfolio Contact Form Submission from $name";
    $mail->Body    = "Name: $name\nEmail: $email\n\nMessage:\n$message";

    $mail->send();
    echo json_encode(['message' => 'Email sent successfully']);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => "Mailer Error: {$mail->ErrorInfo}"]);
}
?>
