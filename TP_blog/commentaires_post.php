<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'>
		<title>Envoie de commentaires</title>	
		<link href="style.css" rel="stylesheet">
	</head>
	<body>
		<form action='index.php' method='post' id='commentForm'>
			<p>Titre<input type='text' name='title'></p>
			<input type="submit" value="Valider">
		</form>
		<br>
		<textarea rows="4" cols="50" name="comment" form="commentForm">Voici mon commentaire...</textarea>
	</body>
</html>
