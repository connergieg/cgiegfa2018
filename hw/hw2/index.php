<?php
    include "inc/functions.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Higher Sum Wins All</title>
        <link href="css/styles.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Paytone+One" rel="stylesheet">
    </head>
    <body>
        <header>
            <h2>Higher Sum Wins All</h2>
        </header>
        
        <hr>
        
        <div id="main">
            <?php
                $playerSums = array();
                for ($i = 0; $i < 2; $i++) {
                    if ($i == 0) {
                        $player = "red";
                    } else {
                        $player = "blue";
                    }
                    echo "<h3 class='$player'>Player " . ($i+1) . "</h3>";
                    $sum = getPlayerSum($player);
                    array_push($playerSums, $sum);
                }
            ?>
        </div>
        
        <div id="winnerPts">
            <?php
                displayWinnerPts($playerSums);
            ?>
        </div>
        
        <hr>
        <footer>
            <figure id="csumbLogo">
                <a href="https://csumb.edu/"><img src="../../img/csumb_logo.png" alt="CSUMB logo"></a>
            </figure>
            <div id="footerText">
                CST336 Internet Programming. 2018&copy; Gieg <br>
                <strong>Disclaimer:</strong> The information in this page 
                is fictitous. <br>
                It is used for academic purposes only. <br>
            </div>
        </footer>
    </body>
</html>