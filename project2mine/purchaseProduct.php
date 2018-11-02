<?php
    session_start();
    include "dbConnection.php";
    $dbConn = getDatabaseConnection("sports");
    
    if (isset($_POST["submit"])) {
        $_SESSION["purchaseItem"] = true;
    } else {
        if (!empty($_SESSION["scart"])) {
            header("Location: scart.php");
            exit();
        } else {
            header("Location: index.php");
            exit();
        }
    }
    
    if (isset($_SESSION["scart"])) {
        for ($j = 0; $j < count($_SESSION["scart"]); $j++) {
            $_SESSION["scart"][$j]["quant"] = $_POST["quant".$j];
            $_SESSION["scart"][$j]["price"] = $_SESSION["scart"][$j]["quant"] * $_SESSION["scart"][$j]["price"];
            
            $sql = "UPDATE sports_purchase
                    SET quantity = quantity + ".$_SESSION["scart"][$j]["quant"].
                    " WHERE playerId = ".$_SESSION["scart"][$j]["id"];
            // echo $sql."<br>";
            $stmt = $dbConn->prepare($sql);
            $stmt->execute();
        }
    }
    
    // print_r($_SESSION["scart"]);
    // echo "<br>";
    
    // $sql = "UPDATE sports_purchase
    //         SET quantity = 0;";
    // $stmt = $dbConn->prepare($sql);
    // $stmt->execute();
    
    if (isset($_SESSION["scart"])) {
        $_SESSION["subtotal"] = 0;
        foreach ($_SESSION["scart"] as $item) {
            $price = $item["price"];
            $_SESSION["subtotal"] += $price;
        }
    }
    $_SESSION["salestax"] = 0.0725*$_SESSION["subtotal"];
    $_SESSION["total"] = $_SESSION["salestax"] + $_SESSION["subtotal"];
    echo "Thank you for shopping with us!<br>Order Summary:<br>";
    echo "Subtotal: $".$_SESSION["subtotal"]."<br>";
    echo "Sales Tax: $".$_SESSION["salestax"]."<br>";
    echo "Total: $".$_SESSION["total"]."<br>";
    
    // add scart array to shopping history
    if (isset($_SESSION["scart"])) {
        array_push($_SESSION["shopHist"], $_SESSION["scart"]);
    }
    
    // print_r($_SESSION["shopHist"]);
    unset($_SESSION["scart"]);
    unset($_SESSION["ids"]);
?>