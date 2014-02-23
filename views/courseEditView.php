<?php

/* View for editing a course. */

require_once("template.php");

class CourseEditView {

  private $id;
  private $name;
  private $credits;
  private $pageName;
  private $content;  

  public function __construct($id, $name, $credits) {
    $this->pageName = "Edit course";
    $this->id = $id;      
    $this->name = $name;
    $this->credits = $credits;
    $this->content = $this->addContent();    
  }
  
  public function display() {
    $navigationTree = "<a class='navLink' href='../courses.php'> Courses </a> > <a class='navLink'" .
                      "href='../courseRead.php/?id={$this->id}'> Course details </a> >";
    $template = new Template($this->pageName, $navigationTree);
    $template->displayTop();
    echo $this->content;
    $template->displayBottom();
  }
  
  public function askForValidInput($id, $name, $credits) {
    if ( !is_numeric($id) ) {
      $view = new courseEditView("", $name, $credits);
      $errorMsg = "<p class='padded' id='error'> You must provide a course id that contains only numerals (0-9). </p>";
    } else if ( empty($name) ) {
      $view = new courseEditView($id, "", $credits);
      $errorMsg = "<p class='padded' id='error'> You must provide a course name. </p>";
    } else if ( !is_numeric($credits) ) {
      $view = new courseEditView($id, $name, "");
      $errorMsg = "<p class='padded' id='error'> You must provide number of credits containing only numerals (0-9). </p>";
    }
    $view->display();
    echo $errorMsg;      
  }
  
  private function addContent() {
    $content = "<div class='padded'> Please edit the following information. Fields marked with an asterisk are mandatory. </div> <p>" .
               "<form action='courseEdit.php' method='post'> <table class='padded'> <tr> <td> Course id </td> <td>" .
               "<input type='text' disabled value='{$this->id}' name='id' class='wideField' maxlength='11'/> * </td> </tr>" .
               "<tr> <td> Course name </td> <td> <input type='text' value='{$this->name}' name='name' class='wideField' maxlength='30'/>" .
               "* </td> </tr> <tr> <td> Number of credits </td> <td> <input type='text' value='{$this->credits}' name='credits' " .
               "class='wideField' maxlength='11'/> * </td> </tr> </table> <p class='padded'> <input type='hidden' name='oldId' " .
               "value='{$this->id}'/> <input type='submit' name='action' value='Save changes'/> <input type='submit' name='action' " .
               "value='Cancel'/> </p> </form>";   
    return $content; 
  }

}
