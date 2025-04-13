<h2>Cities</h2>
<button class="btn btn-primary" onclick="pageLoad('cities/new.php')">Add New City</button>
<button type="button" class="btn btn-primary" onclick="exportData('cities')">Export</button>
<br><br>

<table id="cityTable" class="display" style="width:100%">
    <thead>
        <tr>
            <th>Name</th>
            <th>State</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
</table>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function () {
    $('#cityTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "cities/fetch.php",
        "columns": [
            { "data": "name" },
            { "data": "state_name" },
            { "data": "description" },
            { 
                "data": "id",
                "render": function (data) {
                    return `
                        <button class="btn btn-primary" onclick="pageLoad('cities/edit.php?id=${data}')">Edit</button>
                        <button class="btn btn-danger" onclick="deleteRecord('cities', ${data})">Delete</button>
                    `;
                }
            }
        ]
    });
});
</script>
