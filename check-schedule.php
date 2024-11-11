<?php
include('config/db.php');

date_default_timezone_set('Asia/Manila'); // Set your timezone

$currentDay = date('l'); // Get current day (e.g., "Monday")
$currentTime = date('H:i:s'); // Get current time in HH:MM:SS format

// Query to check if there's a schedule matching the current day and time
$query = "SELECT * FROM watering_schedule WHERE scheduled_day = '$currentDay' AND scheduled_time = '$currentTime'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Retrieve the schedule data
    $schedule = $result->fetch_assoc();
    $relayState = $schedule['action'] === 'ON' ? 'RELAY_ON' : 'RELAY_OFF';

    // Trigger relay action
    $relayControlUrl = 'http://192.168.100.33/capstone/control-relay.php';
    $data = http_build_query(array('relayState' => $relayState));

    // Use cURL to make POST request to control relay
    $ch = curl_init($relayControlUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    $response = curl_exec($ch);
    curl_close($ch);

    echo "Relay action ($relayState) triggered based on schedule.";
} else {
    echo "No scheduled action at this time.";
}
?>
