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

            // Controlla se è stata fornita un'ID del commento genitore (per le risposte)
            if(isset($_GET["parent_comment"])) {
                $parent_comment_id = $_GET["parent_comment"];
                // Aggiungi la risposta al commento nel database
                $result = $dbh->writeComment($post_id, $user_id, $_POST["write-comment"], $parent_comment_id);
            } else {
                // Aggiungi il commento al post nel database
                $result = $dbh->writeComment($post_id, $user_id, $_POST["write-comment"]);
            }

            if ($result) {
                // Reindirizza alla pagina del post dopo aver completato l'operazione
                header("Location: ../feed.php");
                exit(); // Assicura che lo script termini qui e il reindirizzamento venga effettuato correttamente
            } else {
                echo "Si è verificato un errore durante l'aggiunta del commento.";
            }
        } else {
            echo "Il commento non può essere vuoto.";
        }
    } else {
        echo "Errore: dati non inviati tramite metodo POST.";
    }
?>
