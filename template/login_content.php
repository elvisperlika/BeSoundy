<div class="container">
    <h1>Welcome to EngineerNet</h1>
    <form action="login.php" method="post">
            <label for="username" hidden>Username</label>
            <input type="text" id="username" placeholder="username" name="username"/>

            <label for="password" hidden>Password</label>
            <input type="password" id="password" placeholder="password" name="password"/>

            <input type="submit" id="logInBtn" value="log in"/>
            <a id="signUpBtn" href="signUp.php">
                <span>sign up</span>
            </a>
    </form>
    <?php
        if(isset($templateParams["errorelogin"])){
            echo "<p>".$templateParams["errorelogin"]."</p>";
        }
    ?>
</div>