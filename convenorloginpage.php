  <?php
 error_reporting(E_ALL);
 ini_set('display_errors', 1);

 include "db_connection.php";

 // Function to clean input data
 function cleanInput($data) {
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
 }

 // Check if form is submitted
//  if ($_SERVER["REQUEST_METHOD"] == "POST") {
//      $uname = cleanInput($_POST['uname']);
//      $password = cleanInput($_POST['password']);

//      // SQL query to fetch committee_ID based on username and password
//      $sql = "SELECT committee_ID FROM users WHERE user_name = '$uname' AND password = '$password'";
//      $result = mysqli_query($conn, $sql);

//      if (mysqli_num_rows($result) == 1) {
//          $row = mysqli_fetch_assoc($result);
//          $committee_ID = $row['committee_ID'];
//          // Redirect to conveyor.html with committee_ID in the URL
//          header("Location: committeepg copy.php?committee_ID= $committee_ID");
//          exit();
//      } else {
//          $error = "Invalid username or password";
//      }
//  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <title>Login</title>
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
  margin-left: 40px;
  margin-right: 40px;
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






form {
  margin: auto;
  place-content: center;
  place-self: center;
}

/* Full-width inputs */
input[type=text], input[type=password] {
  width: 80%;
  padding: 12px 15px;
  margin: 5px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
  margin-bottom: 30px;
  border-radius: 10px;
}

/* Set a style for all buttons */
button {
  font-family: "Poppins", sans-serif;
  background-color: #93332e;
  justify-content: center;
  align-items: center;
  color: white;
  font-size: 25px;
  padding: 0 60px;
  border-radius: 10px;
  border: #93332e;
  margin-top: 10px;
  margin-bottom: 10px;
}

/* Add a hover effect for buttons */
button:hover {
  opacity: 0.8;
}

/* Extra style for the cancel button (red) */
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f11000;
  color: black;
}

.container {
  place-content: center;
 align: center;
  height: auto;
  max-width: 700px;
  align:center;
  text-align: center;
  margin-left:570px;
  margin-top: 40px;
  margin-bottom:40px;
  border-radius: 20px;
  border: 3px solid #93332e;
  box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);
  padding: 20px ;
}

ul {
  list-style-type: circle;
  padding: 0;
}

.center {
  text-align: center;
}

.center h2 {
  text-align: center;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
  color: white;
  background: #93332e;
  height: 60px;
  margin-left: 80px;
  margin-right: 80px;
  padding: 15px;
}

.convenor h2 {
  padding-top: 15px;
}
.email{
  font-size: 24px; 
}
.uname {
  
  font-size: 25px;
}

.psw {
  font-size: 25px;
}

.reset {
  font-family: "Poppins", sans-serif;
  font-weight: 600;
}

/* Style inputs, select elements and textareas */
input[type=text], select, textarea {
  margin-bottom: 30px;
  width: 80%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 10px;
  box-sizing: border-box;
  resize: vertical;
}

/* Style the label to display next to the inputs */
label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}

