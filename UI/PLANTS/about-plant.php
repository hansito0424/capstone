<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
include('config/db.php');
$sql = "SELECT id, name, image_url FROM plants";
$result = $conn->query($sql);
?>
<?php include('sidebar.php'); ?>
<link rel="stylesheet" href="css/about_plant.css">
<div class="content">
    <h1>Plant Library</h1>

    <div class="plant-library-container">
        <div class="plant-library">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="plant-card">';
                    echo '<img src="' . $row["image_url"] . '" alt="' . $row["name"] . '">';
                    echo '<a href="plant-details.php?id=' . $row["id"] . '">' . $row["name"] . '</a>';
                    echo '</div>';
                }
            } else {
                echo "No plants found in the database.";
            }
            ?>
        </div>
    </div>
</div>
<style>
    /* Container with dark green background */
    .plant-library-container {
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        max-height: 600px; /* Set max height */
        overflow-y: scroll; /* Scroll if content exceeds container */
    }

    /* Grid layout for flexible columns */
    .plant-library {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); /* Flexible columns based on screen size */
        grid-auto-rows: 1fr; /* Uniform row height */
        gap: 20px;
    }

    /* Plant card styling */
    .plant-card {
        background-color: lightgrey;
        padding: 10px;
        border: 1px solid green;
        text-align: center;
        border-radius: 8px;
        display: flex;
        flex-direction: column;
        align-items: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    /* Add animation effect to the plant card on hover */
    .plant-card:hover {
        transform: scale(1.05); /* Slightly enlarge the card */
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.15); /* Add shadow effect */
    }

    /* Styling for the plant image */
    .plant-card img {
        width: 100%; /* Image takes full width of the card */
        height: 200px; /* Adjust the height */
        object-fit: cover; /* Ensures the image fits and crops if necessary */
        border-radius: 8px; /* Rounded corners */
    }

    /* Plant name styling */
    .plant-card a {
        margin-top: 10px;
        text-decoration: none;
        color: black;
        font-weight: bold;
        transition: color 0.3s ease;
    }

    /* Hover effect for plant name */
    .plant-card a:hover {
        color: darkgreen;
    }

    /* Responsive for smaller screens */
    @media screen and (max-width: 768px) {
        .plant-card img {
            height: 150px; /* Smaller image height for small screens */
        }

        .plant-library {
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); /* Adjust grid columns on smaller screens */
        }
    }
</style>
