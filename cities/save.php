<?php
include_once '../config.php';

// Simple validation
if (empty($_POST['name']) || empty($_POST['state_id'])) {
    die("City name and State selection are required.");
}

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$name = trim($_POST['name']);
$state_id = intval($_POST['state_id']);
$description = trim($_POST['description']);

// Check if state_id exists
$stateCheck = $conn->query("SELECT id FROM states WHERE id = $state_id");
if ($stateCheck->num_rows == 0) {
    die("Invalid State selected. Please choose a valid state.");
}

// Insert or Update
if ($id > 0) {
    $stmt = $conn->prepare("UPDATE cities SET name=?, state_id=?, description=? WHERE id=?");
    $stmt->bind_param("sisi", $name, $state_id, $description, $id);
    if($stmt->execute()) {
        echo "City updated successfully!";
    } else {
        echo "Error updating city: " . $conn->error;
    }
    $stmt->close();
} else {
    $stmt = $conn->prepare("INSERT INTO cities (name, state_id, description) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $name, $state_id, $description);
    if($stmt->execute()) {
        echo "City added successfully!";
    } else {
        echo "Error adding city: " . $conn->error;
    }
    $stmt->close();
}
?>
