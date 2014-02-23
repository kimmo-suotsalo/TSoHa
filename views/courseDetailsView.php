<?php

/* Course details view. */

require_once("template.php");

class CourseDetailsView {

  private $pageName;
  private $content;
  private $courseId;

  public function __construct($searchResults) {
    $this->pageName = "Course details";
    $this->content = $this->addContent($searchResults);
  }
  
  public function display() {
    $navigationTree = "<a class='navLink' href='../courses.php'> Courses </a> >";
    $template = new Template($this->pageName, $navigationTree);
    $template->displayTop();
    echo $this->content;
    $template->displayBottom();
  }    
  
  private function addContent($searchResults) {
    $course = $searchResults[0];
    $this->courseId = $course->getId();
    $content = "<h2 class='padded'> {$course->getName()} </h2> <table> <tr> <th> Id </th> <th> Name </th> <th> Credits </th> </tr>";    
    $content = $content . "<tr> <td> {$course->getId()} </td> <td> {$course->getName()} </td> <td class='centered'>" .
                          "{$course->getCredits()} </td> </tr> </table>";
    $content = $content . " <form action='../courseRead.php/?id={$course->getId()}' method='post'> <p class='padded'>";
    if ($_SESSION['role'] == 'coordinator') $content = $content . "<input type='submit' name='action' value='Edit this course'; />" .
                                                                  "<input type='submit' name='action' value='Delete this course'; />";
    $content = $content . "<input type='submit' name='action' value='Show realizations'; /> </p> </form>";        
    return $content;    
  }

  public function confirmDeletion() {
    $message = "<p class='padded' id='error'> Are you sure you want to permanently delete this course? </p> <p class='padded'>" .
               "<form class='padded' action='../courses.php?deleted=true' method='post'> <input type='hidden' name='deleteId' " .
               "value='{$this->courseId}'; /> <input type='submit' value='Yes, delete'; /> </form> <p> <p > <form class='padded' " . 
               "action='../courseRead.php/?id={$this->courseId}' method='post'> <input type='submit' value='Cancel'; /> </form> </p> ";
    echo $message;
  }


}
