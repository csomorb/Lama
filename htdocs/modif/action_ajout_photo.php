<!DOCTYPE html>
<html>
<head>
<title>Ajout Photo</title>
<meta charset="UTF-8"/>
</head>

<body>
<?php 
include('fonction.php');
include('constantes.php');
$id_album= id_album()+1;
$upload1 = upload('photo_couverture' , CHEMIN_BASE.'/img/photo/' . $id_album , 5000000 , array('jpg','png','jpeg','gif','JPG','PNG','JPEG','GIF')); 
if($upload1) {
    $nom_image = $id_album."." . substr(strrchr($_FILES['photo_couverture']['name'],'.'),1);	
	include("conect_database.php");
	$req = $bdd->prepare('INSERT INTO photo(id,titre, date, numero,nom_couverture,alt_couverture) 
					VALUES(:id,:titre,:date, :numero, :nom_couverture, :alt_couverture)');
	$req->execute(array(
	'id' => $id_album , 
	'titre' => htmlspecialchars($_POST['titre']),
	'date' =>  htmlspecialchars($_POST['date']),
	'numero' =>  htmlspecialchars($_POST['numero']),
	'nom_couverture' => $nom_image ,
	'alt_couverture' => htmlspecialchars($_POST['alt_couverture'])
	));
	$req->closeCursor();
	echo "Upload de la photo de couverture réussie...<br />";
	//création du dossier de l'album
	$dossier = $id_album;
	if(!is_dir(CHEMIN_BASE.'/img/photo/'.$dossier))
		mkdir(CHEMIN_BASE.'/img/photo/'.$dossier);
	$minature = "minature";
	if(!is_dir(CHEMIN_BASE.'/img/photo/'.$dossier.'/'.$minature)) 
		mkdir(CHEMIN_BASE.'/img/photo/'.$dossier.'/'.$minature);
	for ($i = 1; $i <= NOMBRE_PHOTO_ALBUM; $i++) {
		// si il y a une image
		if ($_FILES['photo_'.$i]['error'] == 0) {
			$upload = upload('photo_'.$i , CHEMIN_BASE.'/img/photo/' . $id_album ."/".$i , 5000000 , array('jpg','png','jpeg','gif','JPG','PNG','JPEG','GIF'));
			if($upload) {
			// ajout de l'image a la bdd
				$nom_photo = $i."." . substr(strrchr($_FILES['photo_'.$i]['name'],'.'),1);
				$req = $bdd->prepare('INSERT INTO photo_photo(id_photo, nom) VALUES(:id_photo,:nom)');
				$req->execute(array(
					'id_photo' => $id_album,
					'nom' =>  $nom_photo
				));
				$req->closeCursor();
				make_thumb(CHEMIN_BASE.'/img/photo/'.$id_album."/" . $nom_photo,CHEMIN_BASE.'/img/photo/'. $id_album .'/minature/' . $nom_photo,250) ;
				echo "Upload de la photo".$i." réussie...<br/>";
			}
			else
				echo "Aille, échec de l'upload du photo".$i."<br/>";
		}
	}	
}
else 
	echo "Hulalalala on a rencontre un problem! La photo de couverture n'a pas pu etre uplodé vers le serveur!<br/> Arret de l'upload...";
?>
<a href="ajout_photo.php">Ajouter un autre album</a><br/>
<a href="index.php">Retour au menu</a><br/>
</body>
</html>