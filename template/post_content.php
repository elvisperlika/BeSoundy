<?php
    $post = $_GET["post"];
    $post_id = $post["idPost"];

    $comments = $dbh->getPostedComment($post_id);
    $user_id = loggedUser();
    $is_likedP = $dbh -> alreadyLikedPost($user_id, $post_id);
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
        <?php if ($is_likedP) : ?>
            <!-- Se l'utente ha già messo like, visualizza il pulsante unlike -->
            <a class="unlike-button" href="api/unlike.php?type=post&id=<?php echo $post['idPost']; ?>">Like: <?php echo $post['nLike']; ?></a>
        <?php else : ?>
            <!-- Altrimenti, visualizza il pulsante like -->
            <a class="like-button" href="api/like.php?type=post&id=<?php echo $post['idPost']; ?>">Like: <?php echo $post['nLike']; ?></a>
        <?php endif; ?>

        <a class="comment-button" href="#" data-post-id="<?php echo $post_id; ?>">Commenti: <?php echo $post['nComment']; ?></a>    
    </div>

<div  id="commentSection-<?php echo $post_id; ?>" class="comments-section">
    <?php if (count($comments) > 0) : ?>
        <?php foreach ($comments as $comment) : ?>
            <div class="comment">
                <div class="userInfo">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($comment['imgProfile']); ?>" />                
                    <a href="profile.php?user=<?php echo $comment["user"]; ?>"><?php echo $comment["user"]; ?></a>
                </div>
                <p> <?php echo $comment["time"]; ?> </p>
                <p><?php echo $comment['text']; ?></p>
                
                <?php     $is_likedC = $dbh -> alreadyLikedComment($user_id, $comment); ?>

                <?php if ($is_likedC) : ?>
                    <!-- Se l'utente ha già messo like, visualizza il pulsante unlike -->
                    <a class="unlike-button" href="api/unlike.php?type=comment&id=<?php echo $comment['idComment']; ?>">Like: <?php echo $comment['nLike']; ?></a>
                <?php else : ?>
                    <!-- Altrimenti, visualizza il pulsante like -->
                    <a class="like-button" href="api/like.php?type=comment&id=<?php echo $comment['idComment']; ?>">Like: <?php echo $comment['nLike']; ?></a>
                <?php endif; ?>

                <a class="respond-button" href="#" data-comment-id="<?php echo $comment['idComment']; ?>">Rispondi</a> 

                <!-- Aggiungi il form per le risposte sotto ciascun commento -->
                <form id="replyForm-<?php echo $comment['idComment']; ?>" class="reply-form" action="api/create_comment.php?idPost=<?php echo $post_id; ?>&parent_comment=<?php echo $comment['idComment']; ?>" method="POST" style="display: none;">
                    <textarea name="write-comment" placeholder="Scrivi una risposta..." rows="1"></textarea>
                    <input type="submit" value="Invia">
                </form>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>Non ci sono commenti.</p>
    <?php endif; ?>

    <form action="api/create_comment.php?idPost=<?php echo $post_id ?>&comment_author=<?php echo $post["username"]?>" method="POST">
        <img src="data:image/jpeg;base64,<?php echo base64_encode($profile_image_post); ?>" />                
        <label for="write-comment-<?php echo $post_id ?>" hidden>Scrivi un commento</label>
        <textarea id="write-comment-<?php echo $post_id ?>" name="write-comment" placeholder="Scrivi un commento..." rows="1"></textarea>
        <input type="submit" value="Invia">
    </form>
</div>
</article>