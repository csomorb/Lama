<?php
try {
// On se connecte à MySQL
$bdd = new PDO('mysql:host=localhost;dbname=lama', 'root', '25avril2015');
}
catch(Exception $e) {
// En cas d'erreur, on affiche un message et on arrête tout
die('Erreur : '.$e->getMessage());
} ?>