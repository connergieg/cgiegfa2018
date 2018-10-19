<?php
    $suits = array("hearts", "spades", "clubs", "diamonds");
    $deck = array();
    
    for ($i = 0; $i < 4; $i++) {
        for ($j = 1; $j <= 13; $j++) {
            array_push($deck, $suits[$i]."/".$j);
        }
    }
    // print_r($deck);
    
    function selectOption($suit) {
        if ($_GET["suit"] == $suit) {
            echo "selected";
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title> </title>
        <style>
        form, h3, #results {
            text-align: center;
        }
        .ace {
            border: 3px solid #ffff00;
        }
        .king {
            border: 3px solid #00ffff;
        }
        .center {
            margin-left: auto;
            margin-right: auto;
        }
        </style>
    </head>
    <body>
        <form>
            Number of rows: <input type="text" name="rows" value="<?=$_GET['rows']?>"> <br>
            Number of columns: <input type="text" name="cols" value="<?=$_GET['cols']?>"> <br>
            Suit to omit:
            <select name="suit">
                <option <?=selectOption("Hearts")?>>Hearts</option>
                <option <?=selectOption("Spades")?>>Spades</option>
                <option <?=selectOption("Clubs")?>>Clubs</option>
                <option <?=selectOption("Diamonds")?>>Diamonds</option>
            </select> <br>
            <input type="submit" name="submit" value="Submit">
        </form>
        
        <table class="center">
            <?php
                if (isset($_GET["submit"])) {
                    $check = false;
                    if (empty($_GET["rows"]) || empty($_GET["cols"])) {
                        $check = true;
                        echo "<h3>Please enter # of: ";
                        if (empty($_GET["rows"])) {
                            echo " rows";
                        }
                        if (empty($_GET["cols"])) {
                            echo " cols";
                        }
                    }
                    if ($_GET["rows"] * $_GET["cols"] > 39) {
                        $check = true;
                        echo "<h3>Error dimensions too high! Lower them</h3>";
                    }
                    else {
                        $i = 0;
                        foreach ($deck as $card) {
                            $length = strlen($card) - strlen(substr($card, strpos($card, "/")));
                            $suit = substr($card, 0, $length);
                            if ($suit == lcfirst($_GET["suit"])) {
                                unset($deck[$i]);
                            }
                            $i++;
                        }
                        $deck = array_values($deck);
                        // print_r($deck);
                        $aceCount = 0;
                        $kingCount = 0;
                    
                        for ($i = 0; $i < $_GET["rows"]; $i++) {
                            echo "<tr>";
                            for ($j = 0; $j < $_GET["cols"]; $j++) {
                                echo "<td>";
                                shuffle($deck);
                                $card = array_pop($deck);
                                $numCard = substr($card, (strpos($card, "/") + 1), strlen($card)-1);
                                if ($numCard == 1) {
                                    $suit = "ace";
                                    $aceCount++;
                                } else if ($numCard == 13) {
                                    $suit = "king";
                                    $kingCount++;
                                } else {
                                    $suit = "";
                                }
                                echo "<img class='$suit' src='cards/" . $card . ".png'>";
                                echo "</td>";
                            }
                            echo "</tr>";
                        }
                    }
                }
            ?>
        </table>
        
        <div id="results">
            <h2>
        <?php
            if (!$check) {
                if ($aceCount > $kingCount){
                echo "Aces Win!";
                } else if ($aceCount < $kingCount){
                    echo "Kings Win!";
                } else {
                    echo "Tie!";
                } 
                echo "<br>";
                echo "Total # of aces: " . $aceCount . "<br>";
                echo "Total # of kings: " . $kingCount . "<br>";
            }
        ?>
            </h2>
        </div>
    </body>
</html>