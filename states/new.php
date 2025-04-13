<h3>Add New State</h3>
<form id="stateForm">
    <input type="hidden" name="id">
    Name: <input type="text" name="name" required><br>
    Description:<br>
    <textarea name="description"></textarea><br><br>
    <button class="btn btn-success" type="button" onclick="saveState()">Save</button>
    <button class="btn btn-danger" type="button" onclick="pageLoad('states/index.php')">Cancel</button>
</form>

<script>
function saveState() {
    $.post('states/save.php', $('#stateForm').serialize(), function(response) {
        alert(response);
        pageLoad('states/index.php');
    });
}
</script>
