<?php
    require("api.php");

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    $q = $_GET["str"];
    $result = $dbh->getUsers($q);
    foreach($result as $user){
        include '../template/components/user_row.php';
    }
?>