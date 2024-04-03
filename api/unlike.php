<?php
    require("api.php");
    
    $user_id = loggedUser();
    $post_id = $_GET["idPost"];
    $dbh -> unlikesPost($post_id, $user_id);
?>