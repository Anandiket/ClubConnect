<?php
  session_start();
  include "db_connection.php";
  // Check if the committee_ID is set in the session
if (!isset($_SESSION['id'])) {
  echo "Committee ID not set in session.";
  exit;
}

// Retrieve the committee_ID from session
$committee_ID = $_SESSION['committee_ID'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <title>LOGIN</title>
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
@media (max-width: 768px) {
  header {
    margin: 20px;
    padding: 0.8em;
  }
}

@media (max-width: 480px) {
  header {
    margin: 10px;
    padding: 0.6em;
  }
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









.container-full, .container-inner {
  width: 100%;
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
}

label {
  padding: 5px 0;
  font-weight: 800;
  font-size: 1.2rem;
  color:#93332e;
  display: inline-block;
  width: 150px; /* Adjust label width as needed */
  text-align: right;
  margin-right: 20px; /* Add some margin between label and input */
}

h1 {
  font-family: "Poppins", sans-serif;
  height: 50px;
  background-color: #93332e;
  width: 100%;
  font-weight: 600;
  color: white;
  font-size: 18pt;
  text-align: center;
  padding: 10px;
  margin: 0;
  border-radius: 10px;
}

form.register {
  margin: 20px auto;
  padding: 10px;
  text-align: left;
  width: 100%; /* Full width for responsiveness */
  max-width: 800px; /* Adjust maximum width as needed */
}

.row1 {
  width: 100%;
  border-radius: 10px;
  padding: 15px;
  border: 2px solid #93332e;
  margin: auto;
  margin-top: 20px;
  box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);
}

.form-group {
  font-size: 8pt;
  margin-bottom: 15px;
  text-align: left;
}

form.register legend {
  color: #9B2928;
  padding: 2px;
  font-weight: bold;
  font-size: 14px;
  margin-bottom: 5px;
  text-align: center;
}

form.register input, form.register textarea, form.register select {
  border: 1px solid #E1E1E1;
  margin-top: 5px;
  width: 100%;
  box-sizing: border-box;
  margin-bottom: 10px;
  padding: 8px;
  height: 30px;
  font-size: 10pt;
}

form.register textarea {
  height: 80px; /* Adjust height as needed */
}

form.register select {
  margin-bottom: 3px;
  color: #9B2928;
  text-align: left;
}

form.register select.date {
  width: 40px;
}

input:focus, select:focus, textarea:focus {
  background-color: #efffe0;
}

div.agreement {
  margin-left: 15px;
}

div.agreement label {
  text-align: left;
  margin-top: 3px;
}

#registerButton {
  padding: 8px 10px;
  color: #fff;
  cursor: pointer;
  font-size: 14px;
  display: block;
  margin: 20px auto;
  text-align: center;
  background-color: #93332e;
  border: none;
  border-radius: 10px;
  width: 100%;
  max-width: 150px; /* Adjust as needed */
}

#registerButton:hover {
  transform: scale(1.05);
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

#updatedProfile {
  display: none;
  margin: 20px auto;
  background-color: #fff;
  padding: 20px;
}

#updatedProfile h2, #updatedProfile h3 {
  color: #abda0f;
  padding: 2px;
  font-weight: bold;
  font-size: 14px;
  margin-bottom: 5px;
}

.input-row {
  display: flex;
  flex-direction: column;
  margin-bottom: 10px;
}

.input-row label {
  margin-bottom: 5px;
}

.input-row input[type="text"], .input-row textarea {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 10px;
  box-sizing: border-box;
}

input[type="file"] {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 10px;
  box-sizing: border-box;
  align-content: center;
}

button[type=submit] {
  background-color: #93332e;
  color: white;
  font-size: 14px;
  font-weight: 600;
  padding: 8px 20px;
  border-radius: 10px;
  border: none;
  cursor: pointer;
  margin: 20px auto;
  width: auto;
  display: block;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

button:hover {
  opacity: 0.8;
}

/* Responsive adjustments */
@media (max-width: 768px) {
  label {
    width: 100%;
    text-align: left;
    margin-right: 0;
  }

  .input-row {
    flex-direction: column;
  }

  .row1 {
    padding: 15px;
  }

  #registerButton {
    max-width: 100%;
  }

  input[type="file"] {
    max-width: 100%;
  }
}

