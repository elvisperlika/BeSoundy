<?php
require("api.php");

// Controlla se sono stati inviati dati dal form
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ottieni l'ID del commento genitore dall'url
    $parent_comment_id = $_GET["parent_comment"];

    // Controlla se il parametro POST per la risposta è stato impostato e non è vuoto
    if(isset($_POST["write-reply"]) && !empty($_POST["write-reply"])) {
        // Ottieni l'ID dell'utente corrente
        $user_id = loggedUser();

        // Aggiungi la risposta al commento nel database
        $result = $dbh->writeReply($parent_comment_id, $user_id, $_POST["write-reply"]);

        if ($result) {
            // Invia una risposta JSON indicando che l'aggiunta della risposta è avvenuta con successo
            echo json_encode(["success" => true]);
        } else {
            // Invia una risposta JSON indicando che si è verificato un errore durante l'aggiunta della risposta
            echo json_encode(["success" => false, "message" => "Si è verificato un errore durante l'aggiunta della risposta."]);
        }
    } else {
        // Invia una risposta JSON indicando che la risposta non può essere vuota
        echo json_encode(["success" => false, "message" => "La risposta non può essere vuota."]);
    }
} else {
    // Invia una risposta JSON indicando che i dati non sono stati inviati tramite metodo POST
    echo json_encode(["success" => false, "message" => "Errore: dati non inviati tramite metodo POST."]);
}
