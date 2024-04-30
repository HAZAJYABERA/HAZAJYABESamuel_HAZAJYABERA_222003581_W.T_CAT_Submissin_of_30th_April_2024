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
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Our Students</title>
  <style>
    /* Your CSS styles */
  </style>
</head>

<body>
  <header>
    <!-- Your header content -->
  </header>
<body><body bgcolor="gray">
  <form class="forms" role="search" action="search.php">
    <input class="form-control" type="text" placeholder="Search" aria-label="Search">
    <button class="searchbtn" type="submit">Search</button>
  </form>

  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline;"></li>
    <li style="display: inline;"><a href="./home.html">HOME</a></li>
    <li style="display: inline;"><a href="./about_us.html">ABOUT</a></li>
    <li style="display: inline;"><a href="./contact.html">CONTACT</a></li>
    <li style="display: inline;"><a href="./student.html">STUDENTS</a></li>
    <li style="display: inline;"><a href="./teacher.html">TEACHERS</a></li>
    <li style="display: inline;"><a href="./course.html">USER</a></li>
    <li style="display: inline;"><a href="./class.html">CLASSES</a></li>
    <li style="display: inline;"><a href="./library.html">LIBRARYS</a></li>
    <li style="display: inline;"><a href="./payment.html">PAYMENTS</a></li>
    
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>
        <a href="logout.php">Logout</a>
      </div>
    </li>
  </ul>

  <section>
    <h1><u>Students Form</u></h1>
    <form method="post">
      <label for="Stu_id">Stu_id:</label>
      <input type="text" id="Stu_id" name="Stu_id"><br><br>

      <label for="sname">Student_name:</label>
      <input type="text" id="sname" name="Student_name" required><br><br>

      <label for="semail">Email:</label>
      <input type="text" id="semail" name="sEmail" required><br><br>

      <label for="stelephone">Telephone:</label>
      <input type="text" id="sTelephone" name="sTelephone" required><br><br>

      <input type="submit" name="add" value="Insert">
    </form>

    <!-- PHP code for database operations -->
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
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
        // Insert section
        $sms = $connection->prepare("INSERT INTO Students(Stu_id,student_name, Email, Telephone) VALUES (?, ?, ?, ?)");
        $sms->bind_param("ssss", $Stu_id, $Student_name, $sEmail, $sTelephone);

        // Set parameters from POST and execute
        $Stu_id = $_POST['Stu_id'];
        $Student_name = $_POST['Student_name'];
        $sEmail = $_POST['sEmail'];
        $sTelephone = $_POST['sTelephone'];

        if ($sms->execute()) {
            echo "New record has been added successfully.<br><br>
                 <a href='student.html'>Back to Form</a>";
        } else {
            echo "Error inserting data: " . $sms->error;
        }

        $sms->close();
    }

    // SQL query to fetch data from the students table
    $sql = "SELECT * FROM Students";
    $result = $connection->query($sql);
    ?>

    <h2>Table of Student</h2>
    <table id="dataTable">
        <tr>
            <th>Stu_id</th>
            <th>Student_name</th>
            <th>Email</th>
            <th>Telephone</th>
        </tr>   
        <?php
        // Output data of each row
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" .$row["Stu_id"] . "</td>
                          <td>" .$row["Student_name"] . "</td>
                          <td>" .$row["Email"] . "</td> 
                          <td>" .$row["Telephone"] . "</td> 
                           <td><a style='padding:4px' href='delete_student.php?Stu_id=" . $row["Stu_id"] . "'>Delete</a></td>
                    <td><a style='padding:4px' href='update_student.php?Stu_id=" . $row["Stu_id"] . "'>Update</a></td>
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
