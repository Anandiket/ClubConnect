<?php
session_start();
if (!isset($_SESSION['id'])) {
  echo "Committee ID not set in session.";
  exit;
}

$l_id = isset($_GET['l_id']) ? $_GET['l_id'] : 0;
$f_id = isset($_GET['f_id']) ? $_GET['f_id'] : 0;
$dept_id = isset($_GET['dept_id']) ? $_GET['dept_id'] : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title>Event/Achievement/Member Form</title>
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


/*form*/
/* Base styles for form and input */
form {
    margin: 5px auto;
    padding: 50px;
    text-align: center;
    width: 100%;
    max-width: 600px;
    border-radius: 20px;
    border: 3px solid #93332e;
    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);
    font-weight: 600;
}

input[type="submit"] {
    height: 30px;
    width: 30%;
    border-radius: 10px;
    background-color: #93332e;
    color: white;
    font-weight: 600;
    margin-top: 10px;
}

table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}

/* Responsive styles */
@media (max-width: 768px) {
    form {
        padding: 30px;
    }
    
    input[type="submit"] {
        width: 50%;
    }
}

@media (max-width: 480px) {
    form {
        padding: 20px;
    }
    
    input[type="submit"] {
        width: 70%;
    }
}

@media (max-width: 320px) {
    form {
        padding: 10px;
    }
    
    input[type="submit"] {
        width: 90%;
    }
}


/*footer*/
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
        <li>
            <?php if ($l_id == 1) { ?>
                <a href="Logout.php"><b>Logout</b></a>
            <?php } else { ?>
                <a href="#"><b>Login</b></a>
                <ul class="dropdown">
                    <li><a href="convenorloginpage.php?l_id=1">Convenor Login</a></li>
                    <li><a href="convenorloginpage.php?l_id=2">Superadmin Login</a></li>
                </ul>
            <?php } ?>
        </li>
      </ul>
    </div>
</nav>

<a href="committeepg.php?l_id=1&f_id=<?php echo $f_id; ?>&dept_id=<?php echo $dept_id; ?>">
    <button class="back-button">Go Back</button>
</a>

<header><h2>Report</h2></header>

<!-- Category Selection Form -->
<form method="post">
    <label for="category">Select Category:</label>
    <select id="category" name="category" onchange="this.form.submit()">
        <option value="">Select</option>
        <option value="event" <?= isset($_POST['category']) && $_POST['category'] == 'event' ? 'selected' : '' ?>>Event</option>
        <option value="achievement" <?= isset($_POST['category']) && $_POST['category'] == 'achievement' ? 'selected' : '' ?>>Achievement</option>
        <option value="member" <?= isset($_POST['category']) && $_POST['category'] == 'member' ? 'selected' : '' ?>>Member</option>
    </select>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['category'])) {
    $category = $_POST['category'];
    $attributes = [];

    echo '<form method="post" action="generate_table.php">'; // Ensure form action points to the correct script
    echo '<input type="hidden" name="category" value="' . $category . '">';
    echo '<input type="hidden" name="l_id" value="'. $l_id . '">';
    echo '<input type="hidden" name="f_id" value="' . $f_id . '">';
    echo '<input type="hidden" name="dept_id" value="'. $dept_id .'">';

    if ($category == 'event' || $category == 'achievement') {
        echo '<div class="form-group">';
        echo '<label for="start_date">Start Date:</label>';
        echo '<input type="date" id="start_date" name="start_date">';
        echo '</div>';
        echo '<div class="form-group">';
        echo '<label for="end_date">End Date:</label>';
        echo '<input type="date" id="end_date" name="end_date">';
        echo '</div>';
        echo '<br>';
        if ($category == 'event') {
            $attributes = ['Event Name', 'Description', 'Date', 'Resource Person Name', 'Resource Person Contact', 'Resource Person Email', 'Academic Year'];
        } elseif ($category == 'achievement') {
            $attributes = ['Achievement Name', 'Date', 'Description', 'Students'];
        }
    } elseif ($category == 'member') {
        echo '<div class="form-group">';
        echo '<label for="tenure_year">Select Tenure Year:</label>';
        echo '<select id="tenure_year" name="tenure_year">';
        for ($year = 2000; $year <= 2098; $year++) {
            $nextYearShort = str_pad(($year + 1) % 100, 2, '0', STR_PAD_LEFT);
            echo '<option value="' . $year . '-' . $nextYearShort . '">' . $year . '-' . $nextYearShort . '</option>';
        }
        echo '</select>';
        echo '</div>';
        echo '<br>';
        $attributes = ['Member Name', 'Position', 'Department', 'Year', 'Division', 'Tenure Year', 'Member Contact Number'];
    }

    foreach ($attributes as $attribute) {
        echo '<input type="checkbox" name="attributes[]" value="' . $attribute . '">' . $attribute . '<br>';
    }

    echo '<input type="submit" value="Generate Table">';
    echo '</form>';
}
?>

</body>
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
      <a target="_blank" href="https://www.instagram.com/kjsit_official/"><img class="logoinsta" src="insta logo.png" alt="Instagram Logo"></a>
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
</html>
