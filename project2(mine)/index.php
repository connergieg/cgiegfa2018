<?php
    session_start();
    include "dbConnection.php";
    $dbConn = getDatabaseConnection("sports");
    
    if (!isset($_SESSION["scart"])) {
        $_SESSION["scart"] = array();
    } else {
        $newItem = array();
        if (isset($_POST["itemName"])) {
            $found = false;
            foreach ($_SESSION["scart"] as $item) {
                if (($item["id"] == $_POST["itemId"]) && ($item["catId"] == $_POST["itemCatId"])) {
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $newItem["id"] = $_POST["itemId"];
                $newItem["catId"] = $_POST["itemCatId"];
                $newItem["name"] = $_POST["itemName"];
                $newItem["image"] = $_POST["itemImage"];
                $newItem["price"] = $_POST["itemPrice"];
                array_push($_SESSION["scart"], $newItem);
            }
            if (!empty(getCategoryId())) {
                $catId = getCategoryId();
            } else {
                $catId = $_POST["itemCatId"];
            }
            if (!empty($_GET["playerName"])) {
                $playerName = $_GET["playerName"];
            } else {
                $playerName = "";
            }
            header("Location: index.php?playerName=$playerName&catId=$catId&submit=".$_GET["submit"]);
        }
    }
    
    function selectCategory($catId) {
        if ($_GET["catId"] == $catId) {
            return "selected";
        }
    }
    
    function displayCategories() {
        global $dbConn;
        $sql = "SELECT * FROM sports_category";
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $i = 1;
        foreach ($records as $record) {
            if (!empty(getCategoryId())) {
                if ($i == getCategoryId()) {
                    $selected = "selected";
                } else {
                    $selected = "";
                }
            } else {
                $selected = selectCategory($record["catId"]);
            }
            
            echo "<option value='".$record["catId"]."' ".$selected.">".$record["catName"] . "</option>";
            $i++;
        }
    }
    
    function getCategoryId() {
        global $dbConn;
        $playerName = $_GET["playerName"];
        if (!empty($playerName)) {
            $sql = "SELECT * FROM sports_players
                    WHERE playerName = '$playerName'";
            $stmt = $dbConn->prepare($sql);
            $stmt->execute();
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // echo $sql;
            // print_r($records);
            $categoryId = $records[0]["catId"];
        }
        return $categoryId;
    }
    
    function displaySportPlayers() {
        global $dbConn;
        $playerName = $_GET["playerName"];
        $catId = $_GET["catId"];
        $newCatId = getCategoryId();
        
        if (!empty($playerName)) {
            $sql = "SELECT * FROM sports_players
                    WHERE playerName = '$playerName'";
        } else {
            $sql = "";
        }
        if (!empty($newCatId)) {
            $catId = $newCatId;
        }
        if (!empty($sql)) {
            if (!empty($catId)) {
                $sql .= " AND catId = $catId";
            }
        } else {
            if (!empty($catId)) {
                $sql .= "SELECT * FROM sports_players
                    WHERE catId = $catId";
            }
        }
        if (!empty($sql)) {
            // echo $sql."<br>";
            $stmt = $dbConn->prepare($sql);
            $stmt->execute();
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // print_r($records);
            if (empty($records)) {
                echo "<span class='error'>Player not found. Try again<span><br>";
            } else {
                foreach ($records as $record) {
                    $itemId = $record["playerId"];
                    $itemCatId = $record["catId"];
                    $itemName = $record["playerName"];
                    $itemImage = $record["playerImage"];
                    $itemPrice = $record["price"];
                    echo "<tr>";
                    echo "<td><a href='playerInfo.php?name=$itemName&image=".$itemImage."'>".$itemName."</a></td>";
                    echo "<td><form id='add' method='POST'>
                    <input type='hidden' name='itemId' value='$itemId'>
                    <input type='hidden' name='itemCatId' value='$itemCatId'>
                    <input type='hidden' name='itemName' value='$itemName'>
                    <input type='hidden' name='itemImage' value='$itemImage'>
                    <input type='hidden' name='itemPrice' value='$itemPrice'>
                    <input type='submit' value='Add'>
                    </form></td>";
                    echo "</tr>";
                }
            }
            
            
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Sports Cards</title>
        <link rel="stylesheet" href="css/styles.css" type="text/css" />
    </head>
    <body>
        <a href="scart.php">Cart</a> <br><br>
        <form>
            Player Name: <input type="text" name="playerName" value="<?=$_GET['playerName']?>"><br>
            Sport: 
            <select name="catId">
                <option value="">- None -</option>
                <?= displayCategories() ?>
            </select>
            <input type="submit" name="submit" value="Submit">
        </form> <br>
        
        <table>
        <?php
            if (isset($_GET["submit"])) {
                displaySportPlayers();
            }
        ?>
    </body>
</html>