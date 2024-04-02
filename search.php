<?php 
    require_once("bootstrap.php");

    $templateParams["title"] = "Search";
    $templateParams["nav"] = true;
    $templateParams["search"] = true;
    $templateParams["content"] = "search_content.php";
    $templateParams["script"] = array("js/search.js");
    
    // $templateParams["design"] = array("css/search.css");

    require("template/base.php");
?>