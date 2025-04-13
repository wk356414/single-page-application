<h2>States</h2>
<button class="btn btn-primary" onclick="pageLoad('states/new.php')">Add New State</button>
<button type="button" class="btn btn-primary" onclick="exportData('states')">Export</button>
<br><br>
<table id="stateTable" class="display" style="width:100%">
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
</table>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function () {
    $('#stateTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "states/fetch.php",
        "columns": [
            { "data": "name" },
            { "data": "description" },
            { 
                "data": "id",
                "render": function (data) {
                    return `
                        <button class="btn btn-primary" onclick="pageLoad('states/edit.php?id=${data}')">Edit</button>
                        <button class="btn btn-danger" onclick="deleteRecord('states', ${data})">Delete</button>
                    `;
                }
            }
        ]
    });
});
</script>
