<?php 
session_start();
include "db_connection.php";

if(isset($_POST['uname']) && isset($_POST['pass'])) {

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

}

$uname = validate($_POST['uname']);
$pass = validate($_POST['pass']);

if(empty($uname)) {
    header ("Location: convenorloginpage.php?l_id=2&error=User Name is required");
    exit();
}
else if(empty($pass)) {
    header ("Location: convenorloginpage.php?l_id=2&error=Password is required");
    exit();
}

$sql = "SELECT * FROM superadmin WHERE user_name='$uname' AND pass='$pass'";

$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    if($row['user_name'] === $uname && $row['pass'] === $pass) {
        echo "LOGGED IN ";
        $_SESSION['user_name'] = $row['user_name'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['id'] = $row['id'];
        header("Location: addnew.php?l_id=2&dept_id=1");
        exit();
    }
    else{
        header("Location: convenorloginpage.php?l_id=2&error=Incorrect Username or Password");
        exit();
    }
}

else { 
    header("Location: convenorloginpage.php?l_id=2&error=Incorrect Username or Password");
    exit();
}