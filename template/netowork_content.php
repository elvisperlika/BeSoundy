<div>
    <?php 
        if($_SESSION['side'] == "followers"){
            $followers = $dbh->getFollowers($_SESSION['sessionUser']);
            foreach($followers as $user){
                echo "<span> ".$user["follower"]." </span>";
            }
        } else {
            $following = $dbh->getFollowing($_SESSION['sessionUser']);
            foreach($following as $user){
                echo "<span> ".$user["followed"]." </span>";
            }
        }
    ?>
</div>