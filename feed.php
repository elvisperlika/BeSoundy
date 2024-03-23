<?php
    require_once("bootstrap.php");

    $templateParams["title"] = "Feed";
    $templateParams["nav"] = true;
    $templateParams["feed"] = true;
    $templateParams["content"] = "feed_content.php";
    $template["post"] = $dbh->friendsPosts(loggedUser());
    //$template["script"] = "post.js";

    require("template/base.php");
?>