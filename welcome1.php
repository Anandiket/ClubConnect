<?php
include 'db_connection.php';
//include 'retrive.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <title>Welcome</title>
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

.firstsection h1 {
  color: #93332e;
  font-size: 4.625rem;
  margin: 17px 0;
  font-family: 'Poppins', sans-serif;
}

.firstsection h2 {
  margin-top: -60px;
  position: relative;
  top: 40px;
  font-family: 'Poppins', sans-serif;
}

/* Media queries for responsiveness */
@media (max-width: 1200px) {
  .firstsection h1 {
    font-size: 3.5rem;
  }

  .firstsection h2 {
    margin-top: -50px;
    top: 30px;
  }
}

@media (max-width: 768px) {
  .firstsection h1 {
    font-size: 2.5rem;
  }

  .firstsection h2 {
    margin-top: -40px;
    top: 20px;
  }
}

@media (max-width: 480px) {
  .firstsection h1 {
    font-size: 2rem;
  }

  .firstsection h2 {
    margin-top: -30px;
    top: 10px;
  }
}
.secondsection {
  box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);
  margin-top: 100px;
  margin-left: 60px;
  margin-right: 60px;
  border-radius: 20px;
  display: flex;
  justify-content: space-around;
  align-items: center;
  height: 320px;
  background-color: #fff;
}

.leftsection a,
.middlesection a,
.rightsection a {
  color: #93332e;
  text-decoration: none;
}

.myslides {
  display: none;
}

img {
  vertical-align: middle;
}

.slideshow-container {
  max-width: 1000px;
  position: relative;
  margin: auto;
}

.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

.dot {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 1.6s ease;
}

.active {}

.fade {
  animation-name: fade;
  animation-duration: 2.5s;
}

@keyframes fade {
  from { opacity: .4; } 
  to { opacity: 1; }
}

.carousel-container {
  width: 90%;
  margin: 20px auto;
  overflow: hidden;
  position: relative;
}

.carousel-inner {
  display: flex;
  transition: transform 0.9s ease-in-out;
}

/* Media queries for responsiveness */
@media (max-width: 1200px) {
  .secondsection {
    flex-direction: column;
    height: auto;
    width: 80%;
    margin-left: auto;
    margin-right: auto;
  }

  .slideshow-container {
    max-width: 100%;
  }

  .secondsection > div {
    margin-bottom: 20px;
  }
}

@media (max-width: 768px) {
  .secondsection {
    width: 90%;
    margin: 20px auto;
  }

  .slideshow-container {
    max-width: 100%;
  }
}

@media (max-width: 480px) {
  .secondsection {
    width: 95%;
    margin: 10px auto;
  }

  .slideshow-container {
    max-width: 100%;
  }
}
hr{
      border: 0;
      background-color: #93332e;
      height: 2.5px;
      margin: 40px 85px;
}
.carousel-container {
  width: 95%;
  margin: 20px auto;
  overflow: hidden;
  position: relative;
}

.carousel-inner {
  display: flex;
  transition: transform 0.9s ease-in-out;
}

.notice-container {
  position: relative;
  overflow: hidden; /* Ensure hidden overflow to clip expanded content */
  transition: height 0.3s ease; /* Smooth transition for height change */
}

.notice {
  flex: 0 0 31.5%; /* Adjusted width to fit three notices per line */
  margin: 0 10px;
  color: #fff;
  background-color: #93332e;
  padding: 20px;
  border-radius: 15px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
  cursor: pointer; /* Add pointer cursor for hover effect */
  transition: transform 0.3s ease; /* Smooth transition for transform change */
  z-index: 1; /* Ensure notices are below the buttons */
  overflow: hidden; /* Ensure text doesn't overflow the notice */
  text-overflow: ellipsis; /* Show ellipsis for overflowed text */
  white-space: nowrap; /* Prevent text from wrapping */
}

