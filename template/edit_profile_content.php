<a href="profile.php?user=<?php echo $_SESSION['username']; ?>" class="btn-annulla">Annulla</a>

<form action="../api/modify_profile.php" method="POST" enctype="multipart/form-data">
    <div id="editProfileContainer">
        <!-- Contenitore principale -->
        <div id="editProfileMain">
            <!-- Modifica immagine profilo -->
            <div id="profilePicDiv">
                <label for="profilePic">Cambia immagine profilo:</label>
                <input type="file" id="profilePic" name="profilePic" accept="image/*">
            </div>
            <!-- Modifica nome, nome utente, bio -->
            <div id="editProfileContainers">
                <!-- Modifica nome -->
                <div id="newNameContainer">
                    <label for="name">Nuovo nome:</label>
                    <input type="text" id="name" name="name">
                </div>
                <!-- Modifica password -->
                <div id="newPasswordContainer">
                    <label for="newPassword">Nuova Password:</label>
                    <input type="password" id="newPassword" name="newPassword">
                </div>
                <!-- Modifica bio -->
                <div id="newBioContainer">
                    <label for="bio">Bio:</label>
                    <textarea id="bio" name="bio" rows="4"></textarea>
                </div>
            </div>
        </div>
        <!-- Salvare le modifiche -->
        <div id="saveProfile">
            <button type="submit" id="saveButton">Salva modifiche</button>
        </div>
    </div>
</form>
