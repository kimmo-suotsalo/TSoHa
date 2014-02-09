<?php
  
/* Course model. */

class Course {

  private $id;
  private $name;
  private $credits;
  
  public function __construct($id, $name, $credits) {
    $this->id = $id;
    $this->name = $name;
    $this->credits = $credits;
  }

  public function getId() {
    return $this->id;
  }

  public function getName() {
    return $this->name;
  }
  
  public function getCredits() {
    return $this->credits;
  }
  
  public function setId($id) {
    $this->id = $id;
  }

  public function setName($name) {
    $this->name = $name;
  }
  
  public function setCredits($credits) {
    $this->credits = $credits;
  }
  
}
