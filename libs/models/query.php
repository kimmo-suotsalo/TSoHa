<?php
  
/* Query model. */

class Query {

  private $id;
  private $realizationId;
  private $editor;
  private $status;
  private $personInCharge;
  private $openingTime;
  private $closingTime;

  public function __construct($id, $realizationId, $editor, $status, $openingTime, $closingTime) {
    $this->id = $id;
    $this->realizationId = $realizationId;
    $this->editor = $editor;
    $this->status = $status;
    $this->openingTime = $openingTime;
    $this->closingTime = $closingTime;
  }

  public function getId() {
    return $this->id;
  }

  public function getRealizationId() {
    return $this->realizationId;
  }
  
  public function getEditor() {
    return $this->editor;
  }
  
  public function getStatus() {
    return $this->status;
  }
  
  public function getOpeningTime() {
    return $this->openingTime;
  }
  
  public function getClosingTime() {
    return $this->closingTime;
  }
  
  public function setId($id) {
    $this->id = $id;
  }
  
  public function setRealizationId($realizationId) {
    $this->realizationId = $realizationId;
  }
  
  public function setEditor($editor) {
    $this->editor = $editor;
  }
  
  public function setStatus($status) {
    $this->status = $status;
  }
  
  public function setOpeningTime($openingTime) {
    $this->openingTime = $openingTime;      
  }
  
  public function setClosingTime($closingTime) {
    $this->closingTime = $closingTime;
  }

}
