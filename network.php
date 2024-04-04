<?php 
    require_once("bootstrap.php");
    
    $_SESSION['sessionUser'] = $_GET["user"];
    $_SESSION['side'] = $_GET["side"];

    $templateParams["title"] = $_GET["side"];
    $templateParams["nav"] = true;
    $templateParams["content"] = "netowork_content.php";

    require("template/base.php");
?>
