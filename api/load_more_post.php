<?php
require("api.php");

if (isset($_GET['lastPostId'])) {
    $lastPostId = $_GET['lastPostId'];
    $morePosts = $dbh->getMorePosts($lastPostId);
    
    foreach ($morePosts as $post) {
        include "post_content.php";
    }
}
?>
