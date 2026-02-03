<?php
// FILE: get_card.php
header('Content-Type: application/json');
include 'db.php';

$id = isset($_GET['id']) ? $_GET['id'] : '';

$stmt = $conn->prepare("SELECT sender_name, partner_name, sender_email FROM cards WHERE unique_id = ?");
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo json_encode($row);
} else {
    echo json_encode(["error" => "Not found"]);
}
?>