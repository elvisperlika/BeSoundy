<?php 
    require_once("bootstrap.php");
    
    $templateParams["title"] = "alerts";
    $templateParams["nav"] = true;
    $templateParams["content"] = "alerts_content.php";
    $templateParams["script"] = array("js/alerts.js");
    $templateParams["design"] = array("css/alerts.css");

    require("template/base.php");
?>
