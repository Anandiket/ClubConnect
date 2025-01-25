<?php
session_start();
include "db_connection.php";

if (!isset($_SESSION['id'])) {
  header("Location: convenorloginpage.php?l_id=2");
  exit();
}

$is_update = isset($_GET['committee_ID']);
$committee_id = $is_update ? $_GET['committee_ID'] : null; // Get committee ID if update mode

$dept_id = isset($_GET['dept_id']) ? $_GET['dept_id'] : '';
$sql_dept = "SELECT dept_name FROM Department WHERE id = $dept_id";
$result_dept = $conn->query($sql_dept);
$row_dept = $result_dept->fetch_assoc();
$dept_name = $row_dept['dept_name'];

if ($is_update && $committee_id) {
    $sql_committees = "SELECT * FROM committees WHERE committee_ID = ?";

    // Prepare and bind parameter
    $stmt = mysqli_prepare($conn, $sql_committees);
    mysqli_stmt_bind_param($stmt, "i", $committee_id);
    mysqli_stmt_execute($stmt);
    $result_committees = mysqli_stmt_get_result($stmt);

    // Check for committee existence
    if (mysqli_num_rows($result_committees) === 1) {
        $row = mysqli_fetch_assoc($result_committees);
        $committeeName = $row["committeeName"];
        $convenerName = $row["convenerName"]; // Fixed typo here
        $email = $row["email"];
        $contactNo = $row["contactNo"];
        $department = $row["department"];
    } else {
        echo "Committee not found.";
    }
    mysqli_stmt_close($stmt);
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
.center h2 {
  text-align: center;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
  color: white;
  background: #93332e;
  height: 60px;
  margin-left: 20px;
  margin-right: 20px;
  padding-top: 15px;
}

form.register {
  margin: 5px auto;
  padding: 5px;
  text-align: center;
  width: 100%;
  max-width: 600px;
  border-radius: 20px;
  border: 3px solid #93332e;
  box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);
  
}

.form-group {
  margin-bottom: 15px;
  text-align: left;
}

label {
  padding: 5px 0;
  font-weight: 700;
  font-size: 12pt;
  display: inline-block;
  width: 150px; /* Adjust label width as needed */
  text-align: right;
  margin-right: 10px; /* Add some margin between label and input */
}

input[type="text"], input[type="email"]{
  width: calc(100% - 250px);
  height: 30px;
  border: none;
  border-radius: 10px;
  padding: 5px;
}
input[type="tel"] {
  height: 30px;
  border: none;
  border-radius: 10px;
  padding: 5px;
  width:200px;
}
input:focus, select:focus {
  background-color: #efffe0;
}

#registerButton {
  width: 50%;
  font-family: "Poppins", sans-serif;
  background: #9B2928;
  padding: 10px;
  color: #fff;
  text-shadow: 0 -1px 1px rgba(0,0,0,0.25);
  cursor: pointer;
  font-weight: 600;
  font-size: 18px;
  text-align: center;
  border: none;
  border-radius: 5px;
  margin-top: 0px;
  margin-bottom: 20px;
}

#registerButton:hover {
  transform: scale(1.1); 
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); 
}

.border {
  margin: auto;
  margin-top:10px;
  padding: 3px;
}

hr {
  border: 0;
  background-color: #93332e;
  height: 2.5px;
  margin-top: 5px;
  margin-bottom: 5px;
}

form.register select {
  font-family: "Poppins", sans-serif;
  border: 1px solid #E1E1E1;
  width: 130px;
  margin-bottom: 3px;
  color: #9B2928;
  margin-right: 5px;
  text-align: center;
  height: 30px;
  border-radius: 5px;
}
legend{
  color:#93332e;
  font-weight:800;
  margin-top:-1%;
  margin-bottom:8%;
  font-size:22px;

}

/* Media queries for responsiveness */
@media (max-width: 768px) {
  .center h2 {
    margin-left: 10px;
    margin-right: 10px;
  }
  label {
    width: 100%;
    text-align: left;
    margin-right: 0;
  }
  
  input[type="text"], input[type="email"], input[type="tel"], select {
    width: 100%;
  }

  #registerButton {
    width: 100%;
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
            <?php
            if (!isset($_SESSION['id'])) { ?>
            <li><a href="#"><b>Login</b></a>
                <ul class="dropdown">
                    <li><a href="convenorloginpage.php?l_id=1">Convenor Login</a></li>
                    <li><a href="convenorloginpage.php?l_id=2">Superadmin Login</a></li>
                </ul>
            </li>
            <?php } else { ?>
            <li><a href="superadminlogout.php"><b>Logout</b></a></li>
            <?php } ?>
        </ul>
    </div>
</nav>

<div class="center">
    <h2><?php echo $is_update ? "Update " . $dept_name : "New " . $dept_name . " Registration"; ?></h2>
</div>

<div class="container">
    <div id="newUser">
        <form name="newUser" class="register" action="committeedb.php" method="POST">
            <div class="border">
                <fieldset class="row1">
                    <legend><?php echo $dept_name ?> Details</legend>
                    <div class="form-group">
                        <label><?php echo $dept_name ?> Name</label>
                        <input type="text" name="committeeName" class="form-control" value="<?php echo $is_update ? $committeeName : ''; ?>" placeholder="Enter <?php echo $dept_name ?>'s name (25 characters only)">
                    </div>
                    <div class="form-group">
                        <label>Convenor Name</label>
                        <input type="text" name="convenerName" class="form-control" value="<?php echo $is_update ? $convenerName : ''; ?>" placeholder="Enter Convenor's name (25 characters only)">
                    </div>
                </fieldset>
                <hr>
                <fieldset class="row2">
                    <legend>Personal Details</legend>
                    <div class="form-group">
                        <label>EMAIL ID</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $is_update ? $email : ''; ?>" placeholder="Enter your Email Id">
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="tel" name="contactNo" class="form-control" value="<?php echo $is_update ? $contactNo : ''; ?>" placeholder="Enter your Phone Number">
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
                    </div>
                </fieldset>
            </div>   

            <div>
                <input type="hidden" name="action" value="<?php echo $is_update ? 'update' : 'insert'; ?>"> <!-- Hidden field for action type -->
                <input type="hidden" name="committee_ID" value="<?php echo $is_update ? $committee_id  : ''?>">  
                <input type="hidden" name="dept_id" value="<?php echo $dept_id; ?>">
                <button type="submit" id="registerButton"><?php echo $is_update ? "Update" : "Register"; ?> &raquo;</button>
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
    // if any form field isn't filled don't go on
    if (!form.userFirst.value || !form.userLast.value || !form.userPhone.value || !form.userdepartment.value) {
      alert('Missing Data');
      return false;
    }
    return true;
  }

  document.getElementById('registerButton').addEventListener('click', function() {
    if (userRegistration(document.newUser)) {
      var committeeName = document.newUser.userCommitteename.value;
      var convenerName = document.newUser.userConvenername.value;
      var userEmail = document.newUser.userFirst.value;
      var userPhone = document.newUser.userPhone.value;
      var userDepartment = document.newUser.userdepartment.value;
      var remarks = document.newUser.userLast.value;

      // You can do something with the collected data here, like sending it to a server or displaying it
      console.log("Committee Name:", committeeName);
      console.log("Convener Name:", convenerName);
      console.log("User Email:", userEmail);
      console.log("User Phone:", userPhone);
      console.log("User Department:", userDepartment);
      console.log("Remarks:", remarks);

      // Displaying updated profile
      document.getElementById('newUser').style.display = "none";
      document.getElementById('updatedProfile').style.display = "block";
    }
  });
</script>
</body>
</html>