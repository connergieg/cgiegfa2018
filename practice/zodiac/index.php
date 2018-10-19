<?php
    function displayYearList() {
        for ($i = 1500; $i <= 2000; $i++) {
            echo "<li>Year $i</li>";
        }
    }
    function displayYearList2() {
        for ($i = 1500; $i <= 2000; $i++) {
            echo "<li>Year $i";
            if ($i == 1776) {
                echo " <strong>USA INDEPENDENCE</strong>";
            }
            echo "</li>";
        }
    }
    function displayYearList3() {
        for ($i = 1500; $i <= 2000; $i++) {
            echo "<li>Year $i";
            if ($i % 100 == 0) {
                echo " <strong>Happy New Century!</strong>";
            }
            echo "</li>";
        }
    }
    function displayYearList4($start, $end) {
        for ($i = $start; $i <= $end; $i++) {
            echo "<li>Year $i";
            if ($i % 100 == 0) {
                echo " <strong>Happy New Century!</strong>";
            }
            echo "</li>";
        }
    }
    function displayYearList5($rows, $cols, $start) {
        $animals = array("rat", "ox", "tiger", "rabbit", "dragon", "snake", "horse", "goat", "monkey", "rooster", "dog", "pig");
        $index = 0;
        for ($i = 0; $i < $rows; $i++) {
            echo "<tr>";
            for ($j = 0; $j < $cols; $j++) {
                echo "<td>";
                echo "Year $start";
                $start++;
                echo "<img src='img/$animals[$index].png'>";
                $index++;
                if ($index == 11) {
                    $index = 0;
                }
                echo "</td>";
            }
            echo "<tr>";
        }
    }
    function getYearSum($start, $end) {
        $total = 0;
        for ($i = $start; $i <= $end; $i++) {
            $total += $i;
        }
        return $total;
    }
    function displayImageYear($start, $end) {
        $animals = array("rat", "ox", "tiger", "rabbit", "dragon", "snake", "horse", "goat", "monkey", "rooster", "dog", "pig");
        $index = 0;
        for ($i = $start; $i <= $end; $i++) {
            echo "<li>Year $i</li>";
            echo "<img src='img/$animals[$index].png'>";
            $index++;
            if ($index == 11) {
                $index = 0;
            }
        }
    }
    function displayOlympicYear($start, $end) {
        $animals = array("rat", "ox", "tiger", "rabbit", "dragon", "snake", "horse", "goat", "monkey", "rooster", "dog", "pig");
        $index = 0;
        for ($i = $start; $i <= $end; $i++) {
            if ($i % 4 == 0) {
                echo "<li>Year $i</li>";
                echo "<img src='img/$animals[$index].png'>";
                $index++;
                if ($index == 11) {
                    $index = 0;
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title> </title>
        <style>
        
        </style>
    </head>
    <body>
        <h1>Year List</h1>
        <!--<ul>-->
        <!--    <?php //displayYearList() ?>-->
        <!--</ul>-->
        
        <!--<ul>-->
        <!--    <?php //displayYearList2() ?>-->
        <!--</ul>-->
        
        <!--<ul>-->
            <?php //displayYearList3() ?>
        <!--</ul>-->
        
        <!--<ul>-->
            <?php //displayYearList4(1500, 2000) ?>
        <!--</ul>-->
        
        <!--<ul>-->
            <?php
                    //displayYearList4(1500, 2000);
                    // echo "<h2>Year Sum: ".getYearSum(1500, 2000)."</h2>";
            ?>
        <!--</ul>-->
        
        <!--<ul>-->
            <?php //displayImageYear(1900, 2000) ?>
        <!--</ul>-->
        
        <!--<ul>-->
            <?php //displayOlympicYear(1904, 2000) ?>
        <!--</ul>-->
        
        <!--<form>-->
            <?php 
            // if (isset($_GET["submit"])) {
            //     echo "<ul>";
            //     displayOlympicYear($_GET["start"], $_GET["end"]);
            //     echo "</ul>";
            // }
             ?>
            <!--Start Year: <input type="text" name="start">-->
            <!--End Year: <input type="text" name="end">-->
            <!--<input type="submit" name="submit" value="Submit">-->
        <!--</form>-->
        
        <form>
            Number of rows: <input type="text" name="rows"> <br>
            Number of cols: <input type="text" name="cols"> <br>
            <input type="submit" name="submit" value="Submit">
        </form>
        
        <table>
            <?php displayYearList5($_GET["rows"], $_GET["cols"], 1500) ?>
        </table>
    </body>
</html>