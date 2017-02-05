<?php

$erros ='';

if(isset($_POST['valider'])) {
  if (empty($_POST['login']) OR empty($_POST['password'])) {
      //echo 'login ou mot de passe vide';
      $errors ='mot de passe ou login vide';
  } else {
    //vérification de la connexion
    //connexion à la base de données
    $bdd = new PDO();

    $bdd->query('SELECT id, login FROM membres WHERE login =:login AND mdp=:mdp');
    $bdd->prepare(array(
      "login" => $_POST['login'],
      "mdp" => $_POST['mdp']
    ));
    $result=$bdd->fetch();
    var_dump($result); die;
  }
}
?>

<!DOCTYPE html>
<html>
</head>
  <link href="CSS/style.css" rel="stylesheet">
  <link href="bootstrap/css/bootsrtap.min.css" rel="stylesheet">
  <title>connexion</title>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-4 no-float">
        <p></p>
      </div>
      <div class="col-md-8 no-float">
        <div class="bloc-right">
          Vous n'avez pas de compte ?
          <a class="bouton-inscription" href="inscription.php">JE M'INSCRIS</a>
        </div>
        <!--formulaire de connexion-->
        <div class="bloc-center">
          <h2>Connexion candidat</h2>
          <form action='connexion.php' method="post">
            <p>
              <input type="text" name="login" placeholder="Login"/>
            </p>
            <p>
              <input type="password" name="password" placeholder="Mot de passe"/>
            </p>
            <?php
              echo '<p style="color:red;">'.$errors.'</p>';
            ?>
            <p>
              <input type="submit" name="valider"/>
            </p>
          </form>
          <!--link pour la page d'inscription-->
          <p>Mot de passe oublié?
            <a href="">Cliquez ici</a>
          </p>
        </div>
        </div>
      </div>
    </div>
</body>
</html>
