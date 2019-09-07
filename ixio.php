<?php
// As usual, prevent unauthenticated users from accessing
require "./guard.php";
// Get the filename
$filename = htmlspecialchars($_POST['file']);
$file = "/var/simplefileserver/$user/$filename";
// Open a curl session
$ch = curl_init('http://ix.io');
$post = ['f:1' => file_get_contents($file)];
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
// Upload the file
$res = curl_exec($ch);
curl_close($ch);
// Redirect to the resultant ix.io address
header("Location: $res");
?>
