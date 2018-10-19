<?php
    session_start();
    
    if (isset($_POST["removeBtn"])) {
        unset($_SESSION["scart"]);
        $_SESSION["scart"] = array();
        header("Location: index.php");
    }
    
    $subtotal = 0;
    if (!empty($_SESSION["scart"])) {
        $i = 0;
        foreach ($_SESSION["scart"] as $item) {
            echo $item['name'] . " <img src='".$item['image']."' width='100'>";
            echo "$".$item['price'];
            echo "<br>";
            $subtotal += $item['price'];
            $i++;
        }
        echo "<form class='button' method='POST'>
            <input type='submit' name='removeBtn' value='Empty'>
            </form><br>";
        echo "Subtotal: $$subtotal<br>";
    }
    
    print_r($_SESSION["scart"]);
    
    // session_unset();
    // session_destroy();
?>

<!DOCTYPE html>
<html>
    <head>
        <title> </title>
        <link rel="stylesheet" href="css/styles.css" type="text/css" />
    </head>
    <body>

    </body>
</html>