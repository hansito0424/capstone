<?php
include('config/db.php');
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$sensorDataQuery = "SELECT temperature, humidity, soil_moisture, pir_state, timestamp FROM sensordata ORDER BY id DESC LIMIT 1";
$sensorDataResult = $conn->query($sensorDataQuery);

// Fetch the latest control data
$controlDataQuery = "SELECT relay_state, timestamp FROM controldata ORDER BY id DESC LIMIT 1";
$controlDataResult = $conn->query($controlDataQuery);

// Fetch temperature data for the chart
$temperatureDataQuery = "SELECT temperature, timestamp FROM sensordata ORDER BY timestamp ASC";
$temperatureDataResult = $conn->query($temperatureDataQuery);

$temperatures = [];
$timestamps = [];

// Collect temperature data for the chart
while ($row = $temperatureDataResult->fetch_assoc()) {
    $temperatures[] = $row['temperature'];
    $timestamps[] = $row['timestamp'];
}

// Convert timestamps to DateTime objects for filtering
$dateTimeObjects = array_map(function($timestamp) {
    return new DateTime($timestamp);
}, $timestamps);

// Filter timestamps for one-hour intervals
$filteredTemperatures = [];
$filteredTimestamps = [];
$lastTimestamp = null;

foreach ($dateTimeObjects as $index => $dateTime) {
    if ($lastTimestamp === null || $dateTime->diff($lastTimestamp)->h >= 1) {
        $filteredTemperatures[] = $temperatures[$index];
        $filteredTimestamps[] = $dateTime->format('Y-m-d H:i'); // Format as desired
        $lastTimestamp = $dateTime;
    }
}

// Close the database connection
