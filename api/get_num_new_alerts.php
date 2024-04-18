<?php
    require("api.php");

    $alerts = $dbh->getNewAlerts($_SESSION["username"]);
    $_SESSION["new_alerts"] = count($alerts);
?>