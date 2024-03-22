<?php
    require_once("bootstrap.php");

    $templateParams["title"] = "Sign Up";
    $templateParams["nav"] = false;
    $templateParams["signUp"] = true;
    $templateParams["content"] = "signUp_content.php";
    // $templateParams["design"] = array("css/signUp.css", "css/style.css");

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
            $dbh->registerUser($_POST["username"], $_POST["email"], $_POST["password"]);
            header("Location: feed.php");
        }
    }
    
    require("template/base.php");
?>