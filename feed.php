<?php
    require_once("bootstrap.php");

    $templateParams["title"] = "Feed";
    $templateParams["nav"] = true;
    $templateParams["feed"] = true;
    $templateParams["content"] = "feed_content.php";
    $templateParams["script"] = array("js/comment.js");
    $templateParams["design"] = array("css/feed.css");
    $template["post"] = $dbh->friendsPosts(loggedUser());

    require("template/base.php");
?>