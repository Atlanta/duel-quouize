<?php
require_once("accesBdd.php");

/* @return Game id */
function createGame() {
  $pdo = connexionBdd();
  $id = null;
  $sql1 = 'INSERT INTO `parties` (`id`, `user1`, `user2`, `awnsers1`, `awnsers2`, `winner`) VALUES (NULL, \'0\', \'0\', \'0\', \'0\', \'0\')';
  $sql2 = 'SELECT `id` FROM `parties` ORDER BY `id` DESC LIMIT 1';

  try {
      $requete = $pdo->query($sql1);
      $requete->execute();

      $requete = $pdo->query($sql2);
      $requete->execute();

      $id = $requete->fetchAll();
      $requete->CloseCursor();
      $requete = null;
  } catch(PDOException $e) {
      $requete = null;
      echo 'Erreur lors de la création de la partie : ' . $e->getMessage() . '';
      die();
  }

  return $id[0]["id"];
}

function getQuestions($theme) {
		$pdo = connexionBdd();
		$questions = null;
		$sql = 'SELECT * FROM `questions` WHERE `theme`='.$theme.'';

		try {
				$requete = $pdo->query($sql);
				$requete->execute();

				$questions = $requete->fetchAll();
				$requete->CloseCursor();
				$requete = null;
		} catch(PDOException $e) {
				$requete = null;
				echo 'Erreur lors de la récupération des questions : ' . $e->getMessage() . '';
				die();
		}
		return $questions;
}

function selectRandomQuestions($allQuestions) {
    $randomQuestions = array();
		shuffle($allQuestions);
    for ($i=0; $i < 5; $i++) {
      array_push($randomQuestions, $allQuestions[$i]);
    }
		return $randomQuestions;
}

switch ($_POST['request']) {
  case 'getDatas':
    $gameId = createGame();
    $questions = getQuestions($_POST["theme"]);
    $questions = selectRandomQuestions($questions);
    $return = array("id" => $gameId, "questions" => $questions);
    echo json_encode($return);
    break;
  case 'sendResult':
    break;
}

?>
