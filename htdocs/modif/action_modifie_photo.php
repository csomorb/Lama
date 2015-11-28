<!DOCTYPE html>
<html>
<head>
<title>Modifie Photo</title>
<meta charset="UTF-8"/>
</head>

<body>
<?php 
include('constantes.php');
include('fonction.php');
if (!empty($_POST)) {
	$nb_album = 0;
	$nb_photo = 0;
	foreach ($_POST as $key => $value){
		$part = explode("_",$key);
		if ( strcmp("id",$part[0]) == 0 ) {
			//mise a jour de la bdd photo
			$id_album = $value;
			include('conect_database.php');
			$req = $bdd->prepare('UPDATE photo SET titre = :nvtitre, date = :nvdate, numero = :nvnumero, alt_couverture = :nvalt_couverture WHERE id = :id_album');
			$req->execute(array(
			'nvtitre' => htmlspecialchars($_POST[$id_album.'_titre']),
			'nvdate' => htmlspecialchars($_POST[$id_album.'_date']),
			'nvnumero' => htmlspecialchars($_POST[$id_album.'_numero']),
			'nvalt_couverture' => htmlspecialchars($_POST[$id_album.'_alt_couverture']),
			'id_album' => $id_album 
			));
			$nb_album++;
		}
		if ( strcmp("photo",$part[0]) == 0 ) {
			// supression des photos
			$id_photo = htmlspecialchars($part[1]);
			if (file_exists(CHEMIN_BASE."/img/photo/".$part[2]."/minature/".$value))
				if(! unlink(CHEMIN_BASE."/img/photo/".$part[2]."/minature/".$value)) 
					echo "Echec de supression de la minature: ".$value ;
				else
					$nb_photo++;
			if (file_exists(CHEMIN_BASE."/img/photo/".$part[2]."/".$value))
				if(! unlink(CHEMIN_BASE."/img/photo/".$part[2]."/".$value))
					echo "Echec de supression de la photo: ".$value ;
			// suppression des photos de la bdd
			include('conect_database.php');
			$req = $bdd->prepare('DELETE FROM photo_photo WHERE id= ?');
			$req->execute(array($id_photo));
			$req->closeCursor();
		}
	}
}
else 
	echo "formulaire vide!";
//ajout des photos
foreach ($_FILES as $key => $value) {
	if ($_FILES[$key]['error'] == 0) {
		$part = explode("_",$key);
		if (strcmp ("couverture",$part[2]) == 0) {
			//on a une couverture d'album
			$upload1 = upload($key , CHEMIN_BASE.'/img/photo/' . $part[0] , 5000000 , array('jpg','png','jpeg','gif','JPG','PNG','JPEG','GIF')); 
			if ($upload1 )
				echo "Changement de la photo de couverture réussie!<br/>\n";
		}
		else {
			//on a une photo d'album
			//on détermine le nouveau nom
			include('conect_database.php');
			$req = $bdd->prepare('SELECT * FROM photo_photo WHERE id_photo = ? ORDER BY id DESC');
			$req->execute(array($part[0]));
			$data = $req->fetch();
			$nvnom = explode(".",$data['nom']);
			$nom_photo = $nvnom[0] + 1;
			$req->closeCursor();
			$upload1 = upload($key , CHEMIN_BASE.'/img/photo/'. $part[0].'/'.$nom_photo , 5000000 , array('jpg','png','jpeg','gif','JPG','PNG','JPEG','GIF'));
			if($upload1) {
			// ajout de l'image a la bdd
				$nom_photo .= "." . substr(strrchr($_FILES[$key]['name'],'.'),1);
				$req = $bdd->prepare('INSERT INTO photo_photo(id_photo, nom) VALUES(:id_photo,:nom)');
				$req->execute(array(
					'id_photo' => $part[0],
					'nom' =>  $nom_photo
				));
				$req->closeCursor();
				make_thumb(CHEMIN_BASE.'/img/photo/'.$part[0]."/" . $nom_photo,CHEMIN_BASE.'/img/photo/'. $part[0] .'/minature/' . $nom_photo,250) ;
				echo "Upload de la photo réussie...<br/>";
			}
			else
				echo "Aille, échec de l'upload du photo".$i."<br/>";
			
		}
	}
}

if ($nb_album == 1) 
	echo "Modification de l'album effectué!<br/>\n";
else
	echo "Modification de $nb_album albums effectué!<br/>\n";
if ($nb_photo == 1)
	echo "Une photo supprimée!<br/>\n";
elseif ($nb_photo > 1)
	echo "$nb_photo photos supprimées!<br/>\n";
echo "<a href=\"modifie_photo_1.php\">Sélectionner un autres albums à modifier</a><br/>\n";
echo "<a href=\"index.php\">Retour au menu</a><br/>\n";
?>
</body>
</html>