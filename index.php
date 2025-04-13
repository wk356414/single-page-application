<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Neptune Aerotech SPA</title>
    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- dataTables css -->
    <link rel="stylesheet" type="text/css" 
        href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <!-- link to custom css -->
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <!-- sidebar for module navigation -->
    <div id="sidebar">
        <ul>
            <li><a href="javascript:void(0);" onclick="pageLoad('employees/index.php');">Employees</a></li>
            <li><a href="javascript:void(0);" onclick="pageLoad('cities/index.php');">Cities</a></li>
            <li><a href="javascript:void(0);" onclick="pageLoad('states/index.php');">States</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    
    <!-- main Content area -->
    <div id="content">
        <h2>Welcome to Neptune Aerotech</h2>
        <p>Please select a module from the sidebar to begin.</p>
    </div>
    
    <!-- Custom javaScript  -->
    <script src="scripts/pageload.js"></script>
    <script src="scripts/savedata.js"></script>
    <script src="scripts/common.js"></script>
    <!-- DataTable js -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
</body>
</html>