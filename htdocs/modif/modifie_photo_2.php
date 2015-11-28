<!DOCTYPE html>
<html>
<head>
<title>Modifier les albums</title>
<meta charset="UTF-8"/>
</head>

<body>
<form action="action_modifie_photo.php" method="post"  accept-charset="UTF-8" enctype="multipart/form-data" > 
<?php
include('constantes.php');
if (!empty($_POST)) {
	$nb_album = 0;
	foreach ($_POST as $key => $value){
		include('conect_database.php');
		$req = $bdd->prepare('SELECT * FROM photo WHERE id = ?');
		$req->execute(array($value));
		$donnees = $req->fetch();
		echo "<fieldset>\n";
		echo "<input type=\"hidden\" name=\"id_".$value."\" value= \"".$value."\">\n";
		echo "<legend> Modifier ".$donnees['titre']."</legend>\n";
		echo "Titre de l'album: <input type=\"text\" name=\"".$value."_titre\" value=\"".$donnees['titre']."\" required/> <br/>\n";
		echo "Date:  <input type=\"text\" name=\"".$value."_date\" value=\"".$donnees['date']."\" required/> <br/>\n"; 
		echo "Numero: <input type=\"number\" name=\"".$value."_numero\" min=\"0\" step=\"1\" required value=\"".$donnees['numero']."\"/> <br/>\n"; 
		echo "Photo couverture de l'album: " ;
		echo "<img src=\"/img/photo/".$donnees['nom_couverture']."\" />\n";
		echo "Text alt: <input type=\"text\" name=\"".$value."_alt_couverture\" value=\"".$donnees['alt_couverture']."\" /> <br/>\n" ; 
		echo "Pour changer la photo de couverture sélectionne une photo: <input type=\"file\" accept=\"image/*\" name=\"".$value."_photo_couverture\" /><br/>\n" ;
		echo "Supprimer des photos de l'album: <br/>\n";
		$req2 = $bdd->prepare('SELECT * FROM photo_photo WHERE id_photo = ? ORDER BY nom');
		$req2->execute(array($value));
		$compteur = 0;
		while ($donnees2 = $req2->fetch()){
			echo  "<input type=\"checkbox\" name=\"photo_".$donnees2['id']."_".$donnees2['id_photo']."\" value=\"" . $donnees2['nom']  . "\"\>\n";
			echo "<img src=\"/img/photo/".$donnees['id']."/minature/".$donnees2['nom']."\" />\n";
			$compteur++;
			if ($compteur%4 == 0)
				echo "<br/>";
		}
		echo "<br/>\nAjouter des photos, les photos s'ajouteront dans l'ordre photo1) suivi photo2) etc... a la fin de l'album, si tu veux insérer des photos au millieu de l'album supprime l'album et fais en un nouveau:)<br/>";
		for ($i = 1; $i <= NOMBRE_PHOTO_ALBUM; $i++) {
			echo "Photo ".$i.")<input type=\"file\" accept=\"image/*\" name=\"".$value."_photo_" . $i . "\" /><br/>\n"; 
		}
		echo "</fieldset>\n";
		$req->closeCursor();
		$req2->closeCursor();
		$nb_album++;
	}
	if ($nb_album == 1)
		echo "<input type=\"submit\" value=\"Modifier l'album\"/>";
	else
		echo "<input type=\"submit\" value=\"Modifier les albums\"/>";
}	
else {
	echo "Aucun album sélectioné!<br/>";
	echo "<a href=\"modifie_photo_1.php\">Sélectionner des Albums</a><br/>\n";
	echo "<a href=\"index.php\">Retour au menu</a><br/>\n";
}
?>
</form>
</body>
</html>