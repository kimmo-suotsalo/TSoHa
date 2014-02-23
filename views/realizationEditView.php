<?php

/* View for editing a course realization. */

require_once("template.php");

class RealizationEditView {

  private $id;
  private $courseId;
  private $courseName;
  private $beginDate;
  private $endDate;
  private $personInCharge;  
  private $pageName;
  private $content;  

  public function __construct($id, $courseId, $courseName, $beginDate, $endDate, $personInCharge) {  
    $this->id = $id;
    $this->courseId = $courseId;
    $this->courseName = $courseName;
    $this->beginDate = $beginDate;
    $this->endDate = $endDate;
    $this->personInCharge = $personInCharge;    
    $this->pageName = "Edit realization";
    $this->content = $this->addContent();
  }
  
  public function display() {
    $navigationTree = "<a class='navLink' href='../courses.php'> Courses </a> > <a class='navLink' href='../courseRead.php/?" .
                      "id={$this->courseId}'> Course details </a> > <a class='navLink' href='../realizations.php/?courseId=" .
                      "{$this->courseId}&courseName={$this->courseName}'> Realizations </a> > <a class='navLink' " .
                      "href='../realizationRead.php/?id={$this->id}&courseName={$this->courseName}'> Realization details </a> >";        
    
    $template = new Template($this->pageName, $navigationTree);
    $template->displayTop();
    echo $this->content;
    $template->displayBottom();
  }
  
  public function askForValidInput($id, $courseId, $beginDate, $endDate, $username) {
    $user = new user($username, "");
    if ( !empty($username) && !$user->isTeacher() ) {
      $view = new realizationEditView($id, $courseId, $courseName, $beginDate, $endDate, "");
      $errorMsg = "<p class='padded' id='error'> The username you provided does not match any teacher in the system." . 
                  "You must provide a valid username or leave the field empty. </p>";
    } else if ( !empty($beginDate) && !DateTime::createFromFormat('Y-m-d', $beginDate) ) {
      $view = new realizationEditView($id, $courseId, $courseName, "", $endDate, $username);
      $errorMsg = "<p class='padded' id='error'> You must provide a valid begin date or leave the field empty. </p>";
    } else if ( !empty($endDate) && !DateTime::createFromFormat('Y-m-d', $endDate) ) {
      $view = new realizationEditView($id, $courseId, $courseName, $beginDate, "", $username);
      $errorMsg = "<p class='padded' id='error'> You must provide a valid end date or leave the field empty. </p>";
    }
    $view->display();
    echo $errorMsg;      
  }
  
  private function addContent() {    
    $content = "<div class='padded'> Please edit the following information. </div> <p> <form action='../realizationEdit.php/?' " .
               "method='get'> <table class='padded'> <tr> <td> Realization id </td> <td> <input type='text' value='{$this->id}' " .
               "class='wideField' disabled /> </td> </tr> <tr> <td> Related course id </td> <td> <input type='text' " .
               "value='{$this->courseId}' class='wideField' disabled /> </td> </tr> <tr> <td> Begin date (yyyy-mm-dd) </td>" .
               "<td> <input type='text' id='beginDate' value='{$this->beginDate}' name='beginDate' class='wideField' " .
               "maxlength='10'/> </td> </tr> <tr> <td> End date (yyyy-mm-dd) </td> <td> <input type='text' id='endDate' " .
               "value='{$this->endDate}' name='endDate' class='wideField' maxlength='10'/> </td> </tr> <tr> <td> Username of person " .
               "in charge </td> <td> <input type='text' id='personInCharge'value='{$this->personInCharge}' name='personInCharge' " .
               "class='wideField' maxlength='10'/> </td> </tr> </table> <p class='padded'> <input type='hidden' name='id' " .
               "value='{$this->id}'/> <input type='hidden' name='courseId' value='{$this->courseId}'/> <input type='hidden' " .
               "name='courseName' value='{$this->courseName}'/> <input type='submit' name='action' value='Save changes'/> " .
               "<input type='submit' name='action' value='Cancel'/> </p> </form>";    
    return $content;
  }

}
