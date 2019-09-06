<?php
session_start();
if (!$_SESSION['loggedIn']) {
  header("Location: ./login.php");
}
global $user;
$user = $_SESSION['user'];
?>
