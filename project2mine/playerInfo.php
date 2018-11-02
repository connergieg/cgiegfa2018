<?php
    $name = $_GET["name"];
    $image = $_GET["image"];
?>

<!DOCTYPE html>
<html>
    <head>
        <title> </title>
        <style>
            img {
                border: 1px solid black;
            }
        </style>
    </head>
    <body>
        <?=$name?> <br>
        <img src="<?=$image?>">
    </body>
</html>