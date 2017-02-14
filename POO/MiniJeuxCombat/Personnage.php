<?php

class Personnage
{
  private $_id;
  private $_nom;
  private $_degats;

  public function __construct(array $donnees)
  {
      $this->hydrate($donnees);
  }


  public function hydrate(array $donnees)
  {
      foreach ($donnees as $key => $value) {
        $methode = 'set'.ucfirst($key);
        if (method_exists($this, $methode)) {
          $this->$methode($value);
        }
      }
  }

  public function faireDegats(Personnage $pers)
  {

  }

  //setters
  public function setId($id)
  {
    if (is_int($id)) {
      $this->_id = $id;
    }
  }

  public function setNom($nom)
  {
    if (is_string($nom)) {
      $this->_nom = $nom;
    }
  }

  public function setDegats($degat)
  {
    if (is_int($degat) AND $degat > 0) {
      $this->_degats = $degats;
    }
  }

  //getters
  public function getId()
  {
    return $this->_id;
  }

  public function getNom()
  {
    return $this->_nom;
  }

  public function getDegats()
  {
    return $this->_degats;
  }

}
