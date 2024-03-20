<div class="container">
    <h1>Welcome to BeSound</h1>
    <h2 href="signUp.html">Log In</h2>
    <form action="login.php" method="post">
        <fieldset name="inputs">
            <label for="usernameId" hidden>Username</label>
            <input type="text" id="usernameId" placeholder="username" name="usernameId"/>
            <label for="passwordId" hidden>Password</label>
            <input type="password" id="passwordId" placeholder="password" name="passwordId"/>
        </fieldset>
        <fieldset name="buttons">
            <input type="submit" id="logInBtn" value="log in"/>
            <a id="signUpBtn" href="signUp.php">
                <span>sign up</span>
            </a>
            
        </fieldset>
    </form>
</div>