<?php
    require("api.php");

    $type = $_GET["type"];
    $id = $_GET["id"];
    if ($type === "post") {
        $dbh->likesPost($id, loggedUser());
    } elseif ($type === "comment") {
        $dbh->likesComment($id, loggedUser()); // Passa l'ID del commento
    }

    header('Location: ../feed.php');
?>
