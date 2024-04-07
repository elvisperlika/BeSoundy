<div>
    
    <ul id="usersContainer">
        <?php 
            if($_SESSION['side'] == "followers"){
                $followers = $dbh->getFollowers($_SESSION['userNetwork']);
                foreach($followers as $user){
                    echo "<li>";
                        echo "<a href='profile.php?user=".$user["follower"]."'>".$user["follower"]." </a>";
                        if($user["follower"] != $_SESSION["username"]) {
                            if($dbh->isFollowing($_SESSION['userNetwork'], $user["follower"])){
                                echo "<a class='followBtn' href='#' data-user=".$user["follower"].">Unfollow</a>";
                            } else {
                                echo "<a class='followBtn' href='#' data-user=".$user["follower"].">Follow</a>";
                            }
                        }
                    echo "</li>";
                }
            } else {
                $following = $dbh->getFollowing($_SESSION['userNetwork']);
                foreach($following as $user){
                    echo "<li>";
                        echo "<a href='profile.php?user=".$user["followed"]."'>".$user["followed"]." </a>";
                        if($user["followed"] != $_SESSION["username"]) {
                            if($dbh->isFollowing($_SESSION['userNetwork'], $user["followed"])){
                                echo "<a class='followBtn' href='#' data-user=".$user["followed"].">Unfollow</a>";
                            } else {
                                echo "<a class='followBtn' href='#' data-user=".$user["followed"].">Follow</a>";
                            }
                        }
                    echo "</li>";
                }
            }
        ?>
    </ul>
</div>