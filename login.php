<?php
// Cleanup session variables
session_start();
$_SESSION['loggedIn'] = false;
unset($_SESSION['user']);
$users = file_get_contents("/var/simplefileserver/users.txt");
$userArray = preg_split("/\n/", $users);
if (!empty($_POST)) {
  foreach($userArray as $user){
    if ($user == htmlspecialchars($_POST["user"]) and $user != ""){
      // We've found a user
      $_SESSION['loggedIn'] = true;
      $_SESSION['user'] = $user;
      header("Location: ./files.php");
      break;
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <?php include "./header.php" ?>
  <body>
    <form action=<?php echo $_SERVER["PHP_SELF"];?> method="POST">
      <label>Enter username: <input type="text" name="user"> </label>
      <input type="submit">
    </form>
  </body>
</html>
