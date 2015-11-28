<header class="header">
    <img src="img/cadre.png" alt="cadre" class="cadre_galerie"/>
    <h1 class="title-galerie">GALERIE</h1>

    <div class="quote">
        <div class="blue-circle"><div></div></div>
        «Si ta photographie n'est pas bonne, c'est que tu n'étais pas assez près»
        <div class="author">Robert Capa</div>
    </div>

    <div class="col">
        <div class="inside-col">
            <h2>Des tirages limités, numérotés et signés</h2>
            <p>
                Les photographies présentées sur cette page ou ailleurs sur le site sont disponibles à la vente, n'hésitez pas à me contacter pour obtenir plus d'informations.
            </p>
        </div>
    </div>

    <div class="col">
        <div class="inside-col">
            <p>
                Tirage limité à 30 exemplaires, numérotés et signés par l'auteur.
                Pour un rendu optimal, j'utilise des encres pigmentaires qui ont une excellente tenue dans le temps et résistance à la lumière, sur du papier
            </p>
        </div>
    </div>

    <div class="col">
        <div class="inside-col">
            <p>
                Fine Art mat ou baryté pour des formats allant jusqu'au A3+.
                Je peux également réaliser l'encadrement.
                Par ailleurs, je suis ouvert à la discussion et toujours ravi de pouvoir parler photo avec les passionnés, n'hésitez pas à me faire part de vos éventuelles questions ou réactions !
            </p>
        </div>
    </div>

    <div class="col last-col">
        <h3>Caractéristiques</h3>
        <p>
            Exemplaires numérotés et signés par l'auteur.
        </p>

        <h3>Encres</h3>
        <p>
            Encres pigmentaires Epson Ultrachrome K3 Vivid Magenta
        </p>

        <h3>Papier mat</h3>
        <p>
            Hahnemühle Mat Fine Art Photo Rag Smooth 308 g/m2 ou Canson Rag photographique, 310 g/m2 Papier baryté
            Canson Infinity Baryta Photographique, 310 g/m2
        </p>

        <h3>Format</h3>
        <p>
            Jusqu'au A3+
        </p>
    </div>

</header>

<div class="clearfix"></div>

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
	$reponse = $bdd->query('SELECT * FROM photo_galerie ORDER BY id DESC');
	while ($donnees = $reponse->fetch())
	{
		echo "\t<img class=\"photo-big\" src=\"img/galerie/". $donnees['nom'] ."\" alt=\"". $donnees['alt']."\"/>\n";
	}
	$reponse->closeCursor();
	?> 	
</div>