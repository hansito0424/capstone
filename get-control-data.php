<?php
include 'config/db.php';
// Get the latest control state from the database
$sql = "SELECT relay_state FROM controldata ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo $row['relay_state'];
} else {
    echo "RELAY_OFF"; // Default state if no control data is found
}

?>
