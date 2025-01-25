<?php
  session_start();
  include "db_connection.php";
  // Check if the committee_ID is set in the session
if (!isset($_SESSION['id'])) {
  echo "Committee ID not set in session.";
  exit;
}

// Retrieve the committee_ID from session
$committee_id = $_SESSION['committee_ID'];

// Validate and sanitize inputs (optional but recommended)
$committee_id = filter_var($committee_id, FILTER_SANITIZE_NUMBER_INT);

  $is_update = isset($_GET['achievement_id']);
  $achievement_id = $is_update ? $_GET['achievement_id'] : '';

  $sql_achievements = "SELECT * FROM achievements WHERE achievement_id = ?";
  $stmt_achievements = mysqli_prepare($conn, $sql_achievements);
  mysqli_stmt_bind_param($stmt_achievements, "i", $achievement_id);
  mysqli_stmt_execute($stmt_achievements);
  $result_achievements = mysqli_stmt_get_result($stmt_achievements);

  if ($row = mysqli_fetch_assoc($result_achievements)){
    $achievement_name = $row["achievement_name"];
    $achievement_desc = $row["achievement_desc"];
    $achievement_student = $row["achievement_student"];
    $achievements_date = $row["achievements_date"];
    $achievement_photo = $row["achievement_photo"];
  }

  if ($is_update && !empty($achievement_id)) {
    $existing_photos = [];
    $sql_select_photos = "SELECT photo_id, photo FROM photos WHERE achievement_id = ?";
    if ($stmt_select_photos = mysqli_prepare($conn, $sql_select_photos)) {
        mysqli_stmt_bind_param($stmt_select_photos, "i", $achievement_id);
        if (mysqli_stmt_execute($stmt_select_photos)) {
            mysqli_stmt_bind_result($stmt_select_photos, $photo_id, $photo);
            while (mysqli_stmt_fetch($stmt_select_photos)) {
                $photo_url = 'data:image/jpeg;base64,' . base64_encode($photo);
                $existing_photos[$photo_id] = $photo_url;
            }
        }
        mysqli_stmt_close($stmt_select_photos);
    }
}

  ?>
  <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <title>Achievements</title>
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

.label {
  padding: 10px 0;
  font-weight: 500;
  font-size: 12pt;
  display: inline-block;
  width: 150px; /* Adjust label width as needed */
  margin-right: 10px; /* Add some margin between label and input */
}

.row1 {
  margin: auto;
  margin-top: 2%;
  width: 90%; /* Adjusted for responsiveness */
  max-width: 600px; /* Maximum width for larger screens */
  border: 3px solid #93332e;
  border-radius: 10px;
  box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);
  padding: 20px;
}

h1 {
  height: 70px;
  background-color: #93332e;
  color: white;
  font-size: 20pt;
  text-align: center;
  padding: 18px;
  margin-left: auto;
  margin-right: auto;
  border-radius: 10px;
}

form.register {
  margin: 20px auto;
  padding: 20px;
  text-align: left;
}

.form-group {
  font-size: 14px; /* Increased font size for better readability */
  margin-bottom: 20px; /* Increased bottom margin */
}

form.register legend {
  color: #9B2928;
  font-weight: bold;
  font-size: 18px;
  text-align: center;
  margin-bottom: 10px;
  display: block; /* Ensure legend is displayed as a block */
}

form.register input[type="text"],
form.register textarea,
form.register input[type="date"],
form.register select {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 10px;
  box-sizing: border-box;
  margin-bottom: 10px;
  height: 40px; /* Increased height for better touch targets */
}

form.register select {
  max-width: 100%; /* Ensure select box is full width */
}

input:focus,
select:focus {
  background-color: #efffe0;
}

#registerButton {
  font-family: "Poppins", sans-serif;
  background-color: #93332e;
  color: white;
  font-size: 18px;
  border-radius: 10px;
  border: none;
  margin-top: 20px;
  padding: 12px 30px;
  cursor: pointer;
  display: block;
  margin-left: auto;
  margin-right: auto;
}

#registerButton:hover {
  transform: scale(1.1);
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

.input-row {
  display: flex;
  align-items: center; /* Center align items vertically */
  margin-bottom: 20px;
}

.input-row label {
  margin-right: 10px; /* Reduced margin between label and input */
  flex: 0 0 150px; /* Fixed label width */
  text-align: right;
  font-weight: 600;
}

