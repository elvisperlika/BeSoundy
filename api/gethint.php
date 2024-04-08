<?php
    require("api.php");

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    $q = $_GET["str"];
    $result = $dbh->getUsers($q);
    foreach($result as $user){
        echo "<li>";
            echo "<a href='profile.php?user=".$user["username"]." '>".$user["username"]."</a>";
            if($user["username"] != $_SESSION["username"]){
                if($dbh->isFollowing($_SESSION["username"], $user["username"])){
                    echo "<a href='#' class='followButton' data-user=".$user["username"].">Unfollow</a>";
                }else {
                    echo "<a href='#' class='followButton' data-user=".$user["username"].">Follow</a>";
                }
            }
        echo "</li>";
    }
    
?>