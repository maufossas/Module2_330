<?php
require "./guard.php";
header('Content-type: image/gif');
$file = "/var/simplefileserver/$user/" . htmlspecialchars($_GET['name']);
$image = new Imagick($file);
$image->setFormat("gif");
echo $image->getImagesBlob();
?>