/* Style the submit button */
input[type=submit] {
  background-color: #93332e;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}

/* Responsive Styles */

@media (min-width: 1200px) and (max-width: 1600px) {
  .container {
    margin-left: 360px;
    margin-right: 100px;
    width: calc(100% - 200px);
  }
  
  .center h2 {
    margin-left: 100px;
    margin-right: 100px;
    width: calc(100% - 200px);
  }
}

@media (max-width: 1200px) {
  .container {
    margin-left: 100px;
    margin-right: 50px;
    width: calc(100% - 100px);
  }
  
  .center h2 {
    margin-left: 50px;
    margin-right: 50px;
    width: calc(100% - 100px);
  }
}

@media (max-width: 768px) {
  .container {
    margin-left: 20px;
    margin-right: 20px;
    width: calc(100% - 40px);
    height: auto;
  }

  .center h2 {
    margin-left: 20px;
    margin-right: 20px;
    width: calc(100% - 40px);
    height: auto;
    padding: 10px 0;
  }

  input[type=text], input[type=password], select, textarea {
    width: 90%;
  }

  ul li {
    font-size: 16px;
    margin: 10px 0;
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



/* Add this to your existing CSS */
.container.flip {
    animation: flipAnimation 1s forwards;
}

@keyframes flipAnimation {
    0% {
        transform: rotateY(0deg);
    }
    100% {
        transform: rotateY(100deg);
    }
}

.container.flip-reverse {
    animation: flipReverseAnimation 1s forwards;
}

@keyframes flipReverseAnimation {
    0% {
        transform: rotateY(360deg); /* Start with flipped state */
    }
    100% {
        transform: rotateY(260deg); /* End with original state */
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
        <li><a href="#"><b>Login</b></a>
          <ul class="dropdown">
            <li><a href="convenorloginpage.php?l_id=1">Convenor Login</a></li>
            <li><a href="convenorloginpage.php?l_id=2">Superadmin Login</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
  <body>
<div class="center">

<!-- <form action="<?php if (isset($_GET['l_id'])) {
      $l_id = $_GET['l_id'];
    } else {
        echo "ID not specified.";
        exit;
    } 
    if($l_id == 1){
       $action_url = "Login.php";
       $submit_url =  "committeepg.php?f_id=1&l_id=1&committee_ID=? ".urlencode($committee_ID);
    } else {
      $action_url = "superadminlogin.php";
      $submit_url = "addnew.php?l_id=2&dept_id=1";
    }       
    

    ?>" method="post"> -->
<!-- <form action="Login.php" method="post"> -->
<form action="<?php echo $action_url; ?>" method="post">
<div class="convenor">
  <?php
  $sql_login = "SELECT l_name FROM login WHERE l_id = $l_id";
  $result_login = $conn->query($sql_login);
// Check if the query returned a result
if ($result_login->num_rows > 0) {
    // Fetch the department name
    $row_login = $result_login->fetch_assoc();
    $login_name = $row_login['l_name'];
} else {
    // Handle the case where no department is found
    $login_name = "Unknown Department";
}

  ?>
    <h2><?php echo $login_name?> LOGIN</h2>
</div>
    

<div class="container">
    <div class="front">
        <!-- Front content here -->
        <form action="<?php echo $submit_url; ?>" method="post">
            <?php
            if (isset($_GET['error'])) {
                echo "<p style='color:black;'>" . htmlspecialchars($_GET['error']) . "</p>";
            }
            ?>
            
            <?php if($l_id == 1){?>
              <div class="email"><b>Email</b></div>
              <input type="text" placeholder="Enter Registered Email" name="email" required>
        <?php } else{ ?>
          <div class="uname"><b>Username</b></div>
          <input type="text" placeholder="Enter Username" name="uname" required>
          <?php } ?>
            <div class="psw"><b>Password</b></div>
            <input type="password" placeholder="Enter Password" name="pass" required>
            <br>
            <input type="hidden" name="l_id" value="<?php echo $l_id; ?>">
            <button type="submit" id="login-button">Login</button>
        </form>
        <?php if($l_id == 1): ?>
        <div class="reset">
            <span>New user? <a id="signup-link" style="text-decoration: none;" href="signup.php">Sign Up</a></span><br>
            <span>Forgot Password? <a id="signup2-link" style="text-decoration: none;" href="reset.php">Reset</a></span>
        </div>
        <?php endif; ?>
    </div>
</div>

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
</body>
<script>
    function toggleMenu() {
      const menu = document.querySelector(".right");
      menu.classList.toggle("active");
    }
  </script>
<script>
    document.getElementById('signup-link').addEventListener('click', function (event) {
        event.preventDefault(); // Prevent the default link behavior
        
        var container = document.querySelector('.container');
        var originalTransform = container.style.transform; // Store original transform style
        
        // Add flip class to trigger the animation
        container.classList.add('flip');
        
        // Redirect to signup.php after the animation completes
        setTimeout(function () {
            window.location.href = 'signup.php';
            
            // Revert to original state after redirection
            setTimeout(function () {
                container.style.transform = originalTransform;
                container.classList.remove('flip'); // Remove flip class to reset animation
            }, 600); // Adjust timing if needed (should match the animation duration)
        }, 600); // The timeout should match the animation duration
    });
</script>

<script>
    document.getElementById('signup2-link').addEventListener('click', function (event) {
        event.preventDefault(); // Prevent the default link behavior
        
        var container = document.querySelector('.container');
        var originalTransform = container.style.transform; // Store original transform style
        
        // Add flip class to trigger the animation
        container.classList.add('flip-reverse'); // Add a new class for reverse flip
        
        // Redirect to reset.php after the animation completes
        setTimeout(function () {
            window.location.href = 'reset.php';
            
            // Revert to original state after redirection
            setTimeout(function () {
                container.style.transform = originalTransform;
                container.classList.remove('flip-reverse'); // Remove flip class to reset animation
            }, 600); // Adjust timing if needed (should match the animation duration)
        }, 600); // The timeout should match the animation duration
    });
</script>





</html>



