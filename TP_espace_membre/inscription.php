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
  <title>Inscription</title>
</header>
<body>
  <p>formulaire d'inscription</p>
<form action='inscription.php' method="post">
  <p><input type="text" name="login1" placeholder="Login"></p>
  <p><input type="password" name="mdp1" placeholder="mot de passe"></p>
  <p><input type="password" name="mdp2" placeholder="mot de passe"></p>
  <p><input type="text" name="email" placeholder="email"></p>
  <?php echo '<p style="color:red;">'.$errors.'</p>';?>
  <p><input type="submit" name="envoyer" value="Inscription"></p>
</form>
</body>
</html>
