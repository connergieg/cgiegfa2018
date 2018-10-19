<?php
    include "../../../dbConnection.php";
    $dbConn = getDatabaseConnection("midterm");
    
    function getData1() {
        // List all cities/towns that have a population between 50,000 and 80,000
        global $dbConn;
        $sql = "SELECT town_name, population FROM mp_town
                WHERE population >= 50000 AND population <= 80000;";
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // print_r($records);
        return $records;
    }
    
    function getData2() {
        // List all towns and population, ordered by population (from biggest to smallest)
        global $dbConn;
        $sql = "SELECT town_name, population FROM mp_town
                ORDER BY population DESC;";
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // print_r($records);
        return $records;
    }
    
    function getData3() {
        // List the three least populated towns
        global $dbConn;
        $sql = "SELECT town_name, population FROM mp_town
                ORDER BY population LIMIT 3;";
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // print_r($records);
        return $records;
    }
    
    function getData4() {
        // List the counties that start with the letter "S"
        global $dbConn;
        $sql = "SELECT county_name FROM mp_county
                WHERE county_name LIKE :starts;";
        $np = array();
        $np[":starts"] = "S%";
        $stmt = $dbConn->prepare($sql);
        $stmt->execute($np);
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // print_r($records);
        return $records;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title> </title>
        <style>
            #t1 {
                border: 1px solid blue;
            }
            #t2 {
                border: 1px solid red;
                margin: auto;
            }
            #t3 {
                border: 1px solid yellow;
            }
            #t4 {
                border: 1px solid green;
                float: right;
            }
            header, footer {
                clear: right;
                text-align: center;
            }
            footer h3 {
                font-weight: normal;
                font-style: italic;
            }
        </style>
    </head>
    <body>
        <header>
            <h1>Midterm Practice 2: Generate Reports</h1>
        </header>
        <table id="t1">
            <?php
                foreach (getData1() as $record) { ?>
                    <tr>
                        <?php echo "<td>".$record["town_name"]."<td><td>"
                        .$record["population"]."</td>"; ?>
                    </tr> <?php
                }
            ?>
        </table>
        <hr>
        <table id="t2">
            <?php
                foreach (getData2() as $record) { ?>
                    <tr>
                        <?php echo "<td>".$record["town_name"]."</td><td>"
                        .$record["population"]."</td"; ?>
                    </tr> <?php
                }
            ?>
        </table>
        <hr>
        <table id="t3">
            <?php 
                foreach (getData3() as $record) { ?>
                    <tr>
                        <?php echo "<td>".$record["town_name"]."</td><td>"
                        .$record["population"]."</td>"; ?>
                    </tr> <?php
                }
            ?>
        </table>
        <hr>
        <table id="t4">
            <?php 
                foreach (getData4() as $record) { ?>
                    <tr>
                        <?php echo "<td>".$record["county_name"]."</td>"; ?>
                    </tr> <?php
                }
            ?>
        </table>
        <footer>
            <h3>CST336 Internet Programming<br>By: Conner Gieg<br>10/17/18</h3>
        </footer>
    </body>
</html>