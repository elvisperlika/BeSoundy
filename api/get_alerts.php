<?php
    require("api.php");

    $alerts = $dbh->getNewAlerts($_SESSION["username"]);
    foreach($alerts as $alert){
        include "../template/components/alert_row.php";
    }
?>