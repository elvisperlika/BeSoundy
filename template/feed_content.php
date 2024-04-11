<?php
    $friends_post = $template["post"];
    $all_post_finished = false;
?>

<div id="postsContainer">
    <section>
        <?php if(empty($friends_post)): ?>
            <p> Nessun post da mostrare. Prova a seguire altri utenti!</p>
        <?php endif ?>
        <div class="post-container">
            <?php foreach ($friends_post as $post) : ?>
                <?php include "post_content.php"; ?>
            <?php endforeach; ?>
        </div>
        <?php $all_post_finished = true; ?>
    </section>
    <?php if(($all_post_finished == true)&&!empty($friends_post)): ?>
        <p class="avviso">I post dei tuoi amici sono finiti, cerca nuovi account per altri contenuti!</p>
    <?php endif ?>
</div>


