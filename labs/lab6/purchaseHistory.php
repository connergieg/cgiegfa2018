<?php
    include "../../dbConnection.php";
    $dbConn = getDatabaseConnection("ottermart");
    
    function displayPurchase() {
        global $dbConn;
        $productId = $_GET["productId"];
        $productName = $_GET["productName"];
        $productImage = $_GET["productImage"];
        
        // $sql = "SELECT * FROM om_purchase
        //         WHERE productId = :productId";
        $sql = "SELECT * FROM om_product 
        NATURAL LEFT JOIN om_purchase WHERE productId = $productId";
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC); // fetchAll returns an Array of Arrays
        // print_r($records);
        
        echo "<span id='productName'>$productName</span><br>";
        echo "<img src='".$records[0]["productImage"]."' width='100'>";
        
        if (!empty($records[0]["purchaseId"])) {
            echo "<table>";
            echo "<tr>";
            echo "<th>Quantity</th><th>Unit Price</th><th>Purchase Date</th>";
            echo "</tr>";
            foreach ($records as $record) {
                echo "<tr>";
                echo "<td>" . $record["quantity"] . "</td>";
                echo "<td>" . $record["unitPrice"] . "</td>";
                echo "<td>" . $record["purchaseDate"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<h3>Product hasn't been purchased</h3>";
        }
        
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Purchase History</title>
        <link rel="stylesheet" href="css/styles2.css" type="text/css" />
    </head>
    <body>
        <h1>Purchase History</h1>
        <div id="purchaseHistory">
            <?=displayPurchase()?>
        </div>
    </body>
</html>