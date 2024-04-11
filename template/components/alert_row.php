<?php
    echo "<li>";
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