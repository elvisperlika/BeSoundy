<?php
    require("api.php");
    $user_id = loggedUser();
    $post_id = $_GET["idPost"];
    $dbh -> likesPost($post_id, $user_id);
    $likedUser = $dbh -> postUser($post_id);
    header('Location: ..feed.php');
    /*if(isset($_GET["idPost"])) {
        // Ottieni l'ID del post dalla richiesta GET
        $post_id = $_GET["idPost"];

        // Ottieni l'ID dell'utente loggato
        $user_id = loggedUser();

        // Esegui l'azione per incrementare i like sul post
        $dbh->likesPost($post_id, $user_id);

        // Reindirizza l'utente alla pagina del post dopo aver messo like
        header('Location: post_content.php');
        exit(); // Assicura che lo script si interrompa qui
    } else {
        // Se l'ID del post non è stato passato correttamente, gestisci l'errore
        echo "ID del post non valido";
    }*/
    //$dbh->newNotificationForPost($receiving_user_id, get_logged_in_username(), "L", $post_id);
?>