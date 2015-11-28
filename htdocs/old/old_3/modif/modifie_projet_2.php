<!DOCTYPE html>
<html>
<head>
<title>Modifier projet</title>
<meta charset="UTF-8"/>
</head>

<body>
<form action="action_modifie_projet.php" method="post"  accept-charset="UTF-8" enctype="multipart/form-data" > 
<?php
include('constantes.php');
if (!empty($_POST)) {
	$nb_projet = 0;
	include('conect_database.php');
	foreach ($_POST as $key => $value){
		$req = $bdd->prepare('SELECT * FROM projet WHERE id = ?');
		$req->execute(array($value));
		$donnees = $req->fetch();
		echo "<fieldset>\n";
		echo "<input type=\"hidden\" name=\"id_".$value."\" value= \"".$value."\">\n";
		echo "<legend> Modifier ".$donnees['titre']."</legend>\n";
		echo "Nom du projet: <input type=\"text\" name=\"".$value."_titre\" value=\"".$donnees['titre']."\" required/> <br/>\n";
		echo "Description du projet: <input type=\"text\" name=\"".$value."_description\" value=\"".$donnees['description']."\"/> <br/>\n";
		echo "Note: <input type=\"text\" name=\"".$value."_note\" value=\"".$donnees['note']."\"/> <br/>\n";
		echo "Commandataire: <input type=\"text\" name=\"".$value."_commandataire\" value=\"".$donnees['commandataire']."\"/> <br/>\n";
		echo "Commande: <br/> \n";
		echo "	<textarea name=\"".$value."_commande\" rows=\"5\" cols=\"50\">".$donnees['commande']."</textarea> <br/>\n";
		echo "Date: <input type=\"text\" name=\"".$value."_date\" value=\"".$donnees['date']."\"/> <br/>\n";
		echo "Composition: <br/>\n";
		echo "	<textarea name=\"".$value."_composition\" rows=\"5\" cols=\"50\">".$donnees['composition']."</textarea> <br/>\n";
		echo "Photographies: <input type=\"text\" name=\"".$value."_photographie\" value=\"".$donnees['photographie']."\" /> <br/>\n";
		echo "Medium: <input type=\"text\" name=\"".$value."_medium\" value=\"".$donnees['medium']."\"/> <br/>\n";
		echo "Sous-titre: <input type=\"text\" name=\"".$value."_sous_titre\" value=\"".$donnees['sous_titre']."\"/> <br/>\n";
		echo "Le gros texte: <br/>\n";
		echo "La grande lettre: <input type=\"text\" name=\"".$value."_grande_lettre\" value=\"".$donnees['lettre']."\"/><br/>\n";
		echo "Texte affiché en gras: <br/><textarea name=\"".$value."_contenu_gras\" rows=\"15\" cols=\"100\">".$donnees['gras']."</textarea> <br/>\n";
		echo "La suite du gros texte en normal: <br/>\n";
		echo "	<textarea name=\"".$value."_contenu_norm\" rows=\"15\" cols=\"100\">".$donnees['normal']."</textarea>	<br/>\n";
		echo "Photo principale du projet: " ;
		echo "<img src=\"/img/projets/minature/".$donnees['photo_principale']."\" />\n";
		echo "Pour changer la photo de couverture sélectionne une photo: <input type=\"file\" accept=\"image/*\" name=\"".$value."_photoprincipale\" /><br/>\n" ;
		echo "Supprimer des photos de l'album: <br/>\n";
		$req2 = $bdd->prepare('SELECT * FROM photo_projet WHERE id_projet = ? ORDER BY nom');
		$req2->execute(array($value));
		$compteur = 0;
		while ($donnees2 = $req2->fetch()){
			echo  "<input type=\"checkbox\" name=\"photo_".$donnees2['id']."_".$donnees2['id_projet']."\" value=\"" . $donnees2['nom']  . "\"/>\n";
			echo "<img src=\"/img/projets/minature/".$donnees2['nom']."\" />\n";
			$compteur++;
			if ($compteur%4 == 0)
				echo "<br/>";
		}
		echo "<br/>\nAjouter des photos, les photos s'ajouteront dans l'ordre photo1) suivi photo2) etc... a la fin du projet, si tu veux insérer des photos au millieu du projet supprime les photos et remets les:)<br/>";
		for ($i = 1; $i <= NOMBRE_PHOTO_PROJET; $i++) {
			echo "Photo ".$i.")<input type=\"file\" accept=\"image/*\" name=\"".$value."_photo_" . $i . "\" /><br/>\n"; 
		}
		echo "</fieldset>\n";
		$req->closeCursor();
		$req2->closeCursor();
		$nb_projet++;
	}
	if ($nb_projet == 1)
		echo "<input type=\"submit\" value=\"Modifier le projet\"/>";
	else
		echo "<input type=\"submit\" value=\"Modifier les projets\"/>";
}	
else {
	echo "Aucun projet!<br/>";
	echo "<a href=\"modifie_projet_1.php\">Sélectionner des Projets</a><br/>\n";
	echo "<a href=\"index.php\">Retour au menu</a><br/>\n";
}
?>
</form>
</body>
</html>