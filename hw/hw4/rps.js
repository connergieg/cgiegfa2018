var imgPlayer;
var btnRock;
var btnPaper;
var btnScissors;
var btnGo;
var playerChoice;
var rps = ["rock", "paper", "scissors"];
var computerChoice;

function init(){
	imgPlayer = document.getElementById("imgPlayer");
	btnRock = document.getElementById("btnRock");
	btnPaper = document.getElementById("btnPaper");
	btnScissors = document.getElementById("btnScissors");
}
	
function selectRock(){
	// alert('rock');
	imgPlayer.src = "images/rock.png";
	playerChoice = "rock";
	// console.log(playerChoice);
}

function selectPaper(){
	// alert('paper');
	imgPlayer.src = "images/paper.png";
	playerChoice = "paper";
	// console.log(playerChoice);
}

function selectScissors(){
	// alert('scissors');
	imgPlayer.src = "images/scissors.png";
	playerChoice = "scissors";
	// console.log(playerChoice);
}

function getComputerChoice() {
	var index = Math.floor(Math.random() * rps.length);
	return rps[index];
}

function decideMatchResult() {
	var result;
	if (playerChoice == "rock" && computerChoice == "rock") {
		reason = "Rock ties with rock";
		result = "Tie";
	} else if (playerChoice == "rock" && computerChoice == "paper") {
		reason = "Paper covers rock";
		result = "Computer wins";
		computerCount++;
	} else if (playerChoice == "rock" && computerChoice == "scissors") {
		reason = "Rock crushes scissors";
		result = "Player wins";
		playerCount++;
	} else if (playerChoice == "paper" && computerChoice == "rock") {
		reason = "Paper covers rock";
		result = "Player wins";
		playerCount++;
	} else if (playerChoice == "paper" && computerChoice == "paper") {
		reason = "Paper ties with paper";
		result = "Tie";
	} else if (playerChoice == "paper" && computerChoice == "scissors") {
		reason = "Scissors cut paper";
		result = "Computer wins";
		computerCount++;
	} else if (playerChoice == "scissors" && computerChoice == "rock") {
		reason = "Rock crushes scissors";
		result = "Computer wins";
		computerCount++;
	} else if (playerChoice == "scissors" && computerChoice == "paper") {
		reason = "Scissors cut paper";
		result = "Player wins";
		playerCount++;
	} else if (playerChoice == "scissors" && computerChoice == "scissors") {
		reason = "Scissors tie with scissors";
		result = "Tie";
	} else {
		reason = "";
		result = "Undecided try again";
	}
	$("#matchResult").append(reason);
	if (reason != "") {
		$("#matchResult").append("<br>");
	}
	$("#matchResult").append(result);
}

