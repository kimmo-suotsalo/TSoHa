<?php

/* Course realization catalog model. */

class RealizationCatalog {

  private $courseId;
  
  public function __construct($courseId) {
    $this->courseId = $courseId;
  }

  public function createNewRealization($beginDate, $endDate, $personInCharge) {
    $sql = "insert into Kurssitoteutus(kurssikoodi, alkuPvm, loppuPvm, vastuuhenkilo)
            values(?, ?, ?, ?);";
    $query = getTietokantayhteys()->prepare($sql);
    $query->execute( array($this->courseId, $beginDate, $endDate, $personInCharge) );
  }

  public function findRealizationById($id) {
    $sql = "select * from Kurssitoteutus where tunnus = ?;";
    $query = getTietokantayhteys()->prepare($sql);
    $query->execute( array($id) );
    $results = $query->fetchAll();
    $row = $results[0];

    $username = $row[4];
    $sql = "select etunimi, sukunimi from Kayttaja where tunnus = ?";
    $query = getTietokantayhteys()->prepare($sql);
    $query->execute( array($username) );
    $personInCharge = $query->fetch();

    $found = array();    
    array_push( $found, new realization($row[0], $row[1], "{$row[2]}", "{$row[3]}", $row[4], $personInCharge[0], $personInCharge[1]) );    
    return $found;
  }

  public function findAll() {
    $sql = "select * from Kurssitoteutus where kurssikoodi = ? order by tunnus;";
    $query = getTietokantayhteys()->prepare($sql);
    $query->execute( array($this->courseId) );
    $results = $query->fetchAll();
    $found = array();

    foreach ($results as $row) {
      $username = $row[4];
      $sql = "select etunimi, sukunimi from Kayttaja where tunnus = ?";
      $query = getTietokantayhteys()->prepare($sql);
      $query->execute( array($username) );
      $personInCharge = $query->fetch();
      array_push( $found, new realization($row[0], $row[1], "{$row[2]}", "{$row[3]}", $row[4],
                  $personInCharge[0], $personInCharge[1] ) );
    }

    return $found;
  }

  public function deleteRealization($id) {
    $sql = "delete from Kurssitoteutus where tunnus = ?;";
    $query = getTietokantayhteys()->prepare($sql);
    $query->execute( array($id) );
  }

  public function updateRealization($beginDate, $endDate, $personInCharge, $id) {
    $sql = "update Kurssitoteutus set alkuPvm=?, loppuPvm=?, vastuuhenkilo=? where tunnus=?;";
    $query = getTietokantayhteys()->prepare($sql);
    $query->execute( array($beginDate, $endDate, $personInCharge, $id) );
  }

}
