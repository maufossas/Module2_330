<?php
// Cleanup session variables
session_start();
$_SESSION['loggedIn'] = false;
unset($_SESSION['user']);
$users = file_get_contents("/var/simplefileserver/users.txt");
$userArray = preg_split("/\n/", $users);
if (!empty($_POST)) {
  foreach($userArray as $user){
    if ($user == htmlspecialchars($_POST["user"])){
      $_SESSION['loggedIn'] = true;
      $_SESSION['user'] = $user;
      header("Location: ./files.php");
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>File_sharing</title>
    <link href="StyleSheetModule2.css" rel="stylesheet" type="text/css"/>
  </head>
  <body>
    <form action=<?php echo $_SERVER["PHP_SELF"];?> method="POST">
      Enter username: <input type="text", name="user">
      <input type="submit">
    </form>
  </body>
</html>
