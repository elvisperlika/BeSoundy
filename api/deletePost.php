<?php
    require("api.php");

    $dbh->deletePost($_GET["post-id"]);
?>