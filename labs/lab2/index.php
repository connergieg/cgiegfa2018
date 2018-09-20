<?php
    include "inc/functions.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <title> 777 Slot Machine </title>
        <link href="css/styles.css" rel="stylesheet">
    </head>
    <body>
        
        <div id="main">
            <?php
                play();
            ?>
            
            <form>
                <input type="submit" value="Spin">
            </form>
        </div>
        
    </body>
</html>