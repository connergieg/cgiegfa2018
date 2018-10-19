<?php

include 'inc/charts.php';
$posters = array("ready_player_one","rampage","paddington_2","hereditary","alpha","black_panther","christopher_robin","coco","dunkirk","first_man");
$newPosters = array();
for ($i = 0; $i < 4; $i++) {
    shuffle($posters);
    $poster = array_pop($posters);
    array_push($newPosters, $poster);
}
// print_r($newPosters);

function movieReviews() {
    // global $posters;
    global $newPosters;
    
    $randomPoster = array_pop($newPosters);
    
    echo "<div class='poster'>";
    echo "<h2>";
    $newRandomPoster = "";
    for ($i = 0; $i < strlen($randomPoster); $i++) {
        if ($randomPoster[$i] == "_") {
            $newRandomPoster = $newRandomPoster . " ";
        }
        else {
            $newRandomPoster = $newRandomPoster . $randomPoster[$i];
        }
    }
    echo ucwords($newRandomPoster);
    echo "</h2>";
    echo "<img width='100' src='img/posters/$randomPoster.jpg'>";    
    echo "<br>";
    
    //NOTE: $totalReviews must be a random number between 100 and 300
    $totalReviews = rand(100, 300); 
    
    //NOTE: $ratings is an array of 1-star, 2-star, 3-star, and 4-star rating percentages
    //      The sum of rating percentages MUST be 100
    // $ratings = array(30,20,40,10);
    $ratings = array();
    $total = 100;
    for ($i = 0; $i < 3; $i++) {
        $randNum = rand(0, 30);
        $total = $total - $randNum;
        array_push($ratings, $randNum);
    }
    array_push($ratings, $total);
    print_r($ratings);
    
    //NOTE: displayRatings() displays the ratings bar chart and
    //      returns the overall average rating
    $overallRating = displayRatings($totalReviews,$ratings);
    
    //NOTE: The number of stars should be the rounded value of $overallRating
    // echo "<br><img src='img/star.png' width='25'>";
    // echo "<img src='img/star.png' width='25'>";
    echo "<br>";
    for ($i = 0; $i < floor($overallRating); $i++) {
        echo "<img src='img/star.png' width='25'>";
    }
    
    echo "<br>Total reviews: $totalReviews";
    echo "</div>";
}    

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Movie Reviews </title>
        <style type="text/css">
            body {
                text-align:center;
            }
            #main {
                display:flex;
                justify-content: center;
            }
            .poster {
                padding: 0 10px;
            }
        </style>
    </head>
    <body>
       
       <h1> Movie Reviews </h1>
        <div id="main">
           <?php
             //NOTE: Add for loop to display 4 movie reviews
             for ($i = 0; $i < 4; $i++) {
                 movieReviews();
             }
           ?>
       </div>
       <br/>
       <hr>
       <h1>Based on ratings you should watch:</h1>
       
    </body>
</html>