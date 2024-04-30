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
    $Class_id = $_REQUEST['Class_id'];
    
    // Prepare and execute the DELETE statement
    $wc = $connection->prepare("DELETE FROM Classes WHERE Class_id=?");
    $wc->bind_param("i", $Class_id);
    
    // Execute the DELETE statement
    if ($wc->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting data: " . $wc->error;
    }
    $wc->close();
} else {
    echo "Class_id is not set.";
}

$connection->close();
?>
