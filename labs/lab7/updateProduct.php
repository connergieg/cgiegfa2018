<?php
    session_start();
    include "inc/functions.php";
    validateSession();
    
    if (!isset($_GET["prodId"])) {
        header("Location: admin.php");
        exit();
    }
    
    updateProduct();
    $sql = "SELECT * FROM om_product
            WHERE productId = ".$_GET["prodId"];
    // echo $sql."<br>";
    
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    // print_r($record);
?>

<!DOCTYPE html>
<html>
    <head>
        <title> </title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/styles.css" type="text/css" />
    </head>
    <body class="navy">
        <form action="admin.php">
            <button id="goBack">Go Back</button>
        </form>
        <h1 class="yellow"> Update Product </h1>
        
        <form class="yellow">
           <input type="hidden" name="prodId" value="<?=$_GET["prodId"]?>">    
           Product name: <input type="text" name="productName" value="<?=$record['productName']?>"><br>
           Description: <textarea name="description" cols="50" rows="4"><?=trim($record['productDescription'])?></textarea><br>
           Price: $<input type="text" name="price" value="<?=$record['price']?>"><br>
           Category: 
           <select name="catId">
              <option value="">Select One</option>
              <?php
                $categories = getCategories();
                foreach ($categories as $category) {
                    $catId = $category["catId"];
                    $catName = $category["catName"];
                    if ($record["catId"] == $catId) {
                        $selected = " selected";
                    } else {
                        $selected = "";
                    }
                    echo "<option value='$catId'".$selected.">".$catName."</option>";
                }
              ?>
           </select> <br />
           Set Image Url: <input type="text" name="productImage" value="<?=$record['productImage']?>"><br><br>
           <input type="submit" name="updateProduct" value="Update Product">
        </form>
    </body>
</html>