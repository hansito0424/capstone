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
    <h1 style="color: black;">Plant Library</h1>

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
    .plant-library-container {
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        max-height: 600px; 
        overflow-y: scroll; 
    }

    .plant-library {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); 
        grid-auto-rows: 1fr; 
        gap: 20px;
    }

   
    .plant-card {
        background-color: lightgray;
        padding: 10px;
        border: 1px solid green;
        text-align: center;
        border-radius: 8px;
        display: flex;
        flex-direction: column;
        align-items: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .plant-card:hover {
        transform: scale(1.05); 
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.15); 
    }

    .plant-card img {
        width: 100%; 
        height: 200px; 
        object-fit: cover; 
        border-radius: 8px; 
    }

    .plant-card a {
        margin-top: 10px;
        text-decoration: none;
        color: black;
        font-weight: bold;
        transition: color 0.3s ease;
    }

    .plant-card a:hover {
        color: darkgreen;
    }

    @media screen and (max-width: 768px) {
        .plant-card img {
            height: 150px; 
        }

        .plant-library {
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); 
        }
    }
</style>
