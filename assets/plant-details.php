<?php
include('config/db.php');
$plant_id = $_GET['id'];

// Query to get plant details
$sql = "SELECT * FROM plants WHERE id = $plant_id";
$result = $conn->query($sql);

// Check if plant exists
if ($result->num_rows > 0) {
    $plant = $result->fetch_assoc();
} else {
    echo "Plant not found.";
    exit;
}
?>
<?php include('sidebar.php'); ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $plant['name']; ?>Details</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
    .plant-details-container {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-top: 20px;
    }

    .plant-details-left {
        display: flex;
        flex-direction: column;
    }

    .plant-details-img {
        width: 250px;
        height: 520px;
        object-fit: cover;
        border-radius: 10px;
        margin-top: -20px;
    }

    .plant-info p {
        margin-top: 20px;
        margin-bottom: 0;
    }

    .plant-info h2 {
        color: #006A4E;
        margin-bottom: 20px;
    }

    .plant-info p {
        margin-top: 0;
    }

    .plant-stats {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        gap: 20px;
        margin-top: 90px;
    }

    .stat-box {
        background-image: linear-gradient(to bottom right, #00CC33, #1B8A6B);
        box-shadow: 5px 8px 0 rgba(0, 0, 0, 0.3), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        padding: 20px;
        border-radius: 10px;
        flex-grow: 1;
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease; /* Smooth animation */
    }

    /* Animation on hover */
    /* .stat-box:hover {
        transform: scale(1.05); Slightly enlarges the stat box
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3); Adds a stronger shadow effect
    } */

    .stat-box h3 {
        color: white;
        margin-bottom: 10px;
    }

    .stat-box p {
        color: #333;
    }

    /* Responsive Design */
    @media only screen and (max-width: 768px) {
        .plant-details-container {
            flex-direction: column;
        }

        .plant-stats {
            flex-direction: column;
        }
    }
</style>

</head>
<body>
    <div class="content">
        <h1 style="color: black;">Plant Details</h1>
        <div class="plant-details-container">
            <div class="plant-details-left">
                <img src="<?php echo $plant['image_url']; ?>" alt="<?php echo $plant['name']; ?>" class="plant-details-img">
            </div>
            <div class="plant-info">
                <h2><?php echo $plant['name']; ?></h2>
                <p><strong>Details:</strong> <?php echo $plant['details']; ?></p>
                <div class="plant-stats">
                    <div class="stat-box">
                        <h3>Water Schedule</h3>
                        <p><?php echo $plant['water_schedule']; ?></p>
                    </div>
                    <div class="stat-box">
                        <h3>Fertilizer</h3>
                        <p><?php echo $plant['fertilizer']; ?></p>
                    </div>
                    <div class="stat-box">
                        <h3>Humidity</h3>
                        <p><?php echo $plant['humidity']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
