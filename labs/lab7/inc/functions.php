<?php
    include "../../inc/dbConnection.php";
    $dbConn = getDatabaseConnection("ottermart");
    
    function validateSession() {
        if (!isset($_SESSION["adminFullName"])) {
            header("Location: index.php");
            exit();
        }
    }
    
    function validateLogin() {
        global $dbConn;
        // This SQL does not prevent SQL injection
        // $sql = "SELECT * FROM om_admin
        //         WHERE username = '$username'
        //         AND password = '$password'";
        $sql = "SELECT * FROM om_admin
                WHERE username = :username
                AND password = :password";
        $stmt = $dbConn->prepare($sql);
        $np = array();
        $np[":username"] = $_POST["username"];
        $np[":password"] = sha1($_POST["password"]);
        $stmt->execute($np);
        $record = $stmt->fetch(PDO::FETCH_ASSOC); //we're expecting just one record
        // print_r($record);
        
        if (empty($record)) {
            // echo "Wrong username or password!";
            $_SESSION["loggedIn"] = false;
            header("Location: index.php?loginAttempt=true");
        } else {
            // echo "Welcome " . $record["firstName"] . " " . $record["lastName"];
            $_SESSION["loggedIn"] = true;
            $_SESSION["adminFullName"] = $record["firstName"] . " " . $record["lastName"];
            header("Location: admin.php"); //redirects to another program
        }
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
            $productName = $record["productName"];
            $productPrice = $record["price"];
            echo "[<a id='update' href='updateProduct.php?prodId=$productId'>Update</a>] ";
            // echo "[<a id='delete' href='deleteProduct.php?prodId=$productId&prodName=$productName'>Delete</a>] ";
            echo "<form id='deleteForm' action='deleteProduct.php' onsubmit='return confirmDelete()'>
            <input type='hidden' name='prodId' value='$productId'>
            <button type='submit'>Delete</button>
            </form>";
            echo " <a onclick='openModal()' target='productModal' href='productInfo.php?prodId=$productId'>$productName</a>";
            echo " $" . $productPrice . "<hr>";
        }
    }
    
    function getProductInfo() {
        global $dbConn;
        $prodId = $_GET["prodId"];
        $sql = "SELECT * FROM om_product
                WHERE productId = " . $prodId;
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
        // print_r($record);
        return $record;
    }
    
    function getCategories() {
        global $dbConn;
        $sql = "SELECT * FROM om_category 
                ORDER BY catName";
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // print_r($records);
        return $records;
    }
    
    function insertNewProduct() {
        global $dbConn;
        if (isset($_GET["submitProduct"])) {
            $productName = $_GET["productName"];
            $description = $_GET["description"];
            $price = $_GET["price"];
            $catId = $_GET["catId"];
            $image = $_GET["productImage"];
            
            $sql = "INSERT INTO om_product (productName, productDescription, productImage, price, catId)
                    VALUES (:prodName, :prodDesc, :prodImage, :price, :catId)";
            $stmt = $dbConn->prepare($sql);
            $np = array();
            $np[":prodName"] = $productName;
            $np[":prodDesc"] = $description;
            $np[":prodImage"] = $image;
            $np[":price"] = $price;
            $np[":catId"] = $catId;
            $stmt->execute($np);
            echo "<br><div class='alert alert-success' style='margin-left:50px; width:300px;' role='alert'>
            New Product Added
            </div>";
        }
    }
    
    function updateProduct() {
        global $dbConn;
        if (isset($_GET["updateProduct"])) {
            $productName = $_GET["productName"];
            $description = $_GET["description"];
            $price = $_GET["price"];
            $catId = $_GET["catId"];
            $image = $_GET["productImage"];
            $sql = "UPDATE om_product
                    SET productName = :productName,
                    productDescription = :description,
                    productImage = :productImage,
                    price = :price,
                    catId = :catId
                    WHERE productId = ".$_GET["prodId"];
            // echo $sql."<br>";
            $stmt = $dbConn->prepare($sql);
            $np = array(":productName" => $productName, ":description" => $description,
            ":productImage" => $image, ":price" => $price, ":catId" => $catId);
            $stmt->execute($np);
        }
    }
    
    function deleteProduct() {
        global $dbConn;
        $sql = "DELETE FROM om_product
                WHERE productId = " . $_GET["prodId"];
        // echo $sql;
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        
        header("Location: admin.php");
    }
?>