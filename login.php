<?php
require_once("bootstrap.php");

$templateParams["title"] = "Login";
$templateParams["nav"] = false;
$templateParams["login"] = true;
$templateParams["content"] = "login_content.php";
$templateParams["design"] = array("css/logIn.css");

if($_SERVER["REQUEST_METHOD"] === "POST") {
    if(!isset($_POST["username"]) || !isset($_POST["password"]) || empty($_POST["username"]) || empty($_POST["password"])) {
        $templateParams["errorelogin"] = "One or more fields are empty";
    } else {
        $username = $_POST["username"];
    
        $user = $dbh->getUserByUsername($username);

        if($user === null) {
            $templateParams["errorelogin"] = "User not found";
        }

        if(password_verify($_POST["password"], $user["password"])) {
            registerLoggedUser($user);
            header("Location: feed.php");
            exit();
        } else {
            $templateParams["errorelogin"] = "Incorrect username or password";
        }
    }
}

require("template/base.php");
?>
