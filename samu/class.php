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
  <title>Our Classes</title>
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
    <li style="display: inline;"><a href="./home.html">HOME</a></li>
    <li style="display: inline;"><a href="./about_us.html">ABOUT</a></li>
    <li style="display: inline;"><a href="./contact.html">CONTACT</a></li>
    <li style="display: inline;"><a href="./student.html">STUDENTS</a></li>
    <li style="display: inline;"><a href="./teacher.html">TEACHERS</a></li>
    <li style="display: inline;"><a href="./course.html">USER</a></li>
    <li style="display: inline;"><a href="./class.html">CLASSES</a></li>
    <li style="display: inline;"><a href="./library.html">LIBRARYS</a></li>
    <li style="display: inline;"><a href="./payment.html">PAYMENT</a></li>

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
    <h1><u>Classes Form</u></h1>
    <form method="post">
      <label for="clid">Class id:</label>
      <input type="number" id="clid" name="clid"><br><br>

      <label for="clevel">Level:</label>
      <input type="text" id="clevel" name="clevel" required><br><br>

      <label for="cllocation">Location:</label>
      <input type="text" id="cllocation" name="cllocation" required><br><br>

      <label for="clyear">Year:</label>
      <input type="text" id="clyear" name="clyear" required><br><br>

      <input type="submit" name="insert" value="Insert">
    </form>

    <h2>Table of Classes</h2>
    <table>
      <tr>
        <th>Class id</th>
        <th>Class Level</th>
        <th>Location</th>
        <th>Year</th>
      </tr>
      <?php
      // Your PHP code to fetch and display data
      $host = "localhost";
      $user = "samuel";
      $pass = "222003581";
      $database = "hazajyabera_samuel_222003581";
      $connection = new mysqli($host, $user, $pass, $database);
      
      if ($connection->connect_error) {
          die("Connection failed: " . $connection->connect_error);
      }
      
      $sql = "SELECT * FROM Classes";
      $result = $connection->query($sql);
      
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              echo "<tr><td>" . $row["Class_id"] . "</td>
                        <td>" . $row["Class_level"] . "</td>
                        <td>" . $row["Location"] . "</td> 
                        <td>" . $row["Year"] . "</td>
                        
                    <td><a style='padding:4px' href='delete_class.php? Class_id=" . $row["Class_id"] . "'>Delete</a></td>
                    <td><a style='padding:4px' href='update_class.php?Stu_id=" . $row["Class_id"] . "'>Update</a></td>
                </tr>";
            
          }
      } else {
          echo "<tr><td colspan='4'>No data found</td></tr>";
      }
      
      $connection->close();
      ?>
    </table>
  </section>

  <footer>
    <center> 
      <b><h2>UR CBE BIT &copy; 2024 &reg;, Designed by: @HAZAJYABERA Samuel</h2></b>
    </center>
  </footer>
</body>
</html>
