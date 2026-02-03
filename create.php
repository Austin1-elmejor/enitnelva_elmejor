<?php
// FILE: create.php
header('Content-Type: application/json');
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sender = $_POST['sender'];
    $partner = $_POST['partner'];
    $email = $_POST['email'];
    
    // Generate a random 6-character ID
    $unique_id = substr(md5(uniqid(rand(), true)), 0, 6); 

    $stmt = $conn->prepare("INSERT INTO cards (unique_id, sender_name, partner_name, sender_email) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $unique_id, $sender, $partner, $email);
    
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "id" => $unique_id]);
    } else {
        echo json_encode(["status" => "error", "message" => "Database error"]);
    }
}
?>