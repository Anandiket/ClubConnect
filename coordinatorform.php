<?php
session_start();
include "db_connection.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <title>Coordinator</title>
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
  

.row1{
border:none;
}
.row2{
  border:none;
}
hr{
  border: 0;
      background-color: #93332e;
      height: 2.5px;
}
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

/* Header styles */
h1 {
    font-size: 2em;
    text-align: center;
    padding: 10px;
    margin-bottom: 20px;
}

/* Form styles */
form.register {
  border: 3px solid #93332e;
    border-radius: 20px;
    padding: 20px;
    margin: 20px 0;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

/* Fieldset and legend styles */
fieldset {
    margin-bottom: 20px;
}

legend {
  color:#93332e;
    font-size: 1.1em;
    margin-bottom: 10px;
}

/* Form group styles */
.form-group {
    margin-bottom: 15px;
}

label {
    display: inline-block;
    width: 150px;
    text-align: right;
    margin-right: 10px;
    font-weight:600;

}

input[type="text"], input[type="email"], input[type="file"], select {
    width: calc(100% - 180px);
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 10px;
}

input[type="text"]:focus, input[type="email"]:focus, select:focus {
    border-color: #93332e;
    outline: none;
    box-shadow: 0 0 5px rgba(155, 41, 40, 0.5);
}

/* Button styles */
#registerButton {
    width: 250px;
    padding: 10px;
    background-color: #93332e;
    color: #fff;
    border: none;
    border-radius: 5px;
    font-size: 18px;
    font-weight: 600;
    cursor: pointer;
    margin: 20px auto;
    display: block;
    text-align: center;
    transition: transform 0.3s, box-shadow 0.3s;
}

#registerButton:hover {
    transform: scale(1.1);
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    label {
        width: 100%;
        text-align: left;
        margin-bottom: 5px;
    }

    input[type="text"], input[type="email"], input[type="file"], select {
        width: 100%;
        margin-bottom: 10px;
    }

    .row1, .row2 {
        width: 100%;
        margin-left: 0;
        padding: 0;
    }
}

