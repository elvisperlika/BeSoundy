<?php
    require("api.php");

    // Controlla se sono stati inviati dati dal form
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Ottieni l'ID dell'utente corrente
        $user_id = loggedUser();
        // Ottieni il timestamp attuale
        $timestamp = date("Y-m-d H:i:s");

        // Assicurati che sia stato inviato un file e che non ci siano errori
        if(isset($_FILES["image-upload"]) && $_FILES["image-upload"]["error"] == 0) {
            // Leggi il contenuto dell'immagine come BLOB
            $imageContent = file_get_contents($_FILES["image-upload"]["tmp_name"]);

            // Inserisci il nuovo post nel database con il contenuto dell'immagine come BLOB
            $result = $dbh->newPost($imageContent, $_POST["didascalia"], $timestamp, $user_id);

            if ($result) {
                // Reindirizza alla pagina del feed dopo aver completato l'operazione
                header("Location: ../feed.php");
                exit(); // Assicura che lo script termini qui e il reindirizzamento venga effettuato correttamente
            } else {
                echo "Si è verificato un errore durante l'inserimento del post nel database.";
            }
        } else {
            echo "Si è verificato un errore durante il caricamento dell'immagine.";
        }
    }
?>
