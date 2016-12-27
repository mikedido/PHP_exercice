<?php 

//redirect to comments page
/*if(isset($_POST['login']) AND $_POST['comment']) {
	//envoie du formulaire
	header('location:comments.php');
}else {
	echo '<p>login et/ou commentaire vide</p>';
}*/
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<p>Formulaire d'envoie de commentaire </p>
	<form action="comments.php" method="post">
		<p>Votre login<input type="text" name="login" id="login" /></p>
		<p>Votre mot de passe<input type="text" name="comment" id="comment"></p>
		<input type="submit" value="Valider">
	</form>
</body>
</html>

<?php 

/**
*Connexion à la BDD
*/
try{
$db = new PDO('mysql:host=localhost;dbname=mahdi_tp1;charst=utf8', 'root', 'ma1985gu'); 
} catch(Exception $e){
	die($e->getMessage());
}

/**
* Afficahge de tous les logins + commentaires
*/

$query = $db->query('SELECT login, comment FROM comments');

while($datas = $query->fetch()) {
	echo '<p><b>'.$datas['login'].'</b> : '.$datas['comment'].'</p>';
}
