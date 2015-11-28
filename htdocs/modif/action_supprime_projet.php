<!DOCTYPE html>
<html>
<head>
<title>Supprime Projet</title>
<meta charset="UTF-8"/>
</head>

<body>
<?php
include('constantes.php');
function supprime_projet($id_projet) {
	include('conect_database.php');
	$req = $bdd->prepare('SELECT count(id) AS nb_projet FROM projet WHERE id = ?');
	$req->execute(array($id_projet));
	$donnees = $req->fetch();
	if ($donnees['nb_projet'] == 0) {
		$req->closeCursor();
		return 0;
	}
	$req->closeCursor();
	$req = $bdd->prepare('SELECT * FROM photo_projet WHERE id_projet = :id_projet');
	$req->execute(array('id_projet' => $id_projet));
	while ($data = $req->fetch()) {
		if(! unlink(CHEMIN_BASE."/img/projets/".$data['nom'])) echo "Echec de supression de l image". $data['nom'] ;
		if(! unlink(CHEMIN_BASE."/img/projets/minature/".$data['nom'])) echo "Echec de supression de la minature". $data['nom'];
	}
	$req->closeCursor();
	$req = $bdd->prepare('DELETE FROM photo_projet WHERE id_projet = :id_projet');
	$req->execute(array('id_projet' => $id_projet));
	$req->closeCursor();
	$req = $bdd->prepare('SELECT * FROM projet WHERE id = :id_projet');
	$req->execute(array('id_projet' => $id_projet));
	$data = $req->fetch();
	if(! unlink(CHEMIN_BASE."/img/projets/".$data['photo_principale'])) echo "Echec de supression de l image". $data['nom'] ;
	if(! unlink(CHEMIN_BASE."/img/projets/minature/".$data['photo_principale'])) echo "Echec de supression de la minature". $data['nom'];
	$req->closeCursor();
	$req = $bdd->prepare('DELETE FROM projet WHERE id = :id_projet');
	$req->execute(array('id_projet' => $id_projet));
	$req->closeCursor();
	return 1;
}

if (!empty($_POST)) {
	$nb_projet = 0;
	foreach ($_POST as $key => $value){
		$nb_projet+=supprime_projet(htmlspecialchars($value));
	}
	include('fonction.php');
	genere_project_json();
	echo "$nb_projet Projet(s) supprimé !<br/>\n";
}
else 
	echo "Aucun projet sélectioné pour la supression!<br/>\n";
?>
<a href="supprime_projet.php">Supprimer d'autres projets</a><br/>
<a href="index.php">Retour au menu</a>
</body>
</html>