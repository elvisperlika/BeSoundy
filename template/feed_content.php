<?php
    $all_post_finished = false;
?>
        <?php 
            $post_array = array();
        ?>

<div id="postsContainer">
    <div class="post-container">
<?php    
    $lenth = count($_COOKIE["post_array"]);
    echo "<span>".$lenth."</span>";
    for ($i = 0; $i < $lenth; $i++) {
        $postId = $_COOKIE["post_array"][$i];
        $post = $dbh->getPostById($postId);
        if ($i == $lenth - 1) {
            $_COOKIE["last_post_id"] = $postId;
        }
        include("post_content.php");
    }

?>
    </div>
</div>

