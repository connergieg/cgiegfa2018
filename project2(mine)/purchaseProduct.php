<?php
    session_start();
    include "dbConnection.php";
    $dbConn = getDatabaseConnection("sports");
    
    for ($j = 0; $j < count($_SESSION["scart"]); $j++) {
        $_SESSION["scart"][$j]["quant"] = $_POST["quant".$j];
        
        $sql = "UPDATE sports_purchase
                SET quantity = quantity + ".$_SESSION["scart"][$j]["quant"].
                " WHERE playerId = ".$_SESSION["scart"][$j]["id"];
        // echo $sql."<br>";
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
    }
    
    // $sql = "UPDATE sports_purchase
    //         SET quantity = 0;";
    // $stmt = $dbConn->prepare($sql);
    // $stmt->execute();
    
    session_unset();
    session_destroy();
    header("Location: index.php");
    print_r($_SESSION["scart"]);
?>