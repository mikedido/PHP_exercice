<?php

$erros= '';

if (isset($_POST['envoyer'])) {
  //vérification des champs
  if(empty($_POST['login1'])) {
    $errors = 'Champ login vide';
  }elseif(empty($_POST['mdp1'])) {
    $errors = 'Champ mot de passe vide';
  } elseif(empty($_POST['mdp2'])) {
    $errors = 'Champ mot de passe 2 vide';
  }elseif(empty($_POST['email'])) {
    $errors = 'Champ email vide';
  }else{
    //vérification du format email
    preg_match('#^[a-zA-Z0-9._-]+@[a-zA-Z0-9]+\.[a-zA-Z._-]{2,4}$#', $_POST['email'], $matches);
    if(empty($matches)) {
      $errors = "format du mail invalide";
    }
  }
  //si les mdp et mdp2 ne sont pas identiques
  if ($_POST['mdp1']!==$_POST['mdp2']) {
    $errors= 'Mots de passes non identiques';
  }
  //si l'email ne respecte pas le format
  /*if (!preg_match('#@#', $_POST['email'])) {

  }*/
  if (empty($errors)) {
    //connexion à la basde données
    $user_db='root';
    $mdp_db='ma1985gu';
    try {
      $bd = new PDO("mysql:host=localhost;dbname=mahdi_tp1;charste=utf8", $user_db, $mdp_db);
    } catch(Exception $e) {
      die($e->getMessage());
    }

    //vérification de l'exitance de la requete
    $query= $bd->prepare('SELECT id, login FROM membres WHERE login=:login');
    $query->execute(array(
      'login' => $_POST['login1']
    ));
    $result = $query->fetch();

    if (isset($result['id'])) {
      $errors = 'Login existe déja';
    }


    if (empty($errors)) {
      $query->closeCursor();
      $query = $bd->prepare('INSERT INTO membres (login, mdp, email, inscription) VALUES (:login, :mdp, :email, now())');
      $query->execute(array(
        'login' => $_POST['login1'],
        'mdp'   => sha1($_POST['mdp1']),
        'email' => $_POST['email']
      ));


      //redirection
      header('location:connexion.php');
    }

  }
}

?>
<!DOCTYPE HTML>
<html>
<header>
  <link href="CSS/style.css" rel="stylesheet">
  <title>Inscription</title>
</header>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-4 no-float">
        <p></p>
      </div>

  <div class="col-md-8 no-float">
  <!--formulaire d'inscription-->
  <div class="bloc-center">
    <h2>formulaire d'inscription</h2>
    <form action='inscription.php' method="post">
      <p><input type="text" name="login1" placeholder="Login"></p>
      <p><input type="password" name="mdp1" placeholder="mot de passe"></p>
      <p><input type="password" name="mdp2" placeholder="mot de passe"></p>
      <p><input type="text" name="email" placeholder="email"></p>
      <?php echo '<p style="color:red;">'.$errors.'</p>';?>
      <p><input type="submit" name="envoyer" value="Inscription"></p>
    </form>
  </div>
</div>
</div>
</div>
</body>
</html>
