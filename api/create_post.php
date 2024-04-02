<?php
    $_GET["debug"] = true;
    require("../bootstrap.php");
    $user_id = loggedUser();
    $timestamp = date("Y-m-d H:i:s");

    // Assicurati che sia stato inviato un file e che non ci siano errori
    if(isset($_FILES["image-upload"]) && $_FILES["image-upload"]["error"] == 0) {
        // Leggi il contenuto dell'immagine come BLOB
        $imageContent = file_get_contents($_FILES["image-upload"]["tmp_name"]);

        // Inserisci il nuovo post nel database con il contenuto dell'immagine come BLOB
        $dbh->newPost($imageContent, $_POST["didascalia"], $timestamp, $user_id);
    } else {
        echo "Si è verificato un errore durante il caricamento dell'immagine.";
    }
?>
