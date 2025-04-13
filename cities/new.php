<?php
include_once '../config.php';
$states = $conn->query("SELECT id, name FROM states");
?>

<h3>Add New City</h3>
<form id="cityForm">
    <input type="hidden" name="id">
    Name: <input type="text" name="name" required><br>
    State: 
    <select name="state_id" required>
        <option value="">Select State</option>
        <?php while($s = $states->fetch_assoc()): ?>
            <option value="<?= $s['id'] ?>"><?= htmlspecialchars($s['name']) ?></option>
        <?php endwhile; ?>
    </select><br>
    Description:<br>
    <textarea name="description"></textarea><br><br>
    <button type="button" class="btn btn-success" onclick="saveCity()">Save</button>
    <button type="button" class="btn btn-danger" onclick="pageLoad('cities/index.php')">Cancel</button>
</form>

<script>
function saveCity() {
    $.post('cities/save.php', $('#cityForm').serialize(), function(response) {
        alert(response);
        pageLoad('cities/index.php');
    });
}
</script>
