<?php

if(isset($_POST['login']) AND isset($_POST['comment'])) {
    if (!empty($_POST['login']) AND !empty($_POST['comment'])) {

	try {
    $user_db	='root';
    $mdp_db		='ma1985gu';
		$db = new PDO('mysql:host=localhost;dbname=mahdi_tp1;charst=utf8', $user_db, $mdp_db);

	}catch(Exception $e) {
		die($e->getMessage());
	}

	$query = $db->prepare('INSERT INTO commentss (login, comment, publication_date) VALUES(:login, :comment, now())');

	$query->execute(array(
		'login'   => htmlentities($_POST['login']),
		'comment' => htmlentities($_POST['comment'])));


	header('location:sender.php');

    }

	header('location:sender.php');
}


	header('location:sender.php');
