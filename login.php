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
        }
        else if(empty($_POST["username"]) || empty($_POST["password"])) {
            $templateParams["errorelogin"] = "One or more fields are empty";
        }
        else if(isset($_POST["username"]) && isset($_POST["password"])){
            $login_result = $dbh->checkLogin($_POST["username"], $_POST["password"]);
            if(count($login_result)==0){
                $templateParams["errorelogin"] = "This user doesn't exist!";
            }
            else{
                registerLoggedUser($login_result[0]);
                header("Location: feed.php");
            }
        } 
    }
    
    require("template/base.php");
?>