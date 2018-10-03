<?php
    session_start();
    $startSec = microtime(true);
    function getDeck() {
        $deck = array();
        $suits = array("clubs","spades","hearts","diamonds");
        for ($i = 0; $i < 4; $i++){
            for ($u = 1; $u <= 13; $u++){
                $deck[] = $suits[$i] . " " . $u;
            }
        }
        return $deck;
    }
    function displayHands($deck) {
        $randInd = range(0, 3);
        $names = array("Player 1: Sophisticated Moose", "Player 2: Fancy Bear", "Player 3: Derped Unicorn", "Player 4: Cool Spaceman");
        $players = array("Player 1: Sohpisticated Moose" => 0, "Player 2: Fancy Bear" => 0, "Player 3: Derped Unicorn" => 0, "Player 4: Cool Spaceman" => 0);
        
        shuffle($randInd);
        
        for ($i = 0; $i < 4; $i++) {
            $playerTotal = 0;
            if ($names[$randInd[$i]] == "Player 1: Sophisticated Moose") {
                echo "<div class='p1'>
                <img class='profile' src='img/moose.png' alt='Moose'>
                <h3>Player 1:Sophisticated Moose</h3>
            </div>";
            }
            else if ($names[$randInd[$i]] == "Player 2: Fancy Bear") {
                echo "<div class='p2'>
                <img class='profile' src='img/bear.png' alt='Bear'>
                <h3>Player 2:Fancy Bear</h3>
            </div>";
            }
            else if ($names[$randInd[$i]] == "Player 3: Derped Unicorn") {
                echo "<div class='p3'>
                <img class='profile' src='img/unicorn.png' alt='Unicorn'>
                <h3>Player 3:Derped Unicorn</h3>
            </div>";
            }
            else {
                echo "<div class='p4'>
                <img class='profile' src='img/spaceman.png' alt='Spaceman'>
                <h3>Player 4:Cool Spaceman</h3>
            </div>";
            }
            while ($playerTotal <= 35) {
                shuffle($deck);
                $card = array_pop($deck);
                $card_suit = substr($card, 0, strpos($card, " "));
                $card_val = intval(substr($card, (strpos($card, ' ') + 1), strlen($card)));
                echo "<img src='cards/$card_suit/" . $card_val . ".png'>";
                $playerTotal += $card_val;
            }
            $players[$names[$randInd[$i]]] = $playerTotal;
            echo $players[$names[$randInd[$i]]] . "<br>";
        }
        
        return $players;
    }
    function displayWinners($players) {
        $winners = array();
        $check = false;
        foreach ($players as $key => $value) {
            if ($value == 42) {
                $check = true;
                break;
            }
        }
        if (!$check) {
            $min = min($players);
        } else {
            $min = 42;
        }
        foreach($players as $key => $value) {
            if ($value >= $min && $value <= 42) {
                $min = $value;
            }
        }
        $winnerTotal = 0;
        foreach($players as $key => $value) {
            if ($min == $value && $min <= 42) {
                array_push($winners, $key);
            }
            else if ($min <= 42) {
                $winnerTotal += $value;
            }
        }
        if (count($winners) == 0) {
            echo "Nobody wins";
        }
        else {
            if (count($winners) == 1) {
                echo "<h3>" . $winners[0] . " wins </h3>";
            }
            else {
                for ($i = 0; $i < count($winners)-1; $i++) {
                    echo "<h3>" . $winners[$i] . "," . "</h3>";
                }
                echo "<h3>" . $winners[count($winners)-1] . " win ";
            }
            echo "<h3>" . $winnerTotal . " points!</h3>";
        }
        echo "<br>";
    }
    function displayElapsedTime() {
        global $startSec;
        echo "<h3>Elapsed Time: </h3>";
        $elapsedTime = microtime(true) - $startSec;
        echo "<h3>$elapsedTime</h3>";
        echo "<br>";
        if (!isset($_SESSION["avgSec"])) {
            $_SESSION["avgSec"] = $elapsedTime;
        }
        else {
            $_SESSION["avgSec"] += $elapsedTime;
        }
        if (!isset($_SESSION["gameCount"])) {
            $_SESSION["gameCount"] = 1;
        }
        else {
            $_SESSION["gameCount"]++;
        }
        echo "<h3>Avg Elapsed Time: </h3>";
        echo "<h3>" . $_SESSION["avgSec"]/$_SESSION["gameCount"] . "</h3>";
        echo "<br>";
        echo "<h3># of games played: </h3>";
        echo "<h3>" . $_SESSION["gameCount"] . "</h3>";
    }
?>
