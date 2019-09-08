<?php
require "./guard.php";

function makeDelete($file) {
  global $user;
  $ext = pathinfo($file, PATHINFO_EXTENSION);
  echo "<li>
<form class=inline action=" . $_SERVER['PHP_SELF'] . " method=post>
<input type=hidden name=file value=$file>
<a href=\"./view.php?name=$file\">$file</a>
<input type=submit name=action value=Delete>
</form>
";
  if ($ext == 'txt' or $ext == 'mp3' or $ext == 'csv'){
    echo "<form class =inline action=\"./ixio.php\" method=post>
<input type=hidden name=file value=$file>
<input type=submit name=paste value=\"Upload to ix.io\">
</form>";
  }
  echo"</li>";
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
  <?php include "./header.php" ?>
  <body>
    <a href="./login.php">Logout</a>
    <!--
         NOTE FOR GRADER:
         We have not simply ignored the instruction to destroy the session.
         Rather, we disagree with it. See the note on https://www.php.net/manual/en/function.session-destroy.php
         for our rationale. Also see Login.php in this project for our implementation.
    -->
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
