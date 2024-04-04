<div>
    <?php 
        if($_SESSION['side'] == "followers"){
            $followers = $dbh->getFollowers($_SESSION['sessionUser']);
            foreach($followers as $user){
                echo "<a href='profile.php?user=".$user["follower"]."'>".$user["follower"]." </a>";
            }
        } else {
            $following = $dbh->getFollowing($_SESSION['sessionUser']);
            foreach($following as $user){
                echo "<a href='profile.php?user=".$user["followed"]."'>".$user["followed"]." </a>";
            }
        }
    ?>
</div>