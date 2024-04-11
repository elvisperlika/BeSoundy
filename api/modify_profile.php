<?php
require("api.php");

// Controlla se sono state apportate modifiche
$modifiche_eseguite = true;
$error_message = "";

// Controlla se il form è stato inviato
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Controlla se almeno uno dei campi è stato compilato
    if (isset($_POST["newName"]) || isset($_POST["newUsername"]) || isset($_POST["newBio"]) || isset($_FILES["newImg"]["name"])) {
        $user_id = loggedUser();

        // Aggiorna il nome
        if (isset($_POST["newName"])) {
            $modifiche_eseguite = $dbh->updateName($_POST["newName"], $user_id);
            if (!$modifiche_eseguite) {
                $error_message .= "Errore durante l'aggiornamento del nome. ";
            }
        }
        // Aggiorna lo username
        if (isset($_POST["newUsername"])) {
            $modifiche_eseguite = $dbh->updateUsername($_POST["newUsername"], $user_id);
            if (!$modifiche_eseguite) {
                $error_message .= "Errore durante l'aggiornamento dell'username. ";
            }
        }
        // Aggiorna la bio
        if (isset($_POST["newBio"])) {
            $modifiche_eseguite = $dbh->updateBio($_POST["newBio"], $user_id);
            if (!$modifiche_eseguite) {
                $error_message .= "Errore durante l'aggiornamento della bio. ";
            }
        }
        // Aggiorna l'immagine del profilo
        if (isset($_FILES["newImg"]["name"])) {
            $newImage = file_get_contents($_FILES["newImg"]["tmp_name"]);
            $modifiche_eseguite = $dbh->updateImgProfile($newImage, $user_id);
            if (!$modifiche_eseguite) {
                $error_message .= "Errore durante l'aggiornamento dell'immagine del profilo. ";
            }
        }
    } else {
        $error_message = "Nessuna modifica effettuata.";
        $modifiche_eseguite = false;
    }
}

// Se almeno una modifica è stata eseguita con successo, reindirizza a profile.php
if ($modifiche_eseguite) {
    header("Location: ../profile.php");
    exit();
} else {
    // Altrimenti, rimani sulla pagina di modifica del profilo e visualizza il messaggio di errore
    echo $error_message;
}
?>
