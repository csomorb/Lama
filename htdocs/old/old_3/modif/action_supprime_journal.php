<!DOCTYPE html>
<html>
<head>
<title>Supprime Journal</title>
<meta charset="UTF-8"/>
</head>

<body>
<?php
include('constantes.php');

function suprime_article($id_article) {
	include('conect_database.php');
	$req1 = $bdd->prepare('SELECT count(id) AS nb_article FROM journal WHERE id = ?');
	$req1->execute(array($id_article));
	$donnees = $req1->fetch();
	if ($donnees['nb_article'] == 0) {
		$req1->closeCursor();
		return 0;
	}
	$req1->closeCursor();
	//on supprimme les phots de l'article et les minatures corespondants
	$req2 = $bdd->prepare('SELECT * FROM photo_journal WHERE id_journal = ?');
	$req2->execute(array($id_article));
	while ($donnees = $req2->fetch()){
		if(file_exists(CHEMIN_BASE."/img/journal/".$donnees['nom']))
			if(! unlink(CHEMIN_BASE."/img/journal/".$donnees['nom'])) echo "Echec de supression de l image" ;
		if(file_exists(CHEMIN_BASE."/img/journal/minature/".$donnees['nom']))
			if(! unlink(CHEMIN_BASE."/img/journal/minature/".$donnees['nom'])) echo "Echec de supression de l image" ;
	}
	$req2->closeCursor();
	// on supprime les photo de la table photo_journal
	$req3 = $bdd->prepare('DELETE FROM photo_journal WHERE id_journal = :id_journal');
	$req3->execute(array('id_journal' => $id_article));
	$req3->closeCursor();
	// on supprime les données de l'album
	$req4 = $bdd->prepare('DELETE FROM journal WHERE id = :id');
	$req4->execute(array('id' => $id_article));
	$req4->closeCursor();
	return 1;
}

if (!empty($_POST)) {
	$nb_article = 0;
	foreach ($_POST as $key => $value){
		$nb_article+=suprime_article(htmlspecialchars($value));
	}
	echo $nb_article." article(s) supprimé!";
}	
else
	echo "Aucun article sélectioné pour la supression!";
?>
<a href="supprime_journal.php">Supprimer d'autres articles</a><br/>
<a href="index.php">Retour au menu</a>
</body>
</html>