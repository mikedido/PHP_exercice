<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>commentaires</title>
		<link href="style.css" rel="stylesheet">
	</head>
	<body>
	<?php
	/**
	*
	*/
	try{
		$bdd= new PDO('mysql:host=localhost;dbname=mahdi_tp1;charset=utf8', 'root', 'ma1985gu');
	}catch(EXCEPTION $e){
		die('erreur :'.$e->getMessage());
	}


	/**
	*Affichage du billet
	*/
	$query = $bdd->prepare('SELECT titre, contenu, date_creation FROM billets WHERE id = :id');
	$query->execute(array(
		'id' => $_GET['billet']));
	$data = $query->fetch();	
	?>
	<div>
		<h2>
			<?php echo $data['titre'];?>
			<em><?php echo $data['date_creation'];?></em>
		</h2>
	</div>
	<p><?php echo $data['contenu']; ?></p>
	<?php
	$query->closeCursor();
	/**
	*Affichage des commentaires
	*/
	?>
	<h2>Commentaires</h2>
	<?php	
	$query = $bdd->prepare('SELECT * FROM commentaires WHERE id_billet=:id');
	$query->execute(array(
		'id'=> $_GET['billet']));	
	
	while($datas = $query->fetch()){
	?>	
		<div>
			<h3>
				<?php echo $datas['auteur'];?>
				<em><?php echo $datas['date_commentaire'];?></em>
			</h3>
		</div>
		<p><?php echo $datas['commentaire'];?></p>
	<?php
	}
	?>
	</body>
</html>
