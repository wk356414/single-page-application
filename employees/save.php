<?php
include_once '../config.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

function checkDuplicateError($e) {
    if ($e->getCode() === 1062) {
        $msg = $e->getMessage();
        if (strpos($msg, 'email') !== false) {
            echo "Error: The email address is already in use.";
        } elseif (strpos($msg, 'mobile') !== false) {
            echo "Error: The mobile number is already in use.";
        } else {
            echo "Error: Duplicate entry detected.";
        }
        exit;
    }
}

try {
    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['mobile']) || empty($_POST['city_id'])) {
        die("All fields are required. Please complete the form.");
    }
    
    $id       = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $mobile   = trim($_POST['mobile']);
    $city_id  = intval($_POST['city_id']);
    $details  = trim($_POST['details']);
    
    if ($id > 0) {
        // Update existing employee
        $stmt = $conn->prepare("UPDATE employees SET name = ?, email = ?, mobile = ?, city_id = ?, details = ? WHERE id = ?");
        $stmt->bind_param("sssisi", $name, $email, $mobile, $city_id, $details, $id);
        $stmt->execute();
        echo "Employee updated successfully!";
        $stmt->close();
    } else {
        // Insert new employee
        $stmt = $conn->prepare("INSERT INTO employees (name, email, mobile, city_id, details) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssis", $name, $email, $mobile, $city_id, $details);
        $stmt->execute();
        echo "Employee added successfully!";
        $stmt->close();
    }
} catch (mysqli_sql_exception $e) {
    checkDuplicateError($e);
    echo "Error: " . $e->getMessage();
    exit;
}
?>