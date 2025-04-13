<?php
include_once '../config.php';


$request = $_REQUEST;
$columns = array( 
    0 => 'e.name', 
    1 => 'e.email', 
    2 => 'e.mobile', 
    3 => 'c.name', 
    4 => 's.name' 
);


$sql = "SELECT e.id, e.name, e.email, e.mobile, c.name AS city_name, s.name AS state_name
        FROM employees e 
        LEFT JOIN cities c ON e.city_id = c.id 
        LEFT JOIN states s ON c.state_id = s.id";


if (!empty($request['search']['value'])) {
    $search = $conn->real_escape_string($request['search']['value']);
    $sql .= " WHERE (e.name LIKE '%{$search}%' OR e.email LIKE '%{$search}%' OR e.mobile LIKE '%{$search}%' OR c.name LIKE '%{$search}%' OR s.name LIKE '%{$search}%')";
}


$result = $conn->query($sql);
$totalFiltered = $result->num_rows;


if (isset($request['order'][0]['column'])) {
    $orderColumn = $columns[$request['order'][0]['column']];
    $orderDir = $request['order'][0]['dir'];
    $sql .= " ORDER BY {$orderColumn} {$orderDir}";
}


if ($request['length'] != -1) {
    $start = intval($request['start']);
    $length = intval($request['length']);
    $sql .= " LIMIT {$start}, {$length}";
}

$result = $conn->query($sql);


$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}


$totalDataResult = $conn->query("SELECT COUNT(*) as total FROM employees");
$totalDataRow = $totalDataResult->fetch_assoc();
$totalData = $totalDataRow['total'];


$response = array(
    "draw" => isset($request['draw']) ? intval($request['draw']) : 0,
    "recordsTotal" => intval($totalData),
    "recordsFiltered" => intval($totalFiltered),
    "data" => $data
);


header('Content-Type: application/json');
echo json_encode($response);
?>