.hidden-content {
  display: none; /* Initially hidden */
  padding: 10px; /* Padding for content */
  overflow: hidden; /* Hide overflow */
  text-overflow: ellipsis; /* Show ellipsis for overflowed text */
  white-space: nowrap; /* Prevent text from wrapping */
  max-height: 3.6em; /* Approximately two lines of text */
  line-height: 1.8em; /* Line height for two lines of text */
}

.notice:hover {
  transform: scale(1.05); /* Slightly increase size on hover */
  z-index: 2; /* Bring the hovered notice to front */
}

.notice:hover .hidden-content {
  display: block; /* Show hidden content on hover */
}


.carousel-controls {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  width: 100%;
  display: flex;
  justify-content: space-between;
  z-index: 3; /* Ensure controls are above notices */
}

.carousel-btn {
  margin: 1px;
  color: #000;
  border: none;
  border-radius: 50%;
  padding: 10px;
  cursor: pointer;
  font-size: 20px;
}

.topevents h1 {
  color: black;
  font-size: 30px;
}

/* Medium screens (up to 1024px) */
@media (max-width: 1024px) {
  .notice {
    flex: 0 0 48%; /* Two notices per line */
  }
}

/* Small screens (up to 768px) */
@media (max-width: 768px) {
  .notice {
    flex: 0 0 100%; /* One notice per line */
    margin-bottom: 20px; /* Add spacing between notices */
  }

  .carousel-controls {
    top: auto;
    bottom: 10px; /* Position controls at the bottom */
  }
}

/* Very small screens (up to 480px) */
@media (max-width: 480px) {
  .carousel-btn {
    font-size: 16px; /* Smaller buttons */
    padding: 5px;
  }
}

/* Extra small screens (up to 360px) */
@media (max-width: 360px) {
  .carousel-btn {
    font-size: 14px; /* Even smaller buttons */
    padding: 3px;
  }

  .notice {
    font-size: 14px; /* Smaller text for notices */
    padding: 8px; /* Adjust padding for smaller screens */
  }

  .carousel-controls {
    bottom: 5px; /* Adjust position of controls */
  }
}

