<!DOCTYPE html>
<html>
<head>
<title>Supprime Article</title>
<meta charset="UTF-8"/>
</head>

<body>

<form action="action_supprime_journal.php" method="post"  accept-charset="UTF-8" >
<fieldset> 
<legend>Supprimer des articles du journal</legend>
<?php 
include('conect_database.php');
$reponse = $bdd->query('SELECT * FROM journal ORDER BY numero');
	while ($donnees = $reponse->fetch())
	{
		echo "<input type=\"checkbox\" name=\"". $donnees['id'] ."\" value=\"" . $donnees['id']  . "\"\>\n";
		echo "Titre: " .$donnees['titre']." Numéro: ".$donnees['numero']."<br/>\n";
	}
$reponse->closeCursor();
?>
<br/>
<input type="submit" value="Supprimer les articles"/>
</fieldset>
</form>
</body>
</html>