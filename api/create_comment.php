<?php
    $_GET["debug"] = true;
    require("../bootstrap.php");
    $post_id = $_GET["idPost"];
    $dbh -> writeComment($post_id, loggedUser(), $_POST["write-comment"]);
    //$dbh->newNotificationForPost($receiving_user_id, get_logged_in_username(),"C", $post_id);
?>