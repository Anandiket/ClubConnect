
<?php
include "retrive.php";
include "db_connection.php";

include "session_timout.php";

$stmt_json = $conn->prepare("SELECT committee_ID FROM committees WHERE committee_ID = ?");
$stmt_json->bind_param("i", $committee_id);
$stmt_json->execute();
$result_json = $stmt_json->get_result();

if ($result_json->num_rows > 0) {
    $committee_ids = [];
    while ($row_json = $result_json->fetch_assoc()) {
        $committee_ids[] = $row_json ['committee_ID']; // Store all committee_IDs in an array
    }
} else {
    // Handle the case where no committees are found for the user
    echo "No committees found for this user.";
    exit();
}

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
        <title>Committee Profile</title>

        
    <style>
:root {
    /* Primary Colors */
    --bc: #0c0c0d;
    --bc-gray: #0d0e10;
    --bc-purple: #1e2731;
    --bc-purple-darker: #181c23;
    --bc-nav-foot: #101317;
    --section: #0e0e10;
    --primary: #94c2e3;
    --secondary: #4888b5;
    /* Colors */
    --white: #ffffff;
    --black: #000000;
    --dark-blue: #1f2029;
    --extra-dark-blue: #13141a;
    --red: #da2c4d;
    --orange: #fd7e14;
    --yellow: #f8ab37;
    --warning: #ffc107;
    --green: #28a745;
    --light-green: #24e33a;
    --teal: #20c997;
    --cyan: #17a2b8;
    --blue: #007bff;
    --indigo: #6610f2;
    --purple: #6f42c1;
    --pink: #e83e8c;
    --light-gray: #ebecf2;
    --bright-gray: #d9d5de;
    --gray: #6c757d;
    --gray-extra-dark: #343a40;
    --dark: #343a40;
    /* Minecraft Colors */
    --m-darkred: #aa0000;
    --m-red: #ff5555;
    --m-gold: #ffaa00;
    --m-yellow: #ffff55;
    --m-green: #55ff55;
    --m-darkgreen: #00aa00;
    --m-darkaqua: #00aaaa;
    --m-aqua: #55ffff;
    --m-blue: #94c2e3;
    --m-darkblue: #0000aa;
    --m-purple: #aa00aa;
    --m-pink: #ff55ff;
    --m-gray: #aaaaaa;
    --m-darkgray: #555555;
    /* Gradients */
    --gradient: linear-gradient(45deg, rgba(148,194,227,1) 0%, rgba(72,136,181,1) 100%);
    --gradient2: linear-gradient(45deg, rgba(148,194,227,1) 0%, rgba(72,136,181,1) 100%);
    /* Sizes */
    --heading: 3.4rem;
    --heading-medium: 2rem;
    --paragraph: 1.1rem;
    --button-large: 1.6rem;
    --button-small: 1.2rem;
    --button-smallest: 1rem;
    /* Fonts */
    --font-main: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
    --font-secondary: SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace;
    --font-slim: "Roboto";
  }
  
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

  /* ScrollTop */
  .back-to-top {
    position: fixed;
    right: 30px;
    bottom: 30px;
    display: none;
    z-index: 98;
  }
  .back-to-top a svg {
    fill: var(--bc-purple);
  }
  .back-to-top a {
    display: block;
    padding: 10px;
    cursor: pointer;
    opacity: 0;
    transition: all .35s ease-in-out;
  }
  .back-to-top a:hover {
    transform: scale(1.1, 1.1);
  }




  /*sagla align*/
  .user-info-bar {
    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.6);
    height: 180px;
    border-radius: 10px;
    margin-bottom: 20px;
    margin-left: auto;
    margin-right: auto;
    width: 85%;
    max-width: 1200px; /* Set a max width for larger screens */
    display: flex;
    padding: 0.75em 0 1em 0;
    background-color: #93332e;
    align-items: center; /* Center align items vertically */
}

.ufo-bar-col2-inner, .ufo-bar-col3-inner, .ufo-bar-col4-inner {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0.5em 0;
}

.user-icon-wrapper {
    width: 100%;
    position: relative;
   
    display: flex;
    justify-content: center;
    align-items: center;
}

.user-icon {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    border: 0.5em solid var(--bc);
    background-color: var(--m-darkred);
    object-fit: cover;
    
    margin-left:80px;
    
}

.username-wrapper-outer {
    display: flex;
    flex-direction: row;
    align-items: center; /* Align items in the center vertically */
    justify-content: flex-start; /* Align items to the start horizontally */
    margin: 0 0 0 1.5em;
    width: 100%;
}

.username-wrapper {
    width: auto; /* Adjust to fit content */
    position: relative;
    text-align: left;
}

.username-dev {
    margin: 0;
    display: inline-block;
    color: var(--white);
    font-size: 2em;
    cursor: default;
}

/* Responsive adjustments */
@media (max-width: 1200px) {
    .user-info-bar {
        flex-direction: row;
        align-items: center;
        height: auto;
    }

    .username-dev {
        font-size: 1.75em;
    }
    .user-icon {
        width: 120px;
        height: 120px;
        margin-left:80px;
    }
}

@media (max-width: 992px) {
    .user-info-bar {
        flex-direction: column;
        align-items: center;
        height: auto;
    }

    .username-dev {
        font-size: 1.5em;
    }
    .user-icon {
        width: 120px;
        height: 120px;
        margin-left:auto;
    }
}

@media (max-width: 768px) {
    .user-info-bar {
        flex-direction: column;
        align-items: center;
        height: auto;
        padding: 0.75em;
    }

    .ufo-bar-col2-inner, .ufo-bar-col3-inner, .ufo-bar-col4-inner {
        padding: 0.5em 0;
    }

    .user-icon {
        width: 120px;
        height: 120px;
        margin-left:auto;
    }

    .username-wrapper-outer {
        align-items: center;
        margin: 0;
    }

    .username-dev {
        font-size: 1.5em;
    }
}















  /*khalcha nav*/
  :root {
    --white: #fff;
    --dark: #000;
}

