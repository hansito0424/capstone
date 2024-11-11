<?php
include 'config/db.php';

// Get the relay state from the request
$relayState = isset($_POST['relayState']) ? $_POST['relayState'] : null;

// Get the current relay state from the database
$sql = "SELECT relay_state FROM controldata ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($row) {
    // Update the relay state only if it has changed
    if ($row['relay_state'] != $relayState) {
        $stmt = $conn->prepare("INSERT INTO controldata (relay_state) VALUES (?)");
        $stmt->bind_param("s", $relayState);
        $stmt->execute();
        $stmt->close();
        echo "Relay state updated to: " . $relayState;
    } else {
        echo "No change in relay state.";
    }
} else {
    // If there's no existing state, insert the new one
    $stmt = $conn->prepare("INSERT INTO controldata (relay_state) VALUES (?)");
    $stmt->bind_param("s", $relayState);
    $stmt->execute();
    $stmt->close();
    echo "Relay state set to: " . $relayState;
}

$conn->close();
?>
