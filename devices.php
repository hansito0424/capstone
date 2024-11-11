<?php
session_start(); 
include 'config/db.php'; 

header('Content-Type: application/json');

if (!isset($_SESSION['userid'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

$user_id = $_SESSION['userid']; 

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = $conn->prepare("SELECT * FROM devices WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $devices = [];
    while ($row = $result->fetch_assoc()) {
        $devices[] = $row;
    }

    echo json_encode($devices);

} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = json_decode(file_get_contents('php://input'), true);
    $deviceName = $data['name'];

    if (!empty($deviceName)) {
        $stmt = $conn->prepare("INSERT INTO devices (name, status, user_id) VALUES (?, 'off', ?)");
        $stmt->bind_param("si", $deviceName, $user_id);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Device added successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error adding device']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Device name cannot be empty']);
    }

} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);
    $deviceId = $data['id'];
    $status = $data['status'];

    if (!empty($deviceId) && !empty($status)) {
        $stmt = $conn->prepare("UPDATE devices SET status = ? WHERE id = ? AND user_id = ?");
        $stmt->bind_param("sii", $status, $deviceId, $user_id);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Device status updated']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error updating device status']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid data provided']);
    }
}
?>
