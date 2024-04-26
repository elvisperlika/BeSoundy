<div>
    <ul id="usersContainer">
        <?php 
            if($_SESSION['side'] == "followers"){
                $followers = $dbh->getFollowers($_SESSION['userNetwork']);
                foreach($followers as $user){
                    echo "<li>";
                        echo "<a class='userLink' href='profile.php?user=".$user["follower"]."'>";
                        $userProfileImage = $dbh->getUserProfileImage($user["follower"]);
                        echo "<img class='imgProfile' src='data:image/jpeg;base64,".base64_encode($userProfileImage)."'/>";
                        echo "".$user["follower"]."</a>";
                        if($user["follower"] != $_SESSION["username"]) {
                            if($dbh->isFollowing($_SESSION['userNetwork'], $user["follower"])){
                                echo "<a class='followBtn' href='#' type='unfollow' data-user=".$user["follower"].">unfollow</a>";
                            } else {
                                echo "<a class='followBtn' href='#' type='follow' data-user=".$user["follower"].">follow</a>";
                            }
                        }
                    echo "</li>";
                }
            } else {
                $following = $dbh->getFollowing($_SESSION['userNetwork']);
                foreach($following as $user){
                    echo "<li>";
                        echo "<a class='userLink' href='profile.php?user=".$user["follower"]."'>";
                        $userProfileImage = $dbh->getUserProfileImage($user["followed"]);
                        echo "<img class='imgProfile' src='data:image/jpeg;base64,".base64_encode($userProfileImage)."'/>";
                        echo "".$user["followed"]."</a>";
                        if($user["followed"] != $_SESSION["username"]) {
                            if($dbh->isFollowing($_SESSION['userNetwork'], $user["followed"])){
                                echo "<a class='followBtn' href='#' type='unfollow' data-user=".$user["followed"].">unfollow</a>";
                            } else {
                                echo "<a class='followBtn' href='#' type='follow' data-user=".$user["followed"].">follow</a>";
                            }
                        }
                    echo "</li>";
                }
            }
        ?>
    </ul>
</div>