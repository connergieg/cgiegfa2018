<?php

$deck = array();

function getHand() {
    global $deck;
    $suits = array("clubs","spades","hearts","diamonds");
    
    for ($i = 0; $i < 4; $i++){
        for ($u = 1; $u <= 13; $u++){
            $deck[] = $suits[$i] . " " . $u;
        }
    }
    
    $totalPoints = 0;
    
    while($totalPoints < 36){
        if($totalPoints > 42){ // Break if player's points exceed 42.
            break;
        }
        $randomCard = rand(0,51);
        
        $substring = substr($deck[$randomCard], 0, strpos($deck[$randomCard], ' '));
        $substring2 = substr($deck[$randomCard], (strpos($deck[$randomCard], ' ') + 1), strlen($deck[$randomCard]));
        
        echo "<img class='cards' src='cards/$substring/$substring2.png'/>";
        
        $totalPoints += $randomCard % 13 + 1;
        echo $totalPoints . " ";
    }
    
}

function printCard(){
    for($i = 0; $i < 52; $i++){
        global $deck;
        $substring = substr($deck[$i], 0, strpos($deck[$i], ' '));
        $substring2 = substr($deck[$i], (strpos($deck[$i], ' ') + 1), strlen($deck[$i]));
    }
}

?>