<?php
  session_start();
  include "db_connection.php";
  // Check if the committee_ID is set in the session
if (!isset($_SESSION['id'])) {
  echo "Committee ID not set in session.";
  exit;
}

// Retrieve the committee_ID from session
$committee_ID = $_SESSION['committee_ID'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['attributes'])) {
    $category = $_POST['category'];
    $selectedAttributes = $_POST['attributes'];
    
    $attributeKeys = [
        'event' => [
            'Event Name' => 'eventName',
            'Description' => 'e_desc',
            
            'Date' => 'event_date',
            'Resource Person Name' => 'RpersonName',
            'Resource Person Contact' => 'RpersonContact',
            
            'Resource Person Email' => 'RpersonEmail',
            'Academic Year' => 'academicYear'
        ],
        'achievement' => [
            'Achievement Name' => 'achievement_name',
            'Date' => 'achievements_date',
            'Description' => 'achievement_desc',
            'Students' => 'achievement_student'
        ],
        'member' => [
            'Member Name' => 'member_name',
            'Position' => 'position',
            'Department' => 'department',
            'Year' => 'year',
            'Division' => 'division',
            'Tenure Year' => 'tenure_year',
            'Member Contact Number' => 'contact_no'
        ]
    ];

    $columns = [];
    foreach ($selectedAttributes as $attribute) {
        $columns[] = $attributeKeys[$category][$attribute];
    }
    $selectColumns = implode(", ", $columns);

    $tableData = [];
    $query = "";
    $stmt = null;

    if ($category == 'event' || $category == 'achievement') {
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        if ($category == 'event') {
            $query = "SELECT $selectColumns FROM events WHERE committee_ID = ? AND event_date BETWEEN ? AND ?";
        } elseif ($category == 'achievement') {
            $query = "SELECT $selectColumns FROM achievements WHERE committee_ID = ? AND achievements_date BETWEEN ? AND ?";
        }
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
            exit;
        }
        $stmt->bind_param('iss', $committee_ID, $start_date, $end_date);
    } elseif ($category == 'member') {
        $tenure_year = $_POST['tenure_year'];
        $query = "SELECT $selectColumns FROM members WHERE committee_ID = ? AND tenure_year = ?";
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
            exit;
        }
        $stmt->bind_param('is', $committee_ID, $tenure_year);
    }

    $stmt->execute();
    $rows = $stmt->get_result();

    while ($row = $rows->fetch_assoc()) {
        $rowData = [];
        foreach ($columns as $column) {
            if ($column === 'photo') {
                // Convert the BLOB data to a base64-encoded string
                $photoData = base64_encode($row[$column]);
                $rowData[] = '<img src="data:image/jpeg;base64,' . $photoData . '" style="width:100px;height:auto;"/>'; // Adjust size as needed
            } else {
                $rowData[] = $row[$column];
            }
        }
        $tableData[] = $rowData;
    }

    if (isset($_POST['export_excel'])) {
        ob_start();
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename={$category}_data.xls");
        echo "<table border='1'>";
        echo "<tr>";
        foreach ($selectedAttributes as $attribute) {
            echo "<th>" . htmlspecialchars($attribute) . "</th>";
        }
        echo "</tr>";
        foreach ($tableData as $rowData) {
            echo "<tr>";
            foreach ($rowData as $data) {
                echo "<td>" . htmlspecialchars($data) . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        ob_end_flush();
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Event/Achievement/Member Form</title>
    <style>
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

.table-container {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch; /* For smooth scrolling on iOS */
    margin: 20px 0; /* Optional: adds some space around the table */
}

table {
    width: 95%;
    border-collapse: collapse;
}

th, td {
    padding: 10px;
    text-align: left;
    border: 1px solid #ddd; /* Optional: adds a border to table cells */
}

th {
    background-color: #f2f2f2; /* Optional: changes the background color of the table header */
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
                    <?php if (isset($_POST['l_id']) && $_POST['l_id'] == 1) { ?>
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
    <?php
    if (isset($_POST['f_id'])) {
      $f_id = $_POST['f_id'];
    }
    if (isset($_POST['dept_id'])) {
      $dept_id = $_POST['dept_id'];
    } ?>
    <a href="report_form.php?l_id=1&f_id=<?php echo $f_id ?>&dept_id=<?php echo $dept_id ?>"><button class="back-button" >Go Back</button></a>
    <header><h2>Report</h2></header>
    
    <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['attributes'])) {
    echo "<h1>Selected Attributes for " . ucfirst($category) . "</h1>";
    echo "<div class='table-container'>";
    echo "<table border='1'>";
    echo "<tr>";
    foreach ($selectedAttributes as $attribute) {
        echo "<th>" . htmlspecialchars($attribute) . "</th>";
    }
    echo "</tr>";
    foreach ($tableData as $rowData) {
        echo "<tr>";
        foreach ($rowData as $data) {
            echo "<td>" . htmlspecialchars($data) . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";
}
?>

<form method="post">
    <input type="hidden" name="category" value="<?= htmlspecialchars($category) ?>">
    <?php
    foreach ($selectedAttributes as $attribute) {
        echo '<input type="hidden" name="attributes[]" value="' . htmlspecialchars($attribute) . '">';
    }
    ?>
    <?php if ($category == 'event' || $category == 'achievement'): ?>
        <input type="hidden" name="start_date" value="<?= htmlspecialchars($start_date) ?>">
        <input type="hidden" name="end_date" value="<?= htmlspecialchars($end_date) ?>">
    <?php elseif ($category == 'member'): ?>
        <input type="hidden" name="tenure_year" value="<?= htmlspecialchars($tenure_year) ?>">
    <?php endif; ?>
    <input type="hidden" name="l_id" value="1">
    <input type="submit" name="export_excel" value="Export to Excel">
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
</body>
<script>
    function toggleMenu() {
      const menu = document.querySelector(".right");
      menu.classList.toggle("active");
    }
  </script>
</html>


