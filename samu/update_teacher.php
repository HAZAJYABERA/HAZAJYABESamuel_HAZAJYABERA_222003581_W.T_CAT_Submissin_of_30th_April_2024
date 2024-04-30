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

// Check if Teacher_id is set
if(isset($_REQUEST['Teacher_id'])) {
    $Teacher_id = $_REQUEST['Teacher_id'];
   
    // Prepare and execute SELECT statement to retrieve teacher details
    $stmt = $connection->prepare("SELECT * FROM teachers WHERE Teacher_id = ?");
    $stmt->bind_param("i", $Teacher_id);
    $stmt->execute();
    $result = $stmt->get_result();
   
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['Teacher_id'];
        $y = $row['Teacher_name'];
        $z = $row['Email'];
        $v = $row['Contact'];
    
    } else {
        echo "Teacher not found.";
    }
}

// Handle form submission
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $Teacher_id = $_POST['Teacher_id'];
    $Teacher_name = $_POST['Teacher_name'];
    $Email = $_POST['Email'];
    $Contact = $_POST['Contact'];
    
    // Update the teacher in the database
    $stmt = $connection->prepare("UPDATE teachers SET Teacher_name=?, Email=?, Contact=? WHERE Teacher_id=?");
    $stmt->bind_param("sssi", $Teacher_name, $Email, $Contact, $Teacher_id);
    
     
        // Redirect to teacher.php after successful update
        header('Location: teacher.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating teacher: " . $stmt->error;
    }

?>

<html>
<body>
    <form method="POST">
        <label for="Teacher_id">Teacher_id:</label>
        <input type="number" name="Teacher_id" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <label for="Teacher_name">Teacher_name:</label>
        <input type="text" name="Teacher_name" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="Email">Email:</label>
        <input type="email" name="Email" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
       
        <label for="Contact">Contact:</label>
        <input type="number" name="Contact" value="<?php echo isset($v) ? $v : ''; ?>">
        <br><br>
       
        <input type="submit" name="up" value="Update">
       
    </form>
</body>
</html>
