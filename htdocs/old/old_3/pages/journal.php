<header class="header">
<img src="img/cadre.png" alt="cadre" class="cadre_journal"/>
    <h1 class="title-journal">JOURNAL</h1>
    
    <div id="anchor"></div>
    <!--<div class="subtitle right-col">
        <h2>
            Des folles aven-<br>tures d’un esprit en vagabondage sur
            le long che-<br>min sinueux des joyeux graphistes épanouis…
        </h2>
    </div>!-->
</header>


<!--<section class="intro">
    <h2>Arpentez les coulisses</h2>
    <p>
        &nbsp;Sur cette page vous pourrez voir des choses ébauchées, des choses pas finies et 
        le derrière des choses. Vous en trouverez de toutes sortes, des personnages tordus, 
        des dodus, des grands, des moches, mais aussi mes joyeuses idées graphiques et des 
        bribes de mes diverses rencontres photographiques.
    </p>
</section>!-->
<section class="debut"> </section>

<?php
try {
	// On se connecte à MySQL
		$bdd = new PDO('mysql:host=localhost;dbname=lama', 'root', '25avril2015');
	}
	catch(Exception $e) {
	// En cas d'erreur, on affiche un message et on arrête tout
		die('Erreur : '.$e->getMessage());
	}
$reponse = $bdd->query('SELECT * FROM journal ORDER BY numero DESC');
while ($donnees = $reponse->fetch()) {
	echo "<section class=\"post\">\n";	
	echo  "\n\t<div class=\"right-col\">\n" ;
	echo "\t\t<h1>#".$donnees['numero']."</h1>\n";
	echo "\t\t<h2>".$donnees['titre']."</h2>\n";
	echo "\t\t<h3>".$donnees['date']."</h3>\n";
	echo "\t\t<p>".$donnees['text']."\n\t\t</p>\n"; 
	echo "\t\t<p class=\"made-of\">".$donnees['type']."</p>\n\t\t\n";
	echo "\t</div>\n" ;
	$req = $bdd->query('SELECT * FROM photo_journal WHERE id_journal ='.$donnees['id']);
	while ($donnees2 = $req->fetch()) {
		echo  "\t<img src=\"img/journal/".$donnees2['nom']."\" alt=\"".$donnees2['alt']."\">\n";
	}
	echo "</section>\n\n";
}
$reponse->closeCursor(); // Termine le traitement de la requête
?>

<!--
<section class="pagination">
    <p><span class="active">1</span>, 2 ... 12</p>
    <img src="img/journal/right-arrow.png" alt="Flèche page suivante">
</section>
!-->