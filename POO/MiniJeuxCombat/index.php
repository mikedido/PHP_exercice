<?php
function load($class){
  require $class.'.php';
}
spl_autoload_register('load');
//démarage d'une session
session_start();

//pour la déconnexion
if (isset($_GET['deconnexion'])) {
  session_destroy();
  header('Location: .');
  exit();
}

//restauration de l'objet
if (isset($_SESSION['perso'])) {

  $perso = $_SESSION['perso'];
}

try{
  $database = new PDO('mysql:host=localhost;dbname=mahdi_tp1;charset=utf8', 'root', 'ma1985gu');
}catch(EXCPETION $e) {

  die('ERROR : '.$e->getMessage());
}

$mp = new ManagerPersonnage($database);

//traitement du bouton create
if (isset($_POST['create']) AND isset($_POST['name'])) {
  //vérification du nom
  if (!empty($_POST['name'])) {
    //check if the user existe
    if ($mp->exist($_POST['name'])) {

      $perso = new Personnage($mp->exist($_POST['name']));
    } else {
      $pers = new Personnage(array(
        'nom' => $_POST['name']
      ));
      $mp->add($pers);

      //get the personne
      $perso = $pers;
    }
  }
}

//traitement du bouton use
if (isset($_POST['use']) AND isset($_POST['name'])) {

  if (!empty($_POST['name'])) {
    //check if the user exists
    if ($mp->exist($_POST['name'])) {
      $perso = $mp->get($_POST['name']);
    } else {
      $message = 'le user n\'existe pas';
    }
  }
}

//pour frapper un personnage
if (isset($_GET['frapper'])) {
  if (!isset($perso)) {
    $message = 'Merci de créer un personnage ou de vous identifier';
  } else {
    $id =(int)$_GET['frapper'];
    //récupération du personnage
    $persoAFrapper = $mp->get($id);
    //recevoir dégets
    $retour = $perso->frapper($persoAFrapper);

    switch($retour) {
      case Personnage::PERSONNAGE_MOI:
          $message = "pourquoi voulez-vous vous frapper?";
        break;
        case Personnage::PERSONNAGE_FRAPPE:
          $message = "Le personnage a bien été frappé !!!";
          //recevoir des dégats
          //$mp->update($perso);
          $mp->update($persoAFrapper);
        break;
        case Personnage::PERSONNAGE_TUE:
          $message = "le personnage a été tué !!!";
          $mp->delete($persoAFrapper);
        break;
        default:
          $message = 'valeur n\'existe pas';
      }
    }
}

//on stoke notre user
if (isset($perso)) {
  $_SESSION['perso'] = $perso;
}

?>

<!DOCTYPE HTML>
<html>
<head>
  <title>Mini tp personnages</title>
  <meta charset="utf-8" />
</head>
<body>
  <p>Nombre de personnages crées: <?php echo $mp->count();?></p>
  <?php $message = !isset($message) ? '': '<p>'.$message.'</p>';
    echo $message;
  ?>
<?php if (isset($perso)) {?>
  <p><a href="?deconnexion=1">Deconnexion</a></p>
  <fieldset>
    <legend>Mes informations</legend>
    <p>
      Nom : <?php echo $perso->getNom(); ?><br />
      Degats : <?php echo $perso->getDegats(); ?>
    </p>
  </fieldset>
  <fieldset>
    <legend>Qui frapper?</legend>
    <?php $listPerso = $mp->getList();
    //var_dump($listPerso); die;
      foreach ($listPerso as $perso) {
        echo '<a href=?frapper='.$perso->getId().'>'.$perso->getNom().'</a> (dégâts :'.$perso->getDegats().') <br />' ;
      }
    ?>
  </fieldset>
<?php } else { ?>
  <form action="index.php" method="post">
    Nom : <input type="text" name='name'>
    <input type="submit" value="Créer un personnage" name="create">
    <input type="submit" value="Utiliser un personnage" name="use">
  </form>
  <?php } ?>
</body>
</html>
