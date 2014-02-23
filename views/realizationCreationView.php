<?php

/* View for creating a new course realization. */

require_once("template.php");

class RealizationCreationView {

  private $courseId;
  private $courseName;
  private $beginDate;
  private $endDate;
  private $personInCharge;  
  private $pageName;
  private $content;  

  public function __construct($courseId, $courseName, $beginDate, $endDate, $personIncharge) {  
    $this->courseId = $courseId;
    $this->courseName = $courseName;
    $this->beginDate = $beginDate;
    $this->endDate = $endDate;
    $this->personInCharge = $personInCharge;    
    $this->pageName = "Create a new realization";
    $this->content = $this->addContent();
  }
  
  public function display() {
    $navigationTree = "<a class='navLink' href='../courses.php'> Courses </a> > <a class='navLink' href='../courseRead.php/?" .
                      "id={$this->courseId}'> Course details </a> > <a class='navLink' href='../realizations.php/?" .
                      "courseId={$this->courseId}&courseName={$this->courseName}'> Realizations </a> >";    
    
    $template = new Template($this->pageName, $navigationTree);
    $template->displayTop();
    echo $this->content;
    $template->displayBottom();
  }
  
  public function askForValidInput($beginDate, $endDate, $username) {
    $user = new user($username, "");
    if ( !empty($username) && !$user->isTeacher() ) {
      $view = new realizationCreationView($_GET['courseId'], $_GET['courseName'], $beginDate, $endDate, "");
      $errorMsg = "<p class='padded' id='error'> The username you provided does not match any teacher in the system." .
                  "You must provide a valid username or leave the field empty. </p>";
    } else if ( !empty($beginDate) && !DateTime::createFromFormat('Y-m-d', $beginDate) ) {
      $view = new realizationCreationView($_GET['courseId'], $_GET['courseName'], "", $endDate, $username);
      $errorMsg = "<p class='padded' id='error'> You must provide a valid begin date or leave the field empty. </p>";
    } else if ( !empty($endDate) && !DateTime::createFromFormat('Y-m-d', $endDate) ) {
      $view = new realizationCreationView($_GET['courseId'], $_GET['courseName'], $beginDate, "", $username);
      $errorMsg = "<p class='padded' id='error'> You must provide a valid end date or leave the field empty. </p>";
    }
    $view->display();
    echo $errorMsg;      
  }
  
  private function addContent() {    
    $content = "<div class='padded'> Please fill in the following information. Realization id will be generated automatically. </div>" .
               "<p> <form action='../realizationCreation.php/?courseId={$this->courseId}' method='get'> <table class='padded'> <tr>" .
               "<td> Related course id </td> <td> <input type='text' value='{$this->courseId}' class='wideField' disabled /> </td>" .
               "</tr> <tr> <td> Begin date (yyyy-mm-dd) </td> <td> <input type='text' value='{$this->beginDate}' name='beginDate'" .
               "class='wideField' maxlength='10'/> </td> </tr> <tr> <td> End date (yyyy-mm-dd) </td> <td> <input type='text' " .
               "value='{$this->endDate}' name='endDate' class='wideField' maxlength='10'/> </td> </tr> <tr> <td> Username of person " .
               "in charge </td> <td> <input type='text' value='{$this->personInCharge}' name='personInCharge' class='wideField' " .
               "maxlength='10'/> </td> </tr> </table> <p class='padded'> <input type='hidden' name='courseId' value='{$this->courseId}' " .
               "/> <input type='hidden' name='courseName' value='{$this->courseName}'/> <input type='submit' name='action' value='Create " .
               "this realization'/> <input type='submit' name='action' value='Cancel'/> </p> </form>";
    return $content;
  }

}
