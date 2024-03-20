<?php
    require_once("bootstrap.php");

    $templateParams["title"] = "Login";
    $templateParams["nav"] = false;
    $templateParams["signUp"] = true;
    $templateParams["content"] = "signUp_content.php";
    $templateParams["design"] = array("css/signUp.css", "css/style.css");
    
    require("template/base.php");
?>