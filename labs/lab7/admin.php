<?php
    session_start();
    include "../../dbConnection.php";
    $dbConn = getDatabaseConnection("ottermart");
    
    if (!isset($_SESSION["adminFullName"])) {
        header("Location: index.php");
    }
    
    function displayAllProducts() {
        global $dbConn;
        $sql = "SELECT * FROM om_product
                ORDER BY productName";
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC); //we're expecting multiple records
        // print_r($records);
        foreach ($records as $record) {
            $productId = $record["productId"];
            echo "[<a href='updateProduct.php?productId=$productId'>Update</a>] ";
            echo "[<a href='deleteProduct.php?productId=$productId'>Delete</a>] ";
            echo $record["productName"] . " " . $record["price"] . "<br>";
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin Main Page</title>
    </head>
    <body>
        <h1>ADMIN SECTION - OTTERMART</h1>
        <h3>Welcome <?= $_SESSION["adminFullName"] ?></h3>
        
        <br><br>
        
        <form action="addProduct.php">
            <input type="submit" value="Add Product">
        </form>
        
        <form action="logout.php">
            <input type="submit" value="Logout">
        </form>
        <br>
        
        <?= displayAllProducts() ?>
    </body>
</html>