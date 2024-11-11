<?php
include('config/db.php');
include('sensors.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="5">
    <title>Smart Plant Monitoring System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            color: black;
        }
        .row {
            color: black;
            text-align: center;
            width: 100%; /* Ensure the header is full width */
        }
        .main-container {
            display: flex; /* Use flexbox for the main container */
            justify-content: space-between; /* Space between containers */
            width: 100%; /* Full width for the main container */
            max-width: 1200px; /* Limit max width */
        }
        .sensor-data-container {
            background-color: #006A4E;
            display: flex;
            flex-direction: column; /* Stack sensor data vertically */
            width: 70%; /* Adjust width to occupy space */
            margin-right: 10px; /* Add space between containers */
        }
        .container, .temp {
            background: white;
            color: #006A4E;
            border: #006A4E solid;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 20px;
            margin: 10px 0; /* Adjust margin for vertical stacking */
            width: 100%; /* Full width */
        }
        .container{
            background-color: #006A4E;
        }
        .data-section {
            display: flex;
            justify-content: space-around;
            color: black;
        }
        .data-item {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 20px;
            margin: 10px;
            width: 30%;
            text-align: center;
        }
        .data-item h3 {
            margin-bottom: 10px;
            font-size: 1.5em;
        }
        .data-item span {
            font-size: 1.2em;
            color: black;
        }
        .notification-container {
            background: #006A4E; /* Light red background */
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 15px;
            margin: 10px; /* Adjust margin */
            width: 250px; /* Fixed width */
            max-height: 400px; /* Max height */
            overflow-y: auto; /* Scroll if content overflows */
        }
        .notification {
            background-color: #006A4E;
            color: black;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #f5c6cb;
            border-radius: 4px;
        }
        canvas {
            width: 100% !important; /* Full width for chart */
            height: 300px !important; /* Fixed height for chart */
        }
    </style>
</head>
<body>

<?php include('sidebar.php'); ?>

<div class="row">
    <h1>Smart Plant Monitoring System</h1>
</div>

<div class="content">

<div class="main-container"> <!-- Main container for flex layout -->
    <div class="sensor-data-container"> <!-- Separate container for sensor data and chart -->
        <div class="container" id="sensorDataContainer">
            <h2>Sensor Data</h2>
            <div class="data-section" id="sensorData">
                <?php if ($sensorDataResult->num_rows > 0): ?>
                    <?php $sensorData = $sensorDataResult->fetch_assoc(); ?>
                    <div class="data-item">
                        <h3>Soil Moisture</h3>
                        <span><?php echo $sensorData['soil_moisture']; ?> %</span>
                    </div>
                    <div class="data-item">
                        <h3>Humidity</h3>
                        <span><?php echo $sensorData['humidity']; ?> %</span>
                    </div>
                    <div class="data-item">
                        <h3>Temperature</h3>
                        <span><?php echo $sensorData['temperature']; ?> °C</span>
                    </div>
                    <div class="data-item">
                        <h3>Last Updated</h3>
                        <span><?php echo $sensorData['timestamp']; ?></span>
                    </div>
                <?php else: ?>
                    <div>No sensor data available</div>
                <?php endif; ?>
            </div>
        </div>

        <div class="temp" id="chartContainer">
            <h2>Temperature Over Time</h2>
            <canvas id="temperatureChart"></canvas>
        </div>
    </div>

    <!-- Notification Container -->
    <div class="notification-container" id="notificationContainer">
        <h2>Notifications</h2>
        <div class="notification">Relay turned on</div>
        <div class="notification">Relay turned off</div>
        <div class="notification">Sensor data updated</div>
        <div class="notification">Low soil moisture detected</div>
        <div class="notification">Temperature is above normal</div>
    </div>
</div>




<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function controlRelay(action) {
        const relayState = action === 'on' ? 'RELAY_ON' : 'RELAY_OFF';
        fetch('http:/192.168.100.52/capstone/control-relay.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'relayState=' + relayState
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            location.reload(); // Refresh the page to get updated data
        });
    }

    // Prepare data for the chart
    const temperatures = <?php echo json_encode($filteredTemperatures); ?>;
    const timestamps = <?php echo json_encode($filteredTimestamps); ?>;

    const ctx = document.getElementById('temperatureChart').getContext('2d');
    const temperatureChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: timestamps,
            datasets: [{
                label: 'Temperature',
                data: temperatures,
                borderColor: '#006A4E',
                borderWidth: 1,
                fill: false
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: 'black' // Change y-axis text color to black
                    }
                },
                x: {
                    ticks: {
                        color: 'black' // Change x-axis text color to black
                    }
                }
            },
            plugins: {
                legend: {
                    labels: {
                        color: 'black' // Change legend text color to black
                    }
                }
            }
        }
    });
</script>

</body>
</html>
