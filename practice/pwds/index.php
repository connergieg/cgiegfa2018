<?php
    session_start();
    
    $alphabet = range("A", "Z");
    $numbers = range(0, 9);
    
    if (!isset($_SESSION["pwd_history"])) {
        $_SESSION["pwd_history"] = array();
    }
    
    function checkRadio($len) {
        if ($_GET["pwdlen"] == $len) {
            echo "checked";
        }
    }
    
    function checkCheckBox() {
        if (isset($_GET["incdig"])) {
            echo "checked";
        }
    }
    
    function displayPasswords() {
        global $alphabet;
        global $numbers;
        $pwds = array();
        for ($i = 0; $i < $_GET["pwd"]; $i++) {
            $pass = "";
            $pass = $alphabet[rand(0, count($alphabet)-1)];
            for ($j = 0; $j < $_GET["pwdlen"]-1; $j++) {
                shuffle($alphabet);
                $pass = $pass . $alphabet[rand(0,count($alphabet)-1)];
            }
            array_push($pwds, $pass);
        }
        if (isset($_GET["incdig"])) {
            for ($i = 0; $i < count($pwds); $i++) {
                for ($j = 0; $j < rand(1, 3); $j++) {
                    $randInd = rand(0, strlen($pwds[$i])-1);
                    $pwds[$i][$randInd] = rand(0,9);
                }
            }
            // print_r($pwds);
        }
        foreach ($pwds as $value) {
            echo $value . "<br>";
        }
        array_push($_SESSION["pwd_history"], $pwds);
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Generate Passwords</title>
        <link rel="stylesheet" href="css/styles.css" type="text/css" />
    </head>
    <body>
        <main>
            <form id="pwds">
                <h1>Custom Password Generator</h1>
                How many passwords? <input type="number" name="pwd" value="<?=$_GET['pwd']?>"> (No more than 8)
                <br><br>
                <strong>Password Length</strong><br>
                <input type="radio" name="pwdlen" value="6" <?=checkRadio("6")?>> 6 characters
                <input type="radio" name="pwdlen" value="8" <?=checkRadio("8")?>> 8 characters
                <input type="radio" name="pwdlen" value="10" <?=checkRadio("10")?>> 10 characters
                <br><br>
                <input type="checkbox" name="incdig" <?=checkCheckBox()?>> Include digits (up to 3 will be part of the password)
                <br><br>
                <input type="submit" name="submit" value="Create Passwords"><br><br>
            </form>
            
            <form action="pwdHistory.php">
                <input type="submit" value="Display Password History">
            </form>
            <br>
            <form action="clearPwdHistory.php">
                <input type="submit" value="Clear">
            </form>
            <br>
        </main>
        
            
            
        <?php
            if (isset($_GET["submit"])) {
                if (!empty($_GET["pwd"]) && isset($_GET["pwdlen"]) && $_GET["pwd"] <= 8) {
                    echo "<p style='text-align: center;'>Generating <strong>" . $_GET["pwd"] . "</strong> passwords with ";
                    echo "<strong>". $_GET["pwdlen"] . "</strong> characters:</p>";
                    echo "<div id='output'>";
                    displayPasswords();
                    echo "</div>";
                }
                else {
                    echo "<h3 style='text-align: center; margin: 0px;'>Error(s):</h3>";
                    if ($_GET["pwd"] > 8) {
                       echo "<div style='text-align: center;'>Number of passwords is > 8</div>"; 
                    }
                    if (empty($_GET["pwd"])) {
                        echo "<div style='text-align: center;'>Number of passwords is empty</div>"; 
                    }
                    if (!isset($_GET["pwdlen"])) {
                        echo "<div style='text-align: center;'>Password length is not set</div>"; 
                    }
                }
            }
        ?>
    </body>
</html>