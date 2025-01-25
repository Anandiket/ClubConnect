<?php
session_start();
include "retrive_events.php";
include "db_connection.php";


// Fetch committee names from the database
// Fetch committee names from the database
$sql_committee_names = "SELECT committee_ID, committeeName FROM committees";
$result_committee_names = mysqli_query($conn, $sql_committee_names);

$committee_names = [];
while ($row = mysqli_fetch_assoc($result_committee_names)) {
    $committee_names[] = $row;
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
  <title>Events</title>
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

    section {
  text-align: center;
}

#filter_form {
  background-color: #93332e;
  text-align: center;
  margin: 20px auto;
  color: white;
  font-weight: 500;
  width: 90%;
  border-radius: 10px;
  box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.6);
  padding: 10px;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
}

#filter_form label,
#filter_form input,
#filter_form select,
#filter_form button {
  margin: 5px;
  font-size: 16px;
}

#filter_form input[type="date"],
#filter_form select {
  padding: 5px;
  border-radius: 5px;
  border: 1px solid #ccc;
  max-width: 100%;
}

#filter_form button {
  border-radius: 5px;
  padding: 5px 10px;
  margin-left: 5px;
  margin-right: 5px;
  background-color: white;
  color: #93332e;
  border: none;
  cursor: pointer;
}

#filter_form button:hover {
  background-color: #f1f1f1;
}

/* Responsive Design */
@media (max-width: 1650px) {
  #filter_form {
    flex-direction: row;
    padding: 10px;
  }

  #filter_form label,
  #filter_form input,
  #filter_form select,
  #filter_form button {
    flex: 1 1 200px;
    min-width: 150px;
    max-width: 100%;
  }

  #filter_form button {
    flex: 1 1 auto;
    min-width: 150px;
  }
}

@media (max-width: 1280px) {
  #filter_form {
    flex-direction: row;
    padding: 10px;
  }

  #filter_form label,
  #filter_form input,
  #filter_form select,
  #filter_form button {
    flex: 1 1 150px;
    min-width: 120px;
    max-width: 100%;
  }

  #filter_form button {
    flex: 1 1 auto;
    min-width: 120px;
  }
}

@media (max-width: 1024px) {
  #filter_form {
    flex-direction: row;
    padding: 10px;
  }

  #filter_form label,
  #filter_form input,
  #filter_form select,
  #filter_form button {
    flex: 1 1 120px;
    min-width: 100px;
    max-width: 100%;
  }

  #filter_form button {
    flex: 1 1 auto;
    min-width: 100px;
  }
}

@media (max-width: 768px) {
  #filter_form {
    flex-direction: row;
    padding: 10px;
  }

  #filter_form label,
  #filter_form input,
  #filter_form select,
  #filter_form button {
    flex: 1 1 100px;
    min-width: 80px;
    max-width: 100%;
  }

  #filter_form button {
    flex: 1 1 auto;
    min-width: 80px;
  }
}

@media (max-width: 480px) {
  #filter_form label,
  #filter_form input,
  #filter_form select,
  #filter_form button {
    font-size: 14px;
    flex: 1 1 100px;
    min-width: 60px;
    max-width: 100%;
  }

  #filter_form button {
    flex: 1 1 auto;
    min-width: 60px;
  }
}


/* Event CSS */
.events {
  width: 100%;
  padding: 20px;
  border-radius: 10px;
  text-align: center;
  box-sizing: border-box; /* Ensure padding and borders are included in width */
}

.events-align {
  text-align: center;
  font-size: 60px;
  box-sizing: border-box;
}

.rectangle_event {
  background: url(eventbg3.jpg) no-repeat center;
  background-size: cover;
  box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.6);
  height: 100%;
  min-height: 300px;
  border-radius: 10px;
  font-size: 20px;
  padding: 20px;
  text-align: center;
  align-self: center;
  margin: auto;
  color: black;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  margin-bottom: 20px; /* Add margin-bottom to space out the buttons */
  box-sizing: border-box; /* Ensure padding and borders are included in width */
  overflow: hidden; /* Hide any overflowing text or elements */
}

.rectangle_event img {
  max-width: 100%;
  height: 150px; /* Set a fixed height for the image */
  border-radius: 10px;
  margin-bottom: 10px;
  object-fit: cover; /* Ensure the image covers the fixed height area */
}

