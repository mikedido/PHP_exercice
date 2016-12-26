<?php 

echo "test de connexion à une BDD mysql avec PDO\n";
try {

$db = new PDO('mysql:host=localhost;dbname=MAHDI_TEST;charst=utf8', 'root', 'test'); 

}catch(Exception $e) {

	die($e->getMessage());
}

$query = $db->query('SELECT * FROM Personnage');

while($donnees = $query->fetch()) {

echo $donnees['sexe'].' '.$donnees['date_naissance'].' '.$donnees['nom']."\n";
}

