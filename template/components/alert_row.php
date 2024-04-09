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
        echo "<a href='profile.php?user=".$alert["sender"]."'>".$alert["sender"]." </a>";
        switch ($alert["type"]) {
            case 'LIKE_POST':
                echo "<span>liked your post </span>";
                echo "<a class='elementBtn' href='#".$alert["idElement"]."'>show</a>";
                break;
            case 'LIKE_COMMENT':
                echo "<span>liked your comment</span>";
                echo "<a class='elementBtn' href='#".$alert["idElement"]."'>show</a>";
                break;
            case 'COMMENT_POST':
                echo "<span>commented on your post</span>";
                echo "<a class='elementBtn' href='#".$alert["idElement"]."'>show</a>";
                break;
            case 'COMMENT_COMMENT':
                echo "<span>replied to your comment</span>";
                echo "<a class='elementBtn' href='#".$alert["idElement"]."'>show</a>";
                break;
            case 'FOLLOW':
                echo "<span>followed you</span>";
                break;
            default:
                echo "<span>alert error: type not found</span>";
                break;
        }
        echo "<a class='deleteBtn' href='#' alert-id=".$alert["idElement"]." alert-receiver=".$alert["receiver"].">delete</a>";
    echo "</li>";
?>