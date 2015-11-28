<!DOCTYPE html>
<html>
<head>
<title>Modifier les albums</title>
<meta charset="UTF-8"/>
</head>

<body>

<form action="modifie_photo_2.php" method="post"  accept-charset="UTF-8" >
<fieldset> 
<legend>Modifier des albums photos</legend>
<?php 
include('conect_database.php');
$compteur=0;
$reponse = $bdd->query('SELECT * FROM photo ORDER BY numero');
	while ($donnees = $reponse->fetch())
	{
		if($compteur%3 == 0)
			echo "<br/>";
		echo "<img src=\"/img/photo/". $donnees['nom_couverture'] ."\" />  \n";
		echo "<input type=\"checkbox\" name=\"". $donnees['id'] ."\" value=\"" . $donnees['id']  . "\"\>\n";
		echo $donnees['titre']." ".$donnees['numero'];
		$compteur++;
	}
$reponse->closeCursor();
?>
<br/>
<input type="submit" value="Modifier les albums"/>
</fieldset>
</form>
</body>
</html>