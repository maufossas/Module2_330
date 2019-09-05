<?php
session_start();
if (!$_SESSION['loggedIn']) {
  header("Location: /login.php");
}
?>
<!DOCTYPE html>
<html>
  <body>
      <div>Files go here</div>
  </body>
</html>
