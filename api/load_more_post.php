<?php
    require("api.php");
    echo("entrato");

    if (isset($_COOKIE["last_post_id"])) {
        echo("entrato");
        $last_post_id = $_COOKIE["last_post_id"];
        echo($last_post_id);
        $user = $_SESSION['username'];
        $morePosts = $dbh->getMorePosts($last_post_id, $user);
        
        // Inizializza l'array post_array se non esiste
        if (!isset($_COOKIE["post_array"])) {
            $_COOKIE["post_array"] = array();
        }

        // Itera sui nuovi post e aggiungi gli ID all'array post_array
        foreach($morePosts as $newPost) {
            array_push($_COOKIE["post_array"], $newPost["idPost"]);
        }
    } else {
        echo("errore last post id");
    }
?>
