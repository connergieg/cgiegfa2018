<?php
    include "../../../dbConnection.php";
    $dbConn = getDatabaseConnection("ottermart");
    
    function displayPurchase() {
        global $dbConn;
        $productId = $_GET["productId"];
        $productName = $_GET["productName"];
        $productImage = $_GET["productImage"];
        
        $sql = "SELECT * FROM om_purchase
                WHERE productId = :productId";
        $namedParameters = array();
        $namedParameters[":productId"] = $productId;
        $stmt = $dbConn->prepare($sql);
        $stmt->execute($namedParameters);
        
        $records = $stmt->fetch(PDO::FETCH_ASSOC);
        // print_r($records);
        
        if (!empty($records)) {
            echo $productName . "<br>";
            echo "<img src='$productImage' width='300'><br>";
            echo "Purcase Date: " . $records["purchaseDate"] . "<br>";
            echo "Unit Price: " . $records["unitPrice"] . "<br>";
            echo "Quantity: " . $records["quantity"] . "<br>";
        } else {
            echo "$productName - Not purchased";
        }
    }
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title> </title>
    </head>
    <body>
        <?=displayPurchase()?>
    </body>
</html>