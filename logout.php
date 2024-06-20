<?php
session_start();
if (isset($_SESSION['name']) && isset($_SESSION['pass'])) {
    unset($_SESSION['name']);
    unset($_SESSION['pass']);
}

header("location: login.php");
exit();
?>