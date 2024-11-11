<?php include('sidebar.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings / Account</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body> 
    <div class="heading-container">
        <h1 style="color: black;">Settings / <span>Account</span></h1>
    </div>
    <div class="account-container">
        <h2>Account</h2>
        <input type="email" class="account-input" placeholder="meow21@gmail.com" >
        <input type="password" class="account-input" placeholder="Password" >
        
        <h2>Forgot Password?</h2>
        <input type="password" class="account-input" placeholder="Change Password">
        <input type="password" class="account-input" placeholder="Confirm Password">
        <button class="save-button">Save</button>
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
            background-color: white;
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

        /* Account container */
        .account-container {
            background-color: white;
            border: 2px solid #006A4E;
            margin-left: 170px;
            border-radius: 15px;
            padding: 30px;
            width: 100%;
            max-width: 400px;
            /* box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); */
            box-shadow: 5px 8px 0 rgba(0, 0, 0, 0.3), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            text-align: center;
        }

        h2 {
            font-size: 1.5em;
            color: black;
            margin-bottom: 15px;
        }

        /* Account input */
        .account-input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ddd;
            background-color: #fff;
            font-size: 1em;
            color: #333;
        }

        /* Save button */
        .save-button {
            width: 100%;
            padding: 10px;
            background-color: #006A4E;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
        }

        .save-button:hover {
            background-color: #45A049;
        }
    </style>
</body>
</html>
