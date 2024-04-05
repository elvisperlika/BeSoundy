<?php
    require("api.php");
    
    $type = $_GET["type"];
    $id = $_GET["id"];
    if ($type === "post") {
        $dbh->unlikesPost($id, loggedUser());
    } elseif ($type === "comment") {
        $dbh->unlikesComment($id, loggedUser());
    }

    header('Location: ../feed.php');
?>
