<?php
    $friends_post = $template["post"];
?>

<section>
    <?php if(empty($friends_post)): ?>
        <p> Nessun post da mostrare. Prova a seguire altri utenti!</p>
    <?php endif ?>
    <?php foreach ($friends_post as $post) {
        $_GET["post"] = $post;
        require("post_content.php");
    }?>
</section>