.rectangle_event p, .rectangle_event h2, .rectangle_event strong {
  margin: 0 0 10px 0; /* Add margin to space out elements */
  word-wrap: break-word; /* Ensure long words break to the next line */
}

/* Media queries remain the same */

@media (max-width: 1650px) {
  .events-align {
    font-size: 55px;
  }

  .rectangle_event {
    min-height: 375px;
  }

  .rectangle_event * {
    font-size: 22px;
  }

  #myTextBox {
    width: 55%;
  }
}

@media (max-width: 1200px) {
  .events-align {
    font-size: 50px;
  }

  .rectangle_event {
    min-height: 350px;
  }

  .rectangle_event * {
    font-size: 20px;
  }

  #myTextBox {
    width: 60%;
  }
}

@media (max-width: 768px) {
  .events-align {
    font-size: 40px;
  }

  .rectangle_event {
    min-height: 300px;
  }

  .rectangle_event * {
    font-size: 18px;
  }

  #myTextBox {
    width: 80%;
  }
}

@media (max-width: 480px) {
  .events-align {
    font-size: 30px;
  }

  .rectangle_event {
    min-height: 250px;
  }

  .rectangle_event * {
    font-size: 16px;
  }

  #myTextBox {
    width: 90%;
  }
}

/* For screens between 1651px and 1700px */
@media (min-width: 1651px) and (max-width: 1700px) {
  .events-align {
    font-size: 70px;
  }

  .rectangle_event {
    min-height: 425px;
  }

  .rectangle_event * {
    font-size: 30px;
  }

  #myTextBox {
    width: 45%;
  }
}

/* For screens between 1701px and 1900px */
@media (min-width: 1701px) and (max-width: 1900px) {
  .events-align {
    font-size: 75px;
  }

  .rectangle_event {
    min-height: 450px;
  }

  .rectangle_event * {
    font-size: 32px;
  }

  #myTextBox {
    width: 40%;
  }
}

