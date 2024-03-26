<?php
    $post = $_GET["post"];
    $post_id = $post["idPost"];

    $comments = $dbh->getPostsComment($post_id);
    $user_id = loggedUser();
    $is_liked = $dbh -> alreadyLikedPost($user_id, $post_id);
    $profile_image = $dbh->getUserProfileImage($post['username']);
?>

<article class="post" id="<?php echo $post_id ?>">

    <div class="userInfo">
        <img src="data:image/jpeg;base64,<?php echo base64_encode($profile_image); ?>" />
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
        <a class="like" href="like.php?post_id=<?php echo $post['idPost']; ?>">Like: <?php echo $post['nLike']; ?></a>
        <a class="comment" nComment="<?php echo $post['nComment']; ?>" href="#">Commenti: <?php echo $post['nComment']; ?></a>
    </div>

</article>
