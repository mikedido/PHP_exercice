<?php

class Personnage
{
  private $_id;
  private $_nom;
  private $_degats;

  const PERSONNAGE_MOI=1;
  const PERSONNAGE_TUE=2;
  const PERSONNAGE_FRAPPE=3;

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

  public function frapper(Personnage $pers)
  {
      if ($pers->getId() == $this->getId()) {
          return self::PERSONNAGE_MOI;
      }

      return $pers->recevoirDegats();
  }

  public function recevoirDegats()
  {
      $this->_degats+=5;

      if ($this->_degats >=100) {
          return self::PERSONNAGE_TUE;
      }

      return self::PERSONNAGE_FRAPPE;
  }

  //setters
  public function setId($id)
  {
    $id = (int)$id;

    if ($id > 0) {
      $this->_id = $id;
    }
  }

  public function setNom($nom)
  {
    if (is_string($nom)) {
      $this->_nom = $nom;
    }
  }

  public function setDegats($degats)
  {
    $degats = (int)$degats;

    if ($degats <= 100 AND $degats >= 0) {
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