@media (max-width: 480px) {
    h1 {
        font-size: 1.5em;
    }

    legend {
        font-size: 1.2em;
    }

    input[type="text"], input[type="email"], select {
        padding: 8px;
    }

    #registerButton {
        font-size: 16px;
        padding: 8px;
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
    <!-- New User Profile -->
    
    <?php
    // Check if the committee_ID is set in the session
if (!isset($_SESSION['committee_ID'])) {
  echo "Committee ID not set in session.";
  exit;
}

// Retrieve the committee_ID from session
$committee_id = $_SESSION['committee_ID'];

// Validate and sanitize inputs (optional but recommended)
$committee_id = filter_var($committee_id, FILTER_SANITIZE_NUMBER_INT);

  $is_update = isset($_GET['coordinator_id']);
  $committee_id = isset($_GET['committee_ID']) ? $_GET['committee_ID'] : '';
 $coordinator_id = $is_update ? $_GET['coordinator_id'] : '';
 $sql_coordinator = "SELECT * FROM coordinator WHERE coordinator_id = ?";
 $stmt_coordinator = mysqli_prepare($conn, $sql_coordinator);
 mysqli_stmt_bind_param($stmt_coordinator, "i", $coordinator_id);
 mysqli_stmt_execute($stmt_coordinator);
 $result_coordinator = mysqli_stmt_get_result($stmt_coordinator);

 if ($row_coordinator = mysqli_fetch_assoc($result_coordinator)) {
     $is_update = true;
     $coordinator_name = $row_coordinator['coordinator_name'];
     $department = $row_coordinator['department'];
     $email = $row_coordinator['email'];
     $contact_no = $row_coordinator['contact_no'];
     $photo = $row_coordinator['photo'];
 }

 mysqli_stmt_close($stmt_coordinator);
mysqli_close($conn);
    ?>
    <header>
            <h2><?php echo $is_update ? "Update Coordinator"  :  "New Coordinator Registration"; ?></h2>
</header>
        <div class="container">
  <div id="newUser">
      <form name="newUser" class="register" action="coordinatordb.php" method="post" enctype="multipart/form-data">
        <!-- <div class="member">
            <h1><?php echo $is_update ? "Update Coordinator"  :  "New Coordinator Registration"; ?></h1>
        </div> -->
        <div class="border">
            <fieldset class="row1">
            <?php
                if (isset($_GET['error'])) {
                    echo "<p style='color:black;'>" . htmlspecialchars($_GET['error']) . "</p>";
                 }
                ?>
                <div class="details">
                    <legend><h2>Coordinator Details</h2></legend>
                </div>
                <div class="form-group">
                    <label>Coordinator Name</label>
                    <input type="text" name="coordinator_name" class="form-control" value="<?php echo $is_update ? htmlspecialchars($coordinator_name) : ''; ?>" placeholder="Enter name (with Designation eg:Prof,Dr)"> 
                </div>
                <div class="form-group">
                    <label>Department</label>
                    <select name="coordinator_department" class="form-control custom-select">
                        <option value="" disabled>Select</option>
                        <option value="Computer" <?php echo ($is_update && $department == 'Computer') ? 'selected' : ''; ?>>Computer</option>
                        <option value="IT" <?php echo ($is_update && $department == 'IT') ? 'selected' : ''; ?>>IT</option>
                        <option value="AIDS" <?php echo ($is_update && $department == 'AIDS') ? 'selected' : ''; ?>>AIDS</option>
                        <option value="EXTC" <?php echo ($is_update && $department == 'EXTC') ? 'selected' : ''; ?>>EXTC</option>
                        <option value="BSH" <?php echo ($is_update && $department == 'BSH') ? 'selected' : ''; ?>>BSH</option>

                    </select>
                </div>
            </fieldset>
            <hr>
            <fieldset class="row2">
                <div class="personal">
                    <legend><h2>Personal Details</h2></legend>
                </div>
                <div class="form-group">
                    <label>Contact Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $is_update ? htmlspecialchars($email) : ''; ?>" placeholder="Enter Coordinator's email">
                </div>
                <div class="form-group">
                    <label>Contact Number</label>
                    <input type="text" name="contact_no" class="form-control" value="<?php echo $is_update ? htmlspecialchars($contact_no) : ''; ?>" pattern="\d{10}" title="Please enter a valid 10-digit contact number" placeholder="Enter contact number (10 digits only)">
                </div>
                
                <div class="form-group">
                    <label>Add profile photo</label>
                    <?php if ($is_update && !empty($photo)) : ?>
                        <div>
                            <p>Previous photo exists.</p>
                            <input type="hidden" name="existing_photo" value="<?php echo htmlspecialchars($photo); ?>">
                        </div>
                    <?php endif; ?>
                    <input type="file" name="photo" class="form-control2">
                </div>
            </fieldset>
            <div>
                <input type="hidden" name="committee_ID" value="<?php echo $committee_id; ?>">
                <input type="hidden" name="action_type" value="<?php echo $is_update ? 'update' : 'insert'; ?>">
                <input type="hidden" name="coordinator_id" value="<?php echo $coordinator_id; ?>">
                <button type="submit" id="registerButton">
                    <?php echo $is_update ? "Update" : "Register"; ?> &raquo;
                </button>
            </div>
        </div>
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
</script>
<script>
  
  function userRegistration(form) {
    const fields = ['userMembername', 'userCommitteename', 'userFirst', 'userLast', 'userPhone', 'userEmail', 'userdepartment', 'userLast', 'userRemarks'];
    const isMissing = fields.some(field => !form[field].value.trim());
    if (isMissing) {
      alert('Missing Data');
      return;
    }

    const emailInput = form.userEmail.value;
    const isValidEmail = /^[a-z0-9._%-]+@[a-z0-9.-]+\.[a-z]{2,5}$/.test(emailInput);
    if (!isValidEmail) {
      alert('Please enter a validated email');
      form.userEmail.focus();
      return false;
    }

    const registeredUser = Object.fromEntries(fields.map(field => [field.replace('user', '').toLowerCase(), form[field].value.trim()]));
    displayUser(registeredUser);
  }

  function displayUser(registeredUser) {
    console.log(registeredUser);
    Object.entries(registeredUser).forEach(([key, value]) => document.getElementById(key === 'email' ? 'userEmail' : 'user' + key.charAt(0).toUpperCase() + key.slice(1)).innerText = `${key === 'email' ? 'Email' : 'Member ' + key.charAt(0).toUpperCase() + key.slice(1)}: ${value}`);
    document.getElementById('newUser').style.display = "none";
    document.getElementById('updatedProfile').style.display = "block";
  }

  document.getElementById('registerButton').addEventListener('click', () => userRegistration(document.newUser));

  
document.querySelector('input[name="photo"]').addEventListener('change', function(event) {
    const [file] = event.target.files;
    if (file) {
        const currentPhoto = document.getElementById('current-photo');
        if (currentPhoto) {
            currentPhoto.src = URL.createObjectURL(file);
        } else {
            const img = document.createElement('img');
            img.id = 'current-photo';
            img.src = URL.createObjectURL(file);
            img.style.maxWidth = '150px';
            img.style.maxHeight = '150px';
            img.style.display = 'block';
            event.target.insertAdjacentElement('beforebegin', img);
        }
    }
});

</script>
</body>
</html>