<?php
    session_start();
    include "dbConnection.php";
    $dbConn = getDatabaseConnection("sports");
    
    $_SESSION["purchaseItem"] = false;
    
    if (isset($_POST["clearHist"])) {
        unset($_SESSION["shopHist"]);
        header("Location: index.php");
    }
    
    if (!isset($_SESSION["ids"])) {
        $_SESSION["ids"] = array();
    }
    
    if (!isset($_SESSION["shopHist"])) {
        $_SESSION["shopHist"] = array();
    }
    
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
                array_push($_SESSION["ids"], $_POST["itemId"]);
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
            $location = "Location: index.php?id=".$_POST["itemId"]."&playerName=$playerName&catId=$catId&submit=".$_GET["submit"];
            if (isset($_GET["orderBy"])) {
                $orderBy = $_GET["orderBy"];
                $location .= "&orderBy=$orderBy";
            }
            if (isset($_GET["sortBy"])) {
                $sortBy = $_GET["sortBy"];
                $location .= "&sortBy=$sortBy";
            }
            if (isset($_GET["team"])) {
                $team = $_GET["team"];
                $location .= "&team=$team";
            }
            if (isset($_GET["addSingle"])) {
                $single = $_GET["addSingle"];
                $location .= "&addSingle=$single";
            }
            header($location);
        }
    }
    
    function selectCategory($catId) {
        if ($_GET["catId"] == $catId) {
            return "selected";
        }
    }
    
    function checkRadio($orderBy) {
        if ($_GET["orderBy"] == $orderBy) {
            echo "checked";
        }
    }
    
    function checkSortRadio($sortBy) {
        if ($_GET["sortBy"] == $sortBy) {
            echo "checked";
        }
    }
    
    function checkCheckBox() {
        if ($_GET["team"] == "on") {
            echo "checked";
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
            
            echo "<option value='".$record['catId']."' ".$selected.">".$record['catName'] . "</option>";
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
        $orderBy = $_GET["orderBy"];
        $sortBy = "ASC";
        $priceFrom = $_GET["priceFrom"];
        $priceTo = $_GET["priceTo"];
        $priceTo = $_GET["priceTo"];
        if (isset($_GET["sortBy"])) {
            $sortBy = $_GET["sortBy"];
        }
        
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
            if (isset($orderBy)) {
                $sql .= " ORDER BY $orderBy $sortBy";
            }
        } else {
            if (!empty($catId)) {
                $sql .= "SELECT * FROM sports_players
                    WHERE catId = $catId";
                if (!empty($priceFrom)) {
                    $sql .= " AND price >= $priceFrom";
                }
                if (!empty($priceTo)) {
                    $sql .= " AND price <= $priceTo";
                }
                if (isset($orderBy)) {
                    $sql .= " ORDER BY $orderBy $sortBy";
                }
            }
        }
        echo $sql;
        if (!empty($sql)) {
            // echo $sql."<br>";
            $stmt = $dbConn->prepare($sql);
            $stmt->execute();
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // print_r($records);
            
            if (empty($records)) {
                echo "<span class='error'>Player not found. Try again</span><br>";
            } else {
                echo "<tr>";
                echo "<th>Name</th>";
                if (isset($_GET["team"])) {
                    echo "<th>Team</th>";
                }
                echo "<th>Price</th>";
                foreach ($records as $record) {
                    $itemId = $record["playerId"];
                    $itemCatId = $record["catId"];
                    $itemName = $record["playerName"];
                    $itemImage = $record["playerImage"];
                    $itemTeam = $record["playerTeam"];
                    $itemPrice = $record["price"];
                    echo "<tr>";
                    echo "<td><a href='playerInfo.php?name=$itemName&image=".$itemImage."'>".$itemName."</a></td>";
                    if (isset($_GET["team"])) {
                        echo "<td>$itemTeam</td>";
                    }
                    if ($_GET["id"] == $itemId) {
                        $class = "added";
                        $value = "Added";
                    } else {
                        $class = "";
                        $value = "$$itemPrice";
                    }
                    echo "<td><form id='add' method='POST'>
                    <input type='hidden' name='itemId' value='$itemId'>
                    <input type='hidden' name='itemCatId' value='$itemCatId'>
                    <input type='hidden' name='itemName' value='$itemName'>
                    <input type='hidden' name='itemImage' value='$itemImage'>
                    <input type='hidden' name='itemPrice' value='$itemPrice'>
                    <input class='$class' type='submit' value='$value'>
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
        <main>
            <a href="scart.php" id="cartButton">Cart</a> <br>
            <div id="cartPreview">
            <ul>
                <?php
                    for ($i = 0; $i < 3; $i++) {
                        if (isset($_SESSION["scart"][$i])) {
                            if ($i == 0) {
                                echo "Cart Preview<br>";
                            }
                            echo "<li>".$_SESSION["scart"][$i]["name"]." | $".$_SESSION["scart"][$i]["price"]."</li>";
                        }
                    }
                ?>
            </ul>
                <?php
                    if (count($_SESSION["scart"]) > 3) {
                        echo "<h4>Click cart for more</h4>";
                    }
                ?>
            </div>
            
            <form>
                Player Name: <input type="text" name="playerName" value="<?=$_GET['playerName']?>"><br>
                Sport: 
                <select name="catId">
                    <option value="">- None -</option>
                    <?= displayCategories() ?>
                </select> <br>
                Price: From <input type="number" name="priceFrom" value="<?=$_GET['priceFrom']?>">
                To <input type="number" name="priceTo" value="<?=$_GET['priceTo']?>"><br>
                Order Results By: 
                <input type="radio" id="teamOrd" name="orderBy" value="playerTeam" <?=checkRadio("playerTeam")?>>
                <label for="teamOrd">Player Team</label>
                <input type="radio" id="nameOrd" name="orderBy" value="playerName" <?=checkRadio("playerName")?>>
                <label for="nameOrd">Player Name</label><br>
                Sort Results By:
                <input type="radio" id="asc" name="sortBy" value="ASC" <?=checkSortRadio("ASC")?>>
                <label for="asc">ASC</label>
                <input type="radio" id="desc" name="sortBy" value="DESC" <?=checkSortRadio("DESC")?>>
                <label for="desc">DESC</label><br>
                <label for="team">Display player's team name</label>
                <input type="checkbox" id="team" name="team" <?=checkCheckBox()?>><br><br>
                <input type="submit" name="submit" value="Submit">
            </form><br>
            <?php
                if (isset($_GET["submit"])) {
                    if (empty($_GET["catId"]) && empty(getCategoryId()) && empty($_GET["playerName"])) {
                        echo "<span class='error'>Error: Please enter a player name or select a sport</span><br><br>";
                    }
                    if (!isset($_GET["orderBy"]) && isset($_GET["sortBy"])) {
                        echo "<span class='warning'>Warning: Please select a Order Results By option and try again.</span><br><br>";
                    }
                }
            ?>
            
            <span id="clickSubmit">After modifying search results, click submit<br>then add your items to the cart.</span><br><br>
            <a href="shopHist.php">Purchase History</a>
            
            <div id="playersTable">
            <table align="center">
            <?php
                if (isset($_GET["submit"])) {
                    if (empty($_GET["playerName"]) && !empty($_GET["catId"])) {
                        if (!empty(getCategoryId())) {
                            $catId = getCategoryId();
                        } else {
                            $catId = $_GET["catId"];
                        }
                        switch ($catId) {
                            case 1:
                                $sport = "football";
                                break;
                            case 2:
                                $sport = "baseball";
                                break;
                            case 3:
                                $sport = "basketball";
                                break;
                            case 4:
                                $sport = "golf";
                                break;
                        }
                        $link = "addAllPlayers.php?catId=".$_GET["catId"].
                        "&priceFrom=".$_GET["priceFrom"]."&priceTo=".$_GET["priceTo"]."&submit=".$_GET["submit"];
                        $link2 = "index.php?catId=".$_GET["catId"]."&priceFrom=".
                        $_GET["priceFrom"]."&priceTo=".$_GET["priceTo"]."&submit=".$_GET["submit"]."&addSingle=1";
                        
                        if (isset($_GET["orderBy"])) {
                            $link .= "&orderBy=".$_GET["orderBy"];
                            $link2 .= "&orderBy=".$_GET["orderBy"];
                        }
                        if (isset($_GET["sortBy"])) {
                            $link .= "&sortBy=".$_GET["sortBy"];
                            $link2 .= "&sortBy=".$_GET["sortBy"];
                        }
                        if (isset($_GET["team"])) {
                            $link .= "&team=".$_GET["team"];
                            $link2 .= "&team=".$_GET["team"];
                        }
                        echo "<button><a href='$link'>Add all players of $sport to cart</a></button><br><br>";
                        echo "<button><a href='$link2'>Add individual players of $sport to cart</a></button>";
                        if (isset($_GET["addSingle"])) {
                            displaySportPlayers();
                        }
                    } else {
                        displaySportPlayers();
                    }
                }
            ?>
            </table>
            </div>
        </main>
    </body>
</html>