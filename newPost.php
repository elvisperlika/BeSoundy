<?php
    require_once("bootstrap.php");

    $templateParams["title"] = "NewPost";
    $templateParams["nav"] = false;
    $templateParams["newPost"] = true;
    $templateParams["content"] = "newPost_content.php";
    $templateParams["design"] = array("css/post.css");

    require("template/base.php");
?>