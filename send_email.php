<?php
// send_email.php

// 1. Load PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

header('Content-Type: application/json');

// 2. Get Data
$data = json_decode(file_get_contents('php://input'), true);

// If running directly in browser for testing, use fake data
if (!$data) {
    $to_email = "abj7teen@gmail.com"; 
    $creator_name = "Test User";
    $partner_name = "Someone"; // Default for testing
} else {
    $to_email = $data['email'];
    $creator_name = $data['name'];
    $partner_name = isset($data['partner']) ? $data['partner'] : "Someone"; // Use partner name if available
}

$mail = new PHPMailer(true);

try {
    // 3. SERVER SETTINGS
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;   // Enable this line if you need deep debugging
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    
    // 👇👇 YOUR GMAIL CREDENTIALS 👇👇
    $mail->Username   = 'yesido698955@gmail.com'; 
    $mail->Password   = 'bppy dsyb svma pyuz'; 
    // 👆👆 YOUR GMAIL CREDENTIALS 👆👆

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // 🔴 FIX FOR LOCALHOST (Bypasses SSL Certificate Check)
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    // 4. RECIPIENTS
    $mail->setFrom('no-reply@lovelink.com', 'Lovelink Bot 💘');
    $mail->addAddress($to_email);

    // 5. CONTENT
    $mail->isHTML(true);
    
    // Dynamic Subject Line
    $mail->Subject = "$partner_name said YES! 💖";
    
    // Dynamic Body
    $mail->Body    = "
        <div style='font-family: Arial, sans-serif; text-align: center; padding: 20px; background-color: #fce4ec;'>
            <h1 style='color: #d81b60;'>YAY! $partner_name said YES! 🎉</h1>
            <p style='font-size: 18px;'>Hey <strong>$creator_name</strong>,</p>
            <p style='font-size: 18px;'>Your Valentine <strong>$partner_name</strong> just accepted your invite!</p>
            <br>
            <p>Go buy those flowers! 🌹</p>
        </div>
    ";

    $mail->send();
    echo json_encode(["status" => "success", "message" => "Email has been sent"]);

} catch (Exception $e) {
    echo json_encode([
        "status" => "error", 
        "message" => "Mailer Error: {$mail->ErrorInfo}"
    ]);
}
?>