body {
    font-family: "Poppins", sans-serif;
    margin: 0;
    padding: 0;
    overflow-x: hidden;
}

.user-info-bar2 {
    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.6);
    border-radius: 10px;
    height: 60px;
    margin: 20px auto;
    width: 85%;
    display: grid;
    color: var(--white);
    background-color: #93332e;
    grid-template-columns: 1fr 16.25% 16.25% 16.25% 16.25% 1fr;
    grid-template-areas: ". ufo-bar2-col1 ufo-bar2-col2 ufo-bar2-col3 ufo-bar2-col4 ufo-bar2-col6";
}

.ufo-bar2-block {
    cursor: pointer;
    text-align: center;
}

.ufo-bar2-block h3 {
    color: var(--white);
    font-weight: 500;
}

.ufo-bar2-col2-inner,
.ufo-bar2-col3-inner,
.ufo-bar2-col4-inner,
.ufo-bar2-col6-inner {
    margin-top: 13px;
    width: 100%;
}

.nav-toggle {
    display: none;
    cursor: pointer;
    width:20%;
    margin:auto;
    top: 20px;
    left: 20px;
    z-index: 11;
    background-color: #93332e;
    padding: 10px;
    border-radius: 10px;
    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.6);
}

.nav-toggle div {
    width: 20px;
    height: 2px;
    background-color: white;
    margin: 5px 0;
    transition: 0.4s;
}

.nav-toggle span {
    color: white;
    font-size: 18px;
    margin-top: 5px;
    font-weight:600;
}

.close-btn {
    position: absolute;
    top: 10px;
    right: 20px;
    font-size: 36px;
    cursor: pointer;
    color: black;
    background: none;
}

.vertical-nav {
    display: none;
    position: fixed;
    top: -100%;
    left: 0;
    width: 50%;
    height: 100%;
    background-color: rgba(147, 51, 46, 0.9);
    z-index: 100;
    padding-top: 60px;
    transition: top 0.5s ease;
}

.vertical-nav a {
    padding: 10px 20px;
    text-decoration: none;
    font-size: 25px;
    color: #fff;
    display: block;
    transition: 0.3s;
}

.vertical-nav a:hover {
    background-color: #575757;
}

@media (max-width: 1200px) {
    .user-info-bar2 {
        display: none;
    }
    .nav-toggle {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .vertical-nav {
        display: block;
    }
}

@media (max-width: 600px) {
    .nav-toggle {
        top: 10px;
        left: 10px;
        padding: 5px;
    }
    .nav-toggle div {
        width: 15px;
        height: 2px;
    }
    .nav-toggle span {
        font-size: 16px;
    }
    .vertical-nav a {
        font-size: 20px;
    }
}


@media (max-width: 400px){
  .nav-toggle {
        top: 6px;
        left: 6px;
        padding: 3px;
    }
    .nav-toggle div {
        width: 15px;
        height: 2px;
    }
    .nav-toggle span {
        font-size: 16px;
    }
    .vertical-nav a {
        font-size: 20px;
    }
}




 

  



/*about*/

.about {
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.6);
            border: 2px solid #93332e;
            max-width: 1000px;
            margin: auto;
            margin-top: 20px;
            margin-bottom:10px;
            padding: 20px;
            border-radius: 10px;
            text-align: justify;
            font-weight: 500;
        }

        .background {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            width: 100%;
            max-height: 120%;
            z-index: -100;
        }

        .button2 {
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.6);
            background-color: #93332e;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: block;
            font-size: 16px;
            margin: auto;
            margin-top:5px;
            margin-bottom: 10px;
            cursor: pointer;
            border-radius: 8px;
        }

        .button2 a {
            color: white;
            text-decoration: none;
            font-weight:600;
            font-size: 16px;
        }

       

        .rectangle_c {
            flex: 1;
            min-width: 250px;
            max-width: calc(33.33% - 20px);
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);
            background-color: #fff;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
        }

        .rectangle_c img {
            width: 100%;
            height: auto;
            max-width: 200px;
            max-height: 180px;
            object-fit: cover;
            border-radius: 50%;
        }

        

        .action-container {
            margin-top: 10px;
        }



        @media (max-width: 1200px){
          .about{
              margin-left:10px;
              margin-right:10px;
            }

        }



        @media (max-width: 768px) {
            .rectangle_c {
                max-width: calc(50% - 20px);
            }
            .about{
              margin-left:10px;
              margin-right:10px;
            }
            .button2 {
                padding: 10px 20px;
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            .rectangle_c {
                max-width: 100%;
            }

            .button2 {
                padding: 10px 20px;
                font-size: 10px;
            }

            .about{
              margin-left:10px;
              margin-right:10px;
            }
        }

/*coordinator*/
.coordinator {
    width: 100%;
    padding: 20px;
    border-radius: 10px;
    text-align: center;
}

.coordinator-flex {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around; /* Adjust as needed */
}

.rectangle_c {
    flex: 1 1 300px; /* Flexible width, starting with 300px, adjusts based on available space */
    max-width: calc(50% - 20px); /* Two columns on smaller screens */
    background-color: #fff;
    border-radius: 30px;
    border: 6px solid #9B2928;
    font-size: 20px; /* Adjust font size */
    padding: 15px;
    margin: 20px 10px; /* Adjust margins for spacing */
    text-align: center;
}

.rectangle_c img {
    width: 100%;
    max-width: 200px; /* Adjust image size */
    height: auto;
    border-radius: 50%;
}

.coordinator-name {
    font-size: 18px; /* Adjust font size */
    font-weight: bold;
}

.coordinator-position {
    font-size: 16px; /* Adjust font size */
}

.action-container {
    margin-top: 10px;
}

.action-button {
    background-color: #93332e;
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 5px;
}

@media (max-width: 768px) {
    .rectangle_c {
        max-width: 95%; /* Two columns on tablets */
    }
}

@media (max-width: 480px) {
    .rectangle_c {
        max-width: 95%; /* Full width on smaller screens */
        font-size: 16px; /* Adjust font size for smaller screens */
    }
}

@media (max-width: 360px) {
    .rectangle_c {
        font-size: 14px; /* Further adjust font size for very small screens */
    }
}

/* event css*/
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


/*filter form*/

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















.achievements {
    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.6);
    border: 2px solid #93332e;
    width: 80%;
    max-width: 500px; /* Smaller container */
    margin: 20px auto;
    padding: 20px;
    border-radius: 10px;
    background-color: white;
    color: black;
    text-align: center;
}