/* Ultra small screens (up to 320px) */
@media (max-width: 320px) {
  .carousel-btn {
    font-size: 12px; /* Very small buttons */
    padding: 2px;
  }

  .notice {
    font-size: 12px; /* Smaller text for notices */
    padding: 5px; /* Adjust padding for ultra small screens */
  }

  .carousel-controls {
    bottom: 2px; /* Adjust position of controls */
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
    <a href="https://kjsit.somaiya.edu.in/"><img src="lg1.png" width="250px"></a>
      
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
  <section class="firstsection" id="home">
    <div class="container">
      <h1>Club Connect</h1>
      <h2>Developed by Department of Computer Engineering</h2>
    </div>
  </section>
  <section class="secondsection" id="home">
    <div class="leftsection">
    <a href="listcom.php?id=<?php echo '2' ?>"><h2>Clubs</h2></a>


<div class="slideshow-container">

<div class="mySlides fade">
<div class="numbertext">1 / 3</div>
<a href="listcom.php?id=<?php echo '2' ?>"><img src="nli.jpeg" style="width:200px"></a>
</div>

<div class="mySlides fade">
<div class="numbertext">2 / 3</div>
<a href="listcom.php?id=<?php echo '2' ?>"><img src="drama.jpg" style="width:200px"></a>

</div>

<div class="mySlides fade">
<div class="numbertext">3 / 3</div>
<a href="listcom.php?id=<?php echo '2' ?>"><img src="spectrum.jpeg" style="width:200px"></a>

</div>

</div>
<br>

<div style="text-align:center">
<span class="dot"></span> 
<span class="dot"></span> 
<span class="dot"></span> 
</div>
    </div>
    <div class="middlesection">
    <a href="listcom.php?id=<?php echo '1'?>"><h2>Committees</h2></a>


        <div class="slideshow-container">
        
        <div class="mySlides fade">
          <div class="numbertext">1 / 3</div>
          <a href="listcom.php?id=<?php echo '1'?>"><img src="csi_kjsieit_student_s_chapter_logo.jpeg" style="width:200px"></a>
        </div>
        
        <div class="mySlides fade">
          <div class="numbertext">2 / 3</div>
          <a href="listcom.php?id=<?php echo '1'?>"><img src="IEEE.jpeg" style="width:200px"></a>
          
        </div>
        
        <div class="mySlides fade">
          <div class="numbertext">3 / 3</div>
          <a href="listcom.php?id=<?php echo '1'?>"><img src="ACS.jpg" style="width:200px"></a>
          
        </div>
        
        </div>
        <br>
        
        <div style="text-align:center">
          <span class="dot"></span> 
          <span class="dot"></span> 
          <span class="dot"></span> 
        </div></div>
    <div class="rightsection">
    <a href="listcom.php?id=<?php echo '3'?>"><h2>Social Bodies</h2></a>


        <div class="slideshow-container">
        
        <div class="mySlides fade">
          <div class="numbertext">1 / 3</div>
          <a href="listcom.php?id=<?php echo '3'?>"><img src="nss.png" style="width:200px"></a>
        </div>
        
        <div class="mySlides fade">
          <div class="numbertext">2 / 3</div>
          <a href="listcom.php?id=<?php echo '3'?>"><img src="ACS.jpg" style="width:200px"></a>
          
        </div>
        
        <div class="mySlides fade">
          <div class="numbertext">3 / 3</div>
          <a href="listcom.php?id=<?php echo '3'?>"><img src="IEEE.jpeg" style="width:200px"></a>
          
        </div>
        
        </div>
        <br>
        
        <div style="text-align:center">
          <span class="dot"></span> 
          <span class="dot"></span> 
          <span class="dot"></span> 
        </div></div>
    </div>
  </section>
  <hr>
  <section class="thirdsection">
    <div class="topevents"><h1>Upcoming Events</h1></div>
    <div class="Bottomevents">
      <div class="carousel-container">
        <?php
          // Step 2: Calculate the date for 30 days from the current date
      $currentDate = date('Y-m-d');
      $endDate = date('Y-m-d', strtotime('+30 days', strtotime($currentDate)));
  
      // Step 3: Write a SQL query to fetch events for the next 30 days
      $sql_notice = "SELECT * FROM events WHERE event_date >= CURDATE() ORDER BY event_date ";
  
      $result_notice = $conn->query($sql_notice);
      // Step 4: Iterate over the results and generate HTML for each event notice
      if ($result_notice->num_rows > 0) {
        echo '<div class="carousel-inner">';
        while($row = $result_notice->fetch_assoc()) {
            echo '<div class="notice">';
            echo '<h2>' . $row['eventName'] . '</h2>'; ?>
            
            <div class="carousel-container">
    <div class="notice-container">
        <div class="hidden-content">
            <p><?php echo $row['e_desc'] ?></p>

        </div>
    </div>
    <div class="carousel-controls">
        <!-- Controls -->
    </div>
</div>

            <?php
            echo '<p>' . date('d.m.Y', strtotime($row['event_date'])) . '</p>';
            echo '<p>'. $row['RpersonName']. ':  ' . $row['RpersonContact'] . '</p>';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo "No upcoming events found";
    }
        ?>
        
       
          <div class="carousel-controls">
              <button class="carousel-btn" onclick="prevSlide()">&#10094;</button>
              <button class="carousel-btn" onclick="nextSlide()">&#10095;</button>
         </div>
         </div>

    </div>
    </section>
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
    let slideIndex = [0, 0, 0];
  let slideId = ["leftsection", "middlesection", "rightsection"];
  let timer = 4000;

  function showSlides() {
    for (let j = 0; j < slideId.length; j++) {
      let slides = document.querySelectorAll(`.${slideId[j]} .mySlides`);
      let dots = document.querySelectorAll(`.${slideId[j]} .dot`);
      for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";  
        dots[i].className = dots[i].className.replace(" active", "");
      }
      slideIndex[j]++;
      if (slideIndex[j] > slides.length) {slideIndex[j] = 1}    
      slides[slideIndex[j]-1].style.display = "block";  
      dots[slideIndex[j]-1].className += " active";
    }
    setTimeout(showSlides, timer); 
  }

  showSlides();
    
    </script>
<script>

let currentIndex = 0;
const notices = document.querySelectorAll(".carousel-inner .notice");
const totalNotices = notices.length;
const carouselInner = document.querySelector(".carousel-inner");
const carouselContainer = document.querySelector(".carousel-container"); // The container element
let intervalId;

function cloneNotices() {
    notices.forEach((notice) => {
        const clone = notice.cloneNode(true);
        carouselInner.appendChild(clone);
    });
}

function startAutoSlideshow() {
    if (totalNotices > 3) {
        intervalId = setInterval(() => {
            nextSlide();
        }, 3000); // Change slide every 3 seconds (3000 milliseconds)
    }
}

function stopAutoSlideshow() {
    clearInterval(intervalId);
}

function prevSlide() {
    currentIndex = (currentIndex - 1 + totalNotices) % totalNotices;
    updateCarousel();
}

function nextSlide() {
    currentIndex++;
    updateCarousel();
}

function updateCarousel() {
    const noticeWidth = notices[0].getBoundingClientRect().width;
    const noticeMarginRight = parseFloat(getComputedStyle(notices[0]).marginRight);
    const buffer = 10; // Increase buffer to account for extra spacing
    const offset = -(currentIndex * (noticeWidth + noticeMarginRight + buffer));
    carouselInner.style.transition = 'transform 0.5s ease';
    carouselInner.style.transform = `translateX(${offset}px)`;

    if (currentIndex >= totalNotices) {
        setTimeout(() => {
            carouselInner.style.transition = 'none';
            carouselInner.style.transform = 'translateX(0)';
            currentIndex = 0;
        }, 500);
    }
}

// Clone notices to create the looping effect
cloneNotices();

// Add event listeners for hover effect on each notice
notices.forEach((notice) => {
    notice.addEventListener("mouseover", () => {
        // Reset all notices to default state
        notices.forEach((n) => {
            n.style.transform = 'scale(1)'; // Reset scale
            n.style.zIndex = '1'; // Reset z-index
            const hiddenContent = n.querySelector('.hidden-content');
            if (hiddenContent) {
                hiddenContent.style.display = 'none'; // Hide hidden content
            }
        });

        // Expand the hovered notice
        notice.style.transform = 'scale(1.05)'; // Adjust scale as needed
        notice.style.zIndex = '2'; // Bring the hovered notice to front
        const hiddenContent = notice.querySelector('.hidden-content');
        if (hiddenContent) {
            hiddenContent.style.display = 'block'; // Show hidden content
        }
    });

    notice.addEventListener("mouseout", () => {
        // Reset the notice when mouse moves out
        notice.style.transform = 'scale(1)'; // Reset scale
        notice.style.zIndex = '1'; // Reset z-index
        const hiddenContent = notice.querySelector('.hidden-content');
        if (hiddenContent) {
            hiddenContent.style.display = 'none'; // Hide hidden content
        }
    });
});

// Start auto slideshow when the page loads
window.addEventListener("load", startAutoSlideshow);

// Pause slideshow on hover over the entire carousel container
carouselContainer.addEventListener("mouseover", stopAutoSlideshow);

// Resume slideshow when not hovering over the entire carousel container
carouselContainer.addEventListener("mouseout", startAutoSlideshow);

// Optional: add event listeners for manual controls (e.g., buttons)
document.querySelector(".prev-button").addEventListener("click", prevSlide);
document.querySelector(".next-button").addEventListener("click", nextSlide);



</script>


</body>
</html>
