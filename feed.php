<?php
    require_once("bootstrap.php");

    $templateParams["title"] = "Feed";
    $templateParams["nav"] = true;
    $templateParams["feed"] = true;
    $templateParams["content"] = "feed_content.php";
    $templateParams["script"] = array("js/comment.js", "js/post.js", "js/like.js");
    $templateParams["design"] = array("css/feed.css");

    $friends_post = $dbh->friendsPosts(loggedUser());

    for ($i = 0; $i < min(10, count($friends_post)); $i++) {
        $post = $friends_post[$i];
        $_COOKIE["post_array"][$i] = $post["idPost"];
    }

    require("template/base.php");