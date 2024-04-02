<?php 
    $userProfileImage = $dbh->getUserProfileImage($_GET['user']);
?>

<div id="profileContainer">
    <div id="rowContainer">
        <div id="profileImage">
            <img src="data:image/jpeg;base64,<?php echo base64_encode($userProfileImage); ?>" />
        </div>
        <div id="followersCounter">
            <p><?php echo $dbh->getFollowersNumber($_GET['user']); ?></p>
            <p>Followers</p>
        </div>
        <div id="followingCounter">
            <p><?php echo $dbh->getFollowingNumber($_GET['user']); ?></p>
            <p>Following</p>
        </div>
        <div id="postCounter">
            <p><?php echo $dbh->getPostsNumber($_GET['user']); ?></p>
            <p>Posts</p>
        </div>
    </div>

    <div id="realName">
        <p><?php echo $dbh->getUserRealName($_GET["user"]); ?></p>
    </div> 
    <div id="bio">
        <p><?php echo $dbh->getUserBio($_GET["user"]); ?></p>       
    </div>
        <?php if($_GET["user"] == $_SESSION["username"]): ?>
            <div id="editProfile">
                <a href="edit_profile.php">Edit Profile</a>
            </div>
        <?php else: ?>
            <div id="followButton">
                <?php if($dbh->isFollowing($_SESSION["username"], $_GET["user"])): ?>
                    <a href="profile.php?user=<?php echo $_GET["user"]; ?>&request=unfollow">Unfollow</a>
                <?php else: ?>
                    <a href="profile.php?user=<?php echo $_GET["user"]; ?>&request=follow">Follow</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    <div>
</div>