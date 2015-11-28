<!DOCTYPE html>
<html>
<head>
<title>Ajout Project</title>
<meta charset="UTF-8"/>
</head>

<body>
<?php

include('fonction.php');
include('constantes.php');
include('conect_database.php');
if (!empty($_POST['titre'])) {
	//ajout du text a la bdd
	$req = $bdd->prepare('INSERT INTO projet (titre,description,commandataire,commande,date,composition,sous_titre,lettre,gras,normal,photographie,medium,note)
		VALUES (:titre,:description,:commandataire,:commande,:date,:composition,:sous_titre,:lettre,:gras,:normal,:photographie,:medium,:note)');
	$req->execute(array('titre' => htmlspecialchars($_POST['titre']),
						'description' => str_replace(array("\r\n", "\n", "\r"), " ",rtrim( nl2br(htmlspecialchars($_POST['description'])))),
						'commandataire' => htmlspecialchars($_POST['commandataire']),
						'commande' => str_replace(array("\r\n", "\n", "\r"), " ",rtrim( nl2br(htmlspecialchars($_POST['commande'])))),
						'date' => htmlspecialchars($_POST['date']),
						'composition' => str_replace(array("\r\n", "\n", "\r"), " ",rtrim( nl2br(htmlspecialchars($_POST['composition'])))),
						'sous_titre' => htmlspecialchars($_POST['sous_titre']),
						'lettre'=> htmlspecialchars($_POST['grande_lettre']),
						'gras'=> str_replace(array("\r\n", "\n", "\r"), " ",rtrim( nl2br(htmlspecialchars($_POST['contenu_gras'])))),
						'normal' => str_replace(array("\r\n", "\n", "\r"), " ", rtrim( nl2br(htmlspecialchars($_POST['contenu_norm'])))),
						'photographie' => htmlspecialchars($_POST['photographie']),
						'medium' => str_replace(array("\r\n", "\n", "\r"), " ",rtrim( nl2br(htmlspecialchars($_POST['medium'])))),
						'note' => str_replace(array("\r\n", "\n", "\r"), " ",rtrim( nl2br(htmlspecialchars($_POST['note']))))
	));
	$req->closeCursor();
	//ajout des images
	$req2 = $bdd->query('SELECT max(id) as dernier_id FROM projet');
	$result = $req2->fetch();
	$id = $result['dernier_id'];
	//ajout photo principale
	if ($_FILES['photo_principale']['error'] == 0) {
		$upload = upload('photo_principale' , CHEMIN_BASE.'/img/projets/'.$id."_principale", 5000000 , array('jpg','png','jpeg','gif','JPG','PNG','JPEG','GIF'));
		if($upload) {
		// ajout de l'image a la bdd
			$nom_photo = $id."_principale." . substr(strrchr($_FILES['photo_principale']['name'],'.'),1);
			$req = $bdd->prepare('UPDATE projet SET photo_principale =:photo_principale WHERE id =:id');
			$req->execute(array('id' => $id,
				'photo_principale' =>  $nom_photo
			));
			$req->closeCursor();
			make_thumb(CHEMIN_BASE.'/img/projets/'.$nom_photo,CHEMIN_BASE.'/img/projets/minature/' . $nom_photo,250) ;
			echo "Upload de la photo principale réussie...<br/>";
		}
		else
			echo "Aille, échec de l'upload de la photo principale<br/>";			
	}
	$req2->closeCursor();
	for ($i = 1; $i <= NOMBRE_PHOTO_PROJET; $i++) {
		// si il y a une image
		if ($_FILES['photo_'.$i]['error'] == 0) {
			$upload = upload('photo_'.$i , CHEMIN_BASE.'/img/projets/'.$id."_".$i, 5000000 , array('jpg','png','jpeg','gif','JPG','PNG','JPEG','GIF'));
			if($upload) {
			// ajout de l'image a la bdd
				$nom_photo = $id."_".$i."." . substr(strrchr($_FILES['photo_'.$i]['name'],'.'),1);
				$req = $bdd->prepare('INSERT INTO photo_projet(id_projet, nom) VALUES(:id_projet,:nom)');
				$req->execute(array(
					'id_projet' => $id,
					'nom' =>  $nom_photo
				));
				$req->closeCursor();
				make_thumb(CHEMIN_BASE.'/img/projets/'.$nom_photo,CHEMIN_BASE.'/img/projets/minature/' . $nom_photo,250) ;
				echo "Upload de la photo".$i." réussie...<br/>";
			}
			else
				echo "Aille, échec de l'upload du photo".$i."<br/>";			
		}	
	}
}
genere_project_json();
?>
<a href="ajout_projet.php">Ajouter un autre projet</a><br/>
<a href="index.php">Retour au menu</a><br/>
</body>
</html>