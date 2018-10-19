<?php
    function getLuckyNumber() {
        do {
            $lucky = rand(1, 10);
        } while ($lucky == 4);
        
        echo $lucky;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Lucky Number </title>
        <style>
        
        </style>
    </head>
    <body>

        <h1> My lucky number is <?= getLuckyNumber(); ?> </h1>
        
        <h2> My second lucky number is <?= getLuckyNumber(); ?> </h2>
    
    </body>
</html>