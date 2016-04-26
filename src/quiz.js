var theme = 0;
var idGame;
var idQuestion = 0;
var reponses;
var nbBonnesReponses = 0;
var questions = null;

$("document").ready(function() {
	$("#reponses").hide();
});

function startGame(theme) {
  $.ajax( {
    method: "POST",
    url: "http://localhost:80/duel-quouize/request.php",
		async: false,
    data: {
      request: 'getDatas',
			theme: theme
    }
  })

  .done(function(response) {
			var datas = $.parseJSON(response);
      idGame = datas.id;
			questions = datas.questions;
  })

  .fail(function(jqXHR, textStatus) {
    alert("Erreur : " + textStatus);
  });
}

function loadQuestion(idQuestion) {
	$("#question").text(questions[idQuestion].text);

	$("#r1").text(questions[idQuestion].reponse1);
	$("#r2").text(questions[idQuestion].reponse2);
	$("#r3").text(questions[idQuestion].reponse3);
	$("#r4").text(questions[idQuestion].reponse4);
}

function endGame() {
	$("#question").text("Résultats");
	$("#nbPoints").text(nbBonnesReponses + "/5");
	$("#bar").width((nbBonnesReponses*20)+"%")
	$("#results").show(1000);
}

$("#themes").children().click(function() {
	theme = $(this).attr("id");

	startGame(theme);

	loadQuestion(idQuestion);

	$("#themes").hide(1000);
	$("#reponses").show(1000);
});

$("#reponses").children().click(function() {
	var choosedAwnser = parseInt($(this).attr("id").substring(1,2));

	console.log(choosedAwnser);

	if(choosedAwnser == parseInt(questions[idQuestion].reponse)) {
		nbBonnesReponses++;
	}

	idQuestion++;

	if(idQuestion < 5) {
		loadQuestion(idQuestion);
	}
	else {
		$("#reponses").hide(1000);
		endGame();
		console.log("Bonnes réponses = " + nbBonnesReponses);
	}
});
