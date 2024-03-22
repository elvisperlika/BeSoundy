<?php
    require_once("bootstrap.php");

    $templateParams["title"] = "Login";
    $templateParams["nav"] = false;
    $templateParams["login"] = true;
    $templateParams["content"] = "login_content.php";
    // $templateParams["design"] = array("css/logIn.css", "css/style.css");

    if($_SERVER["REQUEST_METHOD"] === "POST") {
        if(isset($_POST["username"]) && isset($_POST["password"])){
            $login_result = $dbh->checkLogin($_POST["username"], $_POST["password"]);
            if(count($login_result)==0){
                $templateParams["errorelogin"] = "Errore! Controllare username o password!";
            }
            else{
                registerLoggedUser($login_result[0]);
                header("Location: feed.php");
            }
        } 
        else if(!isset($_POST["username"]) || !isset($_POST["password"])) {
            $templateParams["errorelogin"] = "Uno o più campi sono vuoti";
        }
    }
    
    require("template/base.php");
?>