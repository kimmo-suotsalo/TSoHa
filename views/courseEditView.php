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
    $navigationTree = "<a class='navLink' href='../courses.php'> Courses </a> >
                       <a class='navLink' href='../courseRead.php/?id={$this->id}'> Course details </a> >";
    $template = new Template($this->pageName, $navigationTree);
    $template->displayTop();
    echo $this->content;
    $template->displayBottom();
  }
  
  private function addContent() {    
    return "
	  <div class='padded'>
    Please edit the following information. Fields marked with an asterisk are mandatory.
	  </div> <p>
    <form action='courseEdit.php' method='post'>
      <table class='padded'>
        <tr> <td> Course id </td> <td> <input type='text' disabled value='{$this->id}' name='id' class='wideField' maxlength='11'/> * </td> </tr>
        <tr> <td> Course name </td> <td> <input type='text' value='{$this->name}' name='name' class='wideField' maxlength='30'/> * </td> </tr>
        <tr> <td> Number of credits </td> 
             <td> <input type='text' value='{$this->credits}' name='credits' class='wideField' maxlength='11'/> * </td> </tr>
      </table>
      <p class='padded'>
         <input type='hidden' name='oldId' value='{$this->id}'/>
         <input type='submit' name='action' value='Save changes'/>
         <input type='submit' name='action' value='Cancel'/>
      </p>
    </form>";    
  }

}
