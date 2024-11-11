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
        <h1>Devices <button class="add-device" onclick="addDevice()">+</button></h1>
        <div class="device-grid" id="device-grid">
            <!-- Device cards will be added here dynamically -->
        </div>
    </div>
</div>

<script src="js/trigger.js"></script>

<style>
    /* Grid layout for devices */
    .device-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* Fixed 3 columns */
    gap: 5px; /* Reduced gap between items */
}

/* Square device card styling */
.device-card {
    background-color: green;
    padding: 5px;
    border: 1px solid #ddd;
    text-align: center;
    border-radius: 8px;
    color: white;
    font-weight: bold;
    width: 100%; /* Make card width responsive */
    height: 150px; /* Fixed height for square aspect ratio */
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    box-sizing: border-box; /* Include padding and border in the element's total width and height */
}
   /* Container with white background and rounded corners */
.devices {
    background-color: white;
    padding: 5px;
    border-radius: 10px;
}

/* Heading style */
.devices h1 {
    display: flex;
    align-items: center; /* Align items vertically */
    margin-bottom: 20px;
    font-weight: bold;
    gap: 10px; /* Space between heading text and button */
}

/* Circular add device button styling */
.add-device {
    width: 40px;
    height: 40px;
    background-color: green;
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
    background-color: yellowgreen;
}

/* Grid layout for devices */
.device-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
   
}

/* Device name styling */
.device-card a {
    margin-top: 5px;
    text-decoration: none;
    color: white;
    font-weight: bold;
}

/* Hover effect for device name */
.device-card a:hover {
    color: yellowgreen;
}

/* Light switch styling */
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
    background-color: yellowgreen;
}

input:checked + .slider:before {
    transform: translateX(25px);
}

</style>