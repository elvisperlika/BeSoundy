<?php 
    $userProfileImage = $dbh->getUserProfileImage($_GET['user']);
?>
<div id="profilePage">
    <div id="profileContainer">
        <div id="rowContainer">
            <div id="profileImage">
                <img src="data:image/jpeg;base64,<?php echo base64_encode($userProfileImage); ?>" />
            </div>
            <div id="followersCounter">
                <a href="network.php?user=<?php echo $_GET['user']; ?>&side=followers">
                    <p><?php echo $dbh->getFollowersNumber($_GET['user']); ?></p>
                    <p>Followers</p>
                </a>
            </div>
            <div id="followingCounter">
                <a href="network.php?user=<?php echo $_GET['user']; ?>&side=following">
                    <p><?php echo $dbh->getFollowingNumber($_GET['user']); ?></p>
                    <p>Following</p>
                </a>
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
                <div id="editProfileContainer">
                    <a href="edit_profile.php" id="editButton" data-user="<?php echo $_SESSION["username"]; ?>" >
                        Edit Profile
                    </a>
                    <a href="logout.php" id="logOut">
                        log out
                    </a>
                </div>
            <?php else: ?>
                <div id="followButtonContainer">
                    <a href="#" id="followButton" data-user="<?php echo $_GET["user"]; ?>"><?php if($dbh->isFollowing($_SESSION["username"], $_GET["user"])): ?>Unfollow<?php else: ?>Follow<?php endif; ?></a>
                </div>
            <?php endif; ?>
        <div>
    </div>

    <div id="postsContainer">
        <section>
            <?php
                $userPosts = $dbh->getUserPosts($_GET["user"]);
                if(empty($userPosts)) {
                    echo "<p> Nessun post da mostrare. </p>";
                }
                foreach ($userPosts as $post) {
                    include "post_content.php";
                }
            ?>
        </section>
    </div>
</div>