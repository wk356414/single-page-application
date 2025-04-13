<?php
include_once '../config.php';
$id = intval($_GET['id']);
$data = $conn->query("SELECT * FROM states WHERE id = $id")->fetch_assoc();
?>

<h3>Edit State</h3>
<form id="stateForm">
    <input type="hidden" name="id" value="<?= $data['id'] ?>">
    Name: <input type="text" name="name" value="<?= htmlspecialchars($data['name']) ?>" required><br>
    Description:<br>
    <textarea name="description"><?= htmlspecialchars($data['description']) ?></textarea><br><br>
    <button class="btn btn-success" type="button" onclick="saveState()">Update</button>
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
