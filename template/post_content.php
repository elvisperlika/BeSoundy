<?php
    $post = $_GET["post"];
    $post_id = $post["idPost"];

    $comments = $dbh->postsComment($post_id);
    $user_id = loggedUser();
    $is_liked = $dbh->likedPost($post_id, $user_id);
?>

<article class="post" id="<?php echo $post_id ?>">
    <div class="user-info">
        <p> user: <?php echo $post["username"]; ?> </p>
        <p> descr: <?php echo $post["text"]; ?> </p>
    </div>
    <div class="body">
        <?php echo $post["image"]; ?>
    </div>
    <div class="like-commenti">
        <p> ora: <?php echo $post["time"]; ?> </p>
        <p> like: <?php echo $post["nLike"]; ?> </p>
        <p> commenti: <?php echo $post["nComment"]; ?> </p>
    </div>
</article>
