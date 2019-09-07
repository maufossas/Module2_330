<?php
require "./guard.php";
// Make sure the response is a gif
header('Content-type: image/gif');
$file = "/var/simplefileserver/$user/" . htmlspecialchars($_GET['name']);
// Create an Imagick image
$image = new Imagick($file);
$image->setFormat("gif");
// Send the gif frames
echo $image->getImagesBlob();
?>
