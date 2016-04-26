<?php
include_once("accesBdd.php");

function getAllThemes() {
    $pdo = connexionBdd();
    $themes = null;
    $sql = 'SELECT * FROM themes';

    try {
        $requete = $pdo->query($sql);
        $requete->execute();

        $themes = $requete->fetchAll();
        $requete->CloseCursor();
        $requete = null;
    } catch(PDOException $e) {
        $requete = null;
        echo 'Erreur : : ' . $e->getMessage() . '';
        die();
    }
    return $themes;
}

function selectRandomThemes($allThemes) {
		$randomThemes = array();
		while(count($randomThemes) < 4) {
				$id = rand(0, count($allThemes)-1);
				if(!in_array($allThemes[$id], $randomThemes, true)) {
					array_push($randomThemes, $allThemes[$id]);
				}
		}
		return $randomThemes;
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="css/breeze.css">
</head>
<body>
	<div class="wrapper">
		<div class="container">
			<h1>Duel Quizz</h1>

			<h2 id="question">Pick a theme</h2>

			<form id="themes" action="#">
				<?php
				$randomThemes = selectRandomThemes(getAllThemes());
				foreach ($randomThemes as $theme) {
					echo "<button id=".$theme["id"].">".$theme["nom"]."</button>";
				}?>
			</form>

			<form style="display:none" id="reponses">
				<button id="r1"></button>
				<button id="r2"></button>
				<button id="r3"></button>
				<button id="r4"></button>
			</form>

			<div id="results" style="display:none">
				<h2 id="nbPoints">/5</h2>
				<h3> bonnes réponses</h3>
				<!--<div id=barContainer><div id="bar"></div></div>-->
			</div>
		</div>

		<ul class="bg-bubbles">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
	</div>

	<script type="text/javascript" src="inc/jquery.js"></script>
	<script type="text/javascript" src="src/quiz.js"></script>
</body>
</html>
