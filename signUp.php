<?php
require_once("bootstrap.php");

$templateParams["title"] = "Sign Up";
$templateParams["nav"] = false;
$templateParams["signUp"] = true;
$templateParams["content"] = "signUp_content.php";
$templateParams["design"] = array("css/signUp.css", "css/style.css");

// Verifica se è stato inviato il form di registrazione
if($_SERVER["REQUEST_METHOD"] === "POST") {
    // Verifica se ci sono campi vuoti
    if (empty($_POST["username"]) || empty($_POST["email"]) || empty($_POST["password"])){
        $templateParams["erroreSignUp"] = "Uno o più campi sono vuoti";
        echo 'Uno o più campi sono vuoti';
    }
    // Verifica se l'email è già stata utilizzata
    else if($dbh->emailAlreadyTaken($_POST["email"])) {
        $templateParams["errorSignUp"] = "This email is already taken";
    } 
    // Verifica se lo username è già stato utilizzato
    else if($dbh->usernameAlreadyTaken($_POST["username"])) {
        $templateParams["errorSignUp"] = "This username is already taken";
    } 
    // Se tutti i controlli passano, registra l'utente nel database
    else{
        // Imposta il percorso dell'immagine di profilo predefinita
        $profilePicPath = "utils/images/image-default.png";

        // Registra l'utente nel database con il percorso dell'immagine profilo predefinita
        $dbh->registerUser($_POST["username"], $_POST["email"], $_POST["password"], $profilePicPath);

        // Imposta l'immagine di default per il nuovo utente
        $dbh->updateImgProfile(file_get_contents($profilePicPath), $_POST["username"]);

        // Reindirizza l'utente alla pagina di feed dopo la registrazione
        header("Location: feed.php");
        exit(); // Assicurati di terminare lo script dopo il reindirizzamento
    }
}

// Se non è stato inviato il form, visualizza la pagina di registrazione
require("template/base.php");