@media (max-width: 768px) {
 
  .row1 {
    width: 100%; /* Full width on smaller screens */
  }

  .input-row {
    flex-direction: column;
  }

  .input-row label {
    margin-right: 150px;
    margin-bottom: 5px;
    text-align: left;
    flex: 0 0 auto; /* Reset label flex to auto for full width on small screens */
  }

  form.register input[type="date"] {
    width: 100%; /* Full width for date input on small screens */
  }

  #registerButton {
    width: 100%; /* Full width button on small screens */
    font-size: 16px;
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
.button1{
  margin-right:20px;
  margin-left:20px;
  margin-top:-15px;
  margin-bottom:10px;
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
  <a href="committeepg.php?f_id=3&l_id=1"><button class="back-button" >Go Back</button></a>

      <body>
      <div class="container">
  <div id="newUser">
  <form name="newUser" class="register" action="ach.php" method="post" enctype="multipart/form-data">
  <h1><?php echo $is_update ? "Update Achievement" : "New Achievement"; ?></h1>
  <fieldset class="row1">
    <div class="form-group">
      <?php
      if (isset($_GET['error'])) {
        echo "<p style='color:black;'>" . htmlspecialchars($_GET['error']) . "</p>";
      }
      ?>
      <div class="input-row">
        <label for="name" style="font-weight:700">Achievement Name</label>
        <input type="text" id="name" name="name" value="<?php echo $is_update ? htmlspecialchars($achievement_name) : ''; ?>" placeholder="Enter achievement name">
      </div>
      <div class="input-row">
        <label for="desc" style="font-weight:700; margin-left:-50px;">Description</label>
        <textarea id="desc" name="desc" placeholder="Enter description of the achievement" rows="4"><?php echo $is_update ? htmlspecialchars($achievement_desc) : ''; ?></textarea>
      </div>
      <div class="input-row">
        <label for="student" style="font-weight:700; margin-left:-80px;">Students</label>
        <input type="text" id="student" name="student" value="<?php echo $is_update ? htmlspecialchars($achievement_student) : ''; ?>" placeholder="Enter the name of the students">
        <label for="date" style="font-weight:700">Achievement Date</label>
        <input type="date" id="date" name="date" max="<?php echo date('Y-m-d'); ?>" value="<?php echo $is_update ? htmlspecialchars($achievements_date) : ''; ?>" placeholder="Enter achievement date">
      </div>
      </div>
      <div class="input-row" id="photo-container">
        <label for="photos" style="font-weight:700">Upload new photos</label>
        <input type="file" id="photos" name="achievement_photos[]" class="form-control2" multiple>
      </div>
      <button type="button" id="add-photo" class="btn btn-primary">Add More Photos</button>
      <?php if ($is_update && !empty($existing_photos)): ?>
      <div class="input-row">
        <label style="font-weight:700">Existing Photos</label>
        <div>
          <?php foreach ($existing_photos as $photo_id => $photo_url): ?>
          <div>
            <img src="<?php echo $photo_url; ?>" alt="Photo" style="width:100px; height:auto;">
            <input type="checkbox" name="delete_photos[]" value="<?php echo $photo_id; ?>"> Delete
          </div>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endif; ?>
    </div>
    <div class="button1">
      <input type="hidden" name="committee_ID" value="<?php echo $committee_id; ?>">
      <input type="hidden" name="action_type" value="<?php echo $is_update ? 'update' : 'insert'; ?>">
      <input type="hidden" name="achievement_id" value="<?php echo $achievement_id; ?>">
      <center>
        <button type="submit" id="registerButton">
          <?php echo $is_update ? "Update" : "Submit"; ?> &raquo;
        </button>
      </center>
    </div>
  </fieldset>
</form>

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

  <script>
    function toggleMenu() {
      const menu = document.querySelector(".right");
      menu.classList.toggle("active");
    }

    // Get the date input element
    const dateInput = document.getElementById('date');

    // Set max attribute dynamically to today's date
    dateInput.max = new Date().toISOString().split('T')[0];

    document.getElementById('add-photo').addEventListener('click', function() {
    const photoContainer = document.getElementById('photo-container');
    const newPhotoDiv = document.createElement('div');
    newPhotoDiv.className = 'input-row';
    
    const newLabel = document.createElement('label');
    newLabel.innerText = 'Upload more photos';
    newLabel.style.fontWeight = '700';
    
    const newInput = document.createElement('input');
    newInput.type = 'file';
    newInput.name = 'achievement_photos[]';
    newInput.className = 'form-control2';
    newInput.multiple = true;
    
    newPhotoDiv.appendChild(newLabel);
    newPhotoDiv.appendChild(newInput);
    photoContainer.appendChild(newPhotoDiv);
});
  </script>
               </body>
               </html>