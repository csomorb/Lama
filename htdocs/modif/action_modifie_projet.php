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
	$nb_projet = 0;
	$nb_photo = 0;
	foreach ($_POST as $key => $value){
		$part = explode("_",$key);
		if ( strcmp("id",$part[0]) == 0 ) {
			//mise a jour de la bdd projet
			$id_projet = $value;
			include('conect_database.php');
			$req = $bdd->prepare('UPDATE projet SET titre = :titre, description = :description, commandataire = :commandataire, commande = :commande,
								date = :date, composition = :composition, sous_titre = :sous_titre, lettre = :lettre, gras = :gras, normal = :normal,
								photographie = :photographie, medium = :medium, note= :note WHERE id = :id');
			$req->execute(array('titre' => htmlspecialchars($_POST[$id_projet.'_titre']),
					'description' => str_replace(array("\r\n", "\n", "\r"), " ",rtrim( nl2br(htmlspecialchars($_POST[$id_projet.'_description'])))),
					'commandataire' => htmlspecialchars($_POST[$id_projet.'_commandataire']),
					'commande' => str_replace(array("\r\n", "\n", "\r"), " ",rtrim( nl2br(htmlspecialchars($_POST[$id_projet.'_commande'])))),
					'date' => htmlspecialchars($_POST[$id_projet.'_date']),
					'composition' => str_replace(array("\r\n", "\n", "\r"), " ",rtrim( nl2br(htmlspecialchars($_POST[$id_projet.'_composition'])))),
					'sous_titre' => htmlspecialchars($_POST[$id_projet.'_sous_titre']),
					'lettre'=> htmlspecialchars($_POST[$id_projet.'_grande_lettre']),						
					'gras'=> str_replace(array("\r\n", "\n", "\r"), " ",rtrim( nl2br(htmlspecialchars($_POST[$id_projet.'_contenu_gras'])))),
					'normal' => str_replace(array("\r\n", "\n", "\r"), " ", rtrim( nl2br(htmlspecialchars($_POST[$id_projet.'_contenu_norm'])))),
					'photographie' => htmlspecialchars($_POST[$id_projet.'_photographie']),
					'medium' => str_replace(array("\r\n", "\n", "\r"), " ",rtrim( nl2br(htmlspecialchars($_POST[$id_projet.'_medium'])))),
					'note' => str_replace(array("\r\n", "\n", "\r"), " ",rtrim( nl2br(htmlspecialchars($_POST[$id_projet.'_note'])))),
					'id' => $id_projet
	));
			$nb_projet++;
		}
		if ( strcmp("photo",$part[0]) == 0 ) {
			// supression des photos
			$id_photo = htmlspecialchars($part[1]);
			if (file_exists(CHEMIN_BASE."/img/projets/minature/".$value))
				if(! unlink(CHEMIN_BASE."/img/projets/minature/".$value)) 
					echo "Echec de supression de la minature: ".$value ;
				else
					$nb_photo++;
			if (file_exists(CHEMIN_BASE."/img/projets/".$value))
				if(! unlink(CHEMIN_BASE."/img/projets/".$value))
					echo "Echec de supression de la photo: ".$value ;
			// suppression des photos de la bdd
			include('conect_database.php');
			$req = $bdd->prepare('DELETE FROM photo_projet WHERE id= ?');
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
		if (strcmp ("photoprincipale",$part[2]) == 0) {
			//on a une photo principale
			$upload1 = upload($key , CHEMIN_BASE.'/img/projets/' . $part[0].'_principale' , 5000000 , array('jpg','png','jpeg','gif','JPG','PNG','JPEG','GIF')); 
			if ($upload1 )
				echo "Changement de la photo de couverture réussie!<br/>\n";
		}
		else {
			//on a une photo d'album
			//on détermine le nouveau nom
			include('conect_database.php');
			$req = $bdd->prepare('SELECT * FROM photo_projet WHERE id_projet = ? ORDER BY id DESC');
			$req->execute(array($part[0]));
			$data = $req->fetch();
			$nvnom = explode(".",$data['nom']);
			$name = explode("_",$nvnom[0]);
			$nomphoto = $name[1] + 1;
			$nom_photo = $part[0]."_".$nomphoto;
			$req->closeCursor();
			$upload1 = upload($key , CHEMIN_BASE.'/img/projets/'.$nom_photo , 5000000 , array('jpg','png','jpeg','gif','JPG','PNG','JPEG','GIF'));
			if($upload1) {
			// ajout de l'image a la bdd
				$nom_photo .= "." . substr(strrchr($_FILES[$key]['name'],'.'),1);
				$req = $bdd->prepare('INSERT INTO photo_projet(id_projet, nom) VALUES(:id_projet,:nom)');
				$req->execute(array(
					'id_projet' => $part[0],
					'nom' =>  $nom_photo
				));
				$req->closeCursor();
				make_thumb(CHEMIN_BASE.'/img/projets/' . $nom_photo,CHEMIN_BASE.'/img/projets/minature/' . $nom_photo,250) ;
				echo "Upload de la photo réussie...<br/>";
			}
			else
				echo "Aille, échec de l'upload du photo".$i."<br/>";
			
		}
	}
}
genere_project_json();
if ($nb_projet == 1) 
	echo "Modification du projet effectué!<br/>\n";
else
	echo "Modification de $nb_projet projets effectué!<br/>\n";
if ($nb_photo == 1)
	echo "Une photo supprimée!<br/>\n";
elseif ($nb_photo > 1)
	echo "$nb_photo photos supprimées!<br/>\n";
echo "<a href=\"modifie_projet_1.php\">Sélectionner d'autres projets à modifier</a><br/>\n";
echo "<a href=\"index.php\">Retour au menu</a><br/>\n";
?>
</body>
</html>