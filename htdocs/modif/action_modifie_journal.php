<!DOCTYPE html>
<html>
<head>
<title>Modifie Journal</title>
<meta charset="UTF-8"/>
</head>

<body>
<?php 
include('constantes.php');
include('fonction.php');
if (!empty($_POST)) {
	$nb_article = 0;
	$nb_photo = 0;
	foreach ($_POST as $key => $value){
		$part = explode("_",$key);
		if ( strcmp("id",$part[0]) == 0 ) {
			//mise a jour de la bdd photo
			$id_article = $value;
			include('conect_database.php');
			$req = $bdd->prepare('UPDATE journal SET titre = :nvtitre, date = :nvdate, numero = :nvnumero, type= :nvtype, text= :nvtext WHERE id = :id_article');
			$req->execute(array(
			'nvtitre' => htmlspecialchars($_POST[$id_article.'_titre']),
			'nvdate' => htmlspecialchars($_POST[$id_article.'_date']),
			'nvnumero' => htmlspecialchars($_POST[$id_article.'_numero']),
			'nvtype' => htmlspecialchars($_POST[$id_article.'_type']),
			'nvtext' => htmlspecialchars($_POST[$id_article.'_text']),
			'id_article' => $id_article
			));
			$nb_article++;
		}
		if ( strcmp("photo",$part[0]) == 0 ) {
			// supression des photos
			$id_journal = htmlspecialchars($part[1]);
			if (file_exists(CHEMIN_BASE."/img/journal/minature/".$value))
				if(! unlink(CHEMIN_BASE."/img/journal/minature/".$value)) 
					echo "Echec de supression de la minature: ".$value ;
				else
					$nb_photo++;
			if (file_exists(CHEMIN_BASE."/img/journal/".$value))
				if(! unlink(CHEMIN_BASE."/img/journal/".$value))
					echo "Echec de supression de la photo: ".$value ;
			// suppression des photos de la bdd
			include('conect_database.php');
			$req = $bdd->prepare('DELETE FROM photo_journal WHERE id= ?');
			$req->execute(array($id_journal));
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
		//on a une photo d'album
		//on détermine le nouveau nom
		include('conect_database.php');
		$req = $bdd->prepare('SELECT * FROM photo_journal WHERE id_journal = ? ORDER BY id DESC');
		$req->execute(array($part[0]));
		$data = $req->fetch();
		$p1 = explode(".",$data['nom']);
		$p2 = explode("_",$p1[0]);
		if (strcmp($data['nom'],"") == 0) {
		// création de la premiere image avec l'id	
			$nom_photo = $part[0]."_1";
		}
		else {
			$p2[1]++;
			$nom_photo = $part[0]."_".$p2[1];
		}
		$req->closeCursor();
		$upload1 = upload($key , CHEMIN_BASE.'/img/journal/'.$nom_photo , 5000000 , array('jpg','png','jpeg','gif','JPG','PNG','JPEG','GIF'));
		if($upload1) {
		// ajout de l'image a la bdd
			$nom_photo .= "." . substr(strrchr($_FILES[$key]['name'],'.'),1);
			$req = $bdd->prepare('INSERT INTO photo_journal(id_journal, nom) VALUES(:id_journal,:nom)');
			$req->execute(array(
				'id_journal' => $part[0],
				'nom' =>  $nom_photo
			));
			$req->closeCursor();
			make_thumb(CHEMIN_BASE.'/img/journal/' . $nom_photo,CHEMIN_BASE.'/img/journal/minature/' . $nom_photo,250) ;
		echo "Upload de la photo réussie...<br/>";
		}
		else
			echo "Aille, échec de l'upload du photo".$i."<br/>";	
	}
}
if ($nb_article == 1) 
	echo "Modification de l'article effectué!<br/>\n";
else
	echo "Modification de $nb_article articles effectué!<br/>\n";
if ($nb_photo == 1)
	echo "Une photo supprimée!<br/>\n";
elseif ($nb_photo > 1)
	echo "$nb_photo photos supprimées!<br/>\n";
echo "<a href=\"modifie_journal_1.php\">Sélectionner un autres article à modifier</a><br/>\n";
echo "<a href=\"index.php\">Retour au menu</a><br/>\n";
?>
</body>
</html>