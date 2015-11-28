<!DOCTYPE html>
<html>
<head>
<title>Modifier les articles</title>
<meta charset="UTF-8"/>
</head>

<body>

<form action="modifie_journal_2.php" method="post"  accept-charset="UTF-8" >
<fieldset> 
<legend>Modifier des articles du journal</legend>
<?php 
include('conect_database.php');
$reponse = $bdd->query('SELECT * FROM journal ORDER BY numero');
	while ($donnees = $reponse->fetch())
	{
		echo "<input type=\"checkbox\" name=\"". $donnees['id'] ."\" value=\"" . $donnees['id']  . "\"\>\n";
		echo "Numero: ".$donnees['numero']." Titre: ".$donnees['titre']."<br/>";
	}
$reponse->closeCursor();
?>
<br/>
<input type="submit" value="Modifier les articles"/>
</fieldset>
</form>
</body>
</html>