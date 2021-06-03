<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin Login</title>
        <style>
            body {
                background-color: lightgray;
                text-align: center;
            }
            h1 {
                margin: 0px;
            }
            .error {
                color: red;
            }
            #login {
                width: 300px;
                margin: auto;
                text-align: left;
            }
            #adminSection {
                width: 300px;
                margin: auto;
                text-align: center;
            }
            #main {
                width: 500px;
                margin: 0 auto;
                padding: 20px;
                border-radius: 20px;
                border: 2px solid black;
                background-color: lightgreen;
            }
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        
        <script>
            $(document).ready(function() {
                $("#logOut").click(function() {
                    // alert("You clicked me");
                    logOut = confirm("Log out?");
                    // console.log(logOut);
                    if (logOut) {
                        $("#logOut").attr("href","adminLogout.php");
                    }
                });
            });
        </script>
    </head>
    <body>
        <?php
            if (!isset($_SESSION["username"])) { ?>
            <div id="main">
                <h1>Admin Login</h1><br>
                <p>(Username: admin / Password: secret)</p>
                <form method="POST" action="validateLogin.php" id="login">
                    Username <input type="text" name="username"><br>
                    Password <input type="password" name="password">
                    <button type="submit">Login</button>
                </form>
                <?php
                    if (isset($_SESSION["loggedIn"])) {
                        if (isset($_GET["loginAttempt"])) {
                            if ($_SESSION["loggedIn"] == false) {
                                echo "<span class='error'>Incorrect username or password</span>";
                            }
                        }
                    }
                ?>
            </div>
        <?php
            } else {
        ?>
            <span>You are logged in</span>
            <a id="logOut" href="#">Log out?</a>
            <br><br>
            <form action="adminSection.php" id="adminSection">
                <button type="submit">Admin Section</button>
            </form>
        <?php
            }
        ?>
        
    </body>
</html>