<?php

    function displayArray(){
        global $symbols;
        
        echo "<hr>";
        print_r($symbols);
        
        for ($i=0; $i < count($symbols); $i++ ) {   // count() returns the size of the array
             
            echo $symbols[$i] . ", ";
        }
        
    }
    
    $symbols = array("seven");
    print_r($symbols); //displays array content
    
    
    $points = array("orange"=>250, "cherry"=> 500);
    //echo $points["cherry"]; //displays 500
    $points["seven"] = 1000;
    
    
    array_push($symbols,"orange","grapes"); //adds element(s) to the end of the array
    print_r($symbols); //displays array content
    
    $symbols[] = "cherry";  //adds element to the end of the array
    //print_r($symbols);
    displayArray();
    
    sort($symbols);
    displayArray();
    
    rsort($symbols);
    displayArray();
    
    unset($symbols[2]); //removes an element in the array
    displayArray();
    
    $symbols = array_values($symbols); //re-indexes elements in an array
    displayArray();
    
    shuffle($symbols);
    displayArray();
    
    echo "<hr>";
    
    //echo "Random item: " . $symbols[ rand(0, count($symbols)- 1)];  //displays random item
    
    //echo "Random item: " . $symbols[ array_rand($symbols) ]; //displays random item


    $indexes = array();

    for ($i = 0; $i < 3; $i++) {
        
        $indexes[] = $symbols[ array_rand($symbols) ];
        echo "<img src='../lab2/img/" . $indexes[$i] . ".png'>"; //displays random item
    }
    
    echo "<hr>";
    print_r($indexes);
    
    if ($indexes[0] == $indexes[1] && $indexes[1] == $indexes[2]) {
        
        echo "Congrats!! You won "  . $points[ $symbols[ $indexes[0] ] ] . " points!!";
        
    }


?>


<!DOCTYPE html>
<html>
    <head>
        <title> Review: Arrays </title>
    </head>
    <body>

    </body>
</html>