<?php
    $post_id = $post["idPost"];
    $comments = $dbh->getPostedComment($post_id);
    $user_id = loggedUser();
    $is_likedP = $dbh -> alreadyLikedPost($user_id, $post_id);
    $profile_image_post = $dbh->getUserProfileImage($post['username']);
?>

<article class="post" data-post-id="<?php echo $post_id ?>">

    <div class="userInfo">
        <img src="data:image/jpeg;base64,<?php echo base64_encode($profile_image_post); ?>" />
        <a href="profile.php?user=<?php echo $post["username"]; ?>"><?php echo $post["username"]; ?></a>
    </div>

    <div class="infoPost">
        <p><?php echo $post["time"]; ?></p>
        <p><?php echo $post["text"]; ?></p>
    </div>

    <div class="body">
        <img src="data:image/jpeg;base64,<?php echo base64_encode($post["image"]); ?>" />
    </div>

    <div class="like-commenti">
    <?php if ($is_likedP) : ?>
        <button class="unlike-button liked" data-post-id="<?php echo $post_id; ?>">Like: <?php echo $post['nLike']; ?></button>
    <?php else : ?>
        <button class="like-button" data-post-id="<?php echo $post_id; ?>">Like: <?php echo $post['nLike']; ?></button>
    <?php endif; ?>
    <button class="comment-button" data-post-id="<?php echo $post_id; ?>">comments <?php echo $post['nComment']; ?></button>
    <?php if ($post["username"] == $_SESSION["username"] && $templateParams["title"] == "Profile") : ?>
        <a class='deleteButton' href='#' data-post-id='<?php echo $post_id; ?>'>delete</a>
    <?php endif; ?>
</div>
    
    <div  id="commentSection-<?php echo $post_id; ?>" class="comments-section">
    <?php if (count($comments) > 0) : ?>
        <?php foreach ($comments as $comment) : ?>

            <?php     
                $is_likedC = $dbh -> alreadyLikedComment($user_id, $comment); 
            ?>

            <div class="comment">
                <div class="userInfo">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($comment['imgProfile']); ?>" />                
                    <a href="profile.php?user=<?php echo $comment["user"]; ?>"><?php echo $comment["user"]; ?></a>
                </div>
                <p><?php echo $comment["time"]; ?></p>
                <p><?php echo $comment['text']; ?></p>
                
                <?php $is_likedC = $dbh -> alreadyLikedComment($user_id, $comment); ?>

                <?php if ($is_likedC) : ?>
                    <!-- Se l'utente ha già messo like, visualizza il pulsante unlike -->
                    <button class="unlike-comment-button liked" data-comment-id="<?php echo $comment['idComment']; ?>">Like: <?php echo $comment['nLike']; ?></button>
                <?php else : ?>
                    <!-- Altrimenti, visualizza il pulsante like -->
                    <button class="like-comment-button" data-comment-id="<?php echo $comment['idComment']; ?>">Like: <?php echo $comment['nLike']; ?></button>
                    <?php endif; ?>
                    <button class="respond-button" data-comment-id="<?php echo $comment['idComment']; ?>" data-username="<?php echo $comment['user']; ?>">Rispondi </button>
                <div id="reply-<?php echo $comment['idComment']; ?>" class="respond-section">
                    <textarea id="replyForm-<?php echo $comment['idComment']; ?>" placeholder="answer it" rows="3"></textarea>
                    <button class="reply-form-button" data-post-id="<?php echo $post_id; ?>" data-comment-id="<?php echo $comment['idComment']; ?>">Invia</button>
                
                        <!-- Mostra le risposte a questo commento -->
                    <?php
                        $replies = $dbh->getReplies($comment['idComment']); // Ottieni le risposte per questo commento
                        foreach ($replies as $reply) :
                    ?>
                    <div class="reply">
                        <div class="userInfo">
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($comment['imgProfile']); ?>" />
                            <a href="profile.php?user=<?php echo $comment["user"]; ?>"><?php echo $comment["user"]; ?></a>
                        </div>
                        <p><?php echo $reply["reply_time"]; ?></p>
                        <p><?php echo $reply['reply_text']; ?></p>
                        
                    </div>
                    <?php endforeach; ?>
                </div>

            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>no comments.</p>
    <?php endif; ?>
    </div>

    <div id="commentArea">
        <textarea id="comment-text-<?php echo $post_id; ?>" placeholder="write a new commnet here..." rows="3"></textarea>
        <button class="add-comment-button" data-post-id="<?php echo $post_id; ?>">send</button>
    </div>

</article>
