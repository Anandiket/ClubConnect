<?php
// Start session
session_start();
unset($_SESSION["id"]);
unset($_SESSION["user_name"]);
unset( $_SESSION['committee_ID']);
session_destroy();
header("location: convenorloginpage.php?l_id=1");
exit;
?>
