<?php
session_start();
include 'config/db.php';

if (!isset($_SESSION['userid'])) {
    header('Location: login.php'); // Redirect to login if not logged in
    exit();
}

$userId = $_SESSION['userid'];

// Fetch current user data
$sql = "SELECT firstname, middlename, lastname, sex, username FROM users WHERE id = '$userId'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = $conn->real_escape_string($_POST['fname']);
    $mname = $conn->real_escape_string($_POST['mname']);
    $lname = $conn->real_escape_string($_POST['lname']);
    $sex = $conn->real_escape_string($_POST['sex']);
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // Update user data
    $sql = "UPDATE users SET firstname='$fname', middlename='$mname', lastname='$lname', sex='$sex', username='$username'";
    if (!empty($password)) {
        $sql .= ", password='$password'";
    }
    $sql .= " WHERE id='$userId'";

    if ($conn->query($sql) === TRUE) {
        echo "Profile updated successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body> 
    <div class="heading-container">
        <h1 style="color: black;">Update <span>Profile</span></h1>
    </div>
    <div class="profile-container">
        <div class="profile-card">
            <div class="profile-image">
                <img src="assets/green-leaf.png" alt="Profile Picture">
            </div>
            <form action="profile.php" method="POST">
                <input type="text" class="profile-input" name="fname" value="<?php echo htmlspecialchars($user['firstname']); ?>" required>
                <input type="text" class="profile-input" name="mname" value="<?php echo htmlspecialchars($user['middlename']); ?>">
                <input type="text" class="profile-input" name="lname" value="<?php echo htmlspecialchars($user['lastname']); ?>" required>
                <div class="gender-selection">
                    <label><input type="radio" name="sex" value="Male" <?php echo ($user['sex'] == 'Male') ? 'checked' : ''; ?>> Male</label>
                    <label><input type="radio" name="sex" value="Female" <?php echo ($user['sex'] == 'Female') ? 'checked' : ''; ?>> Female</label>
                </div>
                <input type="text" class="profile-input" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                <input type="password" class="profile-input" name="password" placeholder="New Password (leave blank to keep current)">
                <button type="submit">Update Profile</button>
            </form>
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

        .profile-container {
            width: 100%;
            max-width: 600px; 
            display: flex;
            justify-content: center;
            background-color: white;
            color: #4CAF50;
        }

        .profile-card {
            background-color: white;
            border: 2px solid #006A4E;
            border-radius: 15px;
            padding: 30px;
            width: 100%;
            box-shadow: 5px 8px 0 rgba(0, 0, 0, 0.3), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            max-width: 400px;
            text-align: center;
        }

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

        .profile-card button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .profile-card button:hover {
            background-color: #45a049;
        }
    </style>
</body>
</html>
