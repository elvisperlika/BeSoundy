<div class="container">
    <h1>Welcome to BeSound</h1>
    <h2 href="signUp.html">Log In</h2>
    <form action="php/authenticate.php" method="get">
        <fieldset name="inputs">
            <label for="usernameId" hidden>Username</label>
            <input type="text" id="usernameId" placeholder="username"/>
            <label for="passwordId" hidden>Password</label>
            <input type="password" id="passwordId" placeholder="password"/>
        </fieldset>
        <fieldset name="buttons">
            <a id="signUpBtn" href="signUp.html">
                <span>sign up</span>
            </a>
            <a id="logInBtn" href="logIn.html">
                <span>log in</span>
            </a>
        </fieldset>
    </form>
</div>