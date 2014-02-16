<?php
  
/* User model. */

class User {

  private $username;
  private $password;
  private $firstName;
  private $lastName;
  private $role;
  
  public function __construct($username, $password) {
    $this->username = $username;
    $this->password = $password;
  }

  public function getUsername() {
    return $this->username;
  }
  
  public function getFirstName() {
    return $this->firstName;
  }

  public function getLastName() {
    return $this->lastName;
  }

  public function getRole() {
      return $this->role;
  }

  public function hasAccess() {
    $sql = "select * from Kayttaja where tunnus = ? and salasana = ?;";
    $query = getTietokantayhteys()->prepare($sql);
    $query->execute( array($this->username, $this->password) );
    $results = $query->fetch();
    if ($results[0] == $this->username) {
      $this->firstName = $results[2];
      $this->lastName = $results[3];
      $this->role = $this->determineRole();
      return true;
    }
    return false;
  }    

  public function isTeacher() {
    $sql = "select * from Kayttooikeus where kayttaja = ?;";
    $query = getTietokantayhteys()->prepare($sql);
    $query->execute( array($this->username) );
    $results = $query->fetch();
    
    if ($results[0] == $this->username && $results[1] == "teacher") return true;
    return false;
  }    
  
    
  private function determineRole() {
    $sql = "select * from Rooli, Kayttooikeus, Kayttaja where Rooli.nimi = Kayttooikeus.rooli
            and Kayttooikeus.kayttaja = ?;";
    $query = getTietokantayhteys()->prepare($sql);
    $query->execute( array($this->username) );
    $results = $query->fetch();
    return $results[0];
  }
 
  
}  
