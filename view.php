<?php
require "./guard.php";
$filename = htmlspecialchars($_GET['name']);
$file = "/var/simplefileserver/$user/$filename";
// We display different file types differently. Find out the
// type and make a decision here
switch(mime_content_type($file)) {
  case "text/plain":
    $filetype = "text";
    break;
  case "image/gif":
    $filetype = "image";
    break;
  default:
    $filetype = "unknown";
}
?>
<!DOCTYPE html>
<html>
  <?php require "./header.php" ?>
  <?php if ($filetype == "text") { ?>
    <pre><?php echo file_get_contents($file); ?></pre>
  <?php } elseif($filetype == "image") { ?>
      <img src="image.php?name=<?php echo $filename ?>" />
  <?php } else { ?>
    <p>Sorry, we cannot open this type of file</p>
  <?php }
  ?>
</html>
