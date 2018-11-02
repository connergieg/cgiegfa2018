<?php
    session_start();
    // print_r($_SESSION["shopHist"]);
    // echo "<br>";
    
    function displayShopHist() {
        $i = 1;
        foreach ($_SESSION["shopHist"] as $item) {
            foreach ($item as $info) {
                if ($i == 1) {
                    echo "<tr>";
                }
                echo "<td><img src='".$info["image"]."'>";
                echo $info["name"]." $";
                echo $info["price"]."</td>";
                if ($i % 5 == 0) {
                    echo "</tr>";
                }
                // echo $i;
                $i++;
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title> </title>
        <link rel="stylesheet" href="css/styles.css" type="text/css" />
    </head>
    
    <body>
        <?php
            if (!empty($_SESSION["shopHist"])) {
        ?>
        <div class="main2">
            <form method="POST" id="clearHist" action="index.php">
                <input type="submit" name="clearHist" value="Clear History">
            </form>
            
            <table class="cart">
                <?= displayShopHist(); ?>
            </table>
        </div>
        <?php
            } else {
                echo "<div class='main2 noHistory'>
                <h1>Purchase history is empty</h1>
                </div>";
            }
        ?>
    </body>
</html>