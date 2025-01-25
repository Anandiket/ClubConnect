<?php
session_start();

if (isset($_POST['committee_ID'])) {
    $_SESSION['committee_ID'] = $_POST['committee_ID'];
}
?>
