<?php
    function getPlayerPoints() {
        $dice = range(1, 6);
        $playerPoints = array();
        for ($i = 0; $i < 5; $i++) {
            shuffle($dice);
            array_push($playerPoints, $dice[rand(0, count($dice)-1)]);
        }
        
        return $playerPoints;
    }
    
    function getPlayerSum($color) {
        $playerTotal = 0;
        $player = getPlayerPoints();
        
        for ($i = 0; $i < count($player); $i++) {
            $playerTotal += $player[$i];
            echo "<img src='img/die$player[$i].png'>" . " ";
        }
        echo "<h3 class='$color'>$playerTotal</h3>";
        echo "<br>";
        return $playerTotal;
    }
    
    function displayWinnerPts($playerSums) {
        if ($playerSums[0] != $playerSums[1]) {
            $winnerPoints = $playerSums[0] + $playerSums[1];
            if ($playerSums[0] > $playerSums[1]) {
                $player = "Player 1 ";
                $color = "red";
            }
            else {
                $player = "Player 2 ";
                $color = "blue";
            }
            
            echo "<h2 class='$color result'>$player wins $winnerPoints points</h2>";
        } else {
            echo "<h2 class='tie result'>Tie</h2>";
        }
    }
?>