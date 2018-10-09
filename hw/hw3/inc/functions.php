<?php
    function validateName($name) {
        if (isset($_GET["submit"])) {
            if (empty($_GET[$name])) {
                $check = false;
            }
            else {
                $check = true;
            }
            return $check;
        } else {
            return true;
        }
    }
    
    function displayQuestion($num) {
        echo "Question $num: Correct or Incorrect? 
            <input type='radio' name='q$num' id='correct$num' value='correct'";
        echo ($_GET["q".$num] == "correct")?"checked":"";
        echo ">";
        echo "<label for='correct$num'> Correct </label>";
        echo "<input type='radio' name='q$num' id='incorrect$num' value='incorrect'";
        echo ($_GET["q".$num] == "incorrect")?"checked":"";
        echo ">";
        echo "<label for='incorrect$num'> Incorrect </label>";
    }
    
    function validateQuestion($quest) {
        if (isset($_GET["submit"])) {
            if (!isset($_GET[$quest])) {
                $check = false;
            }
            else {
                $check = true;
            }
            return $check;
        } else {
            return true;
        }
    }
    
    function getQuestionPoint($quest) {
        if ($_GET[$quest] == "correct") {
            $point = 1;
        } else {
            $point = 0;
        }
        return $point;
    }
    
    function displayResults($valid, $correct) {
        if (isset($_GET["submit"])) {
            $check = true;
            foreach($valid as $value) {
                if ($value == false) {
                    $check = false;
                    break;
                }
            }
            if (!$check) {
                echo "<h2 class='error'>You did not fill out the form completely. Try again<h2>";
            }
            else {
               if ($correct < 3) {
                   $class = "fail";
               }
               else {
                   $class = "pass";
               }
               echo "<div id='imgResult'>";
               echo "<span class='$class'>".ucfirst($_GET['fname'])." ".ucfirst($_GET['lname'])." answered $correct question(s) correctly.</span><br>";
               if ($correct >= 3) {
                   switch($correct) {
                       case 3:
                           echo "<img src='img/barelypassed.jpg' alt='Barely passed squirrel' width='350'>";
                           $message = "<br>You barely made it";
                           break;
                       case 4:
                           echo "<img src='img/verygood.png' alt='Very good bunny' width='350'>";
                           $message = "<br>Very good";
                           break;
                       case 5:
                           echo "<img src='img/excellent.jpg' alt='Excellent star' width='350'>";
                           $message = "<br>Excellent";
                           break;
                   }
                   $message = $message . "<br>You passed :)";
               } else {
                   switch($correct) {
                       case 2:
                           echo "<img src='img/soclose.jpg' alt='So close message' width='350'>";
                           $message = "<br>So close";
                           break;
                       case 1:
                           echo "<img src='img/tryharder.png' alt='Try harder text' width='350'>";
                           $message = "<br>Try harder";
                           break;
                        case 0:
                            echo "<img src='img/study.png' alt='Study smart' width='350'>";
                            $message = "<br>Study more";
                            break;
                   }
                   $message = $message . "<br>You failed :(";
               }
               echo "<span class='$class'>".$message."</span>";
               echo "</div>";
            }
        }
    }
?>