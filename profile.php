<?php 
    require_once("bootstrap.php");

    $templateParams["title"] = "Profile";
    $templateParams["nav"] = true;
    $templateParams["profile"] = true;
    $templateParams["content"] = "profile_content.php";
    
    // $templateParams["design"] = array("css/profile.css");
    if($_GET["request"] == "unfollow"){
        $dbh->removeFollowing($_SESSION["username"], $_GET["user"]);
    } elseif($_GET["request"] == "follow"){
        $dbh->addFollowing($_SESSION["username"], $_GET["user"]);
    }

    require("template/base.php");
?>