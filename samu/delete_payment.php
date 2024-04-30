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
    $Payment_id = $_REQUEST['Payment_id'];
    
    // Prepare and execute the DELETE statement
    $wc = $connection->prepare("DELETE FROM payments WHERE Payment_id=?");
    $wc->bind_param("i", $Payment_id);
    if ($wc->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting data: " . $wc->error;
    }

    $wc->close();
} else {
    echo "Payment_id is not set.";
}

$connection->close();
?>
