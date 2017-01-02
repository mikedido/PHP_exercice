<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Mon blog mgu</title>
		<link href="style.css" rel="stylesheet" />
	</head>
	<body>
	
<?php 

/**
* Liste de tous les billest
*
*/
try{
    $bdd = new PDO('mysql:host=localhost;dbname=mahdi_tp1;charset=utf8', 'root', 'ma1985gu');
}catch(EXCEPTION $e) {

    die ('erreur'. $e->getMessage());
}


$query = $bdd->query('SELECT id, titre, contenu, date_creation FROM billets ORDER BY date_creation LIMIT 10');

while($datas = $query->fetch()) {
?>
	<div>
		<h3>
			<?php echo $datas['titre']; ?>
			<em> <?php echo $datas['date_creation']; ?></em>
		</h3>
	</div>
		
	<p><?php echo $datas['contenu'];?> <br />
	<a href="commentaires.php?billet=<?php echo $datas['id'];?>">Commentaires</a>
	</p>
 
<?php
}
?>
	</body>
</html>







