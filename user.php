<?php
    $users = file_get_contents("/home/mauricio.fossas/users/users.txt");
    $userArray = preg_split("/\n/", $users);
    $access = False;
    foreach($userArray as $user){
        if ($user == $_POST["user"]){
            $access= True;
        }
    }
?>