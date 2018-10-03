<?php
include 'functions/function1.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Silverjack - Team 4 </title>
        <link href="css/style.css" rel="stylesheet" />
    </head>
    <body>
        <div class="silverjack">
            <header>Silverjack</header>
            <br>
            <div class="points">
                <?php
                    include 'functions/function2.php';
                    echo "<hr>";
                    $players = displayHands(getDeck());
                    displayWinners($players);
                ?>
                <br>
                <form id form> 
                    <input type="submit" name="play" class="button" value="Play Again">
                </form>
            </div>
            <div id="elapsedTime">
                <?= displayElapsedTime(); ?>
            </div>
        </div>
        <footer>
            <hr>CST 336:Internet Programming. 2018&copy; O'Neill Beaton Lopez Gieg<br>
        <strong>Disclaimer:</strong>The information in this webpage is totally fictuous and not true.<br>
        It is used for academic purposes.<br>
        <img id="logo"src="https://www.gannett-cdn.com/-mm-/27b51b61ea4b998e2d58764f833d0fa9c82c0bed/c=0-75-600-525/local/-/media/2016/03/26/Salinas/B9321500095Z.1_20160326013639_000_GMLDSI43O.1-0.png.jpg?width=534&height=401&fit=crop">
        </footer>
        
        <hr>
    </head>
    <body>
        

    </body>
</html>