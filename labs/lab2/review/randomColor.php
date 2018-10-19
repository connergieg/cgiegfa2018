<?php
    function getLuckyNumber() {
        do {
            $lucky = rand(1, 10);
        } while ($lucky == 4);
        
        echo $lucky;
    }
    
    function getRandomColor() {
        echo "rgba(".rand(0,255).",".rand(0,255).",".rand(0,255).",".(rand(0,10)/10).");";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Lucky Number </title>
        <style>
                
            body {
                background-color: <?= getRandomColor(); ?>
            }
            
            h1 {
                background-color: <?= getRandomColor(); ?>
            }
        
            h2 {
                background-color: <?= getRandomColor(); ?>
            }
        </style>
    </head>
    <body>

        <h1> My lucky number is <?= getLuckyNumber(); ?> </h1>
        
        <h2> My second lucky number is <?= getLuckyNumber(); ?> </h2>
    
    </body>
</html>