<?php
require("api.php");

// Controlla se sono stati inviati dati dal form
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ottieni l'ID del post dal parametro POST
    $post_id = $_GET["idPost"];

    // Controlla se il parametro POST per il commento è stato impostato e non è vuoto
    if(isset($_POST["write-comment"]) && !empty($_POST["write-comment"])) {
        // Ottieni l'ID dell'utente corrente
        $user_id = loggedUser();

        // Aggiungi il commento al post nel database
        $result = $dbh->writeComment($post_id, $user_id, $_POST["write-comment"]);

        if ($result) {
            // Invia una risposta JSON indicando che l'aggiunta del commento è avvenuta con successo
            echo json_encode(["success" => true]);
        } else {
            // Invia una risposta JSON indicando che si è verificato un errore durante l'aggiunta del commento
            echo json_encode(["success" => false, "message" => "Si è verificato un errore durante l'aggiunta del commento."]);
        }
    } else {
        // Invia una risposta JSON indicando che il commento non può essere vuoto
        echo json_encode(["success" => false, "message" => "Il commento non può essere vuoto."]);
    }
} else {
    // Invia una risposta JSON indicando che i dati non sono stati inviati tramite metodo POST
    echo json_encode(["success" => false, "message" => "Errore: dati non inviati tramite metodo POST."]);
}
