<?php
session_start();

if (!$_SESSION['connect']) {
  header('location:connexion.php');
}
/*
*configuration
*
*/
$user_db	='root';
$mdp_db		='ma1985gu';
$nb_commentaires=10;

/**
*Connexion à la BDD
*/
try{
$db = new PDO('mysql:host=localhost;dbname=mahdi_tp1;charst=utf8', $user_db, $mdp_db);
} catch(Exception $e){
	die($e->getMessage());
}

$pages = $db->query('SELECT COUNT(*) AS nb_comments FROM commentss');
$result = $pages->fetch();
$nb_pages = (int)($result['nb_comments']/$nb_commentaires) + ($result['nb_comments']%$nb_commentaires>0 ? 1 : 0);


//Get the page number
if (!isset($_GET['page'])) {
	$_GET['page']= 1;
} elseif (empty($_GET['page']) OR $_GET['page']>$nb_pages OR $_GET['page']<0) {
	echo 'page not authorized';
	return;
}

?>
<!DOCTYPE HTML>
<html>
<header>
  <link href="CSS/style.css" rel="stylesheet">
  <title>Commentaires</title>
</header>
<body>
  <div class="bloc-right">
    <a class="bouton-inscription" href="deconnexion.php">DECONNEXION</a>
  </div>
  <p>bonjour, vous etes maintenant connecté : <?php echo $_SESSION['login']?></p>
<!--formulaire d'envoie de commentaire-->
<div class="form-sender">
  <form action="comment.php" method="post">
    <input type="text" name="comment" id="comment" placeholder="Votre commentaire"><br />
    <input type="submit" value="Envoyer">
  </form>
</div>
<!--liste des derniers commentaires-->
<div class="commentaires">
<?php
$offset = ($_GET['page']-1)*$nb_commentaires;
/**
* Afficahge de tous les 10 derniers logins + commentaires + dates de publication fr de la page
*/

$query = $db->query("SELECT DATE_FORMAT(publication_date, '%H:%i:%s %d-%c-%Y') AS date,
									login, comment FROM commentss ORDER BY publication_date DESC LIMIT $nb_commentaires OFFSET $offset");

while($datas = $query->fetch()) {
	echo '<p>'.$datas['date'].' : <b>'.$datas['login'].'</b> : '.$datas['comment'].'</p>';
}

/*
* Gestion de la pagination
*/
?>
</div>
<div class="pages">
<?php
echo 'pages : ';
for ($i=1; $i<=$nb_pages; $i++) {
	echo "<a href=\"sender.php?page=$i\">$i</a> ";

}?>
</div>
</body>
</html>
