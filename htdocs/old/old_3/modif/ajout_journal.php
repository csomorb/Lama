
<!DOCTYPE html>
<html>
<head>
<title>Ajout Journal</title>
<meta charset="UTF-8"/>
</head>

<body>
<form action="action_ajout_journal.php" method="post"  accept-charset="UTF-8" enctype="multipart/form-data" >
<fieldset> 
<legend>Ajouter un article au journal</legend>
Titre: 
<input type="text" name="titre" autofocus required /> 
<br/>
Numéro:
<input type="number" name="numero" min="0" step="1" value="<?php include("numero_journal.php")?>"/>
<br/>
Date:
<input type="text" name="date" required /> Exemple: 25 Avril 2015 ou Juin 2014
<br/>
Contenu:
<br/>
 <textarea name="contenu" rows="10" cols="100" required />
Enrte le contenu ici.
</textarea>
<br/>
Type: 
<input type="text" name="type" value="Photographie"/> 
<br/>
Photos: <br/>
<?php
include("constantes.php");
for ($i = 1; $i <= NOMBRE_PHOTO_JOURNAL; $i++) {
	echo "Photo ".$i.")<input type=\"file\" accept=\"image/*\" name=\"photo_".$i."\" />\n"; 
	echo "Alt: <input type=\"text\" name=\"alt".$i."\" /><br/>\n";
}
?>
<br/>
Alt : cela signifie "texte alternatif". C'est bien d'indiquer un texte alternatif à l'image, c'est-à-dire un court texte qui
décrit ce que contient l'image. Ce texte sera affiché à la place de l'image si celle-ci ne peut pas être téléchargée (ça arrive),
ou sur les navigateurs de personnes handicapées (non-voyants) qui ne peuvent malheureusement pas "voir" l'image.
Cela aide aussi les robots des moteurs de recherche pour les recherches d'images. Pour la fleur, on mettrait par exemple :
alt="Une fleur". <br/>
L'image 1) se trouvera au dessus, de l'image 2) sur le site, l'image 2) se trouvera au dessus de l'image 3) ect... <br/>
<input type="submit" value="Ajouter au journal"/>

</fieldset>
</form>



</body>
</html>