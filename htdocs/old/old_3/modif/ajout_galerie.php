<!DOCTYPE html>
<html>
<head>
<title>Ajout Galerie</title>
<meta charset="UTF-8"/>
</head>

<body>
<form action="action_ajout_galerie.php" method="post"  accept-charset="UTF-8" enctype="multipart/form-data">
<fieldset> 
<legend>Ajouter une photo a la galerie</legend>
<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
<input type="file" name="photo" id="photo" accept="image/*"/>
Alt: 
<input type="text" name="alt" value="alt"/>
<br/>
<input type="submit" value="Ajouter les photos a la galerie"/>
</fieldset>
</form>
<br/>
Alt : cela signifie "texte alternatif". C'est bien d'indiquer un texte alternatif à l'image, c'est-à-dire un court texte qui
décrit ce que contient l'image. Ce texte sera affiché à la place de l'image si celle-ci ne peut pas être téléchargée (ça arrive),
ou sur les navigateurs de personnes handicapées (non-voyants) qui ne peuvent malheureusement pas "voir" l'image.
Cela aide aussi les robots des moteurs de recherche pour les recherches d'images. Pour la fleur, on mettrait par exemple :
alt="Une fleur". <br/>
</body>
</html>