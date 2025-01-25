<?php
session_start();
include "db_connection.php";
//include "session_timout.php";

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: convenorloginpage.php?l_id=1");
    exit();
}

// Retrieve the username from the session
$email = $_SESSION['email'];

// Query to get the user ID using the username
$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $user_id = $row['id']; // Store the user ID in a variable
} else {
    // Handle the case where the user is not found
    echo "User not found.";
    exit();
}

$stmt->close();

// Query to get the committee_ID using the user_id
$stmt = $conn->prepare("SELECT committee_ID FROM convenor WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $committee_ids = [];
    while ($row = $result->fetch_assoc()) {
        $committee_ids[] = $row['committee_ID']; // Store all committee_IDs in an array
    }
} else {
    // Handle the case where no committees are found for the user
    echo "No committees found for this user.";
    exit();
}

$stmt->close();

// Convert the array of committee IDs to a comma-separated string for the query
$committee_ids_str = implode(",", $committee_ids);

// Query to get the committee names using the committee IDs
$committees_sql = "SELECT * FROM committees WHERE committee_ID IN ($committee_ids_str)";
$committees_result = $conn->query($committees_sql);
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <title>List</title>
    <style>
        /* Bordered form */
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
  z-index: 11; /* Ensures nav is above other elements */
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
    z-index: 11; /* Ensures the right menu is above other elements */
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


.container {
  place-content: center;
  place-self: center;
  height: 450px;
  margin: 80px auto;
  border-radius: 20px;
  border: 3px solid #93332e;
  box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);
  width: calc(100% - 800px);
  max-width: 600px;
  padding: 20px;
  perspective: 1000px;
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
  margin: 0 auto;
  padding: 15px;
  width: calc(100% - 160px);
  max-width: 1200px;
}

.convenor h2 {
  padding-top: 15px;
}

@media (max-width: 1200px) {
  .container {
    width: calc(100% - 200px);
  }
  
  .center h2 {
    width: calc(100% - 40px);
  }
}

@media (max-width: 768px) {
  .container {
    width: 90%;
    height: auto;
    margin: 40px auto;
  }

  .center h2 {
    width: 90%;
    height: auto;
    padding: 10px 0;
  }

  ul {
    padding: 0;
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
            <?php } else { ?>
          <li><a href="Logout.php"><b>Logout</b></a></li>
<?php
          } ?>
          </ul>
          
        </li>
      </ul>
    </div>
  </nav>
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
    <div class="committees">
    <?php
    
    if ($committees_result->num_rows > 0) {
        echo "<ul>";
        while ($committee = $committees_result->fetch_assoc()) { 
          ?>
          <a style="text-decoration: none;" href="javascript:void(0);" onclick="navigateToPage('committeepg.php?f_id=1&l_id=1', <?php echo $committee['committee_ID']; ?>);"><h3><?php echo $committee['committeeName']?><br><br></h3></a>
<?php
          
        }
        echo "</ul>";
    } else {
        echo "No committees found.";
    }

    error_log("User $email (ID: $user_id) accessed the committee list on " . date("Y-m-d H:i:s"));
    ?>
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
function storeCommitteeID(committee_id) {
    // Use AJAX to store the committee ID in the session
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "store_committee.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Optionally handle success response
                console.log("Committee ID stored successfully.");
                // You can optionally redirect here if needed
            } else {
                // Handle error response
                console.error("Error storing Committee ID.");
            }
        }
    };
    xhr.send("committee_ID=" + encodeURIComponent(committee_id));
}

function navigateToPage(url, committee_id) {
    storeCommitteeID(committee_id);
    window.location.href = url;
}

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

<script>
document.getElementById('login-button').addEventListener('click', function (event) {
    event.preventDefault(); // Prevent the default button behavior
    
    var container = document.querySelector('.container');
    
    // Add flip class to trigger the animation
    container.classList.add('flip-reverse'); // Add a new class for reverse flip
});

document.getElementById('signup2-link').addEventListener('click', function (event) {
    event.preventDefault(); // Prevent the default link behavior
    
    var container = document.querySelector('.container');
    
    // Add flip class to trigger the animation
    container.classList.add('flip-reverse'); // Add a new class for reverse flip
});
</script>




</html>



