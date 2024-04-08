<?php
// Controlla se il form è stato inviato
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Controlla se il campo del nome è stato compilato
    if (!empty($_POST["fullName"])) {
        // Aggiorna il nome nel database
        updateName($_SESSION["username"], $_POST["fullName"]);
    }
    // Controlla se il campo dell'username è stato compilato
    if (!empty($_POST["username"])) {
        // Aggiorna l'username nel database
        updateUsername($_SESSION["username"], $_POST["username"]);
    }
    // Controlla se il campo della bio è stato compilato
    if (!empty($_POST["bio"])) {
        // Aggiorna la bio nel database
        updateBio($_SESSION["username"], $_POST["bio"]);
    }
    // Controlla se è stata inviata un'immagine del profilo
    if (!empty($_FILES["profileImage"]["name"])) {
        $newImage = file_get_contents($_FILES["profileImage"]["tmp_name"]);
        // Aggiorna l'immagine del profilo nel database
        updateImgProfile($_SESSION["username"], $newImage);
    }
}
?>


<div id="editProfileContainer">
        <!-- Modifica immagine profilo -->
        <div id="profileImage">
            <label for="profilePic">Cambia immagine profilo:</label>
            <input type="file" id="profilePic" name="profilePic">
        </div>
        <!-- Modifica nome, nome utente, bio -->
        <div id="editProfileContainer">
        <!-- Modifica nome -->
        <div id="fullNameContainer">
            <label for="fullName">Full Name:</label>
            <input type="text" id="fullName" name="fullName">
        </div>
        <!-- Modifica username -->
        <div id="usernameContainer">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username">
        </div>
        <!-- Modifica bio -->
        <div id="bioContainer">
            <label for="bio">Bio:</label>
            <textarea id="bio" name="bio" rows="4"></textarea>
        </div>
        <!-- Salvare le modifiche -->
        <div id="saveProfile">
            <button id="saveButton">Save Changes</button>
        </div>
    </div>
    </div>