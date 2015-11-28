<!DOCTYPE html>
<html>
<head>
<title>Ajout Photo</title>
<meta charset="UTF-8"/>
</head>

<body>
<form action="action_ajout_photo.php" method="post"  accept-charset="UTF-8" enctype="multipart/form-data" >
<fieldset> 
	<legend>Ajouter des photos</legend>
	Titre de l'album: <input type="text" name="titre" autofocus required/> <br/>
	Date:  <input type="text" name="date" required/> <br/>
	Numero: <input type="number" name="numero" min="0" step="1" required value="<?php include('fonction.php'); $num=numero_photo(); echo $num; ?>"/> <br/>
	Photo couverture de l'album: <input type="file" accept="image/*" name="photo_couverture" required/> 
	Alt: <input type="text" name="alt_couverture" value="photo" /> <br/>
<?php
	include('constantes.php');
	for ($i = 1; $i <= NOMBRE_PHOTO_ALBUM; $i++) {
		echo "Photo ".$i.")<input type=\"file\" accept=\"image/*\" name=\"photo_" . $i . "\" /><br/>\n"; 
	}
?>
	<br/>
	<input type="submit" value="Ajouter l'album"/>
</fieldset>
</form>
Alt : cela signifie "texte alternatif". C'est bien d'indiquer un texte alternatif à l'image, c'est-à-dire un court texte qui
décrit ce que contient l'image. Ce texte sera affiché à la place de l'image si celle-ci ne peut pas être téléchargée (ça arrive),
ou sur les navigateurs de personnes handicapées (non-voyants) qui ne peuvent malheureusement pas "voir" l'image.
Cela aide aussi les robots des moteurs de recherche pour les recherches d'images. Pour la fleur, on mettrait par exemple :
alt="Une fleur". <br/>
Le défilement des photos se fera dans l'ordre Photo 1), puis Photo 2) ect...

</body>
</html>