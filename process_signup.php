<?php
/*
// Establishing connection to MySQL database
$servername = "localhost";
$username = "root"; // Default username for MySQL is root
$password = ""; // Default password is blank
$database = "committee"; // Change this to your database name

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieving form data
$username = $_POST['uname'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$email = $_POST["email"];

// Check if password and confirm password match
if ($password !== $confirm_password) {
    die("Passwords do not match. Please enter the same password in both fields.");
}

// Check if username already exists
$stmt_check = $conn->prepare("SELECT * FROM users WHERE user_name = ?");
$stmt_check->bind_param("s", $username);
$stmt_check->execute();
$result = $stmt_check->get_result();

if ($result->num_rows > 0) {
    die("Username already exists. Please choose a different username.");
}

// Validate password strength
if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $password)) {
    die("Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.");
}

// Hashing the password
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// Prepare SQL statement to insert data
$stmt_insert = $conn->prepare("INSERT INTO users (user_name, password) VALUES (?, ?)");
$stmt_insert->bind_param("ss", $username, $password);

// Execute the statement
if ($stmt_insert->execute() === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt_insert->error;
}

header("Location: hptrial.php");
// Close statement and connection
*/

// Establishing connection to MySQL database
$servername = "localhost";
$username = "root"; // Default username for MySQL is root
$password = ""; // Default password is blank
$database = "committee"; // Change this to your database name

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
   header("Location: abc.php?email=$hashed_email&error=Connection failed! Try Again");
   exit();
}

// Retrieving form data
//$username = $_POST['uname'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
/*
if (isset($_GET['email'])) {
    $email = ($_GET['email']); // Sanitize the input
} else {
    // Handle the case when the email parameter is not provided in the URL
    exit("Email parameter is missing from the URL.");
}

$email = $_GET['email'] ?? null;
if ($email === null) {
    // Handle the case when the email parameter is not provided in the URL
    exit("Email parameter is missing from the URL.");
}
*/
$email = $_POST["email"];
$hashed_email = urlencode($email);


// Check if password and confirm password match
if ($password !== $confirm_password) {
   header("Location: abc.php?email=$hashed_email&error=Passwords do not match. Please enter the same password in both fields.");
   exit();
}

// Check if email already exists
// $stmt_check = $conn->prepare("SELECT * FROM users WHERE email = ?");
// $stmt_check->bind_param("s", $email);
// $stmt_check->execute();
// $result = $stmt_check->get_result();

// if ($result->num_rows > 0) {
//     header("Location: abc.php?email=$hashed_email&error=User already exists.");
//     exit();
// }

// Validate password strength
if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $password)) {
    header("Location: abc.php?email=$hashed_email&error=Password must be at least 8 characters long and contain at least 1 uppercase letter, 1 lowercase letter, 1 number, and 1 special character.");
    exit();
}

// Hashing the password
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// Prepare SQL statement to insert data
$stmt_insert = $conn->prepare("UPDATE users SET password = ? WHERE email= '$email'");
// nested query where email = (SELECT email FROM convenor,committees WHERE convenor.committee_ID = committees.committee_ID AND committees.committee_ID = $committee_id) 
$stmt_insert->bind_param("s", $password);

// Execute the statement
if ($stmt_insert->execute() === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt_insert->error;
}

header("Location: convenorloginpage.php?l_id=1");
// Close statement and connection

?>

