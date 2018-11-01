<?php
    include "../../dbConnection.php";
    $dbConn = getDatabaseConnection("c9");
    
    function displayCategories() {
        global $dbConn;
        $sql = "SELECT DISTINCT category FROM p1_quotes ORDER BY category";
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($records as $record) {
            if ($record['category'] == $_GET["category"]) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            echo "<option $selected>".$record['category']."</option>";
        }
    }
    
    function checkRadio($orderBy) {
        if (isset($_GET["orderBy"])) {
            if ($_GET["orderBy"] == $orderBy) {
                echo "checked";
            }
        }
    }
    
    function displayQuotes() {
        global $dbConn;
        $keyword = $_GET["keyword"];
        $category = $_GET["category"];
        $orderBy = $_GET["orderBy"];
        $np = array();
        if (!empty($keyword)) {
            $sql = "SELECT quote FROM p1_quotes WHERE quote LIKE :keyword";
            $np[":keyword"] = "%$keyword%";
        } else {
            $sql = "";
        }
        if (!empty($category)) {
            if (!empty($sql)) {
                $sql .= " AND category = :category";
            } else {
                $sql = "SELECT quote FROM p1_quotes WHERE category = :category";
            }
            $np[":category"] = "$category";
        }
        if (!empty($sql)) {
            if (isset($orderBy)) {
                if ($orderBy == "ASC") {
                    $sql .= " ORDER BY quote $orderBy";
                } else {
                    $sql .= " ORDER BY quote $orderBy";
                }
            }
            // echo $sql."<br>";
            $stmt = $dbConn->prepare($sql);
            $stmt->execute($np);
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // print_r($records);
            if (empty($records)) {
                echo "<h3 class='error'>No quote(s) were found. Try again</h2>";
            } else {
                foreach ($records as $record) {
                    echo "- ".$record["quote"]."<br>";
                }    
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title> </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" type="text/css" />
        <style>
            body, .error {
                text-align: center;
            }
            .error {
                color: red;
            }
            #quotes {
                text-align: left;
                width: 500px;
                margin: auto;
            }
        </style>
    </head>
    <body>
        <div class="jumbotron">
            <h1>Famous Quote Finder</h1>
        </div>
        <form>
            Enter Quote Keyword: <input type="text" name="keyword" value="<?=$_GET['keyword']?>"><br><br>
            Category: 
            <select name="category">
                <option value="">- Select One -</option>
                <?= displayCategories(); ?>
            </select><br><br>
            Order<br>
            <input type="radio" id="az" name="orderBy" value="ASC" <?=checkRadio("ASC");?>>
            <label for="az">A-Z</label><br>
            <input type="radio" id="za" name="orderBy" value="DESC" <?=checkRadio("DESC");?>>
            <label for="za">Z-A</label><br><br>
            <input type="submit" name="submit" value="Display Quotes">
        </form><br>
        
        <div id="quotes">
        <?= displayQuotes(); ?>
        </div>
    </body>
</html>