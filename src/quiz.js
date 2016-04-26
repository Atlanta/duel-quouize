$(document).ready(function() {
	$("#reponses").hide();
});

function getAllThemes() {
  $.ajax( {
    method: "POST",
    url: "http://localhost:80/duel.php",
    data: {
      request: 'getAllThemes'
    }
  })

  .done(function(response) {
      receivedThemes = response;
  })

  .fail(function(jqXHR, textStatus) {
    alert("Erreur : " + textStatus);
  });
}

function selectTheme() {
	var i = 0;
	$("#question").text("Pick a theme !");

	$.each("#reponses:li", function() {
		$(this).text(receivedThemes[i]);
		i++;
	});
}

$("#themes").click(function() {
	switch($(this).)

	$("#themes").hide(1000);
	$("#reponses").show(1000);
});

function sendChoosedTheme() {
  $.ajax( {
    method: "POST",
    url: "http://localhost:80/duel.php",
    data: {
      request: 'getRandomThemes'
    }
  })

  .done(function(response) {
      receivedThemes = response;
  })

  .fail(function(jqXHR, textStatus) {
    alert("Erreur : " + textStatus);
  });
}

$( document ).ajaxStart(function() {
  $( ".log" ).text( "Triggered ajaxStart handler." );
});

var receivedThemes;
var choosedTheme;
var questions;
var nbCorrectAwnsers;
