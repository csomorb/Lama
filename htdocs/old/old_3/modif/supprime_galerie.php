<!DOCTYPE html>
<html>
<head>
<title>Supprime Galerie</title>
<meta charset="UTF-8"/>
</head>

<body>
<form action="action_supprime_galerie.php" method="post"  accept-charset="UTF-8">
<fieldset> 
<legend>Supprimer des photos de la galerie</legend>


<?php
include("conect_database.php");
$reponse = $bdd->query('SELECT nom FROM photo_galerie ORDER BY nom DESC');
	$compteur=0;
	while ($donnees = $reponse->fetch())
	{
		if ($compteur%4 == 0)
			echo "<br/>";
		echo "<input type=\"checkbox\" name=\"". $donnees['nom'] ."\" value=\"" . $donnees['nom']  . "\"\>\n";
		echo "<img src=\"/img/galerie/minature/". $donnees['nom'] ."\" />\n";
		$compteur++;	
	}
$reponse->closeCursor();
?>
<br/>
<input type="submit" value="Supprimer les photos"/>
</fieldset>
</form>
</body>
</html>