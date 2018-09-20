<?php
    function play() {
        $randNums = array();
        for ($i = 1; $i < 4; $i++) {
            $randNum = rand(0, 3);
            displaySymbol($randNum, $i);
            array_push($randNums, $randNum);
        }
        displayPoints($randNums[0], $randNums[1], $randNums[2]);
    }
    
    function displaySymbol($num, $pos) {
        switch($num) {
            case 0:
                $symbol = "seven";
                break;
            case 1:
                $symbol = "cherry";
                break;
            case 2:
                $symbol = "lemon";
                break;
            case 3:
                $symbol = "grapes";
                break;
        }
        
        echo "<img src='img/$symbol.png' id='reel$pos' alt='$symbol' width='70'>";
    }
    
    function displayPoints($num1, $num2, $num3) {
        echo "<div id='output'>";
        $jackpot = false;
        if ($num1 == $num2 && $num2 == $num3) {
            switch($num1) {
                case 0:
                    $totalPoints = 1000;
                    echo "<h1> Jackpot! </h1>";
                    $jackpot = true;
                    break;
                case 1:
                    $totalPoints = 750;
                    break;
                case 2:
                    $totalPoints = 250;
                    break;
                case 3:
                    $totalPoints = 100;
                    break;
            }
            if ($jackpot) {
                echo "<audio autoplay> <source src='jackpot.mp3' type='audio/mpeg'> </audio>";
            }
            echo "<h3> You won $totalPoints points!</h3>";
        } else {
            echo "<h3> Try Again! </h3>";
        }
        echo "</div>";
    }
?>