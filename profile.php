<?php 
    require_once("bootstrap.php");

    $templateParams["title"] = "Profile";
    $templateParams["nav"] = true;
    $templateParams["profile"] = true;
    $templateParams["content"] = "profile_content.php";
    
    // $templateParams["design"] = array("css/profile.css");

    require("template/base.php");
?>