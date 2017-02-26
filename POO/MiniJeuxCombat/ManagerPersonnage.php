<?php

class ManagerPersonnage {

  //private $_instance;
  private $_db;

  public function __construct($db)
  {
      $this->_db = $db;
  }

  /*public function getInstance()
  {
    if ($this->_instance instanceof self) {
        $this->_instance = new self();
    }

    return $this->_instance;
  }*/

  public function count()
  {
    $query = $this->_db->query('SELECT count(*) AS number FROM personnages');

    $result = $query->fetch();
    return $result['number'];
  }

  public function add(Personnage $pers)
  {
    $query = $this->_db->prepare('INSERT INTO personnages (nom) VALUES(:nom)');
    $query->execute(array(
        'nom' => $pers->getNom()
    ));

    $query->fetch();
  }

  public function update(Personnage $pers)
  {
      $query = $this->_db->prepare('UPDATE personnages SET degats = :degats WHERE id = :id');
      $query->execute(array(
          'degats' => $pers->getDegats(),
          'id' => $pers->getId()
      ));
      $query->fetch();
  }

  public function get($info)
  {
      //dans le cas d'un id
      if (is_int($info)) {
          $query = $this->_db->prepare('SELECT id, nom, degats FROM personnages WHERE id = :id');
          $query->execute(array(
              'id' => $info
          ));
      } elseif(is_string($info)) {//dans le cas d'un nom
          $query = $this->_db->prepare('SELECT id, nom, degats FROM personnages WHERE nom = :nom');
          $query->execute(array(
            'nom' => $info
          ));
      }

      $donnees = $query->fetch();

      return new Personnage($donnees);
  }

  public function delete(Personnage $pers)
  {
      $query = $this->_db->prepare('DELETE FROM personnages WHERE id = :id');
      $query->execute(array(
        'id' => $pers->getId()
      ));

      $query->fetch();
  }

  public function getList()
  {
      $persos = array();

      $query = $this->_db->query('SELECT id, nom, degats FROM personnages');
      while($donnees = $query->fetch()) {
        //var_dump($donnees); die;
        $persos[] = new Personnage($donnees);
      }

      return $persos;
  }

  public function exist($info)
  {
      if (is_int($info)) {

        $query = $this->_db->prepare('SELECT id, nom, degats FROM personnages WHERE id = :id');
        $query->execute(array(
          'id' => $info
        ));
      } elseif(is_string($info)) {

        $query = $this->_db->prepare('SELECT id, nom, degats FROM personnages WHERE nom = :nom');
        $query->execute(array(
          'nom' => $info
        ));
      }

      return $query->fetch();
  }

  public function getDb()
  {
    return $this->_db;
  }
}
