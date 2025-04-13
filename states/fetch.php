<?php
include_once '../config.php';

$columns = ['name', 'description'];
$where = '';
$search = $_GET['search']['value'];

if (!empty($search)) {
    $where = " WHERE (name LIKE '%$search%' OR description LIKE '%$search%')";
}

$totalFilteredQuery = "SELECT COUNT(*) FROM states $where";
$totalFiltered = $conn->query($totalFilteredQuery)->fetch_row()[0];

$orderCol = $_GET['order'][0]['column'];
$orderDir = $_GET['order'][0]['dir'];
$orderBy = $columns[$orderCol] ?? 'name';

$start = $_GET['start'];
$length = $_GET['length'];

$dataQuery = "SELECT * FROM states $where ORDER BY $orderBy $orderDir LIMIT $start, $length";
$result = $conn->query($dataQuery);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

$totalRecords = $conn->query("SELECT COUNT(*) FROM states")->fetch_row()[0];

echo json_encode([
    "draw" => intval($_GET['draw']),
    "recordsTotal" => $totalRecords,
    "recordsFiltered" => $totalFiltered,
    "data" => $data
]);
