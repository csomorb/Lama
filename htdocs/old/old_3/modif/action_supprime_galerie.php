<!DOCTYPE html>
<html>
<head>
<title>Supprime Galerie</title>
<meta charset="UTF-8"/>
</head>

<body>
<?php
include('constantes.php');
function suprime_photo_galerie($nom_photo) {
	include('conect_database.php');
	$req = $bdd->prepare('SELECT count(nom) AS nb_photo FROM photo_galerie WHERE nom = ?');
	$req->execute(array($nom_photo));
	$donnees = $req->fetch();
	if ($donnees['nb_photo'] == 0) {
		$req->closeCursor();
		return 0;
	}
	$req->closeCursor();
	$req = $bdd->prepare('DELETE FROM photo_galerie WHERE nom = :nom_photo');
	$req->execute(array('nom_photo' => $nom_photo));
	$req->closeCursor();
	if(! unlink(CHEMIN_BASE."/img/galerie/".$nom_photo)) echo "Echec de supression de l image" ;
	if(! unlink(CHEMIN_BASE."/img/galerie/minature/".$nom_photo)) echo "Echec de supression de la minature";
	return 1;
}

if (!empty($_POST)) {
	$nb_photo = 0;
	foreach ($_POST as $key => $value){
		$nb_photo+=suprime_photo_galerie(htmlspecialchars($value));
	}
	echo $nb_photo." Photos(s) supprimé !<br/>\n";
}
else 
	echo "Aucune photo sélectioné pour la supression!<br/>\n";
?>
<a href="supprime_galerie.php">Supprimer d'autres photos de la galérie</a><br/>
<a href="index.php">Retour au menu</a>
</body>
</html>