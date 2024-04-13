<?php
require("api.php");

// Controlla se sono state apportate modifiche
$modifiche_eseguite = false;
$error_message = "";

// Controlla se il form è stato inviato
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = loggedUser();
    // Inizializza le variabili per contenere i valori da aggiornare
    $newName = isset($_POST["name"]) ? $_POST["name"] : null;
    $newPassword = isset($_POST["newPassword"]) ? $_POST["newPassword"] : null;
    $newBio = isset($_POST["bio"]) ? $_POST["bio"] : null;
    $newImage = null;

    // Controlla se almeno uno dei campi è stato compilato
    if (!empty($newName) || !empty($newPassword) || !empty($newBio) || (isset($_FILES["profilePic"]) && $_FILES["profilePic"]["error"] == 0)) {
        // Aggiorna l'immagine del profilo se è stata caricata una nuova immagine
        if (isset($_FILES["profilePic"]["tmp_name"])) {
            if ($_FILES["profilePic"]["error"] === UPLOAD_ERR_OK) {
                $newImage = file_get_contents($_FILES["profilePic"]["tmp_name"]);
            } else {
                $error_message .= "Errore durante il caricamento dell'immagine del profilo. ";
            }
        }

        // Aggiorna il nome se è stato fornito un nuovo nome
        if (!empty($newName)) {
            $modifiche_eseguite = $dbh->updateName($newName, $user_id);
        }

        // Aggiorna la password se è stata fornita una nuova password
        if (!empty($newPassword)) {
            $modifiche_eseguite = $dbh->updatePassword($newPassword, $user_id);
        }

        // Aggiorna la bio se è stata fornita una nuova bio
        if (!empty($newBio)) {
            $modifiche_eseguite = $dbh->updateBio($newBio, $user_id);
        }

        // Aggiorna l'immagine del profilo se è stata caricata una nuova immagine
        if ($newImage !== null) {
            $modifiche_eseguite = $dbh->updateImgProfile($newImage, $user_id);
        }

        if ($modifiche_eseguite) {
            // Almeno una modifica è stata eseguita con successo
            header("Location: ../profile.php?user=".$_SESSION['username']."");
            exit();
        } else {
            $error_message = "Nessuna modifica effettuata.";
        }
    } else {
        $error_message = "Nessuna modifica effettuata.";
    }
}

// Se si è arrivati a questo punto, nessuna modifica è stata eseguita con successo o il form non è stato inviato
// Visualizza il messaggio di errore
echo $error_message;
?>
