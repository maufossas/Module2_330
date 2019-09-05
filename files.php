<?php
session_start();
if (!$_SESSION['loggedIn']) {
  header("Location: ./login.php");
}
$user = $_SESSION['user'];
// Get a list of files for the user
// Slice off . and ..
$files = array_slice(scandir("/home/mauricio.fossas/users/$user"), 2);
?>
<!DOCTYPE html>
<html>
  <body>
    <ul>
      <?php
      foreach($files as $file) {
        echo "<li>$file</li>";
      }
      ?>
    </ul>
  </body>
</html>
