<?php
include_once '../config.php';

if (empty($_POST['name'])) {
    die("State name is required.");
}

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$name = trim($_POST['name']);
$description = trim($_POST['description']);

if ($id > 0) {
    $stmt = $conn->prepare("UPDATE states SET name=?, description=? WHERE id=?");
    $stmt->bind_param("ssi", $name, $description, $id);
    if($stmt->execute()) {
        echo "State updated successfully!";
    } else {
        echo "Error updating state: " . $conn->error;
    }
    $stmt->close();
} else {
    $stmt = $conn->prepare("INSERT INTO states (name, description) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $description);
    if($stmt->execute()) {
        echo "State added successfully!";
    } else {
        echo "Error adding state: " . $conn->error;
    }
    $stmt->close();
}
?>
