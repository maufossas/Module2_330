<?php
require "./guard.php";
$file = "/var/simplefileserver/$user/" . htmlspecialchars($_GET['name']);
switch(mime_content_type($file)) {
  case "text/plain":
    $filetype = "text";
    break;
  default:
    $filetype = "unknown";
}
?>
<!DOCTYPE html>
<html>
  <?php require "./header.php" ?>
  <?php if ($filetype == "text") { ?>
    <pre><?php echo file_get_contents($file) ?></pre>
  <?php } else { ?>
    <p>Sorry, we cannot open this type of file</p>
  <?php }
  ?>
</html>
