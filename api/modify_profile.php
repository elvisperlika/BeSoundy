<?php
require("api.php");

// Controlla se sono state apportate modifiche
$modifiche_eseguite = true;
$error_message = "";

// Controlla se il form è stato inviato
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Controlla se almeno uno dei campi è stato compilato
    if (isset($_POST["name"]) || isset($_POST["newPassword"]) || isset($_POST["bio"]) || isset($_FILES["profilePic"]["tmp_name"])) {
        $user_id = loggedUser();

        

        // Aggiorna l'immagine del profilo
        if (isset($_FILES["profilePic"]["tmp_name"])) {
            if ($_FILES["profilePic"]["error"] === UPLOAD_ERR_OK) {
                $newImage = file_get_contents($_FILES["profilePic"]["tmp_name"]);

                $modifiche_eseguite = $dbh->updateImgProfile($newImage, $user_id);
                if (!$modifiche_eseguite) {
                    $error_message .= "Errore durante l'aggiornamento dell'immagine del profilo. ";
                }
            } else {
                $error_message .= "Errore durante il caricamento dell'immagine del profilo. ";
            }
        }        
        // Aggiorna il nome
        if (isset($_POST["name"])) {
            $modifiche_eseguite = $dbh->updateName($_POST["name"], $user_id);
            if (!$modifiche_eseguite) {
                $error_message .= "Errore durante l'aggiornamento del nome. ";
            }
        }
        // Aggiorna la password
        if (isset($_POST["newPassword"])) {
            $newPassword = $_POST["newPassword"];
            // Assicurati di implementare una funzione di hash per la tua password, ad esempio password_hash() in PHP
            // In questa implementazione immaginaria, si presume che la funzione updatePassword ritorni true se l'aggiornamento è avvenuto con successo, altrimenti false
            $modifiche_eseguite = $dbh->updatePassword($newPassword, $user_id);
            if (!$modifiche_eseguite) {
                $error_message .= "Errore durante l'aggiornamento della password. ";
            }
        }
        // Aggiorna la bio
        if (isset($_POST["bio"])) {
            $modifiche_eseguite = $dbh->updateBio($_POST["bio"], $user_id);
            if (!$modifiche_eseguite) {
                $error_message .= "Errore durante l'aggiornamento della bio. ";
            }
        }
    } else {
        $error_message = "Nessuna modifica effettuata.";
        $modifiche_eseguite = false;
    }
}

// Se almeno una modifica è stata eseguita con successo, reindirizza a profile.php
if ($modifiche_eseguite) {
    header("Location: ../profile.php?user=".$_SESSION['username']."");
    exit();
} else {
    // Altrimenti, rimani sulla pagina di modifica del profilo e visualizza il messaggio di errore
    echo $error_message;
}
?>
