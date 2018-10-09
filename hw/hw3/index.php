<?php
    include "inc/functions.php";
    $correct = 0;
    $valid = array();
    $error = " <span class='error'>(Required field)</span>";
?>

<!DOCTYPE html>
<html>
    <head>
        <title>HTML Form Quiz</title>
        <link rel="stylesheet" href="css/styles.css" type="text/css" />
    </head>
    <body>
        <h1 id="mainTitle">HTML Form Quiz</h1>
        <form>
            <p>First name: <input type="text" name="fname" value="<?=$_GET['fname']?>" placeholder="First name">
            <?php 
                if (!validateName("fname")) {
                    echo $error;
                    array_push($valid, false);
                }
            ?>
            </p>
            <p>Last name: <input type="text" name="lname" value="<?=$_GET['lname']?>" placeholder="Last name">
            <?php  
                if (!validateName("lname")) {
                    echo $error;
                    array_push($valid, false);
                }
            ?>
            </p>
            <p>Email: <input type="email" name="email" value="<?=$_GET['email']?>" placeholder="Email">
            <?php  
                if (!validateName("email")) {
                    echo $error;
                    array_push($valid, false);
                }
            ?>
            </p>
            <?php
                for ($i = 1; $i < 6; $i++) {
                    echo "<p>";
                    displayQuestion($i);
                    if (!validateQuestion("q".$i)) {
                        echo $error;
                        array_push($valid, false);
                    } else {
                        $point = getQuestionPoint("q".$i);
                        // if ($point != 0) {
                        //     echo " " . $point . " point";
                        // }
                        $correct += $point;
                    }
                    echo "</p>";
                }
            ?>
            <div id="submitBtn">
                <input type="submit" id="submitBtn" name="submit" value="Submit">
                Reset form <input type="checkbox" name="retry">
                <?php
                    if (isset($_GET["retry"])) {
                        header("Location: index.php");
                    }
                ?>
            </div>
        </form>
        <?php
            displayResults($valid, $correct);
        ?>
    </body>
</html>