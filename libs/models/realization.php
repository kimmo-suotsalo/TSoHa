<?php
  
/* Course realization model. */

class Realization {

  private $id;
  private $courseId;
  private $beginDate;
  private $endDate;
  private $personInCharge;
  private $firstName;
  private $lastName;

  public function __construct($id, $courseId, $beginDate, $endDate, $personInCharge, $firstName, $lastName) {
    $this->id = $id;
    $this->courseId = $courseId;
    $this->beginDate = $beginDate;
    $this->endDate = $endDate;
    $this->personInCharge = $personInCharge;
    $this->firstName = $firstName;
    $this->lastName = $lastName;
  }

  public function getId() {
    return $this->id;
  }

  public function getCourseId() {
    return $this->courseId;
  }
  
  public function getBeginDate() {
    return $this->beginDate;
  }
  
  public function getEndDate() {
    return $this->endDate;
  }

  public function getPersonInCharge() {
    return $this->personInCharge;
  }
  
  public function getFirstName() {
    return $this->firstName;
  }
  
  public function getLastName() {
    return $this->lastName;
  }
  
  public function setId($id) {
    $this->id = $id;
  }
  
  public function setCourseId($courseId) {
    $this->courseId = $courseId;
  }
  
  public function setBeginDate($beginDate) {
    $this->beginDate = $beginDate;
  }
  
  public function setEndDate($endDate) {
    $this->endDate = $endDate;
  }

  public function setPersonInCharge($personInCharge) {
    $this->personInCharge = $personInCharge;
  }

  public function setFirstName($firstName) {
    $this->firstName = $fistName;
  }
  
  public function setLastName($lastName) {
    $this->lastName = $lastName;
  }

}
