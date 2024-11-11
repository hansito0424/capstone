<?php
include 'config/db.php'; 

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM devices";
    $result = $conn->query($sql);

    $devices = [];
    while ($row = $result->fetch_assoc()) {
        $devices[] = $row;
    }

    echo json_encode($devices);

} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = json_decode(file_get_contents('php://input'), true);
    $deviceName = $data['name'];

    if (!empty($deviceName)) {
        $stmt = $conn->prepare("INSERT INTO devices (name, status) VALUES (?, 'off')");
        $stmt->bind_param("s", $deviceName);

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
        $stmt = $conn->prepare("UPDATE devices SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $deviceId);

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
