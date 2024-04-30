<?php
// Connection details
$host = "localhost";
$user = "samuel";
$pass = "222003581";
$database = "hazajyabera_samuel_222003581";

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if Class_id is set
if(isset($_REQUEST['Class_id'])) {
    $class_id = $_REQUEST['Class_id'];
   
    // Prepare and execute SELECT statement to retrieve class details
    $stmt = $connection->prepare("SELECT * FROM classes WHERE Class_id= ?");
    $stmt->bind_param("i", $class_id); // Corrected parameter name to lowercase
    $stmt->execute();
    $result = $stmt->get_result();
   
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['Class_id'];
        $y = $row['Class_level'];
        $z = $row['Location'];
        $v = $row['Year'];
    
    } else {
        echo "Class not found.";
    }
}

?>

<html>
<body>
    <form method="POST">
        <label for="Class_id">Class_id:</label>
        <input type="number" name="Class_id" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <label for="Class_level">Class_level:</label>
        <input type="number" name="Class_level" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="Location">Location:</label>
        <input type="text" name="Location" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
       
        <label for="Year">Year:</label>
        <input type="number" name="Year" value="<?php echo isset($v) ? $v : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
       
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $Class_id = $_POST['Class_id'];
    $Class_level = $_POST['Class_level'];
    $Location = $_POST['Location'];
    $Year = $_POST['Year'];

    // Update the class in the database
    $stmt = $connection->prepare("UPDATE classes SET Class_id = ?, Class_level = ?, Location = ?, Year = ? WHERE Class_id = ?");
    $stmt->bind_param("iisii", $Class_id, $Class_level, $Location, $Year, $Class_id);
   
    if ($stmt->execute()) {
        // Redirect to class.php after successful update
        header('Location: class.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating class: " . $stmt->error;
    }
}
?>
