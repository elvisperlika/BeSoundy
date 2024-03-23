<?php
    $post = $_GET["post"];
    $post_id = $post["idPost"];

    $comments = $dbh->postsComment($post_id);
    $user_id = loggedUser();
    $profile_image = $dbh->getUserProfileImage($post['username']);
?>

<article class="post" id="<?php echo $post_id ?>">

    <div class="userInfo">
        <img src="data:image/jpeg;base64,<?php echo base64_encode($profile_image); ?>" />
        <p> <?php echo $post["username"]; ?> </p>
    </div>

    <div class="infoPost">
        <p> <?php echo $post["time"]; ?> </p>
        <p> <?php echo $post["text"]; ?> </p>
    </div>

    <div class="body">
        <img src="data:image/jpeg;base64,<?php echo base64_encode($post["image"]); ?>" />
    </div>

    <div class="like-commenti">
        <p> like: <?php echo $post["nLike"]; ?> </p>
        <p> commenti: <?php echo $post["nComment"]; ?> </p>
    </div>

</article>
