<?php
require_once("bootstrap.php");

$templateParams["title"] = "Login";
$templateParams["nav"] = false;
$templateParams["login"] = true;
$templateParams["content"] = "login_content.php";
$templateParams["design"] = array("css/logIn.css");

if($_SERVER["REQUEST_METHOD"] === "POST") {
    if(!isset($_POST["username"]) || !isset($_POST["password"])) {
        $templateParams["errorelogin"] = "One or more fields are empty";
    } else {
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        // Verifica l'utente e la password nel database
        $login_result = $dbh->checkLogin($username, $password);
        
        // Verifica se l'utente esiste e se la password è corretta
        if($login_result && password_verify($password, $login_result["password"])) {
            // Login riuscito, registra l'utente nel sistema e reindirizza alla pagina di feed
            registerLoggedUser($login_result);
            header("Location: feed.php");
            exit(); // Termina lo script dopo il reindirizzamento
        } else {
            // Credenziali non valide, mostra un messaggio di errore
            $templateParams["errorelogin"] = "Incorrect username or password";
        }
    }
}

require("template/base.php");
?>
