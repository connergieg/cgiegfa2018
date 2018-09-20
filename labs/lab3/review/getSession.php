<?php
    session_start(); // starts or resums an existing session
?>

<!DOCTYPE html>
<html>
    <head>
        <title> </title>
    </head>
    <body>
        <?php
            echo "My name is " . $_SESSION["my_name"];
        ?>
    </body>
</html>