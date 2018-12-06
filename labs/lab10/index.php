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
            #carouselExampleIndicators {
                width: 500px;
                margin: auto;
            }
        </style>
   
    </head>
    <body>
        
    	<!--Add main menu here -->
    	<?php
    	  include "inc/header.php";
    	  include "inc/functions.php";
    	  $pets = getAllPets();
    	?>
    
      <!-- Display Carousel here  -->
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <!--<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>-->
            <!--<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>-->
            <?php
              for ($i = 1; $i < count($pets); $i++) { ?>
                <li data-target="#carouselExampleIndicators" data-slide-to="<?=$i?>"></li>
            <?php
              } ?>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="carousel-caption d-none d-md-block">
                <h5><?=$pets[0]["name"]?></h5>
                <p><?=$pets[0]["description"]?></p>
              </div>
              <img class="d-block w-100" src="img/<?=$pets[0]["pictureURL"]?>" alt="First slide">
            </div>
            <?php
              for ($i = 1; $i < count($pets); $i++) { ?>
                <div class="carousel-item">
                  <div class="carousel-caption d-none d-md-block">
                    <h5><?=$pets[$i]["name"]?></h5>
                    <p><?=$pets[$i]["description"]?></p>
                  </div>
                  <img class="d-block w-100" src="img/<?=$pets[$i]["pictureURL"]?>" alt="Second slide">
                </div>
            <?php
              } ?>
            <!--<div class="carousel-item">-->
            <!--  <img class="d-block w-100" src="img/bear.jpg" alt="Second slide">-->
            <!--</div>-->
            <!--<div class="carousel-item">-->
            <!--  <img class="d-block w-100" src="img/carl.jpg" alt="Third slide">-->
            <!--</div>-->
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>  
        <br>
        <a class="btn btn-outline-success" href="pets.php" role="button">Adopt Now</a>
        <br><br><br>
        <?php
          include "inc/footer.php";
        ?>
    </body>

</html>