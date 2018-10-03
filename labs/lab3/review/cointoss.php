<?php
    session_start();
    // session_unset();
    // session_destroy();
    
    if (!isset($_SESSION["heads"])) {
        $_SESSION["heads"] = 0;
        $_SESSION["tails"] = 0;
        $_SESSION["tossHistory"] = array();
    }
    
    $randNum = rand(0, 1);
    
    if ($randNum == 0) {
        $_SESSION["heads"]++;
        $_SESSION["tossHistory"][] = "H "; //adds element to the array
    } else {
         $_SESSION["tossHistory"][] = "T "; //adds element to the array
    }
    print_r($_SESSION["tossHistory"]);
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Coin Flipping </title>
    </head>
    <body>
        <h2> Heads: <?= $_SESSION['heads'] ?>  </h2>
        
        <h2> Tails: <?= $_SESSION['tails'] ?> </h2>
    </body>
</html>