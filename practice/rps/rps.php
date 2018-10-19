<?php
    function decideMatchWinner() {
        $counter1 = 0;
        $counter2 = 0;
        $player1 = rand(0, 2);
        $player2 = rand(0, 2);
        
        while ($player1 == $player2) {
            $player1 = rand(0, 2);
            $player2 = rand(0, 2);
        }
        
        if ($player1 == 0 && $player2 == 1) {
            $symbol1 = "rock";
            $symbol2 = "paper";
            $matchWinner1 = "";
            $matchWinner2 = "matchWinner";
            $counter2++;
        }
        else if ($player1 == 0 && $player2 == 2) {
            $symbol1 = "rock";
            $symbol2 = "scissors";
            $matchWinner1 = "matchWinner";
            $matchWinner2 = "";
            $counter1++;
        }
        else if ($player1 == 1 && $player2 == 0) {
            $symbol1 = "paper";
            $symbol2 = "rock";
            $matchWinner1 = "matchWinner";
            $matchWinner2 = "";
            $counter1++;
        }
        else if ($player1 == 1 && $player2 == 2) {
            $symbol1 = "paper";
            $symbol2 = "scissors";
            $matchWinner1 = "";
            $matchWinner2 = "matchWinner";
            $counter2++;
        }
        else if ($player1 == 2 && $player2 == 0) {
            $symbol1 = "scissors";
            $symbol2 = "rock";
            $matchWinner1 = "";
            $matchWinner2 = "matchWinner";
            $counter2++;
        }
        else if ($player1 == 2 && $player2 == 1) {
            $symbol1 = "scissors";
            $symbol2 = "paper";
            $matchWinner1 = "matchWinner";
            $matchWinner2 = "";
            $counter1++;
        }
        
        echo "<div class='col $matchWinner1'><img src='img/$symbol1.png' alt='$symbol1' width='150'></div>";
        echo "<div class='col $matchWinner2'><img src='img/$symbol2.png' alt='$symbol2' width='150'></div>";
        
        if ($counter1 > $counter2) {
            return "player1";
        } else {
            return "player2";
        }
    }
    
    function decideFinalWinner($counter1, $counter2) {
        if ($counter1 > $counter2) {
            return "Player 1";
        } else {
            return "Player 2";
        }
    }
?>

<!DOCTYPE html>
<html>

<head>
    <title> RPS </title>
    <style type="text/css">
        body {
            background-color: black;
            color: white;
            text-align: center;
        }

        .row {
            display: flex;
            justify-content: center;
        }

        .col {
            text-align: center;
            margin: 0 70px;
        }

        .matchWinner {
            background-color: yellow;
            margin: 0 70px;
        }

        #finalWinner {
            margin: 0 auto;
            width: 500px;
            text-align: center;
        }
        
        hr {
            width:33%;
        }        
    </style>
</head>

<body>

    <h1> Rock, Paper, Scissors </h1>

    <div class="row">
        <div class="col">
            <h2>Player 1</h2>
        </div>
        <div class="col">
            <h2>Player 2</h2>
        </div>
    </div>

    <?php
        $counter1 = 0;
        $counter2 = 0;
        
        for ($i = 0; $i < 3; $i++) {
            echo "<div class='row'>";
            if (decideMatchWinner() == "player1") {
                $counter1++;
            } else {
                $counter2++;
            }
            echo "</div>";
            echo "<hr>";
        }
        
        $finalWinner = decideFinalWinner($counter1, $counter2);
    ?>

    <div id="finalWinner">
        <h1> <?php echo $finalWinner ?> wins </h1>
    </div>
    
    <a href="https://www.kisspng.com/png-rockpaperscissors-game-money-4410819/">Image source</a>
</body>

</html>
