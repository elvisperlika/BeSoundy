<?php
    require_once("bootstrap.php");

    $templateParams["title"] = "Login";
    $templateParams["nav"] = false;
    $templateParams["login"] = true;
    $templateParams["content"] = "login_content.php";
    $templateParams["design"] = array("css/logIn.css", "css/style.css");
    
    require("template/base.php");
?>