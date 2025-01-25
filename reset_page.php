
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <title>Reset Password</title>
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
  padding: 20px;
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
  height: auto; /* Adjusted for dynamic height based on content */
  padding: 20px;
  border-radius: 20px;
  border: 3px solid #93332e;
  box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);
  max-width: 600px; /* Increase maximum width for computer screens */
  margin: auto; /* Center align the form */
}

.center h2 {
  text-align: center;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
  color: white;
  background: #93332e;
  height: 60px;
  margin: 0 20px; /* Adjust margins for smaller screens */
}

h2 {
  padding-top: 15px;
}

input[type=text], input[type=password] {
  width: 70%; /* Adjusted width for larger screens */
  padding: 12px 15px;
  margin: 10px 0; /* Increased margin for better spacing */
  /* display: inline-block; */
  border: 1px solid #ccc;
  border-radius: 10px; /* Rounded corners */
  box-sizing: border-box;
}

button[type=submit] {
  font-family: "Poppins", sans-serif;
  background-color: #93332e;
  color: white;
  font-size: 23px;
  padding: 14px 20px;
  border-radius: 10px;
  border: none;
  cursor: pointer;
  width: 70%; /* Adjusted width for larger screens */
  margin-top: 20px;
}

button[type=submit]:hover {
  opacity: 0.8;
}

.container {
  margin: auto;
}

@media (max-width: 1200px) {
  form {
    width: calc(100% - 100px);
    padding: 10px;
  }

  .center h2 {
    width: calc(100% - 40px);
    margin: 0 20px;
  }
}

@media (max-width: 768px) {
  form {
    width: calc(100% - 40px);
    padding: 10px;
  }

  .center h2 {
    width: calc(100% - 20px);
    padding: 10px 0;
  }

  input[type=text], input[type=password] {
    width: 100%; /* Full width on smaller screens */
  }

  button[type=submit] {
    width: 100%; /* Full width button on smaller screens */
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
  margin-top:20px;
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


/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
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
<header>
  <h2>CONVENOR LOGIN</h2>
</header>
<body>
  <center>
    <form action="process_reset.php" method="post">
      <div class="sign"><h1><center>Reset Password</center></h1></div>
      <?php if(isset($_GET['error'])) { ?>
          <p class="error"><?php echo $_GET['error']; ?></p>
      <?php } ?>
      <div class="container">
        <label for="psw"><b><h3>Set Password</h3></b></label>
        <input type="password" placeholder="Enter Password" name="password" required>
        <br>
        <label for="psw"><b><h3>Confirm Password</h3></b></label>
        <input type="password" placeholder="Enter Password" name="confirm_password" required>
        <br>
        <input type="hidden" name="email" value="<?php echo isset($_GET['email']) ? $_GET['email'] : ''; ?>">
        <button type="submit">Submit</button>
      </div>
    </form>
  </center>
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

 
