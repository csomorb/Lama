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
foreach ($_FILES as $key => $value) {
	if ($_FILES[$key]['error'] == 0) {
		$upload1 = upload($key , CHEMIN_BASE.'/files/CV' , 5000000 , array('pdf','PDF'));
		if($upload1) {
			echo "CV Changé!<br/>\n";
		}
		else
			echo "Echec lors du chargement du CV!<br/>\n";
	}
}
?>
<a href="index.php">Retour au menu</a>
</body>
</html>