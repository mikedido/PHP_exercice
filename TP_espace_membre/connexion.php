<?php
  if (!isset($_POST['login']) OR !isset($_POST['password'])) {
      echo 'login ou mot de passe vide';
  } else {
    //vérification de la connexion
    //connexion à la base de données
  }
?>

<!DOCTYPE html>
<html>
</head>
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <title>connexion</title>
</head>
<body>
<div class="row">
  <div class="col-sm-4">Largeur 4
  </div>
  <div class="col-sm-8">
    <!--formulaire de connexion-->
    <form action='connexion.php' method="post">
    <p>
      <label>Login</labe>
        <input type="text" name="login"/>
    </p>
    <p>
      <label>Mot de passe</label>
      <input type="password" name="password"/>
    </p>
    <p>
      <input type="submit"/>
    </p>
    </form>
    <!--link pour la page d'inscription-->
    <p>Vous n'avez pas de compte?
      <a href="">Inscription au site</a>
    </p>
  </div>
</div>

</body>
</html>
