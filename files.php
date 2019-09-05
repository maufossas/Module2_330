<?php
session_start();
if (!$_SESSION['loggedIn']) {
  header("Location: ./login.php");
}
$user = $_SESSION['user'];

if(!empty($_POST)) {
  $filename = basename($_FILES["file"]["name"]);
  $file_uploaded = move_uploaded_file($filename, "/home/mauricio.fossas/users/$user/$filename");
}

// Get a list of files for the user
// Slice off . and ..
$files = array_slice(scandir("/home/mauricio.fossas/users/$user"), 2);
?>
<!DOCTYPE html>
<html>
  <body>
    <form action=<?php echo $_SERVER["PHP_SELF"];?> method="POST">
      <input type="file" name="file">
      <input type="submit">
    </form>
    <?php
    if (!$file_uploaded) {
      echo "Failed to upload file.";
    }
    ?>
    <ul>
      <?php
      foreach($files as $file) {
        echo "<li><a href=\"./view.php?user=$user&name=$file\">$file</a></li>";
      }
      ?>
    </ul>
  </body>
</html>
