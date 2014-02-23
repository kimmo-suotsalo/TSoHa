<?php

/* Query catalog model. */

class QueryCatalog {

  private $realizationId;
  
  public function __construct($realizationId) {
    $this->realizationId = $realizationId;
  }

  public function createNewQuery($editor, $status, $openingTime, $closingTime) {
    $sql = "insert into Kysely(kurssi, laatija, tila, avautumisaika, sulkeutumisaika)
            values(?, ?, ?, ?, ?);";
    $query = getTietokantayhteys()->prepare($sql);
    $query->execute( array($this->realizationId, $editor, $status, $openingTime, $closingTime) );
  }

  public function findAll() {
    $sql = "select * from Kysely where kurssi = ? order by tunnus;";
    $query = getTietokantayhteys()->prepare($sql);
    $query->execute( array($this->realizationId) );
    $results = $query->fetchAll();
    $found = array();

    foreach ($results as $row) {
      array_push( $found, new query($row[0], $row[1], $row[2], $row[3], $row[4], $row[5]) );
    }

    return $found;
  }

}
