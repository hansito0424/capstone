<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<?php include('sidebar.php'); ?>

<div class="content">
    <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
    <p>Here you can add information about the plant.</p>
</div>