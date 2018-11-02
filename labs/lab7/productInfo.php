<?php
    include "inc/functions.php";
    if (isset($_GET["prodId"])) {
        $product = getProductInfo();
    } else {
        exit();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title> </title>
        <link rel="stylesheet" href="css/styles.css" type="text/css" />
    </head>
    <body>
        <h3 id="prodName"><?=$product["productName"]?></h3>
        <div>
            <img style="display:inline;" src="<?=$product['productImage']?>" width="100">
        
            <div class="prodInfo">
                Price: <strong>$<?=$product['price']?></strong><br><br>
                Description: <br><?=$product["productDescription"]?>
            </div>
        </div>
    </body>
</html>