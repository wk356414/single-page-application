<?php
include_once '../config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Employees List</title>
</head>
<body>
    <h2>Employee List</h2>
    <button type="button" class="btn btn-primary" onclick="pageLoad('employees/new.php');">Add New Employee</button>
    <button type="button" class="btn btn-primary" onclick="exportData('employees')">Export</button>
    <table id="employeeTable" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>City</th>
                <th>State</th>
                <th>Actions</th>
            </tr>
        </thead>
    </table>
    
    
    <script>
    $(document).ready(function(){
        $('#employeeTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "employees/list.php",
            "columns": [
                { "data": "name" },
                { "data": "email" },
                { "data": "mobile" },
                { "data": "city_name" },
                { "data": "state_name" },
                {
                    "data": "id",
                    "render": function(data, type, row, meta){
                        return '<a href="javascript:void(0)" onclick="pageLoad(\'employees/edit.php?id=' + data + '\')">Edit</a> | ' +
                               '<a href="javascript:void(0)" onclick="deleteRecord(\'employees\', ' + data + ')">Delete</a>';
                    }
                }
            ]
        });
    });
    </script>
</body>
</html>