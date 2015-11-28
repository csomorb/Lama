<!DOCTYPE html>
<html>
<head>
<title>Ajout Galerie</title>
<meta charset="UTF-8"/>
</head>

<body>

<?php
include('fonction.php');
include('constantes.php');
$num_image = num_nouveau_galerie() ;
$nom_image = $num_image."." . substr(strrchr($_FILES['photo']['name'],'.'),1);
$upload1 = upload('photo' , CHEMIN_BASE.'/img/galerie/' . $num_image , 5000000 , array('jpg','png','jpeg','gif','JPG','PNG','JPEG','GIF')); 
if($upload1) {
	//si on a réussi l'upload on ajout l'image a la bdd
	ajout_galerie_bdd($nom_image , htmlspecialchars($_POST['alt']) );
	// et on crée la minature
	make_thumb(CHEMIN_BASE.'/img/galerie/' . $nom_image,CHEMIN_BASE.'/img/galerie/minature/' . $nom_image,250) ;
	echo "Upload de l'image réussi!<br/>\n";
}

else if($_FILES['photo']['error']==4){
	echo "Aucune image sélectionné!\n";
}
else{
	echo "Code erreur:" . $_FILES['photo']['error'];	
}
?>
<a href="ajout_galerie.php">Ajouter une autre image a la galérie</a><br/>
<a href="index.php">Retour au menu</a>
</body>
</html>