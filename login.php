<?php
session_start();
$users = file_get_contents("/home/mauricio.fossas/users/users.txt");
//$users = "dane";
$userArray = preg_split("/\n/", $users);
$_SESSION['loggedIn'] = false;
if (!empty($_POST)) {
  foreach($userArray as $user){
    if ($user == htmlspecialchars($_POST["user"])){
      $_SESSION['loggedIn'] = true;
      header("Location: /files.php");
    }
  }
}
?>
<!DOCTYPE html>
<html lang='en'>
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
