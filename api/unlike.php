<?php
    require("api.php");
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $type = $_POST["type"];
        $id = $_POST["id"];
        if ($type === "post") {
            $dbh->unlikesPost($id, loggedUser());
        } elseif ($type === "comment") {
            $dbh->unlikesComment($id, loggedUser());
        }

        // Restituisci una risposta JSON per indicare che l'operazione è stata completata con successo
        echo json_encode(["success" => true]);
    } else {
        // Se la richiesta non è una richiesta POST, restituisci un messaggio di errore
        echo json_encode(["error" => "Metodo non supportato"]);
    }
?>
