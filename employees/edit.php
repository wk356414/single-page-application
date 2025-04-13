<?php
include_once '../config.php';

if (!isset($_GET['id'])) {
    echo "Employee ID not provided.";
    exit;
}

$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM employees WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$employee = $result->fetch_assoc();
$stmt->close();

if (!$employee) {
    echo "Employee not found.";
    exit;
}

// Fetch list of cities for the dropdown
$citiesQuery = "SELECT id, name FROM cities";
$citiesResult = $conn->query($citiesQuery);
$cities = $citiesResult->fetch_all(MYSQLI_ASSOC);
?>
<h2>Edit Employee</h2>
<form id="employeeForm">
    <!-- Pass employee id for updating -->
    <input type="hidden" name="id" value="<?php echo $employee['id']; ?>">
    
    <label>Name:</label><br>
    <input type="text" name="name" required value="<?php echo htmlspecialchars($employee['name']); ?>"><br>
    
    <label>Email:</label><br>
    <input type="email" name="email" required value="<?php echo htmlspecialchars($employee['email']); ?>"><br>
    
    <label>Mobile:</label><br>
    <input type="text" name="mobile" required value="<?php echo htmlspecialchars($employee['mobile']); ?>"><br>
    
    <label>City:</label><br>
    <select name="city_id" required>
        <option value="">Select City</option>
        <?php foreach($cities as $city): ?>
            <option value="<?php echo $city['id']; ?>" <?php if($employee['city_id'] == $city['id']) echo 'selected'; ?>>
                <?php echo htmlspecialchars($city['name']); ?>
            </option>
        <?php endforeach; ?>
    </select><br>
    
    <label>Details:</label><br>
    <textarea name="details"><?php echo htmlspecialchars($employee['details']); ?></textarea><br><br>
    
    <button type="button" onclick="saveEmployee();">Update</button>
    <button type="button" onclick="pageLoad('employees/index.php');">Cancel</button>
</form>
