<?php

class Kayttaja {

  private $tunnus;
  private $salasana;

  public function __construct($tunnus, $salasana) {
    $this->tunnus = $tunnus;
    $this->salasana = $salasana;
  }

  public function getTunnus() {
    return $this->tunnus;
  }

}
