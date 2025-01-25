<?php 
session_start();
include "db_connection.php" ;
if (isset($_GET['l_id'])) {
  $l_id = $_GET['l_id'];
} 

if (!isset($_SESSION['id'])) {
  header("Location: convenorloginpage.php?l_id=2");
  exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Superadmin</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
 <style>
 * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body, html {
      background: url('image.png') no-repeat center center fixed;
      background-size: cover;
      margin: 0;
      padding: 0;
      min-height: 100%;
      font-family: "Poppins", sans-serif;
    }
    body {
      display: flex;
      flex-direction: column;
    }
    nav {
   margin-top: 20px;
   margin-left: 40px;
   margin-right: 40px;
   border-radius: 20px;
   display: flex;
   justify-content: space-between;
   align-items: center;
   height: 100px;
   z-index: 1000; /* Ensures nav is above other elements */
}

.left {
  margin-top: 5px;
}

.right ul {
  display: flex;
  justify-content: center;
  position: relative;
}

.right ul li {
  list-style: none;
  margin: 0 15px;
  position: relative;
}

.right a {
  font-size: 20px;
  text-decoration: none;
  color: #666777;
  padding: 10px 15px;
  transition: 0.2s;
}

.right a:hover {
  color: #93332e;
  border-bottom: #93332e 4px groove;
}

header {
  background-color: #93332e;
  color: white;
  text-align: center;
  padding: 1em;
  margin-left: 20px;
  margin-right: 20px;
  margin-bottom:10px;
  border-radius: 20px;
  box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);
}

ul li ul.dropdown li {
  background-color:white;
  border-radius:20px;
  box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);
  margin-top:5px;
  padding-top: 10px;
  padding-bottom: 10px;
  font-size: 20px;
  display: block;
  width:100%;
}

ul li ul.dropdown {
  width: 200px;
  position: absolute;
  right: 0;
  top: 100%;
  padding: 10px;
  z-index: 1;
  display: none;
  opacity: 0;
  transition: opacity 0.3s ease;
  border-radius:20px;
}

.dropdown a {
  display: block;
  width: 100%;
  padding: 10px;
  color: #666777;
  text-decoration: none;
}

.dropdown a:hover {
  color: #93332e;
}

ul li:hover ul.dropdown {
  display: block;
  opacity: 1;
}

.menu-toggle {
  display: none;
  font-size: 30px;
  cursor: pointer;
}

.close-btn {
  display: none;
  font-size: 30px;
  cursor: pointer;
  position: absolute;
  top: 10px;
  right: 10px;
  background: rgba(255, 255, 255, 0.9);
  border-radius: 50%;
  padding: 5px;
}
.row1{
border:none;
}
.row2{
  border:none;
}

@media (max-width: 1200px) {
  nav {
    flex-direction: row;
    align-items: center;
  }

  .menu-toggle {
    display: block;
  }

  .right {
    position: fixed;
    top: 0;
    right: -100%;
    height: 100%;
    width: 250px;
    background: rgba(255, 255, 255, 0.9);
    flex-direction: column;
    align-items: flex-start;
    transition: right 0.3s ease-in-out;
    padding-top: 60px;
    box-shadow: -2px 0 5px rgba(0, 0, 0, 0.5);
    z-index: 1001; /* Ensures the right menu is above other elements */
  }

  .right.active {
    right: 0;
  }

  .close-btn {
    display: block;
  }

  .right ul {
    flex-direction: column;
    width: 100%;
  }

  .right ul li {
    margin: 10px 0;
    width: 100%;
  }

  .right a {
    width: 100%;
    padding: 15px;
  }

  ul li ul.dropdown li {
    background-color:white;
  border-radius:20px;
  box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);
  margin-top:5px;
  padding-top: 10px;
  padding-bottom: 10px;
  font-size: 20px;
  display: block;
  width:100%;
  }

  ul li ul.dropdown {
    width: 200px;
  position: absolute;
  right: 0;
  top: 100%;
  padding: 10px;
  z-index: 1;
  display: none;
  opacity: 0;
  transition: opacity 0.3s ease;
  border-radius:20px;
  }

  .dropdown a {
    display: block;
    width: 100%;
    padding: 10px;
    color: #666777;
    text-decoration: none;
  }

  .dropdown a:hover {
    color: #93332e;
  }

  ul li:hover ul.dropdown {
    display: block;
    opacity: 1;
  }
}






  .department {
    width: 90%;
    max-width: 1200px;
    background-color: #93332e;
    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.6);
    margin: auto;
    margin-top: 2%;
    border-radius: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 60px;
  }

  .department ul {
    display: flex;
    justify-content: center;
    padding: 0;
    margin: 0;
    width: 100%;
  }

  .department ul li {
    list-style: none;
    margin: 0 20px;
    flex: 1;
    text-align: center;
  }

  .department a {
    font-weight: 600;
    font-size: 20px;
    text-decoration: none;
    color: white;
    display: inline-block;
  }

  .department a:hover {
    font-weight: 600;
    font-size: 23px;
    color: white;
    border-bottom: white 4px groove;
    transition: 0.2s;
  }
  .highlight {
            font-weight: bold;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);
            border: #ffcccb 2px groove;
            padding:5px;
            border-radius:10px
        }
  @media (max-width: 768px) {
    .department ul li {
      margin: 0 10px;
    }

    .department a {
      font-size: 18px;
    }

    .department a:hover {
      font-size: 20px;
    }
  }

  @media (max-width: 480px) {
    .department {
      flex-direction: column;
      height: auto;
      padding: 10px 0;
    }

    .department ul {
      flex-direction: column;
    }

    .department ul li {
      margin: 10px 0;
    }

    .department a {
      font-size: 16px;
    }

    .department a:hover {
      font-size: 18px;
    }
  }

