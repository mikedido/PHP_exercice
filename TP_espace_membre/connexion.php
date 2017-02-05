<?php
session_start();

$erros ='';

if($_SESSION['connect']) {
  header('location:sender.php');
}


if(isset($_POST['valider'])) {
  if (empty($_POST['login']) OR empty($_POST['password'])) {
      //echo 'login ou mot de passe vide';
      $errors ='login ou mot de passe vide';
  } else {
    //vérification de la connexion
    //connexion à la base de données
    $user_db=root;
    $mdp_db=ma1985gu;
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=mahdi_tp1;charst=utf8', $user_db, $mdp_db);
    } catch(Exception $e) {
        die($e->getMessage());
    }

    $query = $bdd->prepare('SELECT id, login FROM membres WHERE login =:login AND mdp=:mdp');
    $query->execute(array(
        'login' => $_POST['login'],
        'mdp' => sha1($_POST['password'])
    ));

    $result= $query->fetch();

    if(empty($result)) {
      $errors = 'login ou mot de passe invalide';
    } else {
      session_start();
      $_SESSION['id'] = $result['id'];
      $_SESSION['login'] = $result['login'];
      $_SESSION['connect']= true;
      //redirection vers la page senders
      header('location:sender.php');
    }
  }
}
?>

<!DOCTYPE html>
<html>
</head>
  <link href="CSS/style.css" rel="stylesheet">
  <link href="bootstrap/css/bootsrtap.min.css" rel="stylesheet">
  <title>Connexion</title>
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
