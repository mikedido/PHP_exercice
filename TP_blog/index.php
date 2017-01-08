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

//var_dump(isset($_POST['title']));
//var_dump(isset($_POST['comment'])); die;


try{
    $bdd = new PDO('mysql:host=localhost;dbname=mahdi_tp1;charset=utf8', 'root', 'ma1985gu');
}catch(EXCEPTION $e) {

    die ('erreur'. $e->getMessage());
}

//Ajout de commentaires
if(isset($_POST['title']) AND isset($_POST['comment'])) {
	$insert = $bdd->prepare('INSERT INTO billets (titre, contenu, date_creation) VALUES(:titre, :contenu, NOW())');
	$insert->execute(array(
		"titre"	  => $_POST['title'],
		"contenu" => $_POST['comment']));
	
	//$isnert->closeCursor();
}


$query = $bdd->query('SELECT id, titre, contenu, date_creation FROM billets ORDER BY date_creation DESC LIMIT 5');

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
//Ajouter un commentaires
echo "<a href='commentaires_post.php'>Ajouter un commentaire</a>";
?>
	</body>
</html>







