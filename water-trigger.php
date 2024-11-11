<?php
include ('config/db.php');
include ('sensors.php');

include('sidebar.php');
?>
<!-- <meta http-equiv="refresh" content="5"> -->
<div class="content">
    <div class="devices">
        <h2>Devices <button class="add-device" onclick="addDevice()">+</button></h2>
        <div class="device-grid" id="device-grid"></div>
    </div>
    <div class="container" id="controlDataContainer">
    <h2>Control Data</h2>
    <div class="data-section" id="controlData">
        <?php if ($controlDataResult->num_rows > 0): ?>
            <?php $controlData = $controlDataResult->fetch_assoc(); ?>
            <div class="data-item">Relay State: <span><?php echo $controlData['relay_state']; ?></span></div>
            <div class="data-item">Last Updated: <span><?php echo $controlData['timestamp']; ?></span></div>
        <?php else: ?>
            <div>No control data available</div>
        <?php endif; ?>
    </div>
    <div class="control-buttons">
        <button onclick="controlRelay('on')">Turn Relay ON</button>
        <button onclick="controlRelay('off')">Turn Relay OFF</button>
    </div>
</div>
</div>


<script src="js/trigger.js"></script>
<script>
    window.onload = function() {
        fetchDevices(); 
    };
</script>
<script>
    function controlRelay(action) {
        const relayState = action === 'on' ? 'RELAY_ON' : 'RELAY_OFF';
        fetch('http://192.168.100.33/capstone/control-relay.php', {
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
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1,
                fill: false
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<style>
    .device-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr); 
    gap: 5px; 
}

.device-card {
    background-color: white;
    padding: 5px;
    border: 1px solid #ddd;
    text-align: center;
    border-radius: 8px;
    color: black;
    font-weight: bold;
    width: 100%; 
    height: 150px; 
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    box-sizing: border-box; 
    border: 2px solid #006A4E;
}
  
.devices {
    background-color: white;
    padding: 5px;
    border-radius: 10px;
}


.devices h1 {
    display: flex;
    align-items: center; 
    margin-bottom: 20px;
    font-weight: bold;
    gap: 10px; 
}

.add-device {
    width: 40px;
    height: 40px;
    background-color: #306754;
    color: white;
    border: none;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 20px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.add-device:hover {
    background-color: #1B8A6B;
}


.device-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
   
}

.device-card a {
    margin-top: 5px;
    text-decoration: none;
    color: white;
    font-weight: bold;
}


.device-card a:hover {
    color: #1B8A6B;
}

.switch {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 25px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: darkgray;
    transition: .4s;
    border-radius: 25px;
}

.slider:before {
    position: absolute;
    content: "";
    height: 15px;
    width: 15px;
    border-radius: 50%;
    left: 5px;
    bottom: 5px;
    background-color: white;
    transition: .4s;
}

input:checked + .slider {
    background-color: #1B8A6B;
}

input:checked + .slider:before {
    transform: translateX(25px);
}

</style>