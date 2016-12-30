<?php 

/**
* Liste de tous les billest
*
*/
try{
    $bdd = new PDO('mysql:host=localhost;dbname=mahdi_tp1;charset=utf8', 'root', 'ma1985gu');
}catch(EXCEPTION $e) {

    die ('erreur'. $e->getMessage());
}

$query = $bdd->exec('SELECT * FROM billets ORDER BY date_creation LIMIT 10');

while($datas = $query->fetch()) {


}









