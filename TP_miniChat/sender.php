<?php 

//redirect to comments page
if(isset($_POST['login']) AND $_POST['comment']) {
  if(!empty($_POST['login']) AND !empty($_POST['comment'])) {
		//envoie du formulaire
		header('location:comments.php');
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<p>Formulaire d'envoie de commentaire </p>
	<form action="sender.php" method="post">
		<input type="text" name="login" />
		<input type="text" name="comment">
		<input type="submit" value="Valider">
	</form>
</body>
</html>
