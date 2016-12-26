<?php

/**
*Vérifcation du mot de passe
*/
if (isset($_POST['mdp'])) {

	if($_POST['mdp'] =="kangourou") {
		echo 'vous avez accès au portail de la NASA';
	} else {
		echo 'vous avez pas accès';
	}

}


?>
