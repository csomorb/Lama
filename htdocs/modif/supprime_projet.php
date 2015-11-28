<!DOCTYPE html>
<html>
<head>
<title>Supprimer des projet</title>
<meta charset="UTF-8"/>
</head>

<body>

<form action="action_supprime_projet.php" method="post"  accept-charset="UTF-8" >
<fieldset> 
<legend>Supprimer des projets</legend>
<?php 
include('conect_database.php');
$compteur=0;
$reponse = $bdd->query('SELECT * FROM projet');
	while ($donnees = $reponse->fetch())
	{
		if($compteur%3 == 0)
			echo "<br/>";
		echo "<img src=\"/img/projets/minature/". $donnees['photo_principale'] ."\" />  \n";
		echo "<input type=\"checkbox\" name=\"". $donnees['id'] ."\" value=\"" . $donnees['id']  . "\"/>\n";
		echo $donnees['titre'];
		$compteur++;
	}
$reponse->closeCursor();
?>
<br/>
<input type="submit" value="Supprimer les projets"/>
</fieldset>
</form>
</body>
</html>