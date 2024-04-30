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

// Check if id is set
if(isset($_REQUEST['id'])) {
    $cid = $_REQUEST['id'];
   
    // Prepare and execute SELECT statement to retrieve user details
    $stmt = $connection->prepare("SELECT * FROM user WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
   
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['id'];
        $y = $row['username'];
        $z = $row['password'];
        $v = $row['first_name'];
        $w = $row['last_name'];
        $s = $row['email'];
        $t = $row['gender'];
    } else {
        echo "user not found.";
    }
}

?>

<html>
<body>
    <form method="POST">
        <label for="id">id:</label>
        <input type="number" name="id" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <label for="username">username:</label>
        <input type="text" name="username" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="password">password:</label>
        <input type="number" name="password" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
       
        <label for="first_name">first_name:</label>
        <input type="text" name="first_name" value="<?php echo isset($v) ? $v : ''; ?>">
        <br><br>
       
        <label for="last_name">last_name:</label>
        <input type="text" name="last_name" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>
        <label for="email">email:</label>
        <input type="email" name="email" value="<?php echo isset($s) ? $s : ''; ?>">
        <br><br>
       <label for="gender">gender:</label>
        <input type="text" name="gender" value="<?php echo isset($s) ? $s : ''; ?>">
        <br><br>
       
        <input type="submit" name="up" value="Update">
       
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];

    // Update the user in the database
    $stmt = $connection->prepare("UPDATE user SET username=?, password=?, first_name=?, last_name=?, email=?, gender=? WHERE id=?");
    $stmt->bind_param("ssssssi", $username, $password, $first_name, $last_name, $email, $id, $gender);
   
    if ($stmt->execute()) {
        // Redirect to user.php after successful update
        header('Location: user.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating student: " . $stmt->error;
    }
}
?>
