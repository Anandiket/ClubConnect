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







label {
  font-family: "Poppins", sans-serif;
  padding: 10px 0;
  font-weight: 600;
  font-size: 18px;
  width: 150px; /* Adjust label width as needed */
  text-align: right;
  margin-right:10px; /* Add some margin between label and input */
  margin-left:10px;
}

form.register {
  font-family: "Poppins", sans-serif;
  padding: 20px;
  text-align: left;
  max-width: 900px; /* Make the form thinner */
  margin: 0 auto; /* Center the form */
}

.form-group {
  font-family: "Poppins", sans-serif;
  margin-bottom: 15px;
  width: 100%;
}

form.register legend {
  font-family: "Poppins", sans-serif;
  color: #93332e;
  padding: 2px;
  margin-top:20px;
  margin-left: 10px;
  font-weight: bold;
  font-size: 20px;
  font-weight: 100;
  margin-bottom: 10px;
  text-align: center;
}

input[type="text"]{
  font-family: "Poppins", sans-serif;
  border: 1px solid #E1E1E1;
  padding: 20px; /* Reduced padding */
  border-radius: 10px; 
  width: 45%;
  box-sizing: border-box; 
  margin-bottom: 10px; 
  height: 30px; 
}
input[type="text1"]{
  font-family: "Poppins", sans-serif;
  border: 1px solid #E1E1E1;
  padding: 20px; /* Reduced padding */
  border-radius: 10px; 
  width: 40%;
  box-sizing: border-box; 
  margin-bottom: 10px; 
  height: 30px;
}
input[type="tel"]{
  font-family: "Poppins", sans-serif;
  border: 1px solid #E1E1E1;
  padding: 20px; /* Reduced padding */
  border-radius: 10px; 
  width: 35%;
  box-sizing: border-box; 
  margin-bottom: 10px; 
  height: 30px;
}
input[type="file"] {
  border: 1px solid #ccc;
  border-radius: 10px;
  box-sizing: border-box;
  width: 50%;
  align-content: center;

}
form.register select {
  font-family: "Poppins", sans-serif;
  border: 1px solid #E1E1E1;
  border-radius: 10px;
  margin-bottom: 3px;
  color: #9B2928;
  text-align: center;
  width: 20%;
}

input:focus, select:focus {
  font-family: "Poppins", sans-serif;
  background-color: #efffe0;
}

div.agreement {
  font-family: "Poppins", sans-serif;
  margin-left: 15px;
}

#registerButton {
  width: 50%;
  font-family: "Poppins", sans-serif;
  background: #9B2928;
  padding: 8px 10px;
  color: #fff;
  text-shadow: 0 -1px 1px rgba(0,0,0,0.25);
  cursor: pointer;
  font-weight: 600;
  font-size: 18px;
  display: block;
  margin: 20px auto;
  text-align: center;
  border: none;
  border-radius: 5px;
}

#registerButton:hover {
  font-family: "Poppins", sans-serif;
  transform: scale(1.1);
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

#updatedProfile {
  font-family: "Poppins", sans-serif;
  display: none;
  margin: 20px auto 0;
  background-color: #fff;
  padding: 20px;
  border-radius: 20px;
}

#updatedProfile h2, #updatedProfile h3 {
  font-family: "Poppins", sans-serif;
  color: #abda0f;
  padding: 2px;
  margin-left: 10px;
  font-weight: bold;
  font-size: 14px;
  font-weight: 100;
  margin-bottom: 5px;
}

.form-control, .form-control2 {
  font-family: "Poppins", sans-serif;
  border: 1px solid #E1E1E1;
  padding: 0;
  width: 100%;
  box-sizing: border-box;
  margin-bottom: 10px;
  height: 40px; /* Adjusted height */
  border-radius: 5px;
  font-size: 14px;
  font-weight: 500;
}

