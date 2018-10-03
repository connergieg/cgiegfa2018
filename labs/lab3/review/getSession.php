<?php
    session_start();  //starts or resumes an existing session
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Setting a Session Variable </title>
    </head>
    <body>
        
        <h1> My name is <?= $_SESSION["my_name"] ?> </h1>
        <h2> My favorite class is <?= $_SESSION["course"] ?> </h2>

    </body>
</html>