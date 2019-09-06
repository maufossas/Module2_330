<?php
session_start();
if (!$_SESSION['loggedIn']) {
  header("Location: ./login.php");
}
global $user;
$user = $_SESSION['user'];

function makeDelete($file) {
  global $user;
  echo "<li>
<form action=" . $_SERVER['PHP_SELF'] . " method=post>
<input type=hidden name=file value=$file>
<a href=\"./view.php?user=$user&amp;name=$file\">$file</a>
<input type=submit name=action value=Delete>
</form>
</li>";
}

$file_uploaded = true;

if(!empty($_POST)) {
  if ($_POST['action'] == "Upload") {
    $filename = basename($_FILES["file"]["name"]);
    $destination = "/var/simplefileserver/$user/$filename";
    $file_uploaded = move_uploaded_file($_FILES["file"]["tmp_name"], $destination);
  } elseif($_POST['action'] == "Delete") {
    $filename = $_POST["file"];
    unlink("/var/simplefileserver/$user/$filename");
  }
}

// Get a list of files for the user
// Slice off . and ..
$files = array_slice(scandir("/var/simplefileserver/$user"), 2);
?>
<!DOCTYPE html>
<html lang="en">
  <body>
    <form action=<?php echo $_SERVER["PHP_SELF"];?> method="POST" enctype="multipart/form-data">
      <input type="file" name="file">
      <input type="submit" name="action" value="Upload">
    </form>
    <?php
    if (!$file_uploaded) {
      echo "<div class=\"error\">Failed to upload file</div>";
    }
    ?>
    <ul>
      <?php
      foreach($files as $file) {
        makeDelete($file);
      }
      ?>
    </ul>
  </body>
</html>
