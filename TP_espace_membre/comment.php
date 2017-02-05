<?php
session_start();

if (!$_SESSION['connect']) {
  header('location:connexion.php');
}
if(empty($_POST['comment'])) {
  header('location:sender.php');
  return;
}
//send the commentto database
$user_db='root';
$mdp_db='ma1985gu';
try{
  $db = new PDO('mysql:host=localhost;dbname=mahdi_tp1;charset=utf8', $user_db, $mdp_db);
}catch(Exception $e) {
  die($e->getMessage());
}

$query = $db->prepare('INSERT INTO commentss (login, comment, publication_date) VALUES(:login, :comment, now())');

$query->execute(array(
  'login' => $_SESSION['login'],
  'comment'=>$_POST['comment']
));

//retour à la liste des commentaires
header("location:sender.php");

?>
