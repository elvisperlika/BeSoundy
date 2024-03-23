<?php
    $post = $_GET["post"];
    $post_id = $post["idPost"];

    $comments = $dbh->postsComment($post_id);
    $user_id = loggedUser();
    $is_liked = $dbh->isPostLiked($user_id, $post_id);
    $profile_image = $dbh->getUserProfileImage($post['username']);
?>

<article class="post" id="<?php echo $post_id ?>">
    <div class="user-info">
        <?php echo "<img src='" . $profile_image . "' alt='Profile Image'>"; ?>
        <p> user: <?php echo $post["username"]; ?> </p>
        <p> descr: <?php echo $post["text"]; ?> </p>
    </div>
    <div class="body">
        <img src="data:image/jpeg;base64,<?php echo base64_encode($post["image"]); ?>" />
    </div>
    <div class="like-commenti">
        <p> ora: <?php echo $post["time"]; ?> </p>
        <p> like: <?php echo $post["nLike"]; ?> </p>
        <p> commenti: <?php echo $post["nComment"]; ?> </p>
    </div>
</article>
