<header class="header">
	<img src="img/cadre.png" alt="cadre" class="cadre_photo"/>
    <h1 class="title-photo">PHOTOS</h1>
    <div id="anchor"></div>
</header>

<div class="main-photo" data-imgdir="<?php echo SITE_ROOT; ?>img/photo/" id="main-photo">
    <div><img src="<?php echo SITE_ROOT; ?>img/mainphoto.jpg"></div>
</div>

<div class="photos">

<?php 
	try {
	// On se connecte à MySQL
		$bdd = new PDO('mysql:host=localhost;dbname=lama', 'root', '25avril2015');
	}
	catch(Exception $e) {
	// En cas d'erreur, on affiche un message et on arrête tout
		die('Erreur : '.$e->getMessage());
	}
	$reponse = $bdd->query('SELECT count(id) as nb_album FROM photo');
	$donnees = $reponse->fetch();
	$nb_album = $donnees['nb_album'];
	$reponse->closeCursor();
	$nb_ligne = ceil ($nb_album / 3.0);
	$reponse1 = $bdd->query('SELECT * FROM photo');
	$reponse2 = $bdd->query('SELECT * FROM photo');
	$compteur_album = 1;
	$compteur_album_bis = 1;
	for ($i = 1 ; $i <= $nb_ligne; $i++) {
		echo "\t<div class=\"row\">\n";
		echo "\t\t<div class=\"legend\">\n";
		for ($j = 1 ; $j <= 3 && $compteur_album <= $nb_album ; $j++ ) {
			$donnees = $reponse1->fetch();
			if ($donnees['numero'] < 10)
				echo "\t\t\t<p class=\"number\"> 0".$donnees['numero'].".</p>\n";
			else
				echo "\t\t\t<p class=\"number\">".$donnees['numero'].".</p>\n";
			echo "\t\t\t<p class=\"description\">".$donnees['titre']."</p>\n";
			echo "\t\t\t<p class=\"date\">".$donnees['date']."</p>\n";
			$compteur_album++;
		}
		echo "\t\t</div>\n";
		for ($j = 1 ; $j <= 3 && $compteur_album_bis <= $nb_album ; $j++ ) {
			$donnees2 = $reponse2->fetch();
			echo "\t\t<div class=\"photo-thumbnail\">\n"; 
		echo "\t\t\t<a href=\"#anchor\"><img src=\"img/photo/".$donnees2['nom_couverture']."\" alt=\"".$donnees['alt_couverture']."\" data-images=\"\n";
			$reponse3 = $bdd->query('SELECT * FROM photo_photo WHERE id_photo =' .$donnees2['id']);
				while ($data = $reponse3->fetch() ) {
					echo "            ".$donnees2['id']."/".$data['nom']."\n";
				}
			$reponse3->closeCursor();
			echo "\t\t\t\"></a>\n";
			if ($donnees2['numero'] < 10)
				echo "\t\t\t<p class=\"number\">0".$donnees2['numero'].".</p>\n";
			else
				echo "\t\t\t<p class=\"number\">".$donnees2['numero'].".</p>\n";
			echo "\t\t</div>\n";
			$compteur_album_bis++;
		}
		echo "\t</div>\n";
	}
	$reponse1->closeCursor();
	$reponse2->closeCursor();
?>
</div>
