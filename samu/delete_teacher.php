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
    $Stud_id = $_REQUEST['Teacher_id'];
    
    // Prepare and execute the DELETE statement
    $wc = $connection->prepare("DELETE FROM teachers WHERE Teacher_id=?");
    $wc->bind_param("i", $Teacher_id);
    if ($wc->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting data: " . $wc->error;
    }

    $wc->close();
} else {
    echo "Teacher_id is not set.";
}

$connection->close();
?>
