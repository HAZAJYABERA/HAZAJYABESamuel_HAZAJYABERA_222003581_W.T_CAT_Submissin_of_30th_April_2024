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

// Check if Payment_id is set
if(isset($_REQUEST['Payment_id'])) {
    $cid = $_REQUEST['Payment_id'];
   
    // Prepare and execute SELECT statement to retrieve payments details
    $stmt = $connection->prepare("SELECT * FROM payments WHERE  Payment_id = ?");
    $stmt->bind_param("i", $Payment_id);
    $stmt->execute();
    $result = $stmt->get_result();
   
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['Payment_id'];
        $y = $row['Stu_id'];
        $z = $row['Payment_date'];
        $v = $row['Payment_amaunt'];
    
    } else {
        echo "payment not found.";
    }
}

?>

<html>
<body>
    <form method="POST">
        <label for="Payment_id">Payment_id:</label>
        <input type="number" name="Payment_id" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <label for="Stu_id">Stu_id:</label>
        <input type="number" name="Stu_id" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="Payment_date">Payment_date:</label>
        <input type="date" name="Payment_date" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
       
        <label for="Payment_amaunt">Payment_amaunt:</label>
        <input type="number" name="Payment_amaunt" value="<?php echo isset($v) ? $v : ''; ?>">
        <br><br>
       

       
        <input type="submit" name="up" value="Update">
       
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $Payment_id = $_POST['Payment_id'];
    $Stu_id = $_POST['Stu_id'];
    $Payment_date = $_POST['Payment_date'];
    $Payment_amaunt = $_POST['Payment_amaunt'];
    

    // Update the payment in the database
    $stmt = $connection->prepare("UPDATE students SET Student_name=?, Email=?, Telephone=?, Gender=? WHERE Stu_id=?");
    $stmt->bind_param("ssssi", $Student_name, $Email, $Telephone, $Gender, $Stu_id);
   
    if ($stmt->execute()) {
        // Redirect to payment.php after successful update
        header('Location: payment.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating payment: " . $stmt->error;
    }
}
?>
