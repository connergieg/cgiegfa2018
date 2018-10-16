<?php
    include "dbConnection.php";
    $dbConn = getDatabaseConnection("ottermart");
    // Creating database connection
    // $host = "localhost";
    // $dbname = "ottermart";
    // $username = "root";
    // $password = "";
    // $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    function selectCategory($category) {
        if ($_GET["category"] == $category) {
            return "selected";
        }
    }
    
    function checkRadio($orderBy) {
        if ($_GET["orderBy"] == $orderBy) {
            echo "checked";
        }
    }
    
    function checkCheckBox() {
        if (isset($_GET["productImage"])) {
            echo "checked";
        }
    }
    
    function displayCategories() {
        global $dbConn;
        $sql = "SELECT * FROM om_category
                ORDER BY catName";
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // print_r($records);
        // echo "<hr>";
        // echo $records[2] . "<br>";
        // echo $records[0]["catDescription"] . "<br>";
        
        foreach ($records as $record) {
            echo "<option value='".$record['catId']."'".selectCategory($record['catId']).">".$record['catName']."</option>";
        }
    }
    
    function filterProducts() {
        global $dbConn;
        $product = $_GET["productName"];
        $priceFrom = $_GET["priceFrom"];
        $priceTo = $_GET["priceTo"];
        $catId = $_GET["category"];
        $priceFrom = $_GET["priceFrom"];
        $priceTo = $_GET["priceTo"];
        $orderBy = $_GET["orderBy"];
        
        // This SQL works but it doesn't prevent SQL INJECTION (due to the single quotes)
        // $sql = "SELECT * FROM om_product
        //         WHERE productName LIKE '%$product%' OR productDescription LIKE '%$product%'";
        $namedParameters = array();
        $sql = "SELECT * FROM om_product WHERE 1"; // Getting all records from database
        
        if (!empty($product)) {
            // This SQL prevents SQL INJECTION by using a named parameter
            $sql .= " AND (productName LIKE :product OR productDescription LIKE :product)";
            $namedParameters[":product"] = "%$product%";
        }
        if (!empty($catId)) {
            // This SQL prevents SQL INJECTION by using a named parameter
            $sql .= " AND (catId = :catId)";
            $namedParameters[":catId"] = $catId;
        }
        if (!empty($priceFrom)) {
            // This SQL prevents SQL INJECTION by using a named parameter
            $sql .= " AND (price >= :priceFrom)";
            $namedParameters[":priceFrom"] = $priceFrom;
        }
        if (!empty($priceTo)) {
            // This SQL prevents SQL INJECTION by using a named parameter
            $sql .= " AND (price <= :priceTo)";
            $namedParameters[":priceTo"] = $priceTo;
        }
        if (isset($orderBy)) {
            $sql .= " ORDER BY $orderBy";
        }
        
        // echo $sql . "<br>";
        $stmt = $dbConn->prepare($sql);
        $stmt->execute($namedParameters);
        
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // print_r($records);
        return $records;
    }
    
    function displayProducts() {
        $productImage = $_GET["productImage"];
        
        foreach (filterProducts() as $record) {
            echo "<tr>";
            $itemId = $record["productId"];
            $itemName = $record["productName"];
            $itemDesc = $record["productDescription"];
            $itemPrice = $record["price"];
            $itemImage = $record["productImage"];
            
            echo "<td><a href='purchaseHistory.php?productId=$itemId&
            productName=$itemName&productImage=$itemImage'>History</a></td>";
            if (isset($productImage)) {
                echo "<td><img src='$itemImage' width='100'></td>";
            }
            echo "<td>$itemName</td>";
            echo "<td>$itemDesc</td>";
            echo "<td>$itemPrice</td>";
            echo "</tr>";
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Lab 6: OtterMart Product Search</title>
        <link rel="stylesheet" href="css/styles.css" type="text/css" />
    </head>
    <body>
        
        <div id="main">
            <h1>OtterMart Product Search</h1>
            <form>
                Product: <input type="text" name="productName" value="<?=$_GET['productName']?>" placeholder="Product keyword"> <br>
                Category: 
                <select name="category">
                    <option value="">Select One</option>
                    <?= displayCategories() ?>
                </select> <br>
                Price: From <input type="number" name="priceFrom" value="<?=$_GET['priceFrom']?>">
                To <input type="number" name="priceTo" value="<?=$_GET['priceTo']?>"> <br>
                <div class="orderBy">Order Results By:</div>
                <div class="orderBy">
                    <input type="radio" id="productName" name="orderBy" value="productName" <?=checkRadio("productName")?>>
                    <label for="productName">Product Name</label><br>
                    <input type="radio" id="price" name="orderBy" value="price" <?=checkRadio("price")?>>
                    <label for="price">Price</label>
                </div> <br>
                <input type="checkbox" id="productImage" name="productImage" <?=checkCheckBox()?>>
                <label for="productImage">Display Product Pictures</label><br><br>
                <input type="submit" name="submit" value="Search">
            </form> <br>
        </div>
        <?php
            if (!empty(filterProducts())) { ?>
                <h3>Products Found:</h3>
                <table>
                    <tr>
                        <td></td>
                        <?php
                            if (isset($_GET["productImage"])) {
                                echo "<td>Image</td>";
                            }
                        ?>
                        <td>Name</td>
                        <td>Description</td>
                        <td>Price</td>
                    </tr>
                    <?= displayProducts(); ?>
                    </table>
        <?php 
            } else {
                echo "<h3>No products were found. Try again</h3>";
            } 
        ?>
    </body>
</html>