.button2 {
    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);
    background-color: #93332e; /* Background color */
    border: none; /* Remove border */
    font-weight:600;
    color: white; /* White text */
    padding: 15px 32px; /* Padding */
    text-align: center; /* Center text */
    text-decoration: none;
    display: block; /* Align buttons in a row */
    font-size: 21px; /* Text size */
    margin: auto;
    /* margin-bottom: 10px;  */
    margin-top: 15px;
    cursor: pointer; /* Pointer cursor on hover */
    border-radius: 8px; /* Rounded corners */
    width: 40%;
    max-width: 400px;
}

.button2 a {
    color: white;
    text-decoration: none;
    display: block;
    width: 100%;
    height: 100%;
}

.button2 h2 {
    margin: 0;
    font-size: 1.2em;
}

@media (max-width: 768px) {
    .button2 {
        font-size: 14px;
        padding: 12px 24px;
    }

    .button2 h2 {
        font-size: 1em;
    }
}

@media (max-width: 480px) {
    .button2 {
        font-size: 12px;
        padding: 10px 20px;
    }

    .button2 h2 {
        font-size: 0.9em;
    }
}



/* Notification bar styling */
.notification {
  background-color: #ff0000; /* Red background color */
  color: white; /* White text color */
  text-align: center; /* Center-align text */
  padding: 15px; /* Add padding */
  margin-bottom: 20px; /* Add some bottom margin */
  border-radius: 5px; /* Add rounded corners */
  position: fixed; /* Fixed positioning */
  top: 20px; /* Position from the top */
  left: 50%; /* Center horizontally */
  transform: translateX(-50%); /* Center horizontally */
  width: 300px; /* Set width */
  z-index: 1000; /* Set higher z-index to appear above other elements */
}

/* Committees container styling */
.committees-container {
  display: flex;
  flex-wrap: wrap;
  gap: 2%; /* Space between the items */
  justify-content: center; /* Center items */
  padding: 5% 0 0 0;
}

/* Committee wrapper styling */
.committee-wrapper {
  flex: 0 1 calc(50% - 20px); /* Adjusts the width to 50% with some margin */
  box-sizing: border-box;
}

/* Committee card styling */
.committee {
  background-color: #93332e;
  color: white;
  padding: 20px;
  margin: auto;
  box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.6);
  border-radius: 20px;
  text-align: center;
  /* display: flex; */
  justify-content: center;
  align-items: center;
  height: 200px;
  font-size: 20px;
  font-weight: 600;
  width: 80%;
  margin-top: 3%;
}
.topic{
  font-weight:600;
  font-size:22px;
}
.committee strong {
  font-weight: 200;
  font-size:19px;
}
.committee a{
  text-decoration:none;
  color:white;
  font-weight:500;
}
/* Action container styling */
.action-container {
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 10px;
  border-radius: 5px;
  margin-top: 1px;
}

/* Action button styling */
.action-button {
  background-color: #93332e;
  box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.6);
  border: none;
  color: white;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 5px;
  margin-left: 30px;
}

.action-button:hover {
  font-size: 18px;
}

/* Media queries for responsiveness */
@media (max-width: 768px) {
  .committee-wrapper {
    flex: 0 1 calc(100% - 20px); /* Adjusts the width to 100% with some margin */
  }

  .committee {
    font-size: 18px;
    height: auto;
    padding: 15px;
  }

  .action-button {
    font-size: 14px;
    padding: 8px 16px;
  }

  .action-button:hover {
    font-size: 16px;
  }
}

