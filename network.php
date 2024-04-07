<?php 
    require_once("bootstrap.php");
    
    $_SESSION['userNetwork'] = $_GET["user"];
    $_SESSION['side'] = $_GET["side"];

    $templateParams["title"] = $_GET["side"];
    $templateParams["nav"] = true;
    $templateParams["content"] = "network_content.php";
    $templateParams["script"] = array("js/network.js");

    require("template/base.php");
?>
