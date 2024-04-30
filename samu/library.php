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
</html> <!DOCTYPE html>
<html lang="en">
<head>
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
 
 <title>Our Librarys</title>

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
    <li style="display: inline; "><a href="./pyment.html">PAYMENTS</a>
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

<h1><u> librarys Form </u></h1>
<form method="post" action="library.php">

<label for=" Book_id">Book_id:</label>
<input type="text" id=" Book_id" name="bkid"><br><br>

<label for="Title">Book Title:</label>
<input type="text" id="Title" name="Title" required><br><br>

<label for="Book Publisher">Book Publisher:</label>
<input type="text" id="Book Publisher" name="PBook Publisher" required><br><br>

<label for=" Author"> Author:</label>
<input type="text" id=" Authorr" name=" Author" required><br><br>
<input type="submit" name="add" value="Insert"><br><br>


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
    $sms = $connection->prepare("INSERT INTO librarts( Book_id, Title, Publication_year, Author) VALUES (?, ?, ?, ?)");
    $sms->bind_param("sssd", $Book_id, $Title, $Publication_yeare, $Author);

    // Set parameters from POST and execute
    $Book_id= $_POST['Book_id'];
    $Title = $_POST['Title'];
    $Publication_year = $_POST['Publication_year'];
    $Author = $_POST['Author'];

    if ($sms->execute()) {
        echo "New record has been added successfully.<br><br>
             <a href='course.html'>Back to Form</a>";
    } else {
        echo "Error inserting data: " . $sms->error;
    }

    $sms->close();
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    // Update section
    $sms = $connection->prepare("UPDATE librarys SET Book_id=?, Publication_year=?,Title=?;Author?, WHERE Book_id =?");
    $sms->bind_param("ssss", $Book_id, $Title, $Publication_year, $Author);

    // Set parameters from POST and execute
    $Book_id = $_POST['Book_id'];
    $Title= $_POST['Title'];
    $Publication_year = $_POST['Publication_year'];
    $Author = $_POST['Author'];

    if ($sms->execute()) {
        echo "Record updated successfully.<br><br>
             <a href='librarys.html'>Back to Form</a>";
    } else {
        echo "Error updating data: " . $sms->error;
    }

    $stmt->close();
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    // Delete section
    $sms = $connection->prepare("DELETE FROM library WHERE Book_Id=?");
    $sms->bind_param("s", $pid);

    // Set parameter from POST and execute
    $pid = $_POST['pid'];

    if ($sms->execute()) {
        echo "Record deleted successfully.<br><br>
             <a href='librarys.html'>Back to Form</a>";
    } else {
        echo "Error deleting data: " . $sms->error;
    }

    $sms->close();
}

// SQL query to fetch data from the library table
$sql = "SELECT * FROM librarys";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of librarys</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Table of Library </h2>
    
    <table id="dataTable">
        <tr>
            <th>Book_id</th>
            <th>Title</th>
            <th>Publisher</th>
            <th>Author</th>
        </tr>   
        <?php
        // Output data of each row
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["Book_id"] . "</td>
                          <td>" . $row["Title"] . "</td>
                          <td>" . $row["Publication_year"] . "</td> 
                          <td>" . $row["Author"] . "</td>
                  <td><a style='padding:4px' href='delete_library.php?Book_id=" . $row["Book_id"] . "'>Delete</a></td>
                    <td><a style='padding:4px' href='update_library.php?Book_id=" . $row["Book_id"] . "'>Update</a></td>
                </tr>";
            } 
        } else {
            echo "<tr><td colspan='4'>No data found</td></tr>";
        }
        ?>        
    </table>
</body>


<?php
// Close connection
$connection->close();
?>
    </section>


  
<footer>
  <center> 
    <b><h2>UR CBE BIT &copy, 2024 &reg, Designed by: @HAZAJYABERA Samuel</h2></b>
  </center>
</footer>
</body>
</html>