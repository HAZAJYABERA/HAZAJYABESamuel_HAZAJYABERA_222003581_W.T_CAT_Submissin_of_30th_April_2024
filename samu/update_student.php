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

// Check if Stu_id is set
if(isset($_REQUEST['Stu_id'])) {
    $cid = $_REQUEST['Stu_id'];
   
    // Prepare and execute SELECT statement to retrieve students details
    $stmt = $connection->prepare("SELECT * FROM students WHERE Stu_id = ?");
    $stmt->bind_param("i", $Stu_id);
    $stmt->execute();
    $result = $stmt->get_result();
   
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['Stu_id'];
        $y = $row['Student_name'];
        $z = $row['Email'];
        $v = $row['Telephone'];
        $w = $row['Gender'];
    } else {
        echo "student not found.";
    }
}

?>

<html>
<body>
    <form method="POST">
        <label for="Stu_id">Stu_id:</label>
        <input type="number" name="Stu_id" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <label for="Student_name">Student_name:</label>
        <input type="text" name="Student_name" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="Email">Email:</label>
        <input type="email" name="Email" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
       
        <label for="Telephone">Telephone:</label>
        <input type="number" name="Telephone" value="<?php echo isset($v) ? $v : ''; ?>">
        <br><br>
       
        <label for="Gender">Gender:</label>
        <input type="text" name="Gender" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>
       
        <input type="submit" name="up" value="Update">
       
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $Stu_id = $_POST['Stu_id'];
    $Student_name = $_POST['Student_name'];
    $Email = $_POST['Email'];
    $Telephone = $_POST['Telephone'];
    $Gender = $_POST['Gender'];

    // Update the student in the database
    $stmt = $connection->prepare("UPDATE students SET Student_name=?, Email=?, Telephone=?, Gender=? WHERE Stu_id=?");
    $stmt->bind_param("ssssi", $Student_name, $Email, $Telephone, $Gender, $Stu_id);
   
    if ($stmt->execute()) {
        // Redirect to student.php after successful update
        header('Location: student.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating student: " . $stmt->error;
    }
}
?>
