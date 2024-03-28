<?php
    $post = $_GET["post"];
    $post_id = $post["idPost"];

    $comments = $dbh->getPostsComment($post_id);
    $user_id = loggedUser();
    $is_liked = $dbh -> alreadyLikedPost($user_id, $post_id);
    $profile_image_post = $dbh->getUserProfileImage($post['username']);
?>

<article class="post" id="<?php echo $post_id ?>">

    <div class="userInfo">
        <img src="data:image/jpeg;base64,<?php echo base64_encode($profile_image_post); ?>" />
        <a href="profile.php?user=<?php echo $post["username"]; ?>"><?php echo $post["username"]; ?></a>
    </div>

    <div class="infoPost">
        <p> <?php echo $post["time"]; ?> </p>
        <p> <?php echo $post["text"]; ?> </p>
    </div>

    <div class="body">
        <img src="data:image/jpeg;base64,<?php echo base64_encode($post["image"]); ?>" />
    </div>

    <div class="like-commenti">
        <a class="like" href="api/like.php?idPost=<?php echo $post['idPost']; ?>">Like: <?php echo $post['nLike']; ?></a>
        <a class="comment" href="javascript:void(0);" id="toggle-comments">Commenti: <?php echo $post['nComment']; ?></a>    
    </div>

    <div class="comments-section" style="display: block;">
        <?php foreach ($comments as $comment) : ?>
            <div class="comment">
                <div class="userInfo">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($comment['imgProfile']); ?>" />                
                    <a href="profile.php?user=<?php echo $comment["user"]; ?>"><?php echo $comment["user"]; ?></a>
                </div>
                <p> <?php echo $comment["time"]; ?> </p>
                <p><?php echo $comment['text']; ?></p>
                <a class="like" href="api/like.php?idPost=<?php echo $post['idPost']; ?>">Like: <?php echo $post['nLike']; ?></a>
                <a class="comment" href="javascript:void(0);" id="toggle-comments">Rispondi!</a>    
            </div>
        <?php endforeach; ?>
    </div>
</article>