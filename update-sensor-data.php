<?php
include 'config/db.php';

// Get sensor data from the request
$temperature = isset($_POST['temperature']) ? $_POST['temperature'] : null;
$humidity = isset($_POST['humidity']) ? $_POST['humidity'] : null;
$soilMoisture = isset($_POST['soilMoisture']) ? $_POST['soilMoisture'] : null;
$pirState = isset($_POST['pirState']) ? $_POST['pirState'] : null;

// Get the current data from the database
$sql = "SELECT * FROM sensordata ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// Check for changes before updating
$shouldUpdate = false;

if ($row) {
    // Compare the current data with the new data
    if ($row['temperature'] != $temperature || 
        $row['humidity'] != $humidity || 
        $row['soil_moisture'] != $soilMoisture || 
        $row['pir_state'] != $pirState) {
        $shouldUpdate = true;
    }
}

if ($shouldUpdate) {
    // Insert new sensor data into the database
    $stmt = $conn->prepare("INSERT INTO sensordata (temperature, humidity, soil_moisture, pir_state) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ddds", $temperature, $humidity, $soilMoisture, $pirState);
    $stmt->execute();
    $stmt->close();
    echo "Data updated successfully.";
} else {
    echo "No changes detected. Data not updated.";
}

?>
