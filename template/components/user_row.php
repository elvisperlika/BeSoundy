<?php
    $userProfileImage = $dbh->getUserProfileImage($user["username"]);
    echo "<li>";
        echo "<a class='usernameBtn' href='profile.php?user=".$user["username"]."'>";
        echo "<img class='imgProfile' src='data:image/jpeg;base64,".base64_encode($userProfileImage)."'/>";
        echo "".$user["username"]."</a>";
        if($user["username"] != loggedUser()){
            if($dbh->isFollowing(loggedUser(), $user["username"])){
                echo "<a href='#' class='followButton' data-user=".$user["username"].">unfollows</a>";
            } else {
                echo "<a href='#' class='followButton' data-user=".$user["username"].">follow</a>";
            }
        } else {
            echo "<a href='profile.php?user=".$_SESSION["username"]."id='meButton' >me</a>";
        }
    echo "</li>";
?>