<!DOCTYPE html>
<html>
<head>
<title>Supprime Photos</title>
<meta charset="UTF-8"/>
</head>

<body>
<form action="action_supprime_album.php" method="post"  accept-charset="UTF-8" >
<fieldset> 
<legend>Supprimer des albums photos</legend>
<?php 
include('conect_database.php');
$compteur=0;
$reponse = $bdd->query('SELECT * FROM photo ORDER BY numero');
	while ($donnees = $reponse->fetch())
	{
		if ($compteur%3 == 0)
			echo "<br/>";
		echo "<img src=\"/img/photo/". $donnees['nom_couverture'] ."\" />  \n";
		echo "<input type=\"checkbox\" name=\"". $donnees['id'] ."\" value=\"" . $donnees['id']  . "\"\>\n";
		echo "Titre:".$donnees['titre']." Numero: ".$donnees['numero'];
		$compteur++;
	}
$reponse->closeCursor();
?>
<br/>
<input type="submit" value="Supprimer les albums"/>
</fieldset>
</form>
</body>
</html>