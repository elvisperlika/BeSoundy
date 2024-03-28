<?php
    $post = $_GET["post"];
    $post_id = $post["idPost"];

    $comments = $dbh->getPostedComment($post_id);
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
        <a class="comment-button" href="javascript:void(0);" id="toggle-comments" onclick="toggleComments()">Commenti: <?php echo $post['nComment']; ?></a>    
    </div>

<div class="comments-section" style="display: block;">
    <?php if (count($comments) > 0) : ?>
        <?php foreach ($comments as $comment) : ?>
            <div class="comment">
                <div class="userInfo">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($comment['imgProfile']); ?>" />                
                    <a href="profile.php?user=<?php echo $comment["user"]; ?>"><?php echo $comment["user"]; ?></a>
                </div>
                <p> <?php echo $comment["time"]; ?> </p>
                <p><?php echo $comment['text']; ?></p>
                <a class="like" href="api/like.php?idPost=<?php echo $post['idPost']; ?>">Like: <?php echo $post['nLike']; ?></a>
                <a class="comment-button" href="javascript:void(0);" id="toggle-comments">Rispondi!</a>    
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>Non ci sono commenti.</p>
    <?php endif; ?>

    <form action="api/create_comment.php?idPost=<?php echo $post_id ?>&comment_author=<?php echo $post["username"]?>" method="POST">
        <label for="write-comment-<?php echo $post_id ?>" hidden>Scrivi un post</label>
        <textarea id="write-comment-<?php echo $post_id ?>" name="write-comment" placeholder="Scrivi un commento..." rows="1"></textarea>
        <input type="submit" value="Invia">
    </form>
</div>
</article>