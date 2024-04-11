<?php
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
            <!-- Se l'utente ha già messo like, visualizza il pulsante like -->
            <button class="like-button liked" data-post-id="<?php echo $post_id; ?>">Like: <?php echo $post['nLike']; ?></button>
        <?php else : ?>
            <!-- Altrimenti, visualizza il pulsante like -->
            <button class="like-button" data-post-id="<?php echo $post_id; ?>">Like: <?php echo $post['nLike']; ?></button>
        <?php endif; ?>

        <a class="comment-button" href="#" data-post-id="<?php echo $post_id; ?>">Commenti: <?php echo $post['nComment']; ?></a>    
    </div>    
    
    <div  id="commentSection-<?php echo $post_id; ?>" class="comments-section">
    <?php if (count($comments) > 0) : ?>
        <?php foreach ($comments as $comment) : ?>

            <?php     
                $is_likedC = $dbh -> alreadyLikedComment($user_id, $comment); 
                echo $is_likedC;
            ?>

            <div class="comment">
                <div class="userInfo">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($comment['imgProfile']); ?>" />                
                    <a href="profile.php?user=<?php echo $comment["user"]; ?>"><?php echo $comment["user"]; ?></a>
                </div>
                <p> <?php echo $comment["time"]; ?> </p>
                <p><?php echo $comment['text']; ?></p>
                
                <?php if ($is_likedC) : ?>
                    <!-- Se l'utente ha già messo like, visualizza il pulsante unlike -->
                    <button class="unlike-comment-button liked" data-comment-id="<?php echo $comment['idComment']; ?>">Like: <?php echo $comment['nLike']; ?></button>
                <?php else : ?>
                    <!-- Altrimenti, visualizza il pulsante like -->
                    <button class="like-comment-button" data-comment-id="<?php echo $comment['idComment']; ?>">Like: <?php echo $comment['nLike']; ?></button>
                    <?php endif; ?>

                <a class="respond-button" href="#" data-comment-id="<?php echo $comment['idComment']; ?>">Rispondi</a> 

                <textarea id="replyForm-<?php echo $comment['idComment']; ?>" placeholder="Inserisci una risposta..." rows="3"></textarea>
                <button class="reply-form" data-post-id="<?php echo $comment['idComment']; ?>">Invia</button>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>Non ci sono commenti.</p>
    <?php endif; ?>

    <textarea id="comment-text-<?php echo $post_id; ?>" placeholder="Inserisci il tuo commento..." rows="3"></textarea>
    <button class="add-comment-button" data-post-id="<?php echo $post_id; ?>">Invia</button>
</div>
</article>