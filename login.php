<?php
$users = file_get_contents("/home/mauricio.fossas/users/users.txt");
$userArray = preg_split("/\n/", $users);
$access = False;
foreach($userArray as $user){
  if ($user == $_POST["user"]){
    $access = True;
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
