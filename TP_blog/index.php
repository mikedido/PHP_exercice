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

//Ajout de commentaires
if(isset($_POST['title']) AND isset($_POST['comment'])) {
	if (!empty($_POST['title']) AND !empty($_POST['comment'])) {
		$insert = $bdd->prepare('INSERT INTO billets (titre, contenu, date_creation) VALUES(:titre, :contenu, NOW())');
		$insert->execute(array(
			"titre"	  => $_POST['title'],
			"contenu" => $_POST['comment']));
	}
}

//Get the page number
if (!isset($_GET['page'])) {
	$_GET['page']= 1;	
}


$offset = ($_GET['page']-1)*5;


$query = $bdd->query("SELECT id, titre, contenu, date_creation FROM billets ORDER BY date_creation LIMIT 5 OFFSET $offset");

//$query->execute(array(
//	"offset" => $offset));

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

//Pagination

$pages = $bdd->query('SELECT COUNT(*) AS nb_billets FROM billets');

$result = $pages->fetch();

$nb_pages = (int)($result['nb_billets']/5) + ($result['nb_billets']%5>0 ? 1 : 0);

echo 'pages : ';
for ($i=1; $i<=$nb_pages; $i++) {
	echo "<a href=\"index.php?page=$i\">$i</a> ";

}

echo '<br />';
//Ajouter un commentaires
echo "<a href='commentaires_post.php'>Ajouter un commentaire</a>";
?>
	</body>
</html>







