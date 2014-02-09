<?php

/* Course catalog model. */

class CourseCatalog {

  private $courses;

  public function createNewCourse($id, $name, $credits) {
    $sql = "insert into Kurssi values(?,?,?);";
    $query = getTietokantayhteys()->prepare($sql);
    $query->execute( array($id, $name, $credits) );
  }
  

  public function findCourseById($id) {
    $sql = "select * from Kurssi where kurssikoodi = ? order by nimi;";
    $query = getTietokantayhteys()->prepare($sql);
    $query->execute( array($id) );
    $found = array();
    while ( $results = $query->fetch() ) {
      array_push( $found, new course($results[0], $results[1], $results[2]) );
    }
    return $found;
  }
  
  public function findAll() {
    $sql = "select * from Kurssi order by nimi;";
    $query = getTietokantayhteys()->prepare($sql);
    $query->execute();
    $found = array();
    while ( $results = $query->fetch() ) {
      array_push( $found, new course($results[0], $results[1], $results[2]) );
    }
    return $found;
  }
  
  public function deleteCourse($id) {
    $sql = "delete from Kurssi where kurssikoodi = ?;";
    $query = getTietokantayhteys()->prepare($sql);
    $query->execute( array($id) );
  }
  
  public function updateCourse($name, $credits, $oldId) {
    $sql = "update Kurssi set nimi=?, opintopisteet=? where kurssikoodi=?;";
    $query = getTietokantayhteys()->prepare($sql);
    $query->execute( array($name, $credits, $oldId) );
  }
  
}
