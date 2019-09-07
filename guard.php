<?php
// Make sure the user is logged in, and then set the global user
session_start();
if (!$_SESSION['loggedIn']) {
  header("Location: ./login.php");
}
global $user;
$user = $_SESSION['user'];
?>
