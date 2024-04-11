<form action="../api/modify_profile.php" method="POST" enctype="multipart/form-data">
    <div id="editProfileContainer">
        <!-- Modifica immagine profilo -->
        <div id="profileImage">
            <label for="profilePic">Cambia immagine profilo:</label>
            <input type="file" id="profilePic" name="profilePic" accept="image/*">
        </div>
        <!-- Modifica nome, nome utente, bio -->
        <div id="editProfileContainer">
            <!-- Modifica nome -->
            <div id="fullNameContainer">
                <label for="fullName">New Name:</label>
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
                <button type="submit" id="saveButton">Save Changes</button>
            </div>
        </div>
    </div>
</form>
