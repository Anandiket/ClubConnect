<?php
session_start();

?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
        <title> LOGIN </title>
        
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
header {
  margin-top: 40px;
  margin-bottom: 30px;
  margin-left: 40px;
  margin-right: 40px;
  background-color: #9B2928;
  color: white;
  text-align: center;
  padding: 1em;
  border-radius: 15px;
  box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);
}

/* Media queries for responsiveness */
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

.about-us {
  max-width: 1000px;
  margin: auto;
  padding: 20px;
  border-radius: 10px;
  text-align: justify;
}
.about-us1 {
  max-width: 1000px;
  margin: auto;
  padding: 20px;
  border-radius: 10px;
  text-align: justify;
}

.about-us h2 {
  margin-top: 20px;
  margin-bottom: 10px;
}

.about-us p {
  font-weight: 500;
  line-height: 1.6;
}

.about-us ul {
  font-weight: 500;
  line-height: 1.6;
}

/* Base styles for larger screens */
.team-member {
  margin-top: 20px;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.team-row {
  display: flex;
  justify-content: center;
  gap: 50px; /* Increased gap to add distance between the two images */
}

.member {
  text-align: center;
}

.member-img {
  width: 200px;
  height: 300px;
  border-radius: 20px;
  border: 5px solid #93332e;
  object-fit: cover;
  margin-bottom: 30px;
}

/* Media query for tablets (width <= 1024px) */
@media (max-width: 1024px) {
  .team-row {
    gap: 40px; /* Reduced gap for smaller screens */
  }

  .member-img {
    width: 180px;
    height: 270px;
  }

  h2, h3 {
    font-size: 1.3rem;
  }
}

/* Media query for smaller screens (width <= 768px) */
@media (max-width: 768px) {
  .team-row {
    gap: 30px; /* Further reduced gap for tablets and smaller screens */
  }

  .member-img {
    width: 150px;
    height: 225px;
  }

  h2, h3 {
    font-size: 1.2rem;
  }
}

/* Media query for mobile screens (width <= 480px) */
@media (max-width: 480px) {
  .team-row {
    justify-content: space-around;
    flex-wrap: wrap; /* Wraps images on very small screens */
    gap: 20px; /* Keeps some distance between the wrapped images */
  }

  .member-img {
    width: 120px;
    height: 180px;
    margin-bottom: 15px;

  }

  h2, h3 {
    font-size: 1rem;
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
  <header>
    <h1><b>About Us</b></h1>
  </header>
  <br>
  <section class="about-us">
    <h2>Department of Computer Engineering</h2>
    <p>
        The Computer Engineering department was established in the year 2001 to impart quality education. The department has well qualified and motivated faculty members and support staff. The laboratories are adequately equipped with state-of-the-art facilities. The students are members of various professional bodies like IET, CSI, IEEE, NSS etc. Various platforms are available for students, like project competition, technical & cultural festivals, international conference, etc. to showcase their talent. It is a regular practice of the department to organize industrial visits, expert talks, workshops and internship in addition to the latest certification courses for students in the field of Computer engineering. Student have won prizes in various national and international level paper presentation, competitions, project exhibition etc. As the department has good industry interaction and alumni support, students get several opportunities of internship, project guidance, placement and many more.
        The department is accredited by NBA in 2018 and intake has doubled to 120 from academic year 2019-20. Besides offering undergraduate (B. Tech. in Computer Engineering) it also offers Post Graduation (M.Tech.) in Artificial Intelligence. As the autonomous status is awarded by UGC from academic year 2021-22, curricula have revised for UG and PG programs by Board of Studies. Exposure courses like Skill based, Activity based and Technology based courses are added to motivate students to participate in various activities. Under Project Based Learning (PBL) mini, minor and major projects are introduced from sem III to Sem VIII which help students to work in a team and develop projects using latest technologies.
        The department has to its credits of maximum number of placements of the students in Infosys, TCS, Accenture, Cognizant, L&T Infotech, CSC, Tech Mahindra, Mastek, ICON, Majesco, MuSigma, BNP Paribas. Every year, few students opt for pursuing higher studies at prestigious universities in India and abroad.
    </p>
<br>
<br>
    <h2>Vision of Department of Computer Engineering</h2>
    <p>
        To be an excellent center of learning, imparting quality education and creating computer competent professionals to serve the society at large.
    </p>
<br>
<br>
    <h2>Mission of Department of Computer Engineering</h2>
    <p>
      <ul>
        <li>To provide quality education required to shape skilled computer engineers.</li>
        <li>To promote scientific temper and research culture through interdisciplinary and industrial collaboration.</li>
        <li>To prepare industry ready professionals, having ethical values and social commitment.</li>
    </ul>
    </p>
    <br>
    <br>
    <h2>Program Educational Objectives (PEOs):</h2>
    <h3>After 3 to 4 years of graduation, the graduates will be --</h3>
    <p>
        <ul>
            <li>Capable of analysing and solving problems for diverse applications.</li>
            <li>Engaging themselves in lifelong learning and professional development to adapt to the dynamic work environment.</li>
            <li>Able to exhibit a high level of professionalism and work collaboratively at their workplace.</li>
        </ul>
    </p>
    <br>
    <br>
    <h2>Program Specific Outcomes (PSOs):</h2>
    <h3>The graduates of this program will be able to ---</h3>
    <p>
       <ul>
        <li>Apply the core concepts of computer engineering to develop effective solutions</li>
        <li>Analyze, Design and Develop computer programs in order to efficiently build computer-based systems of various levels of complexity</li>
        <li>Build feasible solutions using cutting edge technologies in computer engineering</li>
       </ul> 
    </p>
 </section>
<br>
<section class="about-us1">  
<h2>Head of Department</h2>

    <div class="team-member">
      <div class="member">
        <img src="SA.jpeg" alt="Dr. Sarita Ambadekar" class="member-img">
        <h3>Dr. Sarita Ambadekar(Head of Department)</h3>
      </div>
      <h2>Guided by</h2>
      <div class="team-row">
        <div class="member">
          <img src="PD.jpeg" alt="Prof. Priyanka Deshmukh" class="member-img">
          <h3>Prof. Priyanka Deshmukh</h3>
          <br>
        </div>

        <div class="member">
          <img src="PP.jpeg" alt="Prof. Pradnya Patil" class="member-img">
          <h3>Prof. Pradnya Patil</h3>
          <br>
        </div>
      </div>
    </div>

    <h2>Developed by</h2>

    <div class="team-member">
      <!-- <img src="team_member2.jpg" alt="Team Member 2"> -->
      <!-- <div class="flex"> -->
        <h3>Anandi Ket<br>Avani Mahadik<br>Malav Joshi <br> Sahil Mane</h3>
</section>
<br>
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