@media (max-width: 480px) {
  .notification {
    width: 90%;
    padding: 10px;
  }

  .committee-wrapper {
    flex: 0 1 calc(100% - 20px); /* Adjusts the width to 100% with some margin */
  }

  .committee {
    font-size: 16px;
    height: auto;
    padding: 10px;
  }

  .action-button {
    font-size: 12px;
    padding: 6px 12px;
  }

  .action-button:hover {
    font-size: 14px;
  }
}













.img1 {
  width: 250px;
  margin-left: -10px;
}

.img2 {
  width: 80px;
  margin-left: 10px;
}

.logoinsta, .logofb, .logotit {
  width: 25px;
  margin: 0 10px;
}

.bottomstrip {
  display: flex;
  flex-direction: column;
  align-items: center;
  background-color: #93332e;
  width: 100%;
  height: auto; /* Allow height to adjust */
  padding: 10px 20px;
  box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
}

.footer-container {
  display: flex;
  align-items: center;
  justify-content: space-between;
  width: 100%;
}

.footer-left, .footer-center, .footer-right {
  display: flex;
  align-items: center;
}

.footer-center {
  flex: 1;
  justify-content: center;
  color: white;
  text-align: center;
}

.footer-right {
  justify-content: flex-end;
}

@media (max-width: 767px) {
  .img1 {
    width: 250px;
  }

  .img2 {
    width: 50px;
  }

  .logoinsta, .logofb, .logotit {
    width: 20px;
    margin: 0 5px;
  }

  .footer-container {
    flex-direction: column;
    align-items: center;
  }

  .footer-left, .footer-center, .footer-right {
    justify-content: center;
    margin: 10px 0;
  }

  .footer-right {
    margin-top: 0; /* Remove top margin for smaller screens */
  }
}

</style>
</head>
<nav>
    <div class="left">
      <img src="lg1.png" width="250px">
    </div>
    <div class="menu-toggle" onclick="toggleMenu()">☰</div>
    <div class="right">
      <div class="close-btn" onclick="toggleMenu()">✕</div>
      <ul>
        <li><a href="index.php"><b>Home</b></a></li>
        <li><a href="about.php"><b>About us</b></a></li>
        <li><a href="events.php"><b>Events</b></a></li>
        <li>        <?php
        if (!isset($_SESSION['id'])) { ?>
        <li><a href="#"><b>Login</b></a>
          <ul class="dropdown">
            <li><a href="convenorloginpage.php?l_id=1">Convenor Login</a></li>
            <li><a href="convenorloginpage.php?l_id=2">Superadmin Login</a></li>
            <?php } else { ?>
          <a href="superadminlogout.php"><b>Logout</b></a>
<?php
          } ?>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
<?php
    if (isset($_GET["registered"]) && $_GET["registered"] === "true") {
        echo '<div id="notification" class="notification">Committee registered successfully!</div>';
    }
  ?>
  
  <script>
    setTimeout(function() {
        var notification = document.getElementById('notification');
        if (notification) {
            notification.style.display = 'none';
        }
    }, 2000);
  </script>
<body>
<header>
		<h2>Welcome Admin</h2>
	  </header>	
    <?php
include "db_connection.php";
if (isset($_GET['dept_id'])) {
    $dept_id = $_GET['dept_id'];
} else {
    echo "ID not specified.";
    exit;
}

$sql_dept = "SELECT dept_name FROM Department WHERE id = $dept_id";
$result_dept = $conn->query($sql_dept);
?>
              
                <div class="department">
                <ul>
                <li><a href="addnew.php?l_id=2&dept_id=1" class="<?php echo ($dept_id == 1) ? 'highlight' : ''; ?>">Committees</a></li>
            <li><a href="addnew.php?l_id=2&dept_id=2" class="<?php echo ($dept_id == 2) ? 'highlight' : ''; ?>">Clubs</a></li>
            <li><a href="addnew.php?l_id=2&dept_id=3" class="<?php echo ($dept_id == 3) ? 'highlight' : ''; ?>">Social Bodies</a></li>
             </ul>
            </div>
            <?php
// Check if the department result has rows
if ($result_dept->num_rows > 0) {
    // Fetch the department name
    $row_dept = $result_dept->fetch_assoc();
    $dept_name = $row_dept['dept_name'];
} else {
    echo "No department found.";
    exit;
}

