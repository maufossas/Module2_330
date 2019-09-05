<?php
session_start();
if (!$_SESSION['loggedIn']) {
  header("Location: ./login.php");
}
$user = $_SESSION['user'];

if(!empty($_POST)) {
  $filename = basename($_FILES["file"]["name"]);
  $destination = "/var/simplefileserver/$user/$filename";
  $file_uploaded = move_uploaded_file($_FILES["file"]["tmp_name"], $destination); 
} 

// Get a list of files for the user
// Slice off . and ..
$files = array_slice(scandir("/var/simplefileserver/$user"), 2);
?>
<!DOCTYPE html>
<html>
  <body>
    <form action=<?php echo $_SERVER["PHP_SELF"];?> method="POST" enctype="multipart/form-data">
      <input type="file" name="file">
      <input type="submit" name="upload">
    </form>
    <ul>
      <?php
      foreach($files as $file) {
        echo "<li><a href=\"./view.php?user=$user&name=$file\">$file</a></li>";
      }
      ?>
    </ul>
  </body>
</html>
