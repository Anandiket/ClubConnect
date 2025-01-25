<?php
session_start();
include 'db_connection.php';


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





.committees {
  text-decoration: none;
    margin-top: 40px;
    text-align: left;
    padding: 50px;
}

.committee:hover {
  text-decoration: none;
    color: #ffcccb;
    font-size: 28px;
}
.new {
  text-decoration: none;
  color:white; 
}
.committee {
    text-decoration: none;
    background-color: #93332e;
    color: #fff; /* White text */
    width: 100%; /* Set width to 100% for responsiveness */
    max-width: 1100px; /* Maintain maximum width */
    margin: 10px auto;
    padding: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.9); /* Grey shadow background */
    font-size: 25px;
    border-radius: 10px; /* Add rounded corners */
    box-sizing: border-box;
}

/* Media query for smaller screens */
@media (max-width: 768px) {
    .committees {
        padding: 20px; /* Adjust padding for smaller screens */
    }

    .committee {
        font-size: 20px; /* Adjust font size for smaller screens */
    }
}

@media (max-width: 480px) {
    .committee {
        font-size: 18px; /* Further adjust font size for very small screens */
        padding: 15px; /* Adjust padding for very small screens */
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
  
#searchBar {
    width: 70%; /* Match width of the committee list's box */
    max-width: 1100px; /* Maintain maximum width */
    padding: 10px;
    margin: 20px auto; /* Center the search bar */
    display: block;
    border: 1px solid #ccc; /* Border style */
    border-radius: 10px; /* Rounded corners */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Grey shadow background */
    font-size: 20px;
    box-sizing: border-box; /* Ensure padding and border are included in the element's total width and height */
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
        <?php
        if (isset($_SESSION['committee_ID'])) { ?>
              <li><a  href="javascript:void(0);" onclick="navigateToPage('committeepg.php?f_id=1&l_id=1', <?php echo $_SESSION['committee_ID']; ?>);"><b>Go To Profile</b></a></li>
              <?php } else { ?>  
        <li><a href="#"><b>Login</b></a>
          <ul class="dropdown">
            <li><a href="convenorloginpage.php?l_id=1">Convenor Login</a></li>
            <li><a href="convenorloginpage.php?l_id=2">Superadmin Login</a></li>
            <?php } ?>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
  <a href="index.php"><button class="back-button" >Go Back</button></a>
<header>
  <?php
  if (isset($_GET['id'])) {
    $dept_id = $_GET['id'];
} else {
    echo "ID not specified.";
    exit;
}
// Assume $conn is your database connection object and $dept_id is already set

// Step 1: Retrieve the department name based on dept_id
$sql_dept = "SELECT dept_name FROM Department WHERE id = $dept_id";
$result_dept = $conn->query($sql_dept);

// Check if the query returned a result
if ($result_dept->num_rows > 0) {
    // Fetch the department name
    $row_dept = $result_dept->fetch_assoc();
    $dept_name = $row_dept['dept_name'];
} else {
    // Handle the case where no department is found
    $dept_name = "Unknown Department";
}

?>
  
    <h2 class="sub-title">List of <?php echo $dept_name?></h2>
</header>


<body>
    <div class="fullscreen-container">
        <div class="committees">
        <input type="text" id="searchBar" onkeyup="filterCommittees()" placeholder="Search">

            <?php
            

            // Step 2: Retrieve the list of committees from the database
            $sql = "SELECT * FROM committees WHERE dept_id = $dept_id";
            $result = $conn->query($sql);

            // Step 3: Loop through the retrieved data to display each committee
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {

                   
                    //echo '<a class="new" href="committeepg.php?id=' . $row["committee_ID"] . '"><div class="committee">' . $row["committeeName"] . '</div></a>';
                    ?>
                    <div class="committee"><a class="new" href="committeepg.php?l_id=<?php echo 69 ?>&committee_ID=<?php echo $row["committee_ID"] ?>&f_id=<?php echo 1?>"><?php echo $row["committeeName"] ; ?></a></div>

                <?php
                   
                }
            } else {
                echo "0 results";
            }

            $conn->close();
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
    function filterCommittees() {
      var input, filter, committees, committee, a, i, txtValue;
      input = document.getElementById('searchBar');
      filter = input.value.toUpperCase();
      committees = document.getElementsByClassName('committees')[0];
      committee = committees.getElementsByClassName('committee');

      for (i = 0; i < committee.length; i++) {
        a = committee[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          committee[i].style.display = "";
        } else {
          committee[i].style.display = "none";
        }
      }
    }

    function toggleMenu() {
      const menu = document.querySelector(".right");
      menu.classList.toggle("active");
    }
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
  </script>
</html>
