<?php
    include "../inc/dbConnection.php";
    $dbConn = getDatabaseConnection("games");
    
    function displayProducts() {
        global $dbConn;
        $sql = "";
        $np = array();
        if (isset($_GET["submitProduct"])) {
            $sql .= "SELECT * FROM games_products
                    WHERE prodName LIKE :prodName
                    AND prodConsole = :prodConsole
                    AND Genre = :prodGenre";
            $np[":prodName"] = "%".$_GET["prodName"]."%";
            $np[":prodConsole"] = $_GET["console"];
            $np[":prodGenre"] = $_GET["genre"];
            if (!empty($_GET["priceFrom"])) {
                $np[":priceFrom"] = $_GET["priceFrom"];
                $sql .= " AND price >= :priceFrom";
            }
            if (!empty($_GET["priceTo"])) {
                $np[":priceTo"] = $_GET["priceTo"];
                $sql .= " AND price <= :priceTo";
            }
            
            if (isset($_GET["sortPrice"])) {
                $sortBy = $_GET["sortPrice"];
                $sql .= " ORDER BY price $sortBy";
            }
            // echo $sql."<br>";
            $stmt = $dbConn->prepare($sql);
            $stmt->execute($np);
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // print_r($records);
            if (empty($records)) {
                echo "<h3 class='error'>No products found</h3>";
            } else {
                foreach ($records as $record) {
                    $id = $record["prodId"];
                    $name = $record["prodName"];
                    $img = $record["prodImg"];
                    $console = $record["prodConsole"];
                    if ($console == "XB1") {
                        $console = "<img src='img/xboxLogo.png' width='100'>";
                    } else if ($console == "PS4") {
                        $console = "<img src='img/ps4Logo.png' width='100'>";
                    }
                    $price = $record["price"];
                    echo "<a href='#' class='prodName' id='$id'><img src='$img' width='100'></a> 
                    | <a href='#' class='prodName' id='$id'>$name</a> | $console | $$price <br><hr><br>";
                }
            }
        }
    }
    
    function selectGenre($genre) {
        if ($genre == $_GET["genre"]) {
            return "selected";
        }
    }
    
    function displayGenres() {
        global $dbConn;
        $sql = "SELECT DISTINCT Genre FROM games_products";
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // print_r($records);
        foreach ($records as $record) {
            $genre = $record["Genre"];
            echo "<option ".selectGenre($genre).">$genre</option>";
        }
    }
    
    function selectOption($console) {
        if ($console == $_GET["console"]) {
            echo "selected";
        }
    }
    
    function checkRadio($orderBy) {
        if ($orderBy == $_GET["sortPrice"]) {
            echo "checked";
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>User Search</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <style>
            body {
                text-align: center;
                background-color: lightgray;
            }
            form {
                width: 500px;
                margin: 0 auto;
                text-align: left;
            }
            .error {
                color: red;
            }
            #goBackForm {
                width: 500px;
                margin: 0 auto;
            }
            #goBackBtn {
                margin-top: 20px;
                float: left;
            }
            h1 {
                clear: left;
            }
            #productInfo {
                text-align: left;
                width: 200px;
                display: inline-block;
            }
            #main {
                background-color: lightblue;
                border-radius: 20px;
                width: 800px;
                margin: auto;
            }
        </style>
        
        <script>
            $(document).ready(function() {
               $(".prodName").click(function() {
                    $("#myModal").modal("show");
                    var id = $(this).attr("id");
                    $.ajax({
                        type: "POST",
                        url: "getProductInfo.php",
                        dataType: "json",
                        data: { "id": id },
                        success: function(data,status) {
                        //alert(data);
                            $("#productName").html(data.prodName);
                            $("#productImage").attr("src",data.prodImg);
                            $("#productGenre").html("Genre: "+data.Genre+"<br>");
                            $("#productConsole").html("Console: "+data.prodConsole+"<br>");
                            $("#productPrice").html("Price: $"+data.price+"<br>");
                        },
                        complete: function(data,status) { //optional, used for debugging purposes
                        //alert(status);
                        }
                    });//ajax
                    
                    $.ajax({
                        type: "POST",
                        url: "updateProductViews.php",
                        dataType: "json",
                        data: { "id": id },
                        success: function(data,status) {
                        //alert(data);
                            $("#productViews").html("<br>Product view count: "+data.views);
                        },
                        complete: function(data,status) { //optional, used for debugging purposes
                        //alert(status);
                        }
                    });//ajax
                });//prodNameEvent 
            });
        </script>
    </head>
    <body>
        <form action="index.php" id="goBackForm">
            <button type="submit" id="goBackBtn" class="btn btn-outline-danger">Go Back</button>
        </form>
        <h1>Search for Products</h1>
        
        <form>
            Product Name: <input type="text" name="prodName" value="<?=$_GET['prodName']?>"><br>
            Console: <select name="console">
                <option <?=selectOption("XB1")?>>XB1</option>
                <option <?=selectOption("PS4")?>>PS4</option>
            </select><br>
            Genre: <select name="genre">
                <?=displayGenres()?>
            </select><br>
            Price: From: $<input type="text" name="priceFrom" value="<?=$_GET['priceFrom']?>">
            To: $<input type="text" name="priceTo" value="<?=$_GET['priceTo']?>"><br>
            Sort Price By: <input type="radio" name="sortPrice" id="sortAsc" value="ASC" <?=checkRadio("ASC")?>>
            <label for="sortAsc">Low to High</label>
            <input type="radio" name="sortPrice" id="sortDesc" value="DESC" <?=checkRadio("DESC")?>>
            <label for="sortDesc">High to Low</label><br><br>
            <input type="submit" name="submitProduct" value="Search" class="btn btn-success">
        </form>
        <br><hr>
        
        <div id="main">
            <?=displayProducts()?>
        </div><br><br>
        
        <div id="myModal" class="modal" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="productName"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true" style="color:red;">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <img id="productImage" src="">
                <div id="productInfo">
                    <span id="productGenre"></span>
                    <span id="productConsole"></span>
                    <span id="productPrice"></span>
                    <span id="productViews"></span>
                </div>
                <!--<p>Modal body text goes here.</p>-->
              </div>
              <div class="modal-footer">
                <!--<button type="button" class="btn btn-primary">Save changes</button>-->
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
    </body>
</html>