<?php 

function registerLoggedUser($user){
    $_SESSION["username"] = $user["username"];
    $_SESSION["name"] = $user["name"];
    $_SESSION["email"] = $user["email"];
}

?>