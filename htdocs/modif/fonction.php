<?php
function upload($index,$destination,$maxsize=FALSE,$extensions=FALSE)
{ 
   //Test1: fichier correctement uploadé
	if (!isset($_FILES[$index]) OR $_FILES[$index]['error'] > 0)return FALSE;
   //Test2: taille limite
	if ($maxsize !== FALSE AND $_FILES[$index]['size'] > $maxsize)return FALSE;
   //Test3: extension
	if (!is_uploaded_file( $_FILES[$index]['tmp_name'] )) return FALSE; 
	$ext = substr(strrchr($_FILES[$index]['name'],'.'),1);
	if ($extensions !== FALSE AND !in_array($ext,$extensions)) return FALSE;
   //Déplacement
   return move_uploaded_file($_FILES[$index]['tmp_name'],$destination .".". substr(strrchr($_FILES[$index]['name'],'.'),1));
}

function genere_project_json() {
	$f = fopen(CHEMIN_BASE.'/pages/projects.json', 'w');
	ftruncate($f,0);
	fwrite($f,"[\n");
	$first=true;
	include('conect_database.php');
	$req = $bdd->query('SELECT * FROM projet ORDER BY id DESC');
	while ($data = $req->fetch()) {
		if ($first) {
			fwrite($f,"\t{\n");
			$first = false;
		}
		else
			fwrite($f,",\n\t{\n");
		fwrite($f,"\t\t\"title\": \"".$data['titre']."\",\n");
		fwrite($f,"\t\t\"date\": \"".$data['date']."\",\n");
		fwrite($f,"\t\t\"short_description\": \"".$data['description']."\",\n");
		fwrite($f,"\t\t\"aside\": {\n");
		fwrite($f,"\t\t\t\"Commanditaire\": \"".$data['commandataire']."\",\n");
		fwrite($f,"\t\t\t\"Commande\": \"".$data['commande']."\",\n");
		fwrite($f,"\t\t\t\"Date\": \"".$data['date']."\",\n");
		if (!empty($data['photographie'])) {
			fwrite($f,"\t\t\t\"Composition\": \"".$data['composition']."\",\n");
			fwrite($f,"\t\t\t\"Photographies\": \"".$data['photographie']."\"\n");
		}
		else
			fwrite($f,"\t\t\t\"Composition\": \"".$data['composition']."\"\n");
		fwrite($f,"\t\t},\n");
		fwrite($f,"\t\t\"medium\": \"".$data['medium']."\",\n");
		fwrite($f,"\t\t\"subtitle\": \"".$data['sous_titre']."\",\n");
		fwrite($f,"\t\t\"long_description\": \"".$data['normal']."\",\n");
		fwrite($f,"\t\t\"notes\": \"".$data['note']."\",\n");
		fwrite($f,"\t\t\"main_image\": \"".$data['photo_principale']."\",\n");
		fwrite($f,"\t\t\"images\": [");
		$req2 = $bdd->query('SELECT * FROM photo_projet WHERE id_projet ='.$data['id']);
		$fir = true;
		while ($data2 = $req2->fetch()) {
			if ($fir){
				$fir = false;
				fwrite($f,"\"".$data2['nom']."\"");
			}
			else
				fwrite($f,",\n \"".$data2['nom']."\"");
		}
		fwrite($f,"]\n");
		fwrite($f,"\t}");
	}
	$req->closeCursor();
	fwrite($f,"\n]\n");
	fclose($f);
}


function numero_photo()
{
include("conect_database.php");
// Si tout va bien, on peut continuer
// On récupère tout le contenu de la table jeux_video
$reponse = $bdd->query('SELECT MAX(numero) AS dernier_numero FROM photo');
$donnees = $reponse->fetch();
$numero_courant = $donnees['dernier_numero'] + 1;
$reponse->closeCursor();
return  $numero_courant; 
}


function make_thumb($src,$dest,$desired_width) 
{
  // Ouverture de l'image
  $source_image = imagecreatefromjpeg($src);
  $width = imagesx($source_image);
  $height = imagesy($source_image);

  // Trouver la hauteur désiré pour la miniature, en fonction de sa largeur
  $desired_height = floor($height*($desired_width/$width));

  // Créer une nouvelle image (virtuelle)
  $virtual_image = imagecreatetruecolor($desired_width,$desired_height);

  // Copie de l'image source à la taille désirée
  imagecopyresized($virtual_image,$source_image,0,0,0,0,$desired_width,$desired_height,$width,$height);
  
  // Créer physiquement l'image dans le répertoire de destination
  imagejpeg($virtual_image,$dest);
}

function num_nouveau_galerie()
{
	include("conect_database.php");
	// Si tout va bien, on peut continuer
	// On récupère tout le dernier identifiant de la table photo_galerie
	$reponse = $bdd->query('SELECT MAX(id) AS dernier_numero FROM photo_galerie');
	$donnees = $reponse->fetch();
	$numero_courant = $donnees['dernier_numero'] + 1;
	$reponse->closeCursor();	
	return $numero_courant;
}

function id_album()
{
	include("conect_database.php");
	// Si tout va bien, on peut continuer
	// On récupère tout le dernier identifiant de la table photo_galerie
	$reponse = $bdd->query('SELECT MAX(id) AS dernier_numero FROM photo');
	$donnees = $reponse->fetch();
	$numero_courant = $donnees['dernier_numero'];
	$reponse->closeCursor();	
	return $numero_courant;
}

function ajout_galerie_bdd($nom,$alt)
{
	include("conect_database.php");
	// Si tout va bien, on peut continuer
	// On insere le nom de la nouvelle image dans la table photo_galerie
	$req = $bdd->prepare('INSERT INTO photo_galerie (nom, alt) VALUES(:nom , :alt)');
	$req->execute(array('nom' => $nom , 
						'alt' => $alt
	));
	$req->closeCursor();
	return 0;
}


?>
