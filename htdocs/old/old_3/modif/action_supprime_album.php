<!DOCTYPE html>
<html>
<head>
<title>Supprime Galerie</title>
<meta charset="UTF-8"/>
</head>

<body>
<?php
include('constantes.php');

function supr_dossier( $dir )
{
 // ajout du slash a la fin du chemin s'il n'y est pas
 if( !preg_match( "/^.*\/$/", $dir ) ) $dir .= '/';
 // Ouverture du repertoire demande
 $handle = @opendir( $dir );
 // si pas d'erreur d'ouverture du dossier on lance le scan
 if( $handle != false )
 {
  // Parcours du repertoire
  while( $item = readdir($handle) )
  {
   if($item != "." && $item != "..")
   {
    if( is_dir( $dir.$item ) )
     advRmDir( $dir.$item );
    else unlink( $dir.$item );
   }
  }
  // Fermeture du repertoire
  closedir($handle);
  // suppression du repertoire
  $res = rmdir( $dir );
 }
 else $res = false;
 return $res;
}

function suprime_album($id_album) {
	include('conect_database.php');
	$req = $bdd->prepare('SELECT count(id) AS nb_album FROM photo WHERE id = ?');
	$req->execute(array($id_album));
	$donnees = $req->fetch();
	if ($donnees['nb_album'] == 0) {
		$req->closeCursor();
		return 0;
	}
	$req->closeCursor();
	//on récupère le nom de la couverture
	$req = $bdd->prepare('SELECT nom_couverture FROM photo WHERE id = ?');
	$req->execute(array($id_album));
	$donnees = $req->fetch();
	$nom_couverture = $donnees['nom_couverture'];
	// on supprime les photo de la table photo_photo
	$req = $bdd->prepare('DELETE FROM photo_photo WHERE id_photo = :id_album');
	$req->execute(array('id_album' => $id_album));
	// on supprime les données de l'album
	$req = $bdd->prepare('DELETE FROM photo WHERE id = :id');
	$req->execute(array('id' => $id_album));
	// on supprime la photo de couverture de l'album
	if(! unlink(CHEMIN_BASE."/img/photo/".$nom_couverture)) echo "Echec de supression de l image" ;
	// on supprime les minatures
	if(! supr_dossier(CHEMIN_BASE."/img/photo/".$id_album."/minature/")) echo "Echec de la suppression des minatures";
	// on supprime les photos de l'album
	if(! supr_dossier(CHEMIN_BASE."/img/photo/".$id_album)) echo "Echec de la suppression des photos de l'album";
	return 1;
}

if (!empty($_POST)) {
	$nb_album = 0;
	foreach ($_POST as $key => $value){
		$nb_album+=suprime_album(htmlspecialchars($value));
	}
	echo $nb_album." album(s) supprimé!<br/>\n";
}	
else
	echo "Aucune photo sélectioné pour la supression!";
?>
<a href="supprime_album.php">Supprimer d'autres alums</a><br/>
<a href="index.php">Retour au menu</a>
</body>
</html>
