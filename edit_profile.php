<?php 
    require_once("bootstrap.php");

    $templateParams["title"] = "EditProfile";
    $templateParams["nav"] = false;
    $templateParams["EditProfile"] = true;
    $templateParams["content"] = "edit_profile_content.php";
    $templateParams["design"] = array("css/edit_profile.css");

    require("template/base.php");
?>