<?php
    $friends_post = $template["post"];
    $all_post_finished = false;
?>

<section>
    <?php if(empty($friends_post)): ?>
        <p> Nessun post da mostrare. Prova a seguire altri utenti!</p>
    <?php endif ?>
    <?php foreach ($friends_post as $post) {
        $_GET["post"] = $post;
        require("post_content.php");
    }?>
    <?php $all_post_finished = true; ?>
</section>

<?php if(($all_post_finished == true)&&!empty($friends_post)): ?>
    <p>I post dei tuoi amici sono finiti, cerca nuovi account per altri contenuti!</p>
<?php endif ?>