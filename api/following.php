<?php
    require("api.php");

    if($_GET["request"] == "unfollow"){
        $dbh->removeFollowing($_SESSION["username"], $_GET["user"]);
    } elseif($_GET["request"] == "follow"){
        $dbh->addFollowing($_SESSION["username"], $_GET["user"]);
    }

    // header('Location: ../profile.php?user=' . $_GET["user"] . '');
?>