<?php
    require_once("bootstrap.php");

    $templateParams["title"] = "Login";
    $templateParams["nav"] = false;
    $templateParams["login"] = true;
    $templateParams["content"] = "login_content.php";
    // $templateParams["design"] = array("css/logIn.css", "css/style.css");

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (!isset($_POST['usernameID'], $_POST['passwordId']) ) {
            // Could not get the data that should have been sent.
            $template["loginError"] = "Uno o più campi sono vuoti";
            //exit('Please fill both the username and password fields!');
        } else if (empty($_POST['usernameID']) || empty($_POST['passwordId'])) {
            // One or more values are empty.
            $template["loginError"] = "Uno o più campi sono vuoti";
        } else if(isset($_POST["usernameID"]) && isset($_POST["passwordId"])){
            echo "logInSuccess";
            $template["content"] = "signUp.php";
            if($dbh->logInControl(($_POST["usernameID"]))) {
                $userPassword = $dbh -> getPasswordAndUsername($_POST["usernameID"])[0]['passwordId'];
                $username = $dbh -> getPasswordAndUsername($_POST["usernameID"])[0]['username'];
                if (password_verify($_POST['passwordId'], $userPassword)) {
                    $_SESSION["usernameID"] = $username;
                    header('Location: feed.php');
    
                }else {
                    $template["loginError"] = "Credenziali errate";
                }
            } else {
                $template["loginError"] = "Credenziali errate";
            }
        }
    }
    
    require("template/base.php");
?>