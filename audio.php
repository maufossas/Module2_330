<?php
require "./guard.php";
header('Content-type: audio/mpeg');
$file = "/var/simplefileserver/$user/" . htmlspecialchars($_GET['name']);
echo file_get_contents($file);
?>
