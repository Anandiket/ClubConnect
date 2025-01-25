<?php
// Start session
session_start();
unset($_SESSION["id"]);
unset($_SESSION["user_name"]);
session_destroy();
header("location: convenorloginpage.php?l_id=2");
exit;
?>