<ul id="alertsContainer"> 
    <?php
        $alerts = $dbh->getAlerts($_SESSION["username"]);
        foreach($alerts as $alert){
            echo "<li>";
                echo "<a href='profile.php?user=".$alert["sender"]."'>".$alert["sender"]." </a>";
                echo "<p>".$alert["type"]."</p>";
                // echo <a post ref>
                echo "<a class='readtBtn' href='#' data-user=".$alert["username"].">Delete</a>";
            echo "</li>";
        }
    ?>
</ul>