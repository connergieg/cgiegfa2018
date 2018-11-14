//Initialize global variables
var word = "";
var hint = "";
var board = [];
var guesses = 6;
var words = [
    {word: "snake", hint: "It's a reptile"},
    {word: "monkey", hint: "It's a mammal"},
    {word: "beetle", hint: "It's an insect"}
];

var randIndex = Math.floor(Math.random() * words.length);
word = words[randIndex].word;
hint = words[randIndex].hint;

function initializeBoard() {
    for (var i = 0; i < word.length; i++) {
        board.push("_");
        document.getElementById("word").innerHTML += board[i] + " ";
    }
}

function getGuess(button) {
    guess = false;
    for (var i = 0; i < word.length; i++) {
        if (word[i] == $(button).html().toLowerCase()) {
            board[i] = word[i];
            guess = true;
        }
        $("#word").append(board[i].toUpperCase() + " ");
    }
    return guess;
}

function getWinner() {
    winner = true;
    for (var i = 0; i < board.length; i++) {
        if (board[i] == "_") {
            winner = false;
            break;
        }
    }
    return winner;
}

$(document).ready(function () {
    // console.log("Index: "+randIndex);
    // console.log("Word: "+word);
    // console.log("Hint: "+hint);
    
    $("#hint").click(function() {
        document.getElementById("hint").innerHTML = hint;
        guesses--;
        console.log("Guesses: "+guesses);
        $("#hangImg").attr("src", "img/stick_"+(6-guesses)+".png");
    });
    
    initializeBoard();
    
    var alphabet = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N",
    "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];
    
    // add buttons to #buttons div
    for (var i = 0; i < alphabet.length; i++) {
        $("#buttons").append("<button class='btn btn-success' id='button"+alphabet[i]+"'>"+alphabet[i]+"</button> ");
    }
    
    for (var letter of alphabet) {
        $("#button"+letter).click(function() {
            $(this).attr("disabled","");
            $(this).attr("class", "btn btn-danger");
            $("#word").html("");
            if (!getGuess(this)) {
                guesses--;
                $("#hangImg").attr("src", "img/stick_"+(6-guesses)+".png");
            }
            console.log("Guesses: "+guesses);
            if (getWinner() || guesses == 0) {
                if (getWinner()) {
                    text = "You won";
                    color = "green";
                } else {
                    text = "You lost";
                    
                    color = "red";
                }
                $("#hint").html(hint);
                $("#man").css("border","1px solid "+color);
                // set #buttons div to form to reset game
                $("#buttons").html(text+"<br><form><input type='submit' value='Play Again'></form>");
            }
        });
    }
});