<!DOCTYPE html>
<html>
<head>
<title>Modifier le CV</title>
<meta charset="UTF-8"/>
</head>
<body>
<form action="action_modifie_cv.php" method="post"  accept-charset="UTF-8" enctype="multipart/form-data" > 
<fieldset> 
<legend>Modifier mon CV</legend>
CV au format pdf: <input type="file" required name="cv" /><br/>
La taille du CV est limité à 5 000 000 octets, donc grosso modo 5 Mo...
<br/>
<input type="submit" value="Modifier mon CV"/>
</fieldset>
</form>
</body>
</html>