// Step 2: Retrieve the list of committees from the database
$sql = "SELECT * FROM committees WHERE dept_id = $dept_id";
$result = $conn->query($sql);

// Error handling for SQL query
if (!$result) {
    echo "Error fetching committees: " . $conn->error;
    exit;
}
?>
<button class="button2">
    <a href="committeeform.php?dept_id=<?php echo $dept_id ?>"><h2>Add New <?php echo $dept_name ?></h2></a>
</button>
<?php
// Step 3: Loop through the retrieved data to display each committee
if ($result->num_rows > 0) {
    echo '<div class="committees-container">';
    while ($row = $result->fetch_assoc()) {
        ?>
        <div class="committee-wrapper">
            <div class="committee">
                <?php echo "<div class='topic'>" . $row["committeeName"] . "</div>"; ?>
                <?php
                // Prepare and execute the query to check if convenor's password is set
                $sql_check = "SELECT password FROM users WHERE id = (SELECT user_id FROM convenor WHERE committee_ID = ?)";
                $stmt_check = $conn->prepare($sql_check);
                
                if ($stmt_check) {
                    $stmt_check->bind_param("i", $row['committee_ID']);
                    $stmt_check->execute();
                    $result_check = $stmt_check->get_result();

                    if ($result_check->num_rows > 0) {
                        $row_check = $result_check->fetch_assoc();
                        if (!empty($row_check['password'])) {
                            echo "<strong>The convenor is already registered for " . $row["committeeName"] . "</strong>";
                        } else {
                            echo "<strong>The convenor is not registered for " . $row["committeeName"] . "</strong>";
                            echo "<strong>. Ask the convenor to go to ";
                            ?>
                            <a href="convenorloginpage.php?l_id=1">LOGIN PAGE</a>
                            <?php
                            echo " and sign up as a new user</strong>";
                        }
                    } else {
                        echo "<strong>The convenor is not registered for " . $row["committeeName"] . "</strong>";
                        echo "<strong>. Ask the convenor to go to ";
                        ?>
                        <a href="convenorloginpage.php?l_id=1">LOGIN PAGE</a>
                        <?php
                        echo " and sign up as a new user</strong>";
                    }
                } else {
                    echo "Error preparing statement: " . $conn->error;
                }
                ?>
            </div>
            <div class='action-container'>
                <a class="new" href="committeeform.php?l_id=<?php echo 2; ?>&committee_ID=<?php echo $row["committee_ID"]; ?>&dept_id=<?php echo $dept_id ?>"><button class='action-button'>Update</button></a>
                <form method='POST' action='committeedb.php' onsubmit="return confirm('Are you sure you want to delete this committee?');" style='display:inline;'>
                    <input type='hidden' name='action' value='delete'>
                    <input type='hidden' name='committee_ID' value='<?php echo $row['committee_ID']; ?>'>
                    <input type='hidden' name='dept_id' value='<?php echo $dept_id; ?>'>
                    <input type='hidden' name='table_name' value='committees'>
                    <button type='submit' class='action-button'><b>Delete</b></button>
                </form>
            </div>
        </div>
        <?php
    }
    echo '</div>';
} else {
    echo "0 results";
}

$conn->close();
?>




        
<footer class="bottomstrip">
  <div class="footer-container">
    <div class="footer-left">
      <a href="https://kjsit.somaiya.edu.in/"><img class="img1" src="lg.png" alt="SOMAIYA Logo"></a>
    </div>
    <div class="footer-center dev">
      <h3>Department of Computer Engineering<br>©2023-24<br>Guided by: Prof. Priyanka Deshmukh and Prof. Pradnya Patil<br>Developed by: Anandi Ket, Avani Mahadik, Malav Joshi, and Sahil Mane</h3>
    </div>
    <div class="footer-right">
      <a href="https://www.facebook.com/kjsieitofficial"><img class="logofb" src="fb logo.png" alt="Facebook Logo"></a>
      <a href="https://www.twitter.com/kjsieit1"><img class="logotit" src="twitter logo.png" alt="Twitter Logo"></a>
      <a target="_blank" href="https://www.instagram.com/kjsit_official/?utm_source=ig_web_button_share_sheet&igshid=OGQ5ZDc2ODk2ZA=="><img class="logoinsta" src="insta logo.png" alt="Instagram Logo"></a>
      <img class="img2" src="somaiya trust logo.jpg" alt="SOMAIYA Trust Logo">
    </div>
  </div>
</footer>

        
    <script>
    function toggleMenu() {
      const menu = document.querySelector(".right");
      menu.classList.toggle("active");
    }
  </script>
  </body>
</html>