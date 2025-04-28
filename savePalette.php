<?php
include 'connect.php';
session_start();

header('Content-Type: application/json');

$_POST = json_decode(file_get_contents('php://input'), true);

// Make sure user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Not logged in']);
    exit;
}

$user_id = $_SESSION['user_id'];
$palette = json_encode($_POST['palette']); // array to JSON string

$stmt = $conn->prepare("INSERT INTO palettes (user_id, palette) VALUES (?, ?)");
$stmt->bind_param("is", $user_id, $palette);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Palette saved']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Database error']);
}
?>