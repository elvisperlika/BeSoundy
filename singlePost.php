<?php
    require_once("bootstrap.php");

    $templateParams["title"] = "Post";
    $templateParams["nav"] = true;
    $templateParams["content"] = "single_post_content.php";
    $templateParams["script"] = array("js/comment.js");
    $templateParams["design"] = array("css/feed.css");
    $post = $dbh->getPostById($_GET["post"]);

    require("template/base.php");
?>