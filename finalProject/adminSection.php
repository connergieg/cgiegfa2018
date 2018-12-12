<?php
    session_start();
    if (!isset($_SESSION["username"])) {
        header("Location: index.php");
        exit();
    }
    
    function displayProducts() {
        include "../inc/dbConnection.php";
        $dbConn = getDatabaseConnection("games");
        
        $sql = "SELECT * FROM games_products
                ORDER BY prodName";
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // print_r($records);
        
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
            echo "<div id='prod$id'><button class='update btn btn-secondary' id='$id'>Update</button> ";
            echo "<button class='delete btn btn-warning' id='$id'>Delete</button> ";
            echo "<img src='$img' width='100'> | <a href='#' class='prodName' id='$id'>$name</a> | $console | $$price"."</div><br><hr><br>";
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin Section</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <style>
            body {
                background-color: lightgray;
            }
            #prodDetails, #generateReports, #showProd, #myModal {
                display: none;
            }
            #generateReports {
                border: 2px solid black;
                padding: 20px;
                border-radius: 10px;
                background-color: lightgreen;
            }
            #main {
                width: 800px;
                margin: auto;
            }
            #products {
                border: 2px solid black;
                background-color: lightblue;
                padding: 20px;
                border-radius: 10px;
            }
            #logOutBtn {
                margin-top: 75px;
                float: right;
            }
            #logOutLink {
                color: white;
            }
            #logOutLink:hover {
                text-decoration: none;
            }
            #productInfo {
                width: 200px;
                display: inline-block;
            }
        </style>
        <script>
            function deleteProduct(id) {
                $.ajax({
                    type: "POST",
                    url: "deleteProduct.php",
                    dataType: "",
                    data: { "id": id },
                    success: function(data,status) {
                    //alert(data);
                        window.location.href = "adminSection.php";
                    },
                    complete: function(data,status) { //optional, used for debugging purposes
                    //alert(status);
                    }
                });//ajax
            }
            
            $(document).ready(function() {
                $("#logOutBtn").click(function() {
                    // alert("You clicked me");
                    logOut = confirm("Log out?");
                    // console.log(logOut);
                    if (logOut) {
                        $("#logOutLink").attr("href","adminLogout.php");
                    }
                });//logOutEvent
                
                $("#addProdFirst").click(function() {
                    // alert("HI");
                    $(this).hide();
                    $("#reports").hide();
                    $("#generateReports").hide();
                    $("#prodDetails").show();
                    $("#main").show();
                    $("#modifyProduct").hide();
                    $("#products").hide();
                    $("#showProd").show();
                });//addProdFirst
                
                $("#addProdSecond").click(function() {
                    var prodName = $("#prodName").val();
                    var prodImg = $("#prodImg").val();
                    var prodGenre = $("#prodGenre").val();
                    var prodConsole = $("#prodConsole").val()
                    var prodPrice = $("#prodPrice").val();
                    // console.log(prodName);
                    // console.log(prodDesc);
                    // console.log(prodConsole);
                    // console.log(prodPrice);
                    $.ajax({
                        type: "POST",
                        url: "addProduct.php",
                        dataType: "",
                        data: { "name": prodName, "img": prodImg, "genre": prodGenre, 
                        "console": prodConsole, "price": prodPrice },
                        success: function(data,status) {
                        //alert(data);
                            $("#addMessage").html("");
                            $("#addMessage").html("Product added");
                            $("#addMessage").css("color","green");
                            $("#addMessage").append("<br><br>")
                        },
                        complete: function(data,status) { //optional, used for debugging purposes
                        //alert(status);
                        }
                    });//ajax
                });//addProdSecond
                
                $("#showProd").click(function() {
                    $(this).hide();
                    $("#prodDetails").hide();
                    $("#addProdFirst").show();
                    $("#addMessage").hide();
                    $("#products").show();
                    window.location.href = "adminSection.php";
                });//showProd
                
                $(".update").click(function() {
                    // alert($(this).attr("id"));
                    var id = $(this).attr("id");
                    $("#prod"+id).html("");
                    $.ajax({
                        type: "POST",
                        url: "getProductInfo.php",
                        dataType: "json",
                        data: { "id": id },
                        success: function(data,status) {
                        //alert(data);
                            $("#prod"+id).append("Id: "+data.prodId);
                            $("#prod"+id).append("<br>Name: "+"<input type='text' id='name"+id+"' value='"+data.prodName+"'>");
                            $("#prod"+id).append("<br>Image: "+"<input type='text' id='img"+id+"' value='"+data.prodImg+"'>");
                            $("#prod"+id).append("<br>Genre: "+"<input type='text' id='genre"+id+"' value='"+data.Genre+"'>");
                            $("#prod"+id).append("<br>Console: "+"<select id='console"+id+"'>"+
                            "<option id='xb1"+id+"'>XB1</option><option id='ps4"+id+"'>PS4</option></select>");
                            if (data.prodConsole == "XB1") {
                                $("#xb1"+id).attr("selected", "selected");
                            } else if (data.prodConsole == "PS4") {
                                $("#ps4"+id).attr("selected", "selected");
                            }
                            $("#prod"+id).append("<br>Price: "+"$<input type='text' id='price"+id+"' value='"+data.price+"'>");
                            $("#prod"+id).append(" <button class='updateBtn' id='"+id+"'>UPDATE</button>");
                            $(".updateBtn").css("color","green");
                            $("#prod"+id).append(" <button class='exit'>X</button>");
                            $(".exit").css("color","red");
                            $(".updateBtn").click(function() {
                                console.log("UPDATE btn clicked");
                                $(this).html("<img src='img/loading.gif'>");
                                var id = $(this).attr("id");
                                var name = $("#name"+id).val();
                                var img = $("#img"+id).val();
                                var genre = $("#genre"+id).val();
                                var price = $("#price"+id).val();
                                // console.log(name);
                                // console.log(img);
                                // console.log(genre);
                                // console.log($("#console"+id).val());
                                // console.log(price);
                                $.ajax({
                                    type: "POST",
                                    url: "updateProduct.php",
                                    dataType: "",
                                    data: { "id": id, "name": name, "img": img, "genre": genre,
                                    "console": $("#console"+id).val(), "price": price},
                                    success: function(data,status) {
                                    //alert(data);
                                        $(".updateBtn").html("UPDATE");
                                    },
                                    complete: function(data,status) { //optional, used for debugging purposes
                                    //alert(status);
                                    }
                                });//ajax
                            });//updateBtnEvent
                            
                            $(".exit").click(function() {
                               window.location.href = "adminSection.php"; 
                            });
                        },
                        complete: function(data,status) { //optional, used for debugging purposes
                        //alert(status);
                        }
                    });//ajax
                });//updateEvent
                
                $(".delete").click(function() {
                //   alert("delete clicked");
                    var id = $(this).attr("id");
                    // console.log(id);
                    var choice = confirm("Delete?");
                    if (choice) {
                        // alert("Deleted");
                        deleteProduct(id);
                    }
                });//deleteEvent
                
                $("#reports").click(function() {
                //   alert("reports clicked");
                    $("#generateReports").html("<img src='img/loading.gif'>");
                    $("#generateReports").show();
                    $.ajax({
                        type: "GET",
                        url: "generateReports.php",
                        dataType: "json",
                        data: { "": ""},
                        success: function(data,status) {
                        //alert(data);
                            $("#generateReports").html("");
                            $("#generateReports").append("Total price of all products: $"+data.totalPrice);
                            $("#generateReports").append(" <button id='exitReports'>X</button>");
                            $("#exitReports").css("color","red");
                            $("#generateReports").append("<br>Average price of all products: $"+data.avgPrice);
                            $("#generateReports").append("<br>Product count: "+data.itemCount);
                            $("#exitReports").click(function() {
                                $("#generateReports").hide();
                            });
                        },
                        complete: function(data,status) { //optional, used for debugging purposes
                        //alert(status);
                        }
                    });//ajax
                });
                
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
                });//prodNameEvent
                
            });//documentReady
        </script>
    </head>
    <body>
        <div id="main">
            <button id="logOutBtn" type="submit" class="btn btn-danger">
                <a id="logOutLink" href="#">Logout</a>
            </button><br>
            <h1>Hello <i><?=$_SESSION["username"]?></i></h1>
            
            <button id="addProdFirst" class="btn btn-success">Add new product</button>
            <button id="reports" class="btn btn-info">Generate Reports</button><br><br>
            <div id="prodDetails">
                <h3>Enter details below:</h3>
                Name: <input type="text" id="prodName"><br>
                Image: <input type="text" id="prodImg"><br>
                Genre: <select id="prodGenre">
                    <option>Shooter</option>
                    <option>Platformer</option>
                </select><br>
                Console: 
                <select id="prodConsole">
                   <option>XB1</option>
                   <option>PS4</option>
                </select><br>
                Price: $<input type="text" id="prodPrice">
                <input type="button" id="addProdSecond" value="Add product">
                <br><br>
            </div>
            <div id="generateReports">
                
            </div>
            <span id="addMessage"></span>
            <input type="button" id="showProd" value="Go Back">
            <h3 id="modifyProduct">Modify product info below:</h3>
            <div id="products">
                <?=displayProducts()?>
            </div>
        </div>
        
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