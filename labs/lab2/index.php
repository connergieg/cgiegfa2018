<?php
    function displaySymbol($num, $pos) {
        switch($num) {
            case 0:
                $symbol = "cherry";
                break;
            case 1:
                $symbol = "grapes";
                break;
            case 2:
                $symbol = "lemon";
                break;
            case 3:
                $symbol = "seven";
                break;
        }
        
        echo "<img src='img/$symbol.png' id='reel$pos' alt='$symbol' width='70'>";
    }
    
    function displayPoints($num1, $num2, $num3) {
        echo "<div id='output'>";
        if ($num1 == $num2 && $num2 == $num3) {
            switch($num1) {
                case 0:
                    $totalPoints = 1000;
                    echo "<h1> Jackpot </h1>";
                    break;
                case 1:
                    $totalPoints = 500;
                    break;
                case 2:
                    $totalPoints = 250;
                    break;
                case 3:
                    $totalPoints = 100;
                    break;
            }
            
            echo "<h3> You won $totalPoints! </h3>";
        } else {
            echo "<h3> Try Again! </h3>";
        }
        echo "</div>";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title> 777 Slot Machine </title>
        <link href="css/styles.css" rel="stylesheet">
    </head>
    <body>
        
        <?php
            echo "<div id='main'>";
            
            $randNums = array();
            for ($i = 1; $i < 4; $i++) {
                $randNum = rand(0, 3);
                displaySymbol($randNum, $i);
                array_push($randNums, $randNum);
            }
            displayPoints($randNums[0], $randNums[1], $randNums[2]);
            
            echo "<form>";
            echo "<input type='submit' value='Spin'>";
            echo "</form>";
            
            echo "</div>";
        
        ?>
        
    </body>
</html>