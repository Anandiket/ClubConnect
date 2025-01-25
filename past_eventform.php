<?php
  session_start();
  include "db_connection.php";
  // Check if the committee_ID is set in the session
if (!isset($_SESSION['id'])) {
  echo "Committee ID not set in session.";
  exit;
}

$committee_id = $_SESSION['committee_ID'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <title>Event Registration</title>
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
  padding: 0.6em;
  margin-left: 40px;
  margin-right: 40px;
  margin-bottom:20px;
  border-radius: 10px;
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







/* Container styling */
.container {
  border: 2px solid #93332e;
  border-radius: 10px;
  margin-top: 10px;
  margin-bottom: 20px;
  padding: 10px; /* Reduced padding */
  box-sizing: border-box;
  max-width: 95%;
  margin: 0 auto; /* Center align the container */
}

/* Form field styling */
.row1 {
  border: none;
}

.form-group {
  margin-bottom: 10px; /* Reduced margin */
  display: flex;
  flex-wrap: nowrap; /* Prevent wrapping */
  align-items: center;
}

/* Label styling */
.form-group label {
  margin: 0; /* Remove margin */
  flex: 0 0 auto;
  text-align: left;
}

/* Input fields */
input[type="text"],
input[type="tel"],
input[type="email"],
input[type="date"],
input[type="file"],
input[type="time"],
input[type="text1"],
input[type="link"] {
  flex: 1 1 auto;
  padding: 10px; /* Reduced padding */
  border: 1px solid #ccc;
  border-radius: 10px;
  box-sizing: border-box;
  font-size: 14px; /* Adjusted font size for consistency */
  width: auto; /* Adjust width */
  margin-left: 5px; /* Small margin between label and input */
}

/* Submit button styling */
button[type="submit"] {
  width: 50%;
  padding: 10px; /* Reduced padding */
  font-size: 16px; /* Adjusted font size */
  border-radius: 4px;
  background-color: #93332e;
  color: white;
  border: none;
  cursor: pointer;
  margin: 20px auto; /* Center align the button */
  display: block;
}

/* Media query for larger screens */
@media (min-width: 768px) {
  .container {
    max-width: 80%; /* Limit container width on larger screens */
  }

  .form-group {
    flex-direction: row;
    justify-content: space-between;
  }

  input[type="text"],
  input[type="tel"],
  input[type="email"],
  input[type="date"],
  input[type="link"],
  input[type="file"],
  input[type="text1"],
  input[type="time"] {
    flex: 1 1 25%; /* Adjusted flex for better distribution */
    min-width: 150px; /* Ensure minimum width for inputs */
  }

  .form-group.inline-group {
    flex: 1;
    flex-direction: row;
  }

  .form-group.inline-group label {
    flex: 0 0 auto;
  }

  .form-group.inline-group input {
    flex: 1 1 auto;
  }
}

/* Media query for smaller screens */
@media (max-width: 767px) {
  .form-group {
    flex-direction: column;
    align-items: stretch; /* Ensure elements take full width */
  }

  .form-group label,
  .form-group input[type="text"],
  .form-group input[type="tel"],
  .form-group input[type="email"],
  .form-group input[type="date"],
  .form-group input[type="link"],
  .form-group input[type="file"],
  input[type="text1"],
  input[type="time"] {
    flex: 1 1 100%;
    width: 100%;
  }

  input[type="text"],
  input[type="tel"],
  input[type="email"],
  input[type="date"],
  input[type="link"],
  input[type="file"],
  input[type="time"] {
    margin-bottom: 10px; /* Add margin to input fields for better spacing on mobile */
  }

  .form-group.inline-group {
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
  margin-top:20px;
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
  <a href="committeepg.php?f_id=2&l_id=1"><button class="back-button" >Go Back</button></a>
  <?php
    $is_update = isset($_GET['event_id']);
    $event_id = $is_update ? $_GET['event_id'] : '';
    
    // Initialize variables
   
    
    // Retrieve event details
    if ($is_update && !empty($event_id)) {
        $sql_event = "SELECT * FROM events WHERE Event_ID = ?";
        $stmt_event = mysqli_prepare($conn, $sql_event);
        mysqli_stmt_bind_param($stmt_event, "i", $event_id);
        mysqli_stmt_execute($stmt_event);
        $result_event = mysqli_stmt_get_result($stmt_event);
    
        if ($row = mysqli_fetch_assoc($result_event)) {
            $eventname = $row['eventName'];
            $rpersonname = $row['RpersonName'];
            $eventdate = $row['event_date'];
            $CoordinatorName = $row['CoordinatorName'];
            $rperson_contact_no = $row['RpersonContact'];
            $rperson_email = $row['RpersonEmail'];
            $e_desc = $row['e_desc'];
            $academic_year = $row['academicYear'];
            $r_link = $row['link'];
            $photo = $row['photo'];
            $time = $row['time'];
            $venue = $row['venue'];
            $mode = $row['mode'];
            $type = $row['type'];
            $duration = $row['duration'];
            $beneficiary = $row['beneficiary'];
            $no_students = $row['no_students'];
            $no_faculty = $row['no_faculty'];
            $summary = $row['summary'];
            $file = $row['file'];
            


        }
    
        // Retrieve existing photos
        $existing_photos = [];
        $sql_select_photos = "SELECT photo_id, photo FROM photos WHERE event_id = ?";
        if ($stmt_select_photos = mysqli_prepare($conn, $sql_select_photos)) {
            mysqli_stmt_bind_param($stmt_select_photos, "i", $event_id);
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
    
    // Determine action type based on event date
    $today = date('Y-m-d');
    if ($is_update && !empty($eventdate) && $eventdate < $today) {
        $action_type = 'past';
    } else {
        $action_type = $is_update ? 'update' : 'insert';
    }
    
    ?>
        <title><?php echo $is_update ? "Add Event Details" : "New Event Registration"; ?></title>
    <body>
        <header>
        <form name="newUser" class="register" action="past_event.php" method="post" enctype="multipart/form-data">
        <h2><?php echo $is_update ? "Add Event Details" : "New Event Registration"; ?></h2>
        </header>
        <div class="container">
            <div id="newUser">
                <!-- New User Profile -->
                <fieldset class="row1">
                    <!-- COMMITTEE DETAILS -->
                    <?php
                    if (isset($_GET['error'])) {
                        echo "<p style='color:black;'>" . htmlspecialchars($_GET['error']) . "</p>";
                    }
                    ?>
                    <div class="form-group">
                        <label><b>Event Name</b></label>
                        <input type="text1" name="eventName" class="form-control" value="<?php echo $is_update ? htmlspecialchars($eventname) : ''; ?>" placeholder="Enter event name ">
                    </div>
                    <div class="form-group">
                        <label><b>Resource Person Name</b></label>
                        <input type="text1" name="RpersonName" class="form-control" value="<?php echo $is_update ? htmlspecialchars($rpersonname) : ''; ?>" placeholder="Enter resource person name ">
                    </div>
                    <div class="form-group">
                        <label><b>Coordinator's Name</b></label>
                        <input type="text1" name="CoordinatorName" class="form-control" value="<?php echo $is_update ? htmlspecialchars($CoordinatorName) : ''; ?>" placeholder="Enter coordinator's name ">
                    </div>
                    <div class="form-group inline-group">
                        <label><b>Coordinator's Contact Number</b></label>
                        <input type="tel" name="RpersonContact" class="form-control" value="<?php echo $is_update ? htmlspecialchars($rperson_contact_no) : ''; ?>" pattern="\d{10}" title="Please enter a valid 10-digit contact number" placeholder="Contact No (10 digits only) ">
                        <label><b>Coordinator's Email ID</b></label>
                        <input type="email" name="RpersonEmail" class="form-control" value="<?php echo $is_update ? htmlspecialchars($rperson_email) : ''; ?>" placeholder="Enter email ID">
                    </div>
                    <div class="form-group">
                        <label><b>Event Description</b></label>
                        <input type="text" name="eventDescription" class="form-control" value="<?php echo $is_update ? htmlspecialchars($e_desc) : ''; ?>" placeholder="Enter event description">
                        <label><b>Event Date</b></label>
                        <input type="date" name="eventDate" class="form-control" value="<?php echo $is_update ? htmlspecialchars($eventdate) : ''; ?>" placeholder="Enter event date">
                    </div>
                    <div class="form-group inline-group">
                        <label><b>Event Time</b></label>
                        <input type="time" name="time" class="form-control" value="<?php echo $is_update ? htmlspecialchars($time) : ''; ?>" placeholder="Enter event time">
                        <label><b>Event Venue</b></label>
                        <input type="text" name="venue" class="form-control" value="<?php echo $is_update ? htmlspecialchars($venue) : ''; ?>" placeholder="Enter event venue">
                        <label><b>Event Type</b></label>
                        <input type="text" name="type" class="form-control" value="<?php echo $is_update ? htmlspecialchars($type) : ''; ?>" placeholder="Enter event type">
                    </div>
                    <div class="form-group inline-group">
                        <label><b>Academic Year</b></label>
                        <input type="text" name="academicYear" class="form-control" pattern="\d{4}-\d{2}" title="Please enter a valid academic year (e.g., 2023-24)" value="<?php echo $is_update ? htmlspecialchars($academic_year) : ''; ?>" placeholder="academic yr (Eg. 2023-24)">
                        <label><b>Event Mode</b></label>
                        <input type="text" name="mode" class="form-control" value="<?php echo $is_update ? htmlspecialchars($mode) : ''; ?>" placeholder="Enter event mode">
                    </div>
                    <div class="form-group">
                        <label><b>Registration Link</b></label>
                        <input type="link" name="link" class="form-control" value="<?php echo $is_update ? htmlspecialchars($r_link) : ''; ?>" placeholder="Enter registration link for the event.">
                    </div>
                    <div class="form-group">
                        <label><b>Add Poster/Banner</b></label>
                        <?php if ($is_update && !empty($photo)) : ?>
                            <div>
                                <p> Previous photo exists.</p>
                                <input type="hidden" name="existing_photo" value="<?php echo htmlspecialchars($photo); ?>">
                            </div>
                        <?php endif; ?>
                        <input type="file" name="photo" class="form-control2">
                    </div>
                    <div>
                      <label><b>Beneficiaries</b></label>
                      <input type="text1" name="beneficiary" class="form-control" value="<?php echo $is_update ? htmlspecialchars($beneficiary) : ''; ?>" placeholder="Enter the beneficiaries of this event">
                    </div>
                    <div class="form-group inline-group">
                        <label><b>No. of Internal Participants</b></label>
                        <input type="text" name="no_students" class="form-control" value="<?php echo $is_update ? htmlspecialchars($no_students) : ''; ?>" placeholder="Enter number of students participants">
                        <label><b>No. of External Participants</b></label>
                        <input type="text" name="no_faculty" class="form-control" value="<?php echo $is_update ? htmlspecialchars($no_faculty) : ''; ?>" placeholder="Enter number of faculty participants">
                    </div>
                    <div class="form-group">
                        <label><b>Duration</b></label>
                        <input type="text1" name="duration" class="form-control" value="<?php echo $is_update ? htmlspecialchars($duration) : ''; ?>" placeholder="Enter duration of event ">
                    </div>
                    <div class="form-group">
                        <label><b>Key Points</b></label>
                        <input type="text1" name="summary" class="form-control" value="<?php echo $is_update ? htmlspecialchars($summary) : ''; ?>" placeholder="Enter summary of event ">
                    </div>
                       <!-- Additional Photos -->
    <div class="input-row" id="photo-container">
        <label for="photos" style="font-weight:700">Upload new photos</label>
        <!-- <input type="file" id="photos" name="event_photos[]" class="form-control2" multiple> -->
        
    <input type="file" name="event_photos[]" multiple>
     <input type="submit" value="Submit"> 


    </div>
    <!--<button type="button" id="add-photo" class="btn btn-primary">Add More Photos</button> -->
    <!-- Existing Photos Display and Delete Option -->
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
                    <!--<input type="file" id="file" name="file" class="form-control2"> -->
                </div>

                <div id="others-container">
    <h3>Additional Information</h3>
    <div id="others-container">
    <div class="others-section">
        <div class="form-group">
            <label><b>Title</b></label>
            <input type="text" name="title" class="form-control" placeholder="Enter title">
        </div>
        <div class="form-group">
            <label><b>Content</b></label>
            <input type="text" name="content" class="form-control" placeholder="Enter content">
        </div>
    </div>
</div>
    <button type="button" id="add-others" class="btn btn-secondary">Add More</button>
</div>
                <div>
                    <input type="hidden" name="committee_ID" value="<?php echo $committee_id; ?>">
                    <input type="hidden" name="action_type" value="<?php echo $action_type; ?>">
                    <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
                    <input type="hidden" name="table_name" value="events">
                    <button type="submit" id="registerButton"><?php echo $is_update ? "Update" : "Register"; ?> &raquo;</button>
                </div>
            </div>
        </div>
        </div>
</div>

    </form>


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

  
  document.getElementById('add-photo').addEventListener('click', function() {
    const photoContainer = document.getElementById('photo-container');
    const newPhotoDiv = document.createElement('div');
    newPhotoDiv.className = 'input-row';
    
    const newLabel = document.createElement('label');
    newLabel.innerText = 'Upload more photos';
    newLabel.style.fontWeight = '700';
    
    const newInput = document.createElement('input');
    newInput.type = 'file';
    newInput.name = 'event_photos[]';
    newInput.className = 'form-control2';
    newInput.multiple = true;
    
    newPhotoDiv.appendChild(newLabel);
    newPhotoDiv.appendChild(newInput);
    photoContainer.appendChild(newPhotoDiv);
});

// document.getElementById('add-others').addEventListener('click', function() {
//         const container = document.getElementById('others-container');
//         const newSection = document.createElement('div');
//         newSection.classList.add('others-section');
//         newSection.innerHTML = `
//             <div class="form-group">
//                 <label><b>Title</b></label>
//                 <input type="text" name="others[][title]" class="form-control" placeholder="Enter title" required>
//             </div>
//             <div class="form-group">
//                 <label><b>Content</b></label>
//                 <input type="text" name="others[][content]" class="form-control" placeholder="Enter content" required>
//             </div>
//         `;
//         container.appendChild(newSection);
//     });
</script>
</body>
</html>
