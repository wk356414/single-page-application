<?php
include_once '../config.php';
$id = $_GET['id'];
$city = $conn->query("SELECT * FROM cities WHERE id = $id")->fetch_assoc();
$states = $conn->query("SELECT id, name FROM states");
?>

<h3>Edit City</h3>
<form id="cityForm">
    <input type="hidden" name="id" value="<?= $city['id'] ?>">
    Name: <input type="text" name="name" value="<?= $city['name'] ?>" required><br>
    State:
    <select name="state_id" required>
        <option value="">Select State</option>
        <?php while($s = $states->fetch_assoc()): ?>
            <option value="<?= $s['id'] ?>" <?= ($city['state_id'] == $s['id']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($s['name']) ?>
            </option>
        <?php endwhile; ?>
    </select><br>
    Description:<br>
    <textarea name="description"><?= $city['description'] ?></textarea><br><br>
    <button type="button" class="btn btn-success" onclick="saveCity()">Update</button>
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
