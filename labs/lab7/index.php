<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin Login</title>
        <style>
            .error {
                color: red;
            }
        </style>
    </head>
    <body>
        <h1>Ottermart - Admin Login</h1>
        
        <form method="POST" action="loginProcess.php">
            Username: <input type="text" name="username" value="<?=$_SESSION['username']?>"><br>
            Password: <input type="password" name="password" value="<?=$_SESSION['password']?>"><br>
            <?php
                if (isset($_GET["loginErr"])) {
                    echo "<br><span class='error'>Wrong username or password</span><br><br>";
                }
            ?>
            <input type="submit" value="Login">
        </form>
    </body>
</html>