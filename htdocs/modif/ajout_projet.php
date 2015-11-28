<!DOCTYPE html>
<html>
<head>
<title>Ajout Projet</title>
<meta charset="UTF-8"/>
</head>

<body>
<form action="action_ajout_projet.php" method="post"  accept-charset="UTF-8" enctype="multipart/form-data">
<fieldset> <legend>Ajouter un projet</legend>
	Nom du projet: <input type="text" name="titre" autofocus required/> <br/>
	Description du projet: <input type="text" name="description" /> <br/>
	Note: <input type="text" name="note" /> <br/>
	Photo principale: <input type="file" name="photo_principale" accept="image/*"  required /> <br/>
	Commandataire: <input type="text" name="commandataire"/> <br/>
	Commande: <br/> 
		<textarea name="commande" rows="5" cols="50"> Enrte le contenu ici.</textarea> <br/>
	Date: <input type="text" name="date"/> <br/>
	Composition: <br/>
		<textarea name="composition" rows="5" cols="50"> Enrte le contenu ici.</textarea> <br/>
	Photographies: <input type="text" name="photographie" value="Baptiste Plantin"/> <br/>
	Medium: <input type="text" name="medium" value=""/> <br/>
	Sous-titre: <input type="text" name="sous_titre"/> <br/>
	Le gros texte: <br/>
	La grande lettre: <input type="text" name="grande_lettre" value="ne pas utiliser"><br/>
		<textarea name="contenu_gras" rows="15" cols="100">ne pas utiliser</textarea> <br/>
	La suite du gros texte: <br/>
		<textarea name="contenu_norm" rows="15" cols="100"> Sera affiché normalement </textarea>	<br/>
	Photos:<br/>
	<?php
	include('constantes.php');
	for ($i = 1; $i <= NOMBRE_PHOTO_PROJET; $i++) {
		echo "Photo ".$i.")<input type=\"file\" accept=\"image/*\" name=\"photo_" . $i . "\" /><br/>\n"; 
	}
	?>
<input type="submit" value="Ajouter le projet"/>
</fieldset>
</form>
</body>
</html>
