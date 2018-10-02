<?php
    $backgroundImage = "img/sea.jpg";
    
    if (isset($_GET["submitBtn"])) {  //checks if the form has been submitted
        include "api/pixabayAPI.php";
    
        $keyword = $_GET["keyword"];
        $layout = $_GET["layout"];
        $category = $_GET["category"];
        
        if (!empty($_GET["category"])) {
            $keyword = $_GET["category"];
        }
        
        // echo "Keyword: $keyword <br>";
        // echo "Layout: $layout <br>";
        
        if (strlen(trim($keyword)) != 0 || !empty($category)) {
            if (isset($layout) && $layout == "vertical") {
                $imageURLs = getImageURLs($keyword, $layout);
            }
            else {
                $imageURLs = getImageURLs($keyword);
            }
        }
        else {
            $imageURLs = array();
        }
        $images = array();
        foreach($imageURLs as $image) {
            if ($image != "") {
                array_push($images, $image);
            }
        }
        // print_r($imageURLs);
        // print_r($images);
        
        shuffle($images);
        $backgroundImage = array_pop($images);
        
        if ((empty($keyword) && empty($category)) || count($images) < 7) {
            $backgroundImage = "img/sea.jpg";
        }
    }
    
    function checkRadioBtn($layout) {
        if ($_GET["layout"] == $layout) {
            echo "checked";
        }
    }
    
    function selectOption($category) {
        if ($_GET["category"] == $category) {
            echo "selected";
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Lab 4: Pixabay Slideshow </title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
        <link href="css/styles.css" rel="stylesheet">
        <style>
            
            body {
                background-image: url(<?=$backgroundImage?>);
                background-size: cover;
            }
            
        </style>
        
    </head>


    <body>
        <form  method="GET">
            
            <input type="text" name="keyword" value="<?=$_GET['keyword']?>" size="15" placeholder="Keyword"/>
            
            <div id="layout">
                <input type="radio" id="horiz" name="layout" value="horizontal"
                <?= checkRadioBtn("horizontal") ?>>
                <label for="horiz">Horizontal</label>
                <br>
                <input type="radio" id="vert" name="layout" value="vertical"
                <?= checkRadioBtn("vertical") ?>>
                <label for="vert">Vertical</label>
            </div>
            <br>
            <div>
                <select name="category">
                    <option value="">- None -</option>
                    <option <?= selectOption("Sea") ?>>Sea</option>
                    <option <?= selectOption("Mountains") ?>>Mountains</option>
                    <option <?= selectOption("Forest") ?>>Forest</option>
                    <option <?= selectOption("Sky") ?>>Sky</option>
                </select>
                <br><br>
                <input type="submit" name="submitBtn" value="Submit" />
            </div>
            
        </form>
        <?php
            if (isset($_GET["submitBtn"])) {
                if (strlen(trim($_GET["keyword"])) == 0 && empty($_GET["category"])) {
                    echo "<h1 class='error'>You must type a keyword or select a category</h1>";
                }
                else if (count($images) >= 7) {
        ?>
        
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <?php
                for ($i = 1; $i < 7; $i++) {
                    echo "<li data-target='#carouselExampleIndicators' data-slide-to='$i'></li>";
                }
            ?>
          </ol>
          <div class="carousel-inner">
            <?php
                for ($i = 0; $i < 7; $i++) {
                    $image = array_pop($images);
                    echo "<div class='carousel-item";
                    echo ($i == 0)?" active'>":"'>";
                    echo "<img class='d-block w-100' src='". $image . "' alt='Second slide'>
                    </div>";
                }
            ?>
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
        <?php 
                }
                else {
                    echo "<h1 class='error'>Sorry, at least 7 images must be found please try again.</h1>";
                }
            }
        ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    </body>
</html>