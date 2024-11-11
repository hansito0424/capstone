<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

?>

<?php include('sidebar.php'); ?>
<link rel="stylesheet" href="css/settings.css">
<div class="content">
    <h2 style="color: green;">Settings</h2>
 
    <div class="settings-container">
    <div class="setting-item">
        <a href="edit-profile.php"><h3>Profile</h3></a>
    </div>
    <div class="setting-item">
        <a href="account-settings.php"><h3>Account</h3></a>
    </div>
    <div class="setting-item">
        <a href="about-us.php"><h3>About Us</h3></a>
    </div>
</div>