.custom-select {
  font-family: "Poppins", sans-serif;
  appearance: none;
  -webkit-appearance: none;
  -moz-appearance: none;
  background: url('data:image/svg+xml;charset=US-ASCII,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 4 5"%3E%3Cpath fill="%239B2928" d="M2 0L0 2h4z" /%3E%3C/svg%3E') no-repeat right 10px center;
  background-size: 10px;
  background-color: #fff;
  color: #9B2928;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 14px;
  cursor: pointer;
  height: 40px;
  width: 100%;
  max-width: 100%;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.custom-select option {
  font-family: "Poppins", sans-serif;
  background-color: #fff;
  color: #9B2928;
}

.custom-select:focus {
  border-color: #9B2928;
  box-shadow: 0 0 5px rgba(155, 41, 40, 0.5);
  outline: none;
}

.custom-select:hover {
  border-color: #9B2928;
}

.member h1 {
  font-family: "Poppins", sans-serif;
  font-weight: 500;
}

/* .details {
  margin-top: -30px;
  font-family: "Poppins", sans-serif;
  font-weight: 500;
} */

.personal {
  font-family: "Poppins", sans-serif;
  font-weight: 500;
}

.row1, .row2 {
  border: none;
  margin: 20px 0;
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
}

hr {
  border: 0;
  background-color: #93332e;
  height: 2.5px;
  margin-top: 20px;
  margin-bottom: 20px;
}

.border {
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
  border: 2px solid #93332e;
  border-radius: 10px;
  margin-left: auto;
  margin-right: auto;
  padding: 10px;
  max-width: 100%;
}


@media (max-width: 768px) {
  form.register {
    max-width: 100%;
  }

  label {
    width: 100%;
    text-align: left;
    margin-bottom: 5px;
  }

  form.register input, form.register select {
    width: 100%;
    margin: 0;
  }

  #registerButton {
    width: 100%;
  }

  .row1, .row2 {
    margin: 0;
    flex-direction: column;
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
  <a href="committeepg.php?f_id=4&l_id=1"><button class="back-button" >Go Back</button></a>

<div class="container">
  <div id="newUser">
    <!-- New User Profile -->
    
    <?php
    // Check if the committee_ID is set in the session
if (!isset($_SESSION['id'])) {
  echo "Committee ID not set in session.";
  exit;
}

// Retrieve the committee_ID from session
$committee_id = $_SESSION['committee_ID'];

// Validate and sanitize inputs (optional but recommended)
$committee_id = filter_var($committee_id, FILTER_SANITIZE_NUMBER_INT);

    $is_update = isset($_GET['member_id']);
    //$committee_id = isset($_GET['committee_ID']) ? $_GET['committee_ID'] : '';
    $member_id = $is_update ? $_GET['member_id'] : '';
    $sql_member = "SELECT * FROM members WHERE member_id = ?";
    $stmt_member = mysqli_prepare($conn, $sql_member);
    mysqli_stmt_bind_param($stmt_member, "i", $member_id);
    mysqli_stmt_execute($stmt_member);
    $result_member = mysqli_stmt_get_result($stmt_member);

if ($row = mysqli_fetch_assoc($result_member)) {
    $committee_id = $row['committee_ID'];
    $member_name = $row['member_name'];
    $department = $row['department'];
    $year = $row['year'];
    $division = $row['division'];
    $position = $row['position'];
    $tenure_year = $row['tenure_year'];
    $contact_no = $row['contact_no'];
    $photo = $row['photo'];

} 


mysqli_stmt_close($stmt_member);
mysqli_close($conn);
    ?>
   <header>
            <h2><?php echo $is_update ? "Update Member" : "New Member Registration"; ?></h2>
</header> 
<form name="newUser" class="register" action="memberdb.php" method="post" enctype="multipart/form-data">    
    


        <div class="border">
            <fieldset class="row1">
                <div class="details">
                    <legend><h2>Member Details</h2></legend>
                </div>
                <?php
            if (isset($_GET['error'])) {
                echo "<p style='color:black;'>" . htmlspecialchars($_GET['error']) . "</p>";
            }
            ?>

                <div class="form-group">
                    <label>Member Name</label>
                    <input type="text" name="member_name" class="form-control" value="<?php echo $is_update ? htmlspecialchars($member_name) : ''; ?>" placeholder="Enter member's name (25 characters only)"> 
                                 </div>
                                 <div class="form-group">
                                 <label>Department</label>
<select name="department" id="department" class="form-control custom-select">
    <option value="" disabled>Select</option>
    <option value="Computer" <?php echo ($is_update && $department == 'Computer') ? 'selected' : ''; ?>>Computer</option>
    <option value="IT" <?php echo ($is_update && $department == 'IT') ? 'selected' : ''; ?>>IT</option>
    <option value="AIDS" <?php echo ($is_update && $department == 'AIDS') ? 'selected' : ''; ?>>AIDS</option>
    <option value="EXTC" <?php echo ($is_update && $department == 'EXTC') ? 'selected' : ''; ?>>EXTC</option>
    <option value="BSH" <?php echo ($is_update && $department == 'BSH') ? 'selected' : ''; ?>>BSH</option>
</select>
<label>Year</label>
<select name="year" id="year" class="form-control custom-select">
    <option value="" disabled <?php echo !$is_update ? 'selected' : ''; ?>>Year</option>
    <option value="FY" <?php echo $is_update && $year == 'FY' ? 'selected' : ''; ?>>FY</option>
    <option value="SY" <?php echo $is_update && $year == 'SY' ? 'selected' : ''; ?>>SY</option>
    <option value="TY" <?php echo $is_update && $year == 'TY' ? 'selected' : ''; ?>>TY</option>
    <option value="LY" <?php echo $is_update && $year == 'LY' ? 'selected' : ''; ?>>LY</option>
</select>

    <label>Division</label>
<select name="division" id="division" class="form-control custom-select">
    <option value="" disabled <?php echo !$is_update ? 'selected' : ''; ?>>Division</option>
    <option value="A" <?php echo $is_update && $division == 'A' ? 'selected' : ''; ?>>A</option>
    <option value="B" <?php echo $is_update && $division == 'B' ? 'selected' : ''; ?>>B</option>
</select>
</div>
            </fieldset>
            <hr>
            <fieldset class="row2">
                <div class="personal">
                    <legend><h2>Personal Details</h2></legend>
                </div>
                <div class="form-group">
                <label>Member Position</label>
<select name="position" id="position" class="form-control custom-select">
    <option value="">Select Position</option>
    <option value="Chairperson" <?php echo ($is_update && $position == 'Chairperson') ? 'selected' : ''; ?>>Chairperson</option>
    <option value="Secretary" <?php echo ($is_update && $position == 'Secretary') ? 'selected' : ''; ?>>Secretary</option>
    <option value="Head" <?php echo ($is_update && $position == 'Head') ? 'selected' : ''; ?>>Head</option>
    <option value="Member" <?php echo ($is_update && $position == 'Member') ? 'selected' : ''; ?>>Member</option>
    <option value="Others" <?php echo ($is_update && $position == 'Others') ? 'selected' : ''; ?>>Others</option>
</select>

<!-- Additional text input for 'Others' -->
<div id="otherPositionInput" style="display:none; margin-top:10px;">
    <label>Please specify:</label>
    <input type="text" name="position" class="form-control">
</div>

<!-- Core/Member Checkbox (Single Selection) -->

<div class="form-check">
<label style="margin-top: 10px;">Select Role:</label>
    <input class="form-check-input" type="radio" name="role" id="core" value="Core">
    <label class="form-check-label" for="core">Core</label>

    <input class="form-check-input" type="radio" name="role" id="member" value="Member">
    <label class="form-check-label" for="member">Member</label>
</div>
                <label>Contact No</label>
                <input type="tel" name="contact_no" class="form-control" value="<?php echo $is_update ? htmlspecialchars($contact_no) : ''; ?>" pattern="\d{10}" title="Please enter a valid 10-digit contact number" placeholder="Enter member's contact number">
                </div>


                <div class="form-group">
                    <label>Tenure</label>
                    <input type="text1" name="tenure_year" class="form-control" value="<?php echo $is_update ? htmlspecialchars($tenure_year) : ''; ?>" pattern="\d{4}-\d{2}" title="Please enter a valid year (e.g., 2023-24)" placeholder="Enter tenure year (Eg. 2023-24)">
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
                <input type="hidden" name="member_id" value="<?php echo $member_id; ?>">
                <button type="submit" id="registerButton">
                    <?php echo $is_update ? "Update" : "Register"; ?> &raquo;
                </button>
            </div>
        </div>
    </form>
</div>
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

document.getElementById('department').addEventListener('change', function() {
    var divisionSelect = document.getElementById('division');
    var yearSelect = document.getElementById('year');

    // Clear the current options in the division and year dropdowns
    divisionSelect.innerHTML = '';
    yearSelect.innerHTML = '';

    if (this.value === 'BSH') {
        // Add divisions A through H when BSH is selected
        for (var i = 65; i <= 72; i++) {  // ASCII values for A to H
            var option = document.createElement('option');
            option.value = String.fromCharCode(i);
            option.text = String.fromCharCode(i);
            divisionSelect.appendChild(option);
        }
        // Add only FY to year select
        var optionFY = document.createElement('option');
        optionFY.value = 'FY';
        optionFY.text = 'FY';
        yearSelect.appendChild(optionFY);
    } else {
        // Default divisions for other departments
        var optionA = document.createElement('option');
        optionA.value = 'A';
        optionA.text = 'A';
        divisionSelect.appendChild(optionA);

        var optionB = document.createElement('option');
        optionB.value = 'B';
        optionB.text = 'B';
        divisionSelect.appendChild(optionB);

        // Add SY, TY, and LY to year select
        var optionSY = document.createElement('option');
        optionSY.value = 'SY';
        optionSY.text = 'SY';
        yearSelect.appendChild(optionSY);

        var optionTY = document.createElement('option');
        optionTY.value = 'TY';
        optionTY.text = 'TY';
        yearSelect.appendChild(optionTY);

        var optionLY = document.createElement('option');
        optionLY.value = 'LY';
        optionLY.text = 'LY';
        yearSelect.appendChild(optionLY);
    }
});

document.getElementById('position').addEventListener('change', function() {
    var otherInput = document.getElementById('otherPositionInput');
    if (this.value === 'Others') {
        otherInput.style.display = 'block';
    } else {
        otherInput.style.display = 'none';
    }
});
</script>
</body>
</html>