.achievements-align {
    text-align: center;
}

#title {
    font-size: 25px; /* Adjusted font size */
    font-weight: 1000;
}

#desc {
    font-size: 20px; /* Adjusted font size */
    font-weight: 500;
}

.rectangle {
    width: 200px;
    height: 300px;
    background-color: #93332e;
    border-radius: 10px;
    text-align: center;
    color: #fff;
    font-size: 40px;
    padding: 20px;
    margin: 10px;
}

.action-container {
    display: flex;
    justify-content: space-evenly;
    margin-top: 20px;
}

.action-button {
    border-radius: 5px;
    padding: 10px 20px;
    margin: 5px;
    background-color: #93332e;
    color: white;
    border: none;
    cursor: pointer;
}

.action-button:hover {
    background-color: #c44c47;
}

.achievements img {
    max-width: 100%;
    max-height: 150px; /* Limit the image height */
    object-fit: cover;
    border-radius: 10px;
    margin: auto;
}

/* Responsive Design */
@media (max-width: 768px) {
    .achievements {
        width: 90%;
    }

    #title {
        font-size: 20px;
    }

    #desc {
        font-size: 18px;
    }

    .action-button {
        padding: 5px 10px;
    }
}

@media (max-width: 480px) {
    .achievements {
        width: 95%;
    }

    #title {
        font-size: 18px;
    }

    #desc {
        font-size: 16px;
    }

    .action-button {
        padding: 5px;
    }
}

.carousel {
    position: relative;
    overflow: hidden;
    width: 100%;
    max-width: 600px;
    margin: auto;
}

.carousel-inner {
    display: flex;
    transition: transform 0.5s ease;
}

.carousel-item {
    min-width: 100%;
    box-sizing: border-box;
}

.carousel img {
    width: 100%;
    height: auto;
    max-height: 300px; /* Adjust the max-height as needed */
    object-fit: contain;
}

.carousel-control-prev, .carousel-control-next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background-color: rgba(0, 0, 0, 0.5);
    color: white;
    border: none;
    padding: 10px;
    cursor: pointer;
}

.carousel-control-prev {
    left: 10px;
}

.carousel-control-next {
    right: 10px;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .carousel {
        max-width: 100%;
    }

    .carousel-control-prev, .carousel-control-next {
        padding: 5px;
    }
}

@media (max-width: 480px) {
    .carousel-control-prev, .carousel-control-next {
        padding: 2px;
    }
}



























/*members css*/

.members {
    width: 100%;
    padding: 20px;
    border-radius: 10px;
    text-align: center;
}

.members-flex {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-evenly;
}

.rectangle_m {
    width: calc(33.33% - 20px); /* Adjusted width for responsiveness */
    max-width: 400px; /* Maximum width for larger screens */
    background-color: #fff;
    border-radius: 10px;
    border: 6px solid #9B2928;
    font-size: 20px;
    padding: 20px;
    margin: 10px;
    box-sizing: border-box;
    text-align: center;
    overflow: hidden;
    white-space: nowrap;
}

.rectangle_m img {
    width: 100%; /* Ensure images fit within the rectangle */
    height: auto; /* Maintain aspect ratio */
    border-radius: 10px;
}

.rectangle_m strong {
    font-weight: bold;
}

.action-container {
    margin-top: 10px;
}

.action-button {
    padding: 5px 10px;
    margin: 5px;
    background-color: #93332e;
    color: white;
    border: none;
    cursor: pointer;
    border-radius: 5px;
}

.action-button:hover {
    background-color: #c44c47;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .rectangle_m {
        width: calc(50% - 20px); /* Two items per row on tablets */
        max-width: 300px; /* Maximum width for tablets */
    }
}

