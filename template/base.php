<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $templateParams["title"]; ?></title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Load all design files -->
    <?php 
        if(isset($templateParams["design"])){
            foreach($templateParams["design"] as $css){
                echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"".$css."\" />";
            }
        }
    ?>
    <!-- Load all script files -->
    <?php 
        if(isset($templateParams["script"])){
            foreach($templateParams["script"] as $js){
                echo "<script src=\"".$js."\"></script>";
            }
        }
    ?>
    
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>
<body>
    <header id="mainHeader">
        <?php
            if($templateParams["title"] == "Profile") {
                echo "<span>" . $_GET["user"] . "</span>";
            } else {
                echo "<span>" . $templateParams["title"] . "</span>";
            }
        ?>
    </header>

    <?php 
        require($templateParams["content"]); 
    ?>

    <?php
        if($templateParams["nav"] == true){
            require("template/components/navbar.php");
        }
    ?>

    <footer id="mainFooter">
    </footer>
    
</body>
</html>