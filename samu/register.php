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

// Handling POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieving form data
    $fname  = $_POST['fname'];
    $lname = $_POST['lname'];
    $username = $_POST['username'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
     // Preparing SQL query
    $sql = "INSERT INTO user (first_name, last_name, username, gender, email, password) 
    VALUES ('$fname','$lname','$username','$gender','$email','$password')"; // added missing single quote here                                   
    // Executing SQL query
    if ($connection->query($sql) === TRUE){
        // Redirecting to login page on successful registration
        header("Location: login.php");
        exit();
    } else {
        // Displaying error message if query execution fails
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

// Closing database connection
$connection->close();
?>
