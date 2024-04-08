<?php 
    require_once("api.php");
    $dbh->setViewed($_GET["alert-id"], $_GET["alert-receiver"]);
?>