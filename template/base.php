<?php
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $templateParams["title"]; ?></title>
    <?php 
        if(isset($templateParams["design"])){
            foreach($templateParams["design"] as $css){
                echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"".$css."\" />";
            }
        }
    ?>
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>
<body>
    <header id="mainHeader">
        <?php echo $templateParams["title"] ?>
    </header>

    <?php require($templateParams["content"]); ?>

    <?php
    if($templateParams["nav"] == true){
        require("template/html/navbar.php");
    }
    ?>
    
</body>
</html>