<?php
    include "inc/functions.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <title> CSUMB: Pet Shelter </title>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>   
        <style>
            body {
                text-align: center;
            }
            ul {
                list-style-type: none;
            }
            .modal-dialog {
                width: 600px;
                max-width: 600px;
            }
            #petInfo {
                float: left;
                display: inline-block;
                width: 200px;
                text-align: left;
                padding-left: 10px;
            }
        </style>
        <script>
            $(document).ready(function() {
                $(".petLink").click(function() {
                    $("#myModal").modal("show");
                    $("#container").html("<img src='img/loading.gif'>");
                    // alert("Pet clicked");
                    // alert($(this).attr('id'));
                    $.ajax({
                        type: "GET",
                        url: "api/getPetInfo.php",
                        dataType: "json",
                        data: { "id": $(this).attr("id") },
                        success: function(data,status) {
                        // alert(data.breed);
                            $("#petName").html(data.name);
                            $("#petImg").attr("src","img/"+data.pictureURL);
                            $("#petImg").css("float","left");
                            $("#petAge").html("<strong>Age: </strong>");
                            $("#petAge").append(data.age);
                            $("#petBreed").html("<strong>Breed: </strong>");
                            $("#petBreed").append(data.breed);
                            $("#petDesc").html(data.description);
                            $("#container").html("");
                        },
                        complete: function(data,status) { //optional, used for debugging purposes
                        //alert(status);
                        }
                    });//ajax
                });
            });
        </script>
   
    </head>
    <body>
        
        <!--Add main menu here -->
        <?php
            include "inc/header.php";
            $pets = getAllPets();
            foreach ($pets as $pet) {
                $id = $pet["id"];
                $name = $pet["name"];
                $type = $pet["type"];
                echo "<ul><li>Name: <a href='#' class='petLink' id='$id'>$name</a></li>";
                echo "<li>Type: $type</li></ul>";
            }
        ?>
        
        <div class="modal" id="myModal" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="petName"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!--<p>Modal body text goes here.</p>-->
                <div id="container"></div>
                <img id="petImg" src="">
                <div id="petInfo">
                    <span id="petAge"></span><br>
                    <span id="petBreed"></span><br>
                    <span id="petDesc"></span><br>
                </div>
              </div>
              <div class="modal-footer">
                <!--<button type="button" class="btn btn-primary">Save changes</button>-->
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <?php
            include "inc/footer.php";
        ?>
    </body>

</html>