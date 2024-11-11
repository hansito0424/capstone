<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
} 

?>
<?php include('sidebar.php'); ?>
<!-- <link rel="stylesheet" href="css/water_trigger.css"> Link to external stylesheet for consistency -->

<div class="content">
    <div class="devices">
        <h1 style="color: black;">Devices <button class="add-device" onclick="addDevice()">+</button></h1>
        <div class="device-grid" id="device-grid">
            <!-- Device cards will be added here dynamically -->
        </div>
    </div>
</div>

<script src="js/trigger.js"></script>

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