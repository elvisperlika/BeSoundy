<?php
    require_once("bootstrap.php");

    $templateParams["title"] = "Feed";
    $templateParams["nav"] = true;
    $templateParams["feed"] = true;
    $template["script"] = "comment.js";
    $templateParams["content"] = "feed_content.php";
    $templateParams["design"] = array("css/feed.css");
    $template["post"] = $dbh->friendsPosts(loggedUser());

    require("template/base.php");
?>