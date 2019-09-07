<?php
require "./guard.php";
$filename = htmlspecialchars($_POST['file']);
$file = "/var/simplefileserver/$user/$filename";
$ch = curl_init('http://ix.io');
$post = ['f:1' => file_get_contents($file)];
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
$res = curl_exec($ch);
curl_close($ch);
header("Location: $res");
?>
