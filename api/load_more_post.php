<?php
require_once("bootstrap.php");

if (isset($_GET['lastPostId'])) {
    $lastPostId = $_GET['lastPostId'];
    $morePosts = $dbh->getMorePosts($lastPostId);
    
    // Output HTML dei post aggiuntivi
    foreach ($morePosts as $post) {
        include "post_content.php";
    }
}
?>
