<?php
    $all_post_finished = false;
?>
        <?php 
            $post_array = array();
        ?>

<div id="postsContainer">
    <div class="post-container">
        <?php for ($i = 0; $i < min(10, count($friends_post)); $i++) : ?>
            <?php $post = $friends_post[$i]; ?>
                <?php include "post_content.php"; ?>
        <?php endfor; ?>
    </div>
</div>

