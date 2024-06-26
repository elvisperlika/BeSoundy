<?php
    require_once("bootstrap.php");

    $templateParams["title"] = "Sign Up";
    $templateParams["nav"] = false;
    $templateParams["signUp"] = true;
    $templateParams["content"] = "template/signUp_content.php";
    $templateParams["design"] = array("css/signUp.css", "css/style.css");

    if($_SERVER["REQUEST_METHOD"] === "POST") {
        if (empty($_POST["username"]) || empty($_POST["email"]) || empty($_POST["password"])){
            $templateParams["erroreSignUp"] = "Uno o più campi sono vuoti";
            echo 'Uno o più campi sono vuoti';
        }
        else if($dbh->emailAlreadyTaken($_POST["email"])) {
            $templateParams["errorSignUp"] = "This email is already taken";
        } 
        else if($dbh->usernameAlreadyTaken($_POST["username"])) {
            $templateParams["errorSignUp"] = "This username is already taken";
        } 
        else if(isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"])) {
            // Cripta la password
            $hashedPassword = password_hash($_POST["password"], PASSWORD_DEFAULT);

            // Imposta il percorso dell'immagine di profilo predefinita
            $profilePicPath = "images/image-default.png";
    
            // Registra l'utente nel database con il percorso dell'immagine profilo predefinita
            $dbh->registerUser($_POST["username"], $_POST["email"], $hashedPassword, $profilePicPath);
            
            // Imposta l'immagine di default per il nuovo utente
            $dbh->updateImgProfile(file_get_contents($profilePicPath), $_POST["username"]);
    
            // Reindirizza l'utente alla pagina di login dopo la registrazione
            header("Location: login.php");
            exit(); // Assicurati di terminare lo script dopo il reindirizzamento
        }
    }

    // Se non è stato inviato il form, visualizza la pagina di registrazione
    require("template/base.php");
