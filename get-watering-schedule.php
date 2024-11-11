<?php
// Set scheduled watering time (24-hour format)
$watering_time = "15:30"; // Example time (HH:MM)

// Return the watering time as a JSON object
header('Content-Type: application/json');
echo json_encode(['watering_time' => $watering_time]);
?>
