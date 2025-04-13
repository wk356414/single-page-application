<?php
include_once '../config.php';

if (isset($_GET['table'])) {
    $table = $_GET['table'];
    $allowed = array('employees', 'cities', 'states');
    if (!in_array($table, $allowed)) {
        die("Invalid table.");
    }
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=' . $table . '.csv');
    $output = fopen('php://output', 'w');
    
    if ($table == 'employees') {
       fputcsv($output, array('Name', 'Email', 'Mobile', 'City', 'State', 'Details'));
       $query = "SELECT e.name, e.email, e.mobile, c.name AS city, s.name AS state, e.details
                 FROM employees e
                 LEFT JOIN cities c ON e.city_id = c.id
                 LEFT JOIN states s ON c.state_id = s.id";
    } elseif ($table == 'cities') {
       fputcsv($output, array('Name', 'State', 'Description'));
       $query = "SELECT c.name, s.name AS state, c.description 
                 FROM cities c 
                 LEFT JOIN states s ON c.state_id = s.id";
    } elseif ($table == 'states') {
       fputcsv($output, array('Name', 'Description'));
       $query = "SELECT name, description FROM states";
    }
    
    $result = $conn->query($query);
    while ($row = $result->fetch_assoc()){
        fputcsv($output, $row);
    }
    fclose($output);
    exit();
} else {
    echo "Table not specified.";
}
?>
