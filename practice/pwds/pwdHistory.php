<?php
    session_start();
    
    // print_r($_SESSION["pwd_history"]);
    function displayPwdTable() {
        foreach ($_SESSION["pwd_history"] as $value) {
            echo "<tr>";
            $i = 0;
            foreach ($value as $item) {
                if ($i == 4) {
                    $i = 0;
                    echo "<tr>";
                }
                echo "<td>$item</td>";
                $i++;
            }
            // echo 4-$i;
            for ($j = 0; $j < 4-$i; $j++) {
                echo "<td></td>";
            }
            // echo "<td>PWD</td>";
            // echo "<td>PWD</td>";
            // echo "<td>PWD</td>";
            // echo "<td>PWD</td>";
            echo "</tr>";
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <style>
            body {
                text-align: center;
                background-color: #FFE6F9;
            }
            table {
                margin: 0 auto;
                width: 700px;
                border: 1px solid black;
            }
            tr, td {
                border: 1px solid black;
            }
        </style>
    </head>
    
    <body>
        <h1>Password History</h1>
        <table>
            <?= displayPwdTable() ?>
        </table>
        
        <br>
        <form action="index.php">
            <input type="submit" value="Generate more passwords">
        </form>
    </body>
</html>