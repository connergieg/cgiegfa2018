<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin Login</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/styles.css" type="text/css" />
    </head>
    
    <body class="navy">
        <div class="jumbotron">
           <h1>Ottermart - Admin Login</h1> 
        </div>
        
        <form class="yellow" method="POST" action="loginProcess.php">
            Username: <input type="text" name="username" value="<?=$_SESSION['username']?>"><br>
            Password: <input type="password" name="password" value="<?=$_SESSION['password']?>"><br>
            <?php
                if (!$_SESSION["loggedIn"]) {
                    if (isset($_GET["loginAttempt"])) {
                        echo "<br><div class='alert alert-danger' style='width:300px;' role='alert'>
                        Incorrect username or password
                        </div>";
                    } 
                }
            ?>
            <input type="submit" value="Login">
        </form>
    </body>
</html>