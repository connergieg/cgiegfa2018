<?php
    session_start();
    include "inc/functions.php";
    validateSession();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin Main Page</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/styles.css" type="text/css" />
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this product?");
            }
            function openModal() {
                $("#myModal").modal("show");
            }
        </script>
    </head>
    
    <body>
        <div class="navy">
            <div class="jumbotron">
                <h1>ADMIN SECTION - OTTERMART</h1>
                <h3>Welcome <?= $_SESSION["adminFullName"] ?></h3>
            </div>
        
            <form class="admin" action="addProduct.php">
                <!--<input class="add" type="submit" value="Add Product">-->
                <button type="submit" class="btn btn-outline-success">Add Product</button>
            </form>
            
            <form class="admin" action="logout.php">
                <!--<input id="logout" type="submit" value="Logout">-->
                <button type="submit" class="btn btn-outline-danger">Logout</button>
            </form>
            <br><br>
            
            <div id="products">
            <hr>
            <?= displayAllProducts() ?>
            </div>
        </div>
        
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Product Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <iframe name="productModal" width="450" height="250"></iframe>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>        
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    </body>
</html>