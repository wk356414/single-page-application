<?php
include_once '../config.php';

if (isset($_GET['id']) && isset($_GET['table'])) {
    $id    = intval($_GET['id']);
    $table = $_GET['table'];
    
    // Only allow deletion for specific modules
    $allowed = array('employees', 'cities', 'states');
    if (!in_array($table, $allowed)) {
        echo "Invalid table.";
        exit;
    }
    
    $stmt = $conn->prepare("DELETE FROM $table WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()){
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    $stmt->close();
} else {
    echo "Missing parameters.";
}
?>
