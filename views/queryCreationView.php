<?php

/* View for creating a new query. */

require_once("template.php");

class QueryCreationView {

  private $realizationId;
  private $courseId;
  private $courseName;
  private $status;
  private $openingTime;
  private $closingTime;    
  private $pageName;
  private $content;  

  public function __construct($realizationId, $courseId, $courseName, $status, $openingTime, $closingTime) {  
    $this->realizationId = $realizationId;
    $this->courseId = $courseId;
    $this->courseName = $courseName;
    $this->status = $status;
    $this->openingTime = $openingTime;
    $this->closingTime = $closingTime;    
    $this->pageName = "Create a new query";
    $this->content = $this->addContent();
  }
  
  public function display() {
    $navigationTree = "<a class='navLink' href='../courses.php'> Courses </a> > <a class='navLink' href='../courseRead.php/?" .
                      "id={$this->courseId}'> Course details </a> > <a class='navLink' href='../realizations.php/?courseId=" .
                      "{$this->courseId}&courseName={$this->courseName}'> Realizations </a> > <a class='navLink' " .
                      "href='../realizationRead.php/?id={$this->realizationId}&courseName={$this->courseName}'> Realization details" .
                      "</a> > <a class='navLink' href='../queries.php/?realizationId={$this->realizationId}&courseId=" . 
                      "{$this->courseId}&courseName={$this->courseName}'> Queries </a> >";
                      
    $template = new Template($this->pageName, $navigationTree);
    $template->displayTop();
    echo $this->content;
    $template->displayBottom();
  }
  
  public function askForValidInput($realizationId, $courseId, $courseName, $status, $openingTime, $closingTime) {
    if ( !empty($openingTime) && !DateTime::createFromFormat('Y-m-d H:i:s', $openingTime) ) {
      $view = new queryCreationView($realizationId, $courseId, $courseName, $status, "", $closingTime);
      $errorMsg = "<p class='padded' id='error'> You must provide a valid opening time or leave the field empty. </p>";
    } else if ( !empty($closingTime) && !DateTime::createFromFormat('Y-m-d H:i:s', $closingTime) ) {
      $view = new queryCreationView($realizationId, $courseId, $courseName, $status, $openingTime, "");
      $errorMsg = "<p class='padded' id='error'> You must provide a valid closing time or leave the field empty. </p>";
    }
    $view->display();
    echo $errorMsg;      
  }
  
  private function addContent() {    
    $content = "<h2 class='padded'> Create a new query </h2> <div class='padded'> Please fill in the following information. Query id " .
               "will be generated automatically. </div> <p> <form action='../queryCreation.php/' method='get'> <table class='padded'>" .
               "<tr> <td> Course realization id </td> <td> <input type='text' value='{$this->realizationId}' class='wideField' disabled" .
               "/> </td> </tr> <tr> <td> Query status </td> <td> <select name='status' class='wideField' />"; 
        
    if ($this->status == 'active') $selectOptions = "<option> </option> <option selected> active </option> <option> inactive" .
                                                    "</option> </select>";
    else if ($this->status == 'inactive') $selectOptions = "<option> </option> <option> active </option> <option selected> inactive" .
                                                           "</option> </select>";
    else $selectOptions = "<option> </option> <option> active </option> <option> inactive </option> </select>";
          
    $content = $content . $selectOptions . "</td> </tr> <tr> <td> Opening time (yyyy-mm-dd hh:mm:ss) </td> <td> <input type='text' " . 
                                           "value='{$this->openingTime}' name='openingTime' class='wideField' maxlength='19'/> </td>" .
                                           "</tr> <tr> <td> Closing time (yyyy-mm-dd hh:mm:ss) </td> <td> <input type='text'" .
                                           "value='{$this->closingTime}' name='closingTime' class='wideField' maxlength='19'/> </td>" .
                                           "</tr> </table> <p class='padded'> <input type='hidden' name='realizationId' " .
                                           "value='{$this->realizationId}'/> <input type='hidden' name='courseId' " .
                                           "value='{$this->courseId}'/> <input type='hidden' name='courseName' " .
                                           "value='{$this->courseName}'/> <input type='submit' name='action' " .
                                           "value='Create this query'/> <input type='submit' name='action' value='Cancel'/>" .
                                           "</p> </form>";    
    return $content;
  }

}
