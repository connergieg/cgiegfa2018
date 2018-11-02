<?php
    session_start();
    include "inc/functions.php";
    validateSession();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Add New Product</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/styles.css" type="text/css" />
    </head>
    <body class="navy">
        <form action="admin.php">
            <button id="goBack">Go Back</button>
        </form>
        <h1 class="yellow"> Add New Product </h1>
        
        <form class="yellow">
           Product name: <input type="text" name="productName"><br>
           Description: <textarea name="description" cols="50" rows="4"></textarea><br>
           Price: $<input type="text" name="price"><br>
           Category: 
           <select name="catId">
              <option value="">Select One</option>
              <?php
                $categories = getCategories();
                foreach ($categories as $category) {
                    $catId = $category["catId"];
                    $catName = $category["catName"];
                    echo "<option value='$catId'>".$catName."</option>";
                }
              ?>
           </select> <br />
           Set Image Url: <input type="text" name="productImage"><br><br>
           <input type="submit" name="submitProduct" value="Add Product">
        </form>
        <?php insertNewProduct(); ?>
    </body>
</html>