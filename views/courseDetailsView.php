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
    $content = "<table> <tr> <th> Id </th> <th> Name </th> <th> Credits </th> </tr>";    
    $content = $content . "<tr> <td> {$course->getId()} </td>
                           <td> {$course->getName()} </td> <td class='centered'> {$course->getCredits()} </td> </tr> </table>";
    if ($_SESSION['role'] == 'coordinator') {
      $content = $content . " <form action='../courseRead.php/?id={$course->getId()}' method='post'>
                              <p class='padded'>
                              <input type='submit' name='action' value='Edit this course'; />
                              <input type='submit' name='action' value='Delete this course'; />     
                            </p> </form>";
    }    
    return $content;    
  }

  public function confirmDeletion() {
    echo "<p class='padded' id='error'> Are you sure you want to permanently delete this course? </p>";
    echo "<p class='padded'>";
    echo "<form class='padded' action='../courses.php' method='post'>            
          <input type='hidden' name='deleteId' value='{$this->courseId}'; />
          <input type='submit' value='Yes, delete'; /> </form> <p> <p >";
    echo "<form class='padded' action='../courseRead.php/?id={$this->courseId}' method='post'>            
          <input type='submit' value='Cancel'; /> </form> </p> ";
  }


}
