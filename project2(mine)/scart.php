<?php
    session_start();
    
     // print_r($_SESSION["scart"]);
     
    if (isset($_POST["removeBtn"])) {
        session_unset();
        session_destroy();
        header("Location: index.php");
    }
    
    // echo "<form class='button' method='POST'>
    // <input type='submit' name='removeBtn' value='Empty Cart'>
    // </form><br>";
    // echo "<form class='button' method='POST' action='purchaseProduct.php'>";
    
    function displayShopCart() {
        $subtotal = 0;
        if (!empty($_SESSION["scart"])) {
            echo "<input type='submit' name='submit' value='Purchase Product(s)'>";
            echo "</div><br>";
            echo "<table id='cart'>";
            $j = 0;
            foreach ($_SESSION["scart"] as $item) {
                echo "<tr>";
                for ($col = 0; $col < 2; $col++) {
                    if (isset($_SESSION["scart"][$j])) {
                        echo "<td>";
                        echo $_SESSION["scart"][$j]["name"]."</td><td><img src='".$_SESSION["scart"][$j]["image"]."' width='120'></td>";
                        echo "<td>$".$_SESSION["scart"][$j]["price"]."</td>";
                        echo "<td style='padding-left: 50px;padding-right:50px'>Quantity: <input type='number' name='quant$j' value='1'></td>";
                    }
                    $j++;
                }
                echo "</tr>";
                $subtotal += $item['price'];
            }
            $salestax = 0.0725*$subtotal;
            $total = $subtotal + $salestax;
            echo "<tr><td id='purchase' colspan='8' style='text-align: center;'>Subtotal: $$subtotal<br>
            Sales Tax: $$salestax<br>Total: $$total</td></tr>";
            echo "</table>";
        }
        echo "</form>";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title> </title>
        <link rel="stylesheet" href="css/styles.css" type="text/css" />
    </head>
    <body>
        <div>
        <form class="button" method='POST'>
            <input type='submit' name='removeBtn' value='Empty Cart'>
        </form>
        <form id="purchaseProd" class="button" method='POST' action='purchaseProduct.php'>
        <?= displayShopCart() ?>
    </body>
</html>