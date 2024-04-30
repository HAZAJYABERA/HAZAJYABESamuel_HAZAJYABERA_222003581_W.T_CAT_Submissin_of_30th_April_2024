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

// Check if Book_id is set
if(isset($_REQUEST['Book_id'])) {
    $Book_id = $_REQUEST['Book_id']; // Correct variable name
   
    // Prepare and execute SELECT statement to retrieve library details
    $stmt = $connection->prepare("SELECT * FROM librarys WHERE Book_id= ?");
    $stmt->bind_param("i", $Book_id);
    $stmt->execute();
    $result = $stmt->get_result();
   
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['Book_id'];
        $y = $row['Title'];
        $z = $row['Publication_year'];
        $v = $row['Author'];
    
    } else {
        echo "library not found.";
    }
}

?>

<html>
<body>
    <form method="POST">
        <label for="Book_id">Book_id:</label>
        <input type="number" name="Book_id" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <label for="Title">Title:</label>
        <input type="text" name="Title" value="<?php echo isset($y) ? $y : ''; ?>"> <!-- Corrected input type -->
        <br><br>

        <label for="Author">Author:</label>
        <input type="text" name="Author" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
       
        <label for="Publication_year">Publication_year:</label>
        <input type="date" name="Publication_year" value="<?php echo isset($v) ? $v : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
       
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $Book_id = $_POST['Book_id'];
    $Title = $_POST['Title'];
    $Publication_year= $_POST['Publication_year'];
    $Author = $_POST['Author'];
    
    // Update the library in the database
    $stmt = $connection->prepare("UPDATE librarys SET Title=?, Publication_year=?, Author=? WHERE Book_id=?");
    $stmt->bind_param("sssi", $Title, $Publication_year, $Author, $Book_id); // Corrected binding parameters
   
    if ($stmt->execute()) {
        // Redirect to library.php after successful update
        header('Location: library.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating library: " . $stmt->error;
    }
}
?>