@media (max-width: 480px) {
  h1 {
    font-size: 16pt;
    padding: 10px;
  }

  .input-row label {
    font-size: 12px;
  }

  form.register input, form.register textarea, form.register select {
    padding: 6px;
    font-size: 12px;
  }

  #registerButton {
    font-size: 12px;
    padding: 6px 15px;
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
.back-button {
  width:10%;
    padding: 10px 20px;
    font-size: 16px;
    color: #fff;
    background-color: #93332e;
    border:none;
    margin: 10px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.back-button:hover {
    background-color: #954F4A;
}

@media (max-width: 1200px) {
    .back-button {
        width: 15%;
        font-size: 15px;
        padding: 9px 18px;
    }
}

@media (max-width: 992px) {
    .back-button {
        width: 20%;
        font-size: 14px;
        padding: 8px 16px;
    }
}

@media (max-width: 768px) {
    .back-button {
        width: 25%;
        font-size: 13px;
        padding: 7px 14px;
    }
}

@media (max-width: 576px) {
    .back-button {
        width: 30%;
        font-size: 12px;
        padding: 6px 12px;
    }
}

@media (max-width: 400px) {
    .back-button {
        width: 40%;
        font-size: 11px;
        padding: 5px 10px;
    }
}
    </style>
    </head>
    <body>
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
        <li><?php 
            if (isset($_GET['l_id'])) {
              $l_id = $_GET['l_id'];
            } 
            
            if($l_id == 1) { ?>
              <a href="Logout.php"><b>Logout</b></a>
               <?php } else { ?>
                  <a href="#"><b>Login</b></a>
                  <ul class="dropdown">
                  <li><a href="convenorloginpage.php?l_id=<?php echo 1?>">Convenor Login</a></li>
                  <li><a href="convenorloginpage.php?l_id=<?php echo 2?>">Superadmin Login</a></li>
              <?php } ?>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
  <a href="committeepg.php?f_id=1&l_id=1"><button class="back-button" >Go Back</button></a>
  <header>
  <h1>Add Description</h1>
               </header>
  <center><div class="container">
<div id="newUser">
<?php
    $is_update = isset($_GET['des_id']);
    $committee_id = isset($_GET['committee_ID']) ? $_GET['committee_ID'] : '';
    $des_id = $is_update ? $_GET['des_id'] : '';
    
  
    $sql_desc = "SELECT * FROM descriptions WHERE des_id = ?";
    $stmt_desc = mysqli_prepare($conn, $sql_desc);
    mysqli_stmt_bind_param($stmt_desc, "i", $des_id);
    mysqli_stmt_execute($stmt_desc);
    $result_desc = mysqli_stmt_get_result($stmt_desc);

        if ($row = mysqli_fetch_assoc($result_desc)) {
          $mission = $row['misson'];
          $objective = $row['objective'];
          $more = $row['more'];
          $logo = $row['logo'];
          
      } 


if (isset($_GET['error'])) {
                echo "<p style='color:black;'>" . htmlspecialchars($_GET['error']) . "</p>";
            }
            ?>
  <form name="newUser" class="register" action="desc.php" method="post" enctype="multipart/form-data">
    <fieldset class="row1">
      <div class="form-group">
        
    <div class="row input-row">
      <label for="objective">Objective</label>
      <textarea id="objective" name="objective"  placeholder="Enter objective of the committee" style="height:125px"><?php echo $is_update ? htmlspecialchars($objective) : ''; ?></textarea>
    </div>
    <div class="row input-row">
      <label for="about_us">Mission</label>
      <textarea id="about_us" name="about_us" placeholder="Enter detail about the committee" style="height:125px"><?php echo $is_update ? htmlspecialchars($mission) : ''; ?></textarea>
    </div>
    <div class="row input-row">
      <label for="more_desc">Link for Regitration</label>
      <textarea id="more_desc" name="more_desc" placeholder="Enter the link that will allow the user to enroll in the committee." style="height:125px"><?php echo $is_update ? htmlspecialchars($more) : ''; ?></textarea>
    </div>

        <div class="row input-row">
                <label for="logo">Upload Logo</label>
                <?php if ($is_update && !empty($logo)) : ?>
                    <div>
                        <p>Previous photo exists.</p>
                        <input type="hidden" name="existing_photo" value="<?php echo htmlspecialchars($logo); ?>">
                    </div>
                <?php endif; ?>
                <input type="file" name="logo" class="form-control2">
            </div>
      </div>
      <input type="hidden" name="committee_ID" value="<?php echo isset($_GET['committee_ID']) ? $_GET['committee_ID'] : ''; ?>">

      <input type="hidden" name="redirect_url" value="committeepg.php?committee_ID=<?php echo $committee_ID?>">
      <center>
      <button type="submit">Submit</button>
</center>
</fieldset>
  </form>
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
<script>
    function toggleMenu() {
      const menu = document.querySelector(".right");
      menu.classList.toggle("active");
    }
  </script>
</body>
</html>