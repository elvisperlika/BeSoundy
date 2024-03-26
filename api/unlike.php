<?php
    $_GET["debug"] = true;
    require("../bootstrap.php");
    $user_id = loggedUser();
    $post_id = $_GET["idPost"];
    $dbh -> unlikesPost($post_id, $user_id);
?>