<!DOCTYPE html>
<html>
<head>
<title>Ajout Journal</title>
<meta charset="UTF-8"/>
</head>

<body>
<?php
include('conect_database.php');
include('constantes.php');
include('fonction.php');
$req = $bdd->prepare('INSERT INTO journal(numero, date,
		text, type, titre) VALUES(:numero,
		:date, :text, :type, :titre)');
$req->execute(array(
	'numero' => htmlspecialchars($_POST['numero']),
	'date' =>  htmlspecialchars($_POST['date']),
	'text' =>  htmlspecialchars($_POST['contenu']),
	'type' =>  htmlspecialchars($_POST['type']),
	'titre' =>  htmlspecialchars($_POST['titre']),
	));
$req->closeCursor();
$reponse = $bdd->query('SELECT MAX(id) AS id FROM journal');
$donnees = $reponse->fetch();
$id_journal = $donnees['id'];
$reponse->closeCursor();


// collecte des images
$nb_image = 0;
for ($i = 1; $i <= NOMBRE_PHOTO_JOURNAL; $i++) {
	// si il y a une image
	if ($_FILES['photo_'.$i]['error'] == 0) {
		$upload = upload('photo_'.$i , CHEMIN_BASE.'/img/journal/'.$id_journal."_".$i, 5000000 , array('jpg','png','jpeg','gif','JPG','PNG','JPEG','GIF'));
		if($upload) {
		// ajout de l'image a la bdd
			$nom_photo = $id_journal."_".$i."." . substr(strrchr($_FILES['photo_'.$i]['name'],'.'),1);
			$req = $bdd->prepare('INSERT INTO photo_journal(id_journal, nom) VALUES(:id_journal,:nom)');
			$req->execute(array(
				'id_journal' => $id_journal,
				'nom' =>  $nom_photo
			));
			$req->closeCursor();
			make_thumb(CHEMIN_BASE.'/img/journal/'.$nom_photo,CHEMIN_BASE.'/img/journal/minature/' . $nom_photo,250) ;
			echo "Upload de la photo".$i." réussie...<br/>";
		}
		else
			echo "Aille, échec de l'upload du photo".$i."<br/>";			
	}	
}
echo "L'article a été ajouté au journal!<br/>\n";
?>
<a href="ajout_journal.php">Ajouter d'autres articles</a><br/>
<a href="index.php">Retour au menu</a>
</body>
</html>