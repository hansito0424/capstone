<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<?php include('sidebar.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="stylesheet" href="css/settings.css">
</head>
<body>
    <div class="content">
        <h2 class="settings-heading">Settings</h2>

        <div class="settings-container">
            <div class="setting-item">
                <a href="profile.php">
                    <div class="setting-icon">
                        <img src="assets/profile2.png" alt="Profile Icon">
                    </div>
                    <h3>Profile</h3>
                    <p>Update your profile information</p>
                </a>
            </div>

            <div class="setting-item">
                <a href="account.php">
                    <div class="setting-icon">
                        <img src="assets/account2.png" alt="Account Icon">
                    </div>
                    <h3>Account</h3>
                    <p>Manage your account settings</p>
                </a>
            </div>

            <div class="setting-item">
                <a href="aboutus.php">
                    <div class="setting-icon">
                        <img src="assets/aboutus2.png" alt="About Us Icon">
                    </div>
                    <h3>About Us</h3>
                    <p>Learn more about PlantCare</p>
                </a>
            </div>
        </div>
    </div>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
/* dito banda */
        /* .content {
            
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 900px;
        } */

        .settings-heading {
    font-size: 2.5em;
    color: black;
    text-align: center; 
    margin-bottom: 30px;
    border-bottom: 2px solid #e0e0e0;
    padding-bottom: 10px;
}


        .settings-container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }

        .setting-item {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            width: 30%;
            text-align: center;
            transition: all 0.3s ease-in-out;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.05);
            cursor: pointer;
        }

        .setting-item:hover {
            background-color: #F4F4F4;
            transform: translateY(-5px);
        }

        .setting-item a {
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .setting-icon {
            margin-bottom: 15px;
        }

        .setting-icon img {
            width: 50px;
            height: 50px;
        }

        h3 {
            font-size: 1.5em;
            color: black;
        }

        p {
            font-size: 0.9em;
            color: #7F8C8D;
        }
    </style>
</body>
</html>
