<?php 
    require_once("api.php");
    $dbh->setViewed($_GET["alert"], $_SESSION["username"]);
?>