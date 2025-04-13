<?php
// employees/new.php
include_once '../config.php';

// Fetch list of cities for the dropdown
$citiesQuery = "SELECT id, name FROM cities";
$citiesResult = $conn->query($citiesQuery);
$cities = $citiesResult->fetch_all(MYSQLI_ASSOC);
?>
<h2>Add New Employee</h2>
<form id="employeeForm">
    <!-- Hidden field remains empty for new records -->
    <input type="hidden" name="id" value="">
    
    <label>Name:</label><br>
    <input type="text" name="name" required><br>
    
    <label>Email:</label><br>
    <input type="email" name="email" required><br>
    
    <label>Mobile:</label><br>
    <input type="text" name="mobile" required><br>
    
    <label>City:</label><br>
    <select name="city_id" required>
        <option value="">Select City</option>
        <?php foreach($cities as $city): ?>
            <option value="<?php echo $city['id']; ?>"><?php echo htmlspecialchars($city['name']); ?></option>
        <?php endforeach; ?>
    </select><br>
    
    <label>Details:</label><br>
    <textarea name="details"></textarea><br><br>
    
    <button type="button" class="btn btn-success" onclick="saveEmployee();">Save</button>
    <button type="button" class="btn btn-danger" onclick="pageLoad('employees/index.php');">Cancel</button>
</form>
