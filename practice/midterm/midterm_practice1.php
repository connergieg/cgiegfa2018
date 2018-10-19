<?php
    $usa = array("chicago.png", "hollywood.png", "las_vegas.png", "ny.png", "washington_dc.png", "yosemite.png");
    $mexico = array("acapulco.png", "cabos.png", "cancun.png", "chichenitza.png", "huatulco.png", "mexico_city.png");
    $france = array("bordeaux.png", "le_havre.png", "lyon.png", "montpellier.png", "paris.png", "strasbourg.png");
    
    function selectMonth($value) {
        if ($_GET["month"] == $value) {
            echo "selected";
        }
    }
    
    function selectNumLoc($value) {
        if ($_GET["numLocation"] == $value) {
            echo "checked";
        }
    }
    
    function selectCountry($value) {
        if ($_GET["country"] == $value) {
            echo "selected";
        }
    }
    
    function selectAlphaOrd($value) {
        if ($_GET["order"] == $value) {
            echo "checked";
        }
    }
    
    function validateForm() {
        $errors = array();
        $name = "error";
        if (empty($_GET["month"])) {
            array_push($errors, "<h3 class='$name'>You must select a month</h3>");
        }
        if (!isset($_GET["numLocation"])) {
            array_push($errors, "<h3 class='$name'>You must specify the # of locations</h3>");
        }
        return $errors;
    }
    
    function displayCalendar() {
        global $usa;
        global $mexico;
        global $france;
        switch ($_GET["month"]) {
            case "November":
                $days = 30;
                break;
            case "December":
                $days = 31;
                break;
            case "January":
                $days = 31;
                break;
            case "February":
                $days = 28;
                break;
        }
        switch ($_GET["country"]) {
            case "USA":
                $country_arr = $usa;
                $name = "USA";
                break;
            case "France":
                $country_arr = $france;
                $name = "France";
                break;
            case "Mexico":
                $country_arr = $mexico;
                $name = "Mexico";
                break;
        }
        $rows = $days/7;
        $calendar = array();
        for ($i = 0; $i < $days; $i++) {
            array_push($calendar, "");
        }
        
        $indices = range(0, count($calendar)-1);
        shuffle($indices);
        
        $sort_indices = array();
        $places = array();
        
        for ($i = 0; $i < $_GET["numLocation"]; $i++) {
            shuffle($country_arr);
            $place = array_pop($country_arr);
            $places[$i] = $place;
            $sort_indices[$i] = $indices[$i];
        }
        
        sort($sort_indices);
        if (isset($_GET["order"])) {
            if ($_GET["order"] == "az") {
                sort($places);
            } else {
                rsort($places);
            }
        }
        for ($i = 0; $i < $_GET["numLocation"]; $i++) {
            $calendar[$sort_indices[$i]] = $places[$i];
        }
        // print_r($sort_indices);
        // print_r($places);
        echo "<table>";
        $day = 0;
        for ($i = 0; $i < $rows; $i++) {
            echo "<tr>";
            for ($j = 0; $j < 7; $j++) {
                echo "<td>";
                if ($day < $days) {
                    echo $day+1 . "<br>";
                } else {
                    echo "";
                }
                if (!empty($calendar[$day])) {
                    echo "<img src='img/$name/".$calendar[$day]."'><br>";
                    echo substr($calendar[$day], 0, strlen($calendar[$day])-4);
                } else {
                    echo "";
                }
                echo "</td>";
                $day++;
            }
            echo "</tr>";
        }
        echo "</table>";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title> </title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <style>
            table, td, tr {
                border: 1px solid black;
            }
            td {
                width: 150px;
                height: 100px;
                padding: 0px;
            }
            table {
                margin: 0 auto;
                width: 80%;
            }
            h1 {
                text-align: center;
            }
            .wrapper {
                margin: 0 auto;
                text-align: center;
                font-size: 1.5em;
            }
            .error {
                color: red;
            }
        </style>
    </head>
    <body>
        <div class="jumbotron">
            <h1>Winter Vacation Planner</h1>
        </div>
        
        <div class="wrapper">
        <form>
            Month:
            <select name="month">
                <option value="">Select</option>
                <option <?=selectMonth("November")?>>November</option>
                <option <?=selectMonth("December")?>>December</option>
                <option <?=selectMonth("January")?>>January</option>
                <option <?=selectMonth("February")?>>February</option>
            </select><br>
            Number of locations: 
            <input type="radio" name="numLocation" value="3" id="three" <?=selectNumLoc("3")?>> 
            <label for="three">Three</label>
            <input type="radio" name="numLocation" value="4" id="four" <?=selectNumLoc("4")?>>
            <label for="four">Four</label>
            <input type="radio" name="numLocation" value="5" id="five" <?=selectNumLoc("5")?>>
            <label for="five">Five</label><br>
            Select Country:
            <select name="country">
                <option <?=selectCountry("USA")?>>USA</option>
                <option <?=selectCountry("Mexico")?>>Mexico</option>
                <option <?=selectCountry("France")?>>France</option>
            </select><br>
            Visit locations in alphabetical order: 
            <input type="radio" name="order" value="az" id="az" <?=selectAlphaOrd("az")?>>
            <label for="az">A-Z</label>
            <input type="radio" name="order" value="za" id="za" <?=selectAlphaOrd("za")?>>
            <label for="za">Z-A</label><br>
            <input type="submit" name="submit" value="Create Itinerary">
        </form>
        <hr>
        <?php
            if (isset($_GET["submit"])) {
                if (!empty(validateForm())) {
                    foreach (validateForm() as $error) {
                        echo $error;
                    }
                } else { ?>
                    <h1><?=$_GET["month"]?> Itinerary</h1>
                    <h3>Visiting <?=$_GET["numLocation"]?> places in <?=$_GET["country"]?></h3>
                <?php
                    displayCalendar();
                }
            }
        ?>
            
             
        </div>
    </body>
</html>