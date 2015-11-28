<!DOCTYPE html>
<html>
<head>
<title>Modifier les articles</title>
<meta charset="UTF-8"/>
</head>

<body>
<form action="action_modifie_journal.php" method="post"  accept-charset="UTF-8" enctype="multipart/form-data" > 
<?php
include('constantes.php');
if (!empty($_POST)) {
	$nb_article = 0;
	foreach ($_POST as $key => $value){
		include('conect_database.php');
		$req = $bdd->prepare('SELECT * FROM journal WHERE id = ?');
		$req->execute(array($value));
		$donnees = $req->fetch();
		echo "<fieldset>\n";
		echo "<input type=\"hidden\" name=\"id_".$value."\" value= \"".$value."\">\n";
		echo "<legend> Modifier ".$donnees['titre']."</legend>\n";
		echo "Titre de l'article: <input type=\"text\" name=\"".$value."_titre\" value=\"".$donnees['titre']."\" required/> <br/>\n";
		echo "Date:  <input type=\"text\" name=\"".$value."_date\" value=\"".$donnees['date']."\" required/> <br/>\n"; 
		echo "Type:  <input type=\"text\" name=\"".$value."_type\" value=\"".$donnees['type']."\"/> <br/>\n"; 
		echo "Texte: <br><textarea name=\"".$value."_text\" rows=\"10\" cols=\"100\" required /> ".$donnees['text']."</textarea><br>\n"; 
		echo "Numero: <input type=\"number\" name=\"".$value."_numero\" min=\"0\" step=\"1\" required value=\"".$donnees['numero']."\"/> <br/>\n"; 
		echo "Supprimer des photos de l'article: <br/>\n";
		$req2 = $bdd->prepare('SELECT * FROM photo_journal WHERE id_journal = ? ORDER BY nom');
		$req2->execute(array($value));
		$compteur = 0;
		while ($donnees2 = $req2->fetch()){
			echo  "<input type=\"checkbox\" name=\"photo_".$donnees2['id']."_".$donnees2['id_journal']."\" value=\"" . $donnees2['nom']  . "\"\>\n";
			echo "<img src=\"/img/journal/minature/".$donnees2['nom']."\" />\n";
			$compteur++;
			if ($compteur%4 == 0)
				echo "<br/>";
		}
		echo "<br/>\nAjouter des photos, les photos s'ajouteront dans l'ordre photo1) suivi photo2) etc... a la fin de l'article, si tu veux insérer des photos au millieu de l'article supprime l'article et fais en un nouveau:)<br/>";
		for ($i = 1; $i <= 5; $i++) {
			echo "Photo ".$i.")<input type=\"file\" accept=\"image/*\" name=\"".$value."_photo_" . $i . "\" /><br/>\n"; 
		}
		echo "</fieldset>\n";
		$req->closeCursor();
		$req2->closeCursor();
		$nb_article++;
	}
	if ($nb_article == 1)
		echo "<input type=\"submit\" value=\"Modifier l'article\"/>";
	else
		echo "<input type=\"submit\" value=\"Modifier les articles\"/>";
}	
else {
	echo "Aucun article sélectioné!<br/>";
	echo "<a href=\"modifie_journal_1.php\">Sélectionner des articles</a><br/>\n";
	echo "<a href=\"index.php\">Retour au menu</a><br/>\n";
}
?>
</form>
</body>
</html>