@media (max-width: 768px) {
    .rectangle_m {
        width: calc(100% - 20px); /* Full width on mobile */
        max-width: none; /* No maximum width on mobile */
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
/* General Marquee Styling */
marquee {
  /* background-color: #93332e; */
  color: black;
  padding: 10px;
  font-weight: 600;
  font-size: 16px;
  /* border-radius: 5px;
  box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5); */
  cursor: pointer;
}

/* Enroll Button Styling */
.enroll {
  background-color: #93332e;
  color: White;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
  margin: 0 5px;
}

.enroll:hover {
  background-color: #AD5D59;
}

/* Responsive Design */
@media (max-width: 768px) {
  marquee {
    font-size: 14px;
    padding: 8px;
  }

  .enroll {
    padding: 8px 16px;
    font-size: 14px;
  }
}

@media (max-width: 480px) {
  marquee {
    font-size: 12px;
    padding: 6px;
  }

  .enroll {
    padding: 6px 12px;
    font-size: 12px;
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
        <li><?php 
            // if (isset($_GET['l_id'])) {
            //   $l_id = $_GET['l_id'];
            // } 
            
            if (isset($_SESSION['committee_ID'])) { ?>
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
<div class="back-to-top" style="display: block; opacity: 1;">
    <a class="semplice-event" href="#" data-event-type="helper" data-event="scrollToTop" style="opacity: 1;">
        <svg version="1.1" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="53px" height="20px" viewBox="0 0 53 20" enable-background="new 0 0 53 20" xml:space="preserve">
            <g id="Ebene_3"></g>
            <g><polygon points="43.886,16.221 42.697,17.687 26.5,4.731 10.303,17.688 9.114,16.221 26.5,2.312 	"></polygon></g>
        </svg>
    </a>
</div>

<?php if (isset($_SESSION['committee_ID'])) { ?>
<a href="convenorcommitteelist.php?l_id=1"><button class="back-button" >Go Back</button></a>
<?php } else { ?>
  <a href="listcom.php?id=<?php echo $dept_id?>"><button class="back-button" >Go Back</button></a>
  <?php
  
}
?>
<main>
  
    <div class="user-info-bar">
        <div class="ufo-bar-col2">
            <div class="ufo-bar-col2-inner">
                <div class="user-icon-wrapper">
                <?php if (!empty($logo_image)): ?>
                <img class="user-icon" src="data:image/jpeg;base64,<?php echo $logo_image; ?>" alt="">
            <?php else: ?>
                <img class="user-icon" src="csi_kjsieit_student_s_chapter_logo.jpeg" alt="Default Background Image">
            <?php endif; ?> 
                </div>
            </div>
        </div>
        <div class="ufo-bar-col3">
            <div class="ufo-bar-col3-inner">
                <div class="username-wrapper-outer">
                    <div class="username-wrapper">
                        <!--div class="verified" style="opacity: 0; top: 150%;"><p>Verified Account</p></div-->
                        <h3 class="username-dev"><?php echo $committee_name?></h3>                        <!--svg class="uname-verified" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1350.03 1326.16"-->
                            <defs><style>.cls-11{fill:var(--bc);}.cls-12{fill:#000000;}</style></defs><title>verified</title>
                            <g id="Layer_3" data-name="Layer 3">
                                <polygon class="cls-11" points="0 747.37 120.83 569.85 70.11 355.04 283.43 292.38 307.3 107.41 554.93 107.41 693.66 0 862.23 120.83 1072.57 126.8 1112.84 319.23 1293.35 399.79 1256.05 614.6 1350.03 793.61 1197.87 941.29 1202.35 1147.15 969.64 1178.48 868.2 1326.16 675.02 1235.17 493.77 1315.72 354.99 1133.73 165.58 1123.29 152.16 878.64 0 747.37"/></g>
                            <g id="Layer_2" data-name="Layer 2">
                                <path class="cls-12" d="M755.33,979.23s125.85,78.43,165.06,114c34.93-36,234.37-277.22,308.24-331.94,54.71,21.89,85,73.4,93,80.25-3.64,21.89-321.91,418.58-368.42,445.94-32.74-3.84-259-195.16-275.4-217C689.67,1049.45,725.24,1003.85,755.33,979.23Z" transform="translate(-322.83 -335.95)"/></g>
                        </svg>
                    </div>
                    
                </div>
            </div>
        </div>
        
    </div>
    


    


    <?php if (isset($_SESSION['committee_ID'])) { ?>
    <div class="nav-toggle" onclick="toggleNav()">
        <span>☰ Menu</span>
    </div>

    <div class="vertical-nav" id="vertical-nav">
        <div class="close-btn" onclick="toggleNav()">&times;</div>
        <a href="javascript:void(0);" onclick="navigateToPage('committeepg.php?f_id=1&l_id=1', <?php echo $committee_id; ?>);">About</a>
        <a href="javascript:void(0);" onclick="navigateToPage('committeepg.php?f_id=2&l_id=1', <?php echo $committee_id; ?>);">Events</a>
        <a href="javascript:void(0);" onclick="navigateToPage('committeepg.php?f_id=3&l_id=1', <?php echo $committee_id; ?>);">Achievements</a>
        <a href="javascript:void(0);" onclick="navigateToPage('committeepg.php?f_id=4&l_id=1', <?php echo $committee_id; ?>);">Members</a>
    </div>

    <div class="user-info-bar2">
        <div class="ufo-bar2-col1"></div>
        <div id="ufo-home" class="ufo-bar2-col2 ufo-bar2-block">
            <div class="ufo-bar2-col2-inner">
                <span><i class="uil uil-trophy"></i></span>
                <a style="text-decoration: none;" href="javascript:void(0);" onclick="navigateToPage('committeepg.php?f_id=1&l_id=1', <?php echo $committee_id; ?>);"><h3>About</h3></a>
            </div>
        </div>
        <div id="ufo-videos" class="ufo-bar2-col3 ufo-bar2-block">
            <div class="ufo-bar2-col3-inner">
                <span><i class="uil uil-star"></i></span>
                <a style="text-decoration: none;" href="javascript:void(0);" onclick="navigateToPage('committeepg.php?f_id=2&l_id=1', <?php echo $committee_id; ?>);"><h3>Events</h3></a>
            </div>
        </div>
        <div id="ufo-images" class="ufo-bar2-col4 ufo-bar2-block">
            <div class="ufo-bar2-col4-inner">
                <span><i class="uil uil-comment-alt"></i></span>
                <a style="text-decoration: none;" href="javascript:void(0);" onclick="navigateToPage('committeepg.php?f_id=3&l_id=1', <?php echo $committee_id; ?>);"><h3>Achievements</h3></a>
            </div>
        </div>
        <div id="ufo-about" class="ufo-bar2-col6 ufo-bar2-block">
            <div class="ufo-bar2-col6-inner">
                <span><i class="uil uil-user"></i></span>
                <a style="text-decoration: none;" href="javascript:void(0);" onclick="navigateToPage('committeepg.php?f_id=4&l_id=1', <?php echo $committee_id; ?>);"><h3>Members</h3></a>
            </div>
        </div>
    </div>
<?php } else { ?>

<div class="nav-toggle" onclick="toggleNav()">
        <span>☰ Menu</span>
    </div>

    <div class="vertical-nav" id="vertical-nav">
        <div class="close-btn" onclick="toggleNav()">&times;</div>
        <a href="committeepg.php?committee_ID=<?php echo $committee_id; ?>&f_id=<?php echo 1 ?>&l_id=<?php echo 1 ?>">About</a>
        <a href="committeepg.php?committee_ID=<?php echo $committee_id; ?>&f_id=<?php echo 2 ?>&l_id=<?php echo 1 ?>">Events</a>
        <a href="committeepg.php?committee_ID=<?php echo $committee_id; ?>&f_id=<?php echo 3 ?>&l_id=<?php echo 1 ?>">Achievements</a>
        <a href="committeepg.php?committee_ID=<?php echo $committee_id; ?>&f_id=<?php echo 4 ?>&l_id=<?php echo 1 ?>" >Members</a>
    </div>

    <div class="user-info-bar2">
        <div class="ufo-bar2-col1"></div>
        <div id="ufo-home" class="ufo-bar2-col2 ufo-bar2-block">
            <div class="ufo-bar2-col2-inner">
                <span><i class="uil uil-trophy"></i></span>
                <a style="text-decoration: none;" href="committeepg.php?committee_ID=<?php echo $committee_id; ?>&f_id=<?php echo 1 ?>&l_id=<?php echo 1 ?>" ><h3>About</h3></a>
            </div>
        </div>
        <div id="ufo-videos" class="ufo-bar2-col3 ufo-bar2-block">
            <div class="ufo-bar2-col3-inner">
                <span><i class="uil uil-star"></i></span>
                <a style="text-decoration: none;"href="committeepg.php?committee_ID=<?php echo $committee_id; ?>&f_id=<?php echo 2 ?>&l_id=<?php echo 1 ?>"><h3>Events</h3></a>
            </div>
        </div>
        <div id="ufo-images" class="ufo-bar2-col4 ufo-bar2-block">
            <div class="ufo-bar2-col4-inner">
                <span><i class="uil uil-comment-alt"></i></span>
                <a style="text-decoration: none;" href="committeepg.php?committee_ID=<?php echo $committee_id; ?>&f_id=<?php echo 3 ?>&l_id=<?php echo 1 ?>"><h3>Achievements</h3></a>
            </div>
        </div>
        <div id="ufo-about" class="ufo-bar2-col6 ufo-bar2-block">
            <div class="ufo-bar2-col6-inner">
                <span><i class="uil uil-user"></i></span>
                <a style="text-decoration: none;" href="committeepg.php?committee_ID=<?php echo $committee_id; ?>&f_id=<?php echo 4 ?>&l_id=<?php echo 1 ?>"><h3>Members</h3></a>
            </div>
        </div>
    </div>
    <?php } ?>




    <?php
    switch($f_id){
      case 1: 
      if (!isset($_SESSION['committee_ID'])){
        ?>
     <a href="<?php echo $more_desc; ?>" style="text-decoration: none;">
  <marquee scrollamount="12">
    <span>Click here to Join us! <button class="enroll"><b>Enroll</b></button>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
    <span>Click here to Join us! <button class="enroll"><b>Enroll</b></button>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
    <span>Click here to Join us! <button class="enroll"><b>Enroll</b></button>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
    
    <span>Click here to Join us! <button class="enroll"><b>Enroll</b></button>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
    <span>Click here to Join us! <button class="enroll"><b>Enroll</b></button>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
    <span>Click here to Join us! <button class="enroll"><b>Enroll</b></button>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
    <span>Click here to Join us! <button class="enroll"><b>Enroll</b></button>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
    
  </marquee>
</a>
<?php } ?>



    <section class="about">
            <?php if(!empty($committee_name)): ?>
                <h1>About <?php echo $committee_name?></h1>
                <br>
            <?php endif; ?>
            <?php if(!empty($objective)): ?>
                <h2>Objective of the committee:</h2>
                <?php echo $objective; ?>
            <?php endif; ?>
            
            <?php if(!empty($mission)): ?>
              
                <h2><br>Mission</h2>
                <?php echo $mission; ?>
            <?php endif; ?>
            
            <?php if(!empty($more_desc)): ?>
              <br>
              <br>
              
              
          <?php endif; ?>

       
       
        </section>
        <?php
           if (isset($_SESSION['committee_ID'])){
            if (!isset($des_id) || is_null($des_id)) { ?>
             
              <button class="button2">
              <a href="javascript:void(0);" onclick="navigateToPage('descriptionform.php?f_id=<?php echo 1; ?>&l_id=1', <?php echo $committee_id; ?>);">

                <h2>Add About</h2></a>
                
                <?php
          } else { ?>
              
              <button class="button2">
    <a href="javascript:void(0);" onclick="navigateToPage('descriptionform.php?des_id=<?php echo $des_id; ?>&f_id=<?php echo 1; ?>&l_id=1', <?php echo $committee_id; ?>);">
      <h2>Update About</h2></a>
      </button>  <?php 
          }?>

          <!-- add boxes for coordinators of the committee -->
          <button class="button2">
    <a href="javascript:void(0);" onclick="navigateToPage('coordinatorform.php?f_id=1&l_id=1', <?php echo $committee_id; ?>);">
        <h2>+ New Coordinator</h2>
    </a>
</button>
    <?php } ?>


<section class="coordinator">
        <div class="coordinator-flex">
          <?php
        $c = 0; // Initialize a counter
        $total_coordinators = count($committee_coordinators);

foreach ($committee_coordinators as $coordinator) {
    if ($c % 3 == 0 && $c != 0) {
        // Start a new flex container for every 3 coordinators
        echo "</div><div class='coordinator-flex'>";
    }

    echo "<div class='rectangle_c'>";
    $imageData = base64_encode($coordinator['photo']);
    $mimeType = !empty($coordinator['mime_type']) ? $coordinator['mime_type'] : 'image/jpeg';
    echo "<img src='data:{$mimeType};base64,{$imageData}' alt='Coordinator Photo' style='width: 200px; height: 180px;'>";
    echo "<strong><br><span class='coordinator-name'>" . htmlspecialchars($coordinator['coordinator_name']) . "</span></strong>";
    echo " <div class='coordinator-position'>Contact Details";
    echo "<br>Contact No.: " . htmlspecialchars($coordinator['contact_no']);
    echo "<br>Email: " . htmlspecialchars($coordinator['email']) . "";
    echo "</div>";

    if (isset($_SESSION['committee_ID'])) {
        echo "<div class='action-container'>";
        echo "<a href='javascript:void(0);' onclick='navigateToPage(\"coordinatorform.php?coordinator_id={$coordinator['coordinator_id']}&f_id=1&l_id=1\", $committee_id);'>
            <button class='action-button'><b>Update Coordinator</b></button>
        </a>";

        echo "<form method='POST' action='coordinatordb.php' onsubmit=\"return confirm('Are you sure you want to delete this coordinator?');\" style='display:inline;'>";
        echo "<input type='hidden' name='action_type' value='delete'>";
        echo "<input type='hidden' name='coordinator_id' value='{$coordinator['coordinator_id']}'>";
        echo "<input type='hidden' name='committee_ID' value='{$coordinator['committee_ID']}'>";
        echo "<button type='submit' class='action-button'><b>Delete Coordinator</b></button>";
        echo "</form>"; 
        echo "</div>";
    }

    echo "</div>";

    $c++;
}
?>
        <?php
        break;
        case 2:
           ?>
          <?php  if (isset($_SESSION['committee_ID'])){ ?>
            <button class="button2">
    <a href="javascript:void(0);" onclick="navigateToPage('expform.php?f_id=2&l_id=1', <?php echo $committee_id; ?>);">
        <h2>+ New Event</h2>
    </a>
</button>        
          <?php } ?>
          <form method="GET" action="committeepg.php" id="filter_form">
        <input type="hidden" name="f_id" value="<?php echo htmlspecialchars($_GET['f_id']); ?>">
        <input type="hidden" name="l_id" value="<?php echo htmlspecialchars($_GET['l_id']); ?>">
        <?php
        if (!isset($_SESSION['committee_ID'])){ ?>
        <input type="hidden" name="committee_ID" value="<?php echo $committee_id; ?>">
        <?php } ?>
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
                    <h2><?php echo $event['eventName']; ?></h2>
                    <?php
                    $imageDatae = base64_encode($event['photo']);
                    $mimeTypee = !empty($event['mime_type']) ? $event['mime_type'] : 'image/jpeg';
                    ?>
                    <img src='data:<?php echo $mimeTypee; ?>;base64,<?php echo $imageDatae; ?>' alt='Event Photo'>
                    <p><?php echo $event['e_desc']; ?></p>
                    <p><strong>Date:</strong><?php echo date('d.m.y', strtotime($event['event_date'])); ?></p>    
                    <p><strong>Time:</strong><?php echo date('h:i A', strtotime($event['time'])); ?></p>
                    <p><strong>Venue:</strong><?php echo $event['venue']; ?></p>
                    <p><strong>Type:</strong><?php echo $event['type']; ?></p>
                    <p><strong>Mode:</strong><?php echo $event['mode']; ?></p>


                    <!-- <p><strong>Time:</strong> <?php //echo date('h:i A', strtotime($event['time'])); ?></p> -->
                    <p><strong>Contact:</strong> <?php echo $event['RpersonContact']; ?></p>
                </div>
                <div class='action-container'>
                <a style="text-decoration: none; font-weight: 600;" href="<?php echo $event['link']; ?>"><button class='action-button'><b>Register for Event</b></button>
                </a>
            </div>

                <?php if (isset($_SESSION['committee_ID'])) { ?>
                    <div class='action-container'>
                        <a href='javascript:void(0);' onclick='navigateToPage("expform.php?l_id=1&event_id=<?php echo $event['Event_ID']; ?>&f_id=<?php echo $f_id; ?>", <?php echo $committee_id; ?>);'>
                            <button class='action-button'><b>Update Event</b></button>
                        </a>
                        <form method='POST' action='event.php' onsubmit="return confirm('Are you sure you want to delete this event?');" style='display:inline;'>
                            <input type='hidden' name='action_type' value='delete'>
                            <input type='hidden' name='event_id' value='<?php echo $event['Event_ID']; ?>'>
                            <input type='hidden' name='committee_ID' value='<?php echo $event['committee_ID']; ?>'>
                            <input type='hidden' name='table_name' value='events'>
                            <button type='submit' class='action-button'><b>Delete Event</b></button>
                        </form>
                    </div>
                <?php } ?>
                <?php
            }
        }
        ?>
    </div>
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
                    <h2><?php echo $event_past['eventName']; ?></h2>
                    <?php
                     if (!empty($event_past['photo'])) {
                      $carouselId = 'carousel-' . $event_past['Event_ID'];
                      echo '<div id="' . $carouselId . '" class="carousel">';
                      echo '<div class="carousel-inner">';
                      foreach ($event_past['photo'] as $index => $photo) {
                          echo '<div class="carousel-item ' . ($index === 0 ? 'active' : '') . '">';
                          echo '<img src="data:image/jpeg;base64,' . htmlspecialchars($photo) . '" alt="Event Image" class="carousel-image">';
                          echo '</div>';
                      }
                      echo '</div>';
                      echo '<button class="carousel-control-prev">&lsaquo;</button>';
                      echo '<button class="carousel-control-next">&rsaquo;</button>';
                      echo '</div><br>';
                  }
                    ?>
                    <p><?php echo $event_past['e_desc']; ?></p>
                    <p><strong>Date:</strong> <?php echo date('d.m.y', strtotime($event_past['event_date'])); ?><strong> Time:</strong> <?php echo date('h:i A', strtotime($event_past['time'])); ?></p>
                    <p><strong>Resource Person:</strong> <?php echo $event_past['RpersonName']; ?></p>
                    <p><strong>Contact:</strong> <?php echo $event_past['RpersonContact']; ?></p>
                    <p><strong>Venue:</strong><?php echo $event_past['venue']; ?></p>
                    <p><strong>Type:</strong><?php echo $event_past['type']; ?></p>
                    <p><strong>Mode:</strong><?php echo $event_past['mode']; ?></p>
                    

                <?php if (isset($_SESSION['committee_ID'])) { ?>

                  <div class='action-container'>
                        <input type='hidden' name='event_id' value='<?php echo $event_past['Event_ID']; ?>'>
                        <a style="text-decoration: none; font-weight: 600;" href="pdf.php?Event_ID=<?php echo $event_past['Event_ID']; ?>">
                            <button class='action-button'><b>Print Event Report</b></button>
                        </a>
                    </div>
                    
                    <div class='action-container'>
                        <a href='javascript:void(0);' onclick='navigateToPage("past_eventform.php?l_id=1&event_id=<?php echo $event_past['Event_ID']; ?>&f_id=<?php echo $f_id; ?>", <?php echo $committee_id; ?>);'>
                            <button class='action-button'><b>Add Event Details</b></button>
                        </a>
                        <form method='POST' action='event.php' onsubmit="return confirm('Are you sure you want to delete this event?');" style='display:inline;'>
                            <input type='hidden' name='action_type' value='delete'>
                            <input type='hidden' name='event_id' value='<?php echo $event_past['Event_ID']; ?>'>
                            <input type='hidden' name='committee_ID' value='<?php echo $event_past['committee_ID']; ?>'>
                            <input type='hidden' name='table_name' value='events'>
                            <button type='submit' class='action-button'><b>Delete Event</b></button>
                        </form>
                    </div>
                <?php } ?>
                </div> <!-- Close the rectangle_event div here -->
                <?php
            }
        }
        ?>
    </div>
</section>
<?php } ?>

<?php
break;
case 3:
  if (isset($_SESSION['committee_ID'])) {
  ?>
  <button class="button2">
      <a href="javascript:void(0);" onclick="navigateToPage('achievementsform.php?l_id=1&f_id=3', <?php echo $committee_id; ?>);">
          <h2>+ New Achievement</h2>
      </a>
  </button>
  <?php } ?>
  
  <?php
  if (count($committee_achievements) > 0) {
      foreach ($committee_achievements as $row) {
          echo '<section class="achievements">';
          echo '<div class="achievements-align" id="title">' . $row['achievement_name'] . '</div><br>';
          echo '<div class="achievements-align" id="desc">' . $row['achievement_desc'] . '</div><br>';
  
          if (!empty($row['photo'])) {
              $carouselId = 'carousel-' . $row['achievement_ID'];
              echo '<div id="' . $carouselId . '" class="carousel">';
              echo '<div class="carousel-inner">';
              foreach ($row['photo'] as $index => $photo) {
                  echo '<div class="carousel-item ' . ($index === 0 ? 'active' : '') . '">';
                  echo '<img src="data:image/jpeg;base64,' . htmlspecialchars($photo) . '" alt="Achievement Image" class="carousel-image">';
                  echo '</div>';
              }
              echo '</div>';
              echo '<button class="carousel-control-prev">&lsaquo;</button>';
              echo '<button class="carousel-control-next">&rsaquo;</button>';
              echo '</div><br>';
          }
  
          echo '<div class="achievements-align" id="desc"><b>Students:</b> ' . $row['achievement_student'] . '</div><br>';
          echo '<div class="achievements-align" id="desc">' . date('d.m.y', strtotime($row['achievements_date'])) . '</div><br>';
  
          if (isset($_SESSION['committee_ID'])) {
              echo "<div class='action-container'>";
              echo "<a href='javascript:void(0);' onclick='navigateToPage(\"achievementsform.php?l_id=1&f_id=3&achievement_id={$row['achievement_ID']}\", $committee_id);'>
              <button class='action-button'>Update Achievement</button>
              </a>";
  
              echo "<form method='POST' action='ach.php' onsubmit=\"return confirm('Are you sure you want to delete this achievement?');\" style='display:inline;'>";
              echo "<input type='hidden' name='action_type' value='delete'>";
              echo "<input type='hidden' name='achievement_id' value='{$row['achievement_ID']}'>";
              echo "<input type='hidden' name='committee_ID' value='{$row['committee_ID']}'>";
              echo "<button type='submit' class='action-button'>Delete Achievement</button>";
              echo "</form>";
              echo "</div>";
          }
  
          echo '</section>';
          echo '<br>';
      }
  } else { ?>
  <div class="achieve" style="margin:50px 0 200px 0;">
    <center>
      <h2>All great achievements require TIME.</h2>
  </center>
  </div>
  <?php
  }
 
  break;
    case 4:
  if (isset($_SESSION['committee_ID'])) {
?>

<button class="button2">
    <a href="javascript:void(0);" onclick="navigateToPage('memberform.php?f_id=4&l_id=1', <?php echo $committee_id; ?>);">
        <h2>+ New Member</h2>
    </a>
</button>
    <?php } ?>
    
    <center><h2>Core</h2></center>
<section class="members">
        <div class="members-flex">
        <?php
        
        $counter = 0; // Initialize a counter
        foreach ($committee_members as $member) {
          if($member['role'] == 'Core'){
            
            if ($counter % 3 == 0 && $counter != 0) {
                // Start a new flex container for every 3 members
                echo "</div><div class='members-flex'>";
            }

            echo "<div class='rectangle_m'>";
            $imageData = base64_encode($member['photo']);
            $mimeType = !empty($member['mime_type']) ? $member['mime_type'] : 'image/jpeg';
            echo "<img src='data:{$mimeType};base64,{$imageData}' alt='Member Photo'>";
            echo "<strong><br><span class='member-name'>" . htmlspecialchars($member['member_name']) . "</span></strong>";
            echo "<strong><br><span class='member-position'>" . htmlspecialchars($member['position']) . "</span></strong>";
            echo "<br><span class='member-position'>" . htmlspecialchars($member['year']) .":" . htmlspecialchars($member['division']) ."</span>";
            echo "<strong><br><span class='member-position'>" . htmlspecialchars($member['contact_no']) . "</span></strong>";
            echo "<strong><br><span class='member-position'>" . htmlspecialchars($member['tenure_year']) . "</span></strong>";
           
            if (isset($_SESSION['committee_ID'])){
            echo "<div class='action-container'>";
            echo "<a href='javascript:void(0);' onclick='navigateToPage(\"memberform.php?member_id={$member['member_id']}&f_id=4&l_id=1\", $committee_id);'>
            <button class='action-button'><b>Update Member</b></button>
          </a>";
    
            echo "<form method='POST' action='memberdb.php' onsubmit=\"return confirm('Are you sure you want to delete this member?');\" style='display:inline;'>";
            echo "<input type='hidden' name='action_type' value='delete'>";
            echo "<input type='hidden' name='member_id' value='{$member['member_id']}'>";
            echo "<input type='hidden' name='committee_ID' value='{$member['committee_ID']}'>";
            echo "<button type='submit' class='action-button'><b>Delete Member</b></button>";
            echo "</form>"; 
            echo "</div>";
            }
            echo "</div>";
            

            $counter++;

            if ($counter % 3 == 0 || $counter == $num_non_members) {
                // Close the flex container after every 3 members or if it's the last member
                echo "</div><br><br>";
            }
          } 
        }

        ?>
           </div>
           </section>
<center><h2>Members</h2></center>
<section class="members">
    <div class="members-flex">
        <?php
        $counter = 0; // Initialize a counter
        foreach ($committee_members as $member) {
            if ($member['role'] == 'Member') {
                if ($counter % 3 == 0 && $counter != 0) {
                    // Start a new flex container for every 3 members
                    echo "</div><div class='members-flex'>";
                }

                echo "<div class='rectangle_m'>";
                // $imageData = base64_encode($member['photo']);
                // $mimeType = !empty($member['mime_type']) ? $member['mime_type'] : 'image/jpeg';
                // echo "<img src='data:{$mimeType};base64,{$imageData}' alt='Member Photo'>";
                echo "<strong><br><span class='member-name'>" . htmlspecialchars($member['member_name']) . "</span></strong>";
                // echo "<strong><br><span class='member-position'>" . htmlspecialchars($member['position']) . "</span></strong>";
                echo "<br><span class='member-position'>" . htmlspecialchars($member['year']) .":" . htmlspecialchars($member['division']) . "</span>";
                echo "<strong><br><span class='member-position'>" . htmlspecialchars($member['contact_no']) . "</span></strong>";
                echo "<strong><br><span class='member-position'>" . htmlspecialchars($member['tenure_year']) . "</span></strong>";



               if (isset($_SESSION['committee_ID'])) {
                    echo "<div class='action-container'>";
                    echo "<a href='javascript:void(0);' onclick='navigateToPage(\"memberform.php?member_id={$member['member_id']}&f_id=4&l_id=1\", $committee_id);'>
                    <button class='action-button'><b>Update Member</b></button></a>";
                    echo "<form method='POST' action='memberdb.php' onsubmit=\"return confirm('Are you sure you want to delete this member?');\" style='display:inline;'>";
                    echo "<input type='hidden' name='action_type' value='delete'>";
                    echo "<input type='hidden' name='member_id' value='{$member['member_id']}'>";
                    echo "<input type='hidden' name='committee_ID' value='{$member['committee_ID']}'>";
                    echo "<button type='submit' class='action-button'><b>Delete Member</b></button>";
                    echo "</form>";
                    echo "</div>";
                }

                echo "</div>";

                $counter++;

                if ($counter % 3 == 0 || $counter == $num_members) {
                    // Close the flex container after every 3 members or if it's the last member
                    echo "</div><br><br>";
                }
            }
        }
        ?>
    </div>
</section>
<?php
break;
}

?>



</main>
<?php if (isset($_SESSION['committee_ID'])) { ?>

<button class="button2">
  <a href = "report_form.php?l_id=1&f_id=<?php echo $f_id ?>&dept_id=<?php echo $dept_id ?>">Generate Report</a>
</button>
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
  </script>
<script>
        function resizeText() {
            const textElements = document.querySelectorAll('.member-name, .member-position');

            textElements.forEach(textElement => {
                const container = textElement.parentElement.parentElement; // Assuming parent is <strong> and its parent is .rectangle_m
                let fontSize = 24; // Start with a reasonably large font size
                textElement.style.fontSize = `${fontSize}px`;

                // Reduce the font size until the text fits within the container
                while (textElement.scrollWidth > container.clientWidth && fontSize > 10) { // Ensure font size doesn't get too small
                    fontSize--;
                    textElement.style.fontSize = `${fontSize}px`;
                }
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            resizeText();
            
            // Call resizeText() again if the window is resized
            window.addEventListener('resize', resizeText);
        });

        
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

function clearFilter() {
            document.getElementById('event_date').value = '';
            document.getElementById('event_filter').value = 'all';
            document.getElementById('filter_form').submit();
        }


</script>


<script>
function toggleNav() {
    var nav = document.getElementById("vertical-nav");
    if (nav.style.top === "0px") {
        nav.style.top = "-100%";
    } else {
        nav.style.top = "0px";
    }
}

function navigateToPage(url, committee_id) {
    window.location.href = url + '&committee_id=' + committee_id;
}
</script>
<script>
  // Function to repeat content inside the marquee
  function repeatMarqueeContent() {
    const marquee = document.getElementById('marquee');
    const content = '<h3>Click here to Join us!<button class="enroll"><b>Enroll</b></button></h3>';
    const repeatCount = 10; // Adjust the repeat count as needed

    for (let i = 0; i < repeatCount; i++) {
      marquee.innerHTML += content + '&nbsp;&nbsp;&nbsp;&nbsp;'; // Add spaces between repetitions
    }
  }

  // Call the function to repeat content
  repeatMarqueeContent();
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const carousels = document.querySelectorAll('.carousel');

    carousels.forEach(carousel => {
        const prevButton = carousel.querySelector('.carousel-control-prev');
        const nextButton = carousel.querySelector('.carousel-control-next');
        const inner = carousel.querySelector('.carousel-inner');
        const items = carousel.querySelectorAll('.carousel-item');
        let currentIndex = 0;

        function updateCarousel() {
            const width = inner.clientWidth;
            inner.style.transform = `translateX(-${currentIndex * width}px)`;
        }

        prevButton.addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex--;
            } else {
                currentIndex = items.length - 1;
            }
            updateCarousel();
        });

        nextButton.addEventListener('click', () => {
            if (currentIndex < items.length - 1) {
                currentIndex++;
            } else {
                currentIndex = 0;
            }
            updateCarousel();
        });

        window.addEventListener('resize', updateCarousel);
        updateCarousel();
    });
});

</script>
</body>
</html>