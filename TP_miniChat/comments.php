<?php 

try {

$db = new PDO('mysql:host=localhost;dbname=mahdi_tp1;charst=utf8', 'root', 'ma1985gu'); 

}catch(Exception $e) {

	die($e->getMessage());
}


$query = $db->prepare('INSERT INTO comments (login, comment) VALUES(:login, :comment)');

$query->execute(array(
		'login'   => $_POST['login'],
		'comment' => $_POST['comment']));


