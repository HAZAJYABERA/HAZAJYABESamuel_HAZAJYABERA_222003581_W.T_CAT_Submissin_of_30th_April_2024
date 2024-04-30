<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> change bg color after 1 sec</title>
  <script type="text/javascript">
    const colors=['#ff0000','f1f1f1','#00ff00','#000ff','#ffff00','#ff00ff','#00ff'];
    let index =0;
    function changeBackgroundColor(){
      document.body.style.backgroundColor=colors
      [index];
      index=(index+1)%colors.length;
    }
    //change backgroundcplor every second
    setInterval(changeBackgroundColor, 1000);
  </script>
</head>
<body>

</body>
</html> !<DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Our Payments</title>
  <style>
    /* Normal link */
    a {
      padding: 5px;
      color: white;
      background-color: blue;
      text-decoration: none;
      margin-right: 5px;
    }

    /* Visited link */
    a:visited {
      color: purple;
    }
    /* Unvisited link */
    a:link {
      color: yellow; /* Changed to lowercase */
    }
    /* Hover effect */
    a:hover {
      background-color: yellow;
    }

    /* Active link */
    a:active {
      background-color: blue;
    }

    /* Extend margin left for search button */
    button.btn {
      margin-left: 5px; /* Adjust this value as needed */
      margin-top: 4px;
    }
    /* Extend margin left for search button */
    input.form-control {
      margin-left: 1200px; /* Adjust this value as needed */

      padding: 8px;
     
    }
    .forms{
      margin-left: 700px;

    }
    .searchbtn{
      background-color: blue;
      border: none;
    }
  </style>
  </head>

  <header>

<body><body bgcolor="gray">
  <form class="forms" role="search" action="search.php">
      <input class="" type="text" placeholder="Search" aria-label="Search">
      <button class="searchbtn" type="submit">Search</button>
    </form>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline;">
  </li>
    <li style="display: inline; "><a href="./home.html">HOME</a>
  </li>
    <li style="display: inline; "><a href="./about us.html">ABOUT</a>
  </li>
    <li style="display: inline; "><a href="./contact.html">CONTACT</a>
  </li>
    <li style="display: inline; "><a href="./student.html">STUDENTS</a>
  </li>
    <li style="display: inline; "><a href="./teacher.html">TEACHERS</a>
  </li>
    <li style="display: inline; "><a href="./course.html">USER</a>
  </li>
    <li style="display: inline; "><a href="./class.html">CLASSES</a>
  </li>
    <li style="display: inline; "><a href="./olibrary.html">LIBRARYS</a>
  </li>
    <li style="display: inline; "><a href="./pyment.html">PAYMENTs</a>
  </li>
    
  
  
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>
        <a href="logout.php">Logout</a>
      </div>
    </li><br><br>
      
  </ul>

</header>
<section>

    <h1><u> Payments Form </u></h1>
    <form method="post" action="payment.php">
            
        <label for="pymtid"> Payment_id:</label>
        <input type="text" id=" Payment_id" name=" Payment_id"><br><br>

        <label for=" Stu_id"> Stu_id:</label>
        <input type="text" id=" Stu_id" name=" Stu_id" requi;red><br><br>

        <label for="Payment_date">Payment_date:</label>
        <input type="date" id="Payment_date" name="Payment_date" required><br><br>

        <label for="Payment_amaunt">Payment_amaunt:</label>
        <input type="text" id="Payment_amaunt" name="Payment_amaunt" required><br><br>
         
        <input type="submit" name="add" value="Insert">
    
    </form>
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

// Check if the form is submitted for insert
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insert'])) {
    // Insert section
    $sms = $connection->prepare("INSERT INTO payment(Payment_id, Stu_id,  Payment_date, Payment_amount) VALUES (?, ?, ?, ?)");
    $sms->bind_param("ssss", $Payment_id, $Stu_id, $Payment_date, $cPayment_amount);

    // Set parameters from POST and execute
    $Payment_id= $_POST['Payment_id'];
    $Stu_id = $_POST['Stu_id'];
    $Payment_date = $_POST['Payment_date'];
    $Payment_amount = $_POST['Payment_amount'];
    if ($stmt->execute()) {
            echo "New record has been added successfully.<br><br>
                 <a href='payment.html'>Back to Form</a>";
        } else {
            echo "Error inserting data: " . $sms->error;
        }

        $sms->close();
    }

    // SQL query to fetch data from the payment table
    $sql = "SELECT * FROM payments";
    $result = $connection->query($sql);
    ?>
    <h2>Table of Payment</h2>
    <table id="dataTable">
        <tr>
            <th>Payment_id</th>
            <th>Stu_id</th>
            <th>Payment_date</th>
            <th>Payment_amaunt</th>
           
        </tr>   
        <?php
        // Output data of each row
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" .$row["Payment_id"] . "</td>
                          <td>" .$row["Stu_id"] . "</td>
                          <td>" .$row["Payment_date"] . "</td> 
                          <td>" .$row["Payment_amaunt"] . "</td>
                          
                            <td><a style='padding:4px' href='delete_payment.php?Payment_id=" . $row["Payment_id"] . "'>Delete</a></td>
                    <td><a style='padding:4px' href='update_payment.php?Payment_id=" . $row["Payment_id"] . "'>Update</a></td>
                </tr>";
            } 
        } else {
            echo "<tr><td colspan='4'>No data found</td></tr>";
        }
        ?>        
    </table>

    <?php
    // Close connection
    $connection->close();
    ?>
  </section>

  <footer>
    <center> 
      <b><h2>UR CBE BIT &copy; 2024 &reg;, Designed by: @HAZAJYABERA Samuel</h2></b>
    </center>
  </footer>
</body>
</html>
