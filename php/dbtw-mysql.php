<?php
    $host = "localhost";
    $user = "root";
    $pass = "Elvis101";
    $database = "BeSoundy";
    
    // connessione DBMS
    $myconn = mysql_connect($host, $user, $pass) or die('Errore...');
    
    //connessione DB database
    mysql_select_db($database, $myconn) or die('Errore...');
?>