<?php
include_once '../config.php';

$columns = ['c.name', 's.name', 'c.description'];
$sql = "FROM cities c LEFT JOIN states s ON c.state_id = s.id";

$search = $_GET['search']['value'];
$where = '';
if (!empty($search)) {
    $where = " WHERE (c.name LIKE '%$search%' OR s.name LIKE '%$search%')";
}

$totalFilteredQuery = "SELECT COUNT(*) $sql $where";
$totalFiltered = $conn->query($totalFilteredQuery)->fetch_row()[0];

$orderCol = $_GET['order'][0]['column'];
$orderDir = $_GET['order'][0]['dir'];
$orderBy = $columns[$orderCol] ?? 'c.name';

$start = $_GET['start'];
$length = $_GET['length'];

$dataQuery = "SELECT c.id, c.name, s.name AS state_name, c.description 
              $sql $where ORDER BY $orderBy $orderDir LIMIT $start, $length";
$result = $conn->query($dataQuery);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

$totalQuery = "SELECT COUNT(*) FROM cities";
$totalRecords = $conn->query($totalQuery)->fetch_row()[0];

echo json_encode([
    "draw" => intval($_GET['draw']),
    "recordsTotal" => $totalRecords,
    "recordsFiltered" => $totalFiltered,
    "data" => $data
]);
?>
