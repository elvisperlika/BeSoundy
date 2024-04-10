<?php
    echo "<li>";
        echo "<span>";
        $time = $alert["time"];
        $current_time = time();
        $time_diff = $current_time - strtotime($time);
        if ($time_diff < 60) {
            echo $time_diff . " seconds ago";
        } elseif ($time_diff < 3600) {
            echo floor($time_diff / 60) . " minutes ago";
        } elseif ($time_diff < 86400) {
            echo floor($time_diff / 3600) . " hours ago";
        } else {
            echo floor($time_diff / 86400) . " days ago";
        }
        echo "</span>";
        echo "<a href='profile.php?user=".$alert["sender"]."'>".$alert["sender"]."</a>";
        switch ($alert["type"]) {
            case 'LIKE_POST':
                echo "<span>liked your post </span>";
                break;
            case 'LIKE_COMMENT':
                echo "<span>liked your comment in this post</span>";
                break;
            case 'COMMENT_POST':
                echo "<span>commented on your post</span>";
                break;
            case 'COMMENT_COMMENT':
                echo "<span>replied to your comment in this post</span>";
                break;
            case 'FOLLOW':
                echo "<span>followed you</span>";
                break;
            default:
                echo "<span>alert error: type not found</span>";
                break;
        }
        if($alert["type"] != 'FOLLOW') {
            $post = $dbh->getPostByElementIdAndType($alert["idElement"], $alert["type"]);
            echo "<a href='singlePost.php?post=".$post['idPost']."'>";
                echo "<img src='data:image/jpeg;base64,".base64_encode($post['image'])."'/>";  
            echo "</a>";
        }
        echo "<a class='deleteBtn' href='#' alert-id=".$alert["idElement"]." alert-receiver=".$alert["receiver"].">delete</a>";
    echo "</li>";
?>