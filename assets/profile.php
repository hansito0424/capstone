<?php include('sidebar.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings / Profile</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body> 
    <div class="heading-container">
        <h1 style="color: black;">Settings / <span>Profile</span></h1>
    </div>
    <div class="profile-container">
        <div class="profile-card">
            <div class="profile-image">
                <img src="assets/green-leaf.png" alt="Profile Picture">
            </div>
            <input type="text" class="profile-input" placeholder="Juan Tamad De la Cruz">
            <input type="email" class="profile-input" placeholder="meow@21@gmail.com">
            <div class="gender-selection">
                <label><input type="radio" name="gender" value="male" checked> Male</label>
                <label><input type="radio" name="gender" value="female"> Female</label>
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
            flex-direction: column;
            height: 100vh;
            
            justify-content: center;
            align-items: center;
            position: relative;
        }

        /* Top left heading container */
        .heading-container {
            position: absolute;
            top: 35px;
            left: 260px;
            color: #4CAF50;
        }

        h1 {
            font-size: 2em;
            font-weight: bold;
        }

        h1 span {
            font-weight: normal;
            color: #7F8C8D;
        }

        /* Profile container */
        .profile-container {
            width: 100%;
            max-width: 600px; /* Limit the width of the container */
            display: flex;
            justify-content: center;
            background-color: white;
            color: #4CAF50;
            
        }

        /* Profile card */
        .profile-card {
    background-color: white;
    border: 2px solid #006A4E;
    border-radius: 15px;
    padding: 30px;
    width: 200%;
    box-shadow: 5px 8px 0 rgba(0, 0, 0, 0.3), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    max-width: 400px;
    text-align: center;
    margin-left: 170px; /* Adjust this value as needed */
}


        /* Profile image */
        .profile-image {
            width: 100px;
            height: 100px;
            background-color: white;
            border-radius: 50%;
            margin: 0 auto 20px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 2px solid #006A4E;
        }

        .profile-image img {
            width: 100%;
            height: auto;
        }

        /* Profile input */
        .profile-input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ddd;
            background-color: #fff;
            font-size: 1em;
            color: #333;
        }

        /* Gender selection */
        .gender-selection {
            display: flex;
            justify-content: center;
            gap: 20px;
            font-size: 1em;
            color: #333;
        }

        .gender-selection label {
            display: flex;
            align-items: center;
            gap: 5px;
            cursor: pointer;
        }

        .gender-selection input[type="radio"] {
            accent-color: #4CAF50;
        }
    </style>
</body>
</html>
