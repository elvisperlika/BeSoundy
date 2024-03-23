<div class="container">
    <h1>Welcome to EngineerNet</h1>
    <h2>Sign Up</h2>
    <form action="signUp.php" method="post">
            <label for="username" hidden>Username</label>
            <input type="text" id="username" name="username" placeholder="username"/>

            <label for="email" hidden>Email</label>
            <input type="text" id="email" name="email" placeholder="email"/>

            <label for="password" hidden>Password</label>
            <input type="password" id="password" name="password" placeholder="password"/>

            <input type="submit" id="signUpBtn" value="signUp" >
            <a id="returnBtn" href="logIn.php">
                <span>return</span>
            </a>
    </form>
    <?php
        if(isset($templateParams["errorSignUp"])){
            echo "<p>".$templateParams["errorSignUp"]."</p>";
        }   
    ?>
</div>