/* For screens larger than 1900px */
@media (min-width: 1901px) {
  .events-align {
    font-size: 85px;
  }

  .rectangle_event {
    min-height: 475px;
  }

  .rectangle_event * {
    font-size: 36px;
  }

  #myTextBox {
    width: 35%;
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
.action-button{
  text-decoration: none;
  font-weight: 400; 
  color:white; 
  background-color:#93332e;
  padding:8px;
  border:#93332e;
  border-radius:15px;
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
              <li><a href="javascript:void(0);" onclick="navigateToPage('committeepg.php?f_id=1&l_id=1', <?php echo $_SESSION['committee_ID'];?>"><b>Go To Profile</b></a></li>
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


  
      <form method="GET" action="events.php" id="filter_form">
        <!-- <input type="hidden" name="f_id" value="<?php// echo htmlspecialchars($_GET['f_id']); ?>">
        <input type="hidden" name="l_id" value="<?php// echo htmlspecialchars($_GET['l_id']); ?>"> -->
        <label for="start_date">Filter by Start Date:</label>
        <input type="date" name="start_date" id="start_date" value="<?php echo isset($_GET['start_date']) ? htmlspecialchars($_GET['start_date']) : ''; ?>">

        <label for="end_date">Filter by End Date:</label>
        <input type="date" name="end_date" id="end_date" value="<?php echo isset($_GET['end_date']) ? htmlspecialchars($_GET['end_date']) : ''; ?>">

        <label for="event_filter">Filter Events:</label>
        <select name="event_filter" id="event_filter">
            <option value="all" <?php echo (isset($_GET['event_filter']) && $_GET['event_filter'] == 'all') ? 'selected' : ''; ?>>All Events</option>
            <option value="upcoming" <?php echo (isset($_GET['event_filter']) && $_GET['event_filter'] == 'upcoming') ? 'selected' : ''; ?>>Upcoming Events</option>
            <option value="past" <?php echo (isset($_GET['event_filter']) && $_GET['event_filter'] == 'past') ? 'selected' : ''; ?>>Past Events</option>
        </select>

        <label for="committee_name">Filter by Committee Name:</label>
    <select name="committee_ID" id="committee_ID">
        <option value="" <?php echo (isset($_GET['committee_ID']) && $_GET['committee_ID'] == '') ? 'selected' : ''; ?>>All Committees</option>
        <?php foreach ($committee_names as $committee): ?>
            <option value="<?php echo htmlspecialchars($committee['committee_ID']); ?>" <?php echo (isset($_GET['committee_ID']) && $_GET['committee_ID'] == $committee['committee_ID']) ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($committee['committeeName']); ?>
            </option>
        <?php endforeach; ?>
    </select>

        <button type="submit">Filter</button>
        <button type="button" onclick="clearFilter()">Clear Filter</button>
    </form>
<!-- Display Events -->
<?php if ($event_filter == 'all' || $event_filter == 'upcoming') { ?>
<center><h2>Upcoming Events</h2></center>
<section class="events">
    <h1 class="event-align"></h1>
    <div class="div-align">
        <?php
        if (!empty($upcoming_events)) {
            foreach ($upcoming_events as $event) {
                ?> 
                <div class="rectangle_event" id="myTextBox">
                <p><strong>Committee Name:</strong> <?php echo $event['committeeName']; ?></p>
                    <h2><?php echo $event['eventName']; ?></h2>
                    <?php
                    $imageDatae = base64_encode($event['photo']);
                    $mimeTypee = !empty($event['mime_type']) ? $event['mime_type'] : 'image/jpeg';
                    ?>
                    <img src='data:<?php echo $mimeTypee; ?>;base64,<?php echo $imageDatae; ?>' alt='Event Photo'>
                    <p><?php echo $event['e_desc']; ?></p>
                    <p><strong>Date:</strong> <?php echo date('d.m.y', strtotime($event['event_date'])); ?></p>
                    <p><strong>Time:</strong><?php echo date('h:i A', strtotime($event['time'])); ?></p>
                    <p><strong>Venue:</strong><?php echo $event['venue']; ?></p>
                    <p><strong>Type:</strong><?php echo $event['type']; ?></p>
                    <p><strong>Mode:</strong><?php echo $event['mode']; ?></p>
                    <p><strong>Resource Person:</strong> <?php echo $event['RpersonName']; ?></p>
                    <p><strong>Contact:</strong> <?php echo $event['RpersonContact']; ?></p>
                    <div class='action-container'>
                <a href="<?php echo $event['link']; ?>"><button class='action-button'><b>Register for Event</b></button>
                </a>
            </div>
                </div>
                <br>
                <!-- <div class='action-container'>
                <a href="<?php echo $event['link']; ?>"><button class='action-button'><b>Register for Event</b></button>
                </a>
            </div> -->
                <?php
            }
        }
        ?>
    </div>
    <br><br><br><br>
</section>
<?php } ?>

<?php if ($event_filter == 'all' || $event_filter == 'past') { ?>
<center><h2>Past Events</h2></center>
<section class="events">
    <h1 class="event-align"></h1>
    <div class="div-align">
        <?php
        if (!empty($past_events)) {
            foreach ($past_events as $event_past) {
                ?> 
                <div class="rectangle_event" id="myTextBox">
                <p><strong>Committee Name:</strong> <?php echo $event_past['committeeName']; ?></p>

                <h2><?php echo $event_past['eventName']; ?></h2>
                <?php
                    $imageDatap = base64_encode($event_past['photo']);
                    $mimeTypep = !empty($event_past['mime_type']) ? $event_past['mime_type'] : 'image/jpeg';
                    ?>
                    <img src='data:<?php echo $mimeTypep; ?>;base64,<?php echo $imageDatap; ?>' alt='Event Photo'>
                    <p><?php echo $event_past['e_desc']; ?></p>
                    <p><strong>Date:</strong> <?php echo date('d.m.y', strtotime($event_past['event_date'])); ?></p>
                    <p><strong>Resource Person:</strong> <?php echo $event_past['RpersonName']; ?></p>
                    <p><strong>Contact:</strong> <?php echo $event_past['RpersonContact']; ?></p>
                </div>
                
                <br>
                <?php
            }
        }
        ?>
    </div>
    <br><br><br><br>
</section>
<?php } ?>





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

    function clearFilter() {
            document.getElementById('event_date').value = '';
            document.getElementById('event_filter').value = 'all';
            document.getElementById('filter_form').submit();
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


</body>
</html>









