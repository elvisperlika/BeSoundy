<?php 
    require_once("bootstrap.php");

    $templateParams["title"] = "Profile";
    $templateParams["nav"] = true;
    $templateParams["profile"] = true;
    $templateParams["content"] = "template/profile_content.php";
    $templateParams["script"] = array("js/profile.js", "js/comment.js", "js/post.js");
    $templateParams["design"] = array("css/profile.css");

    require("template/base.php");