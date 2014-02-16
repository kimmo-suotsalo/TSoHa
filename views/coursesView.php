<?php

/* Courses view. */

require_once("template.php");

class CoursesView {

  private $pageName;
  private $content;

  public function __construct($searchResults) {
    $this->pageName = "Courses";
    $this->content = $this->addContent($searchResults);
  }
  
  public function display() {
    $template = new Template($this->pageName);
    $template->displayTop();
    echo $this->content;
    $template->displayBottom();
  }    
  
  private function addContent($searchResults) {
    $content = "<p class='padded'> Select a course id to ";
    if ($_SESSION['role'] == 'coordinator') $content = $content . "view, edit or delete a course. </p>";
    else $content = $content . "view a course. </p>";

    $content = $content . "<table> <tr> <th> Id </th> <th> Name </th> <th> Credits </th> </tr>";
        
    foreach ($searchResults as $course) {
      $content = $content . "<tr> <td class='tableItem'> <a class='tableItem' href='courseRead.php/?id={$course->getId()}'>
                                  {$course->getId()} </td>
                             <td> {$course->getName()} </td> <td class='centered'> {$course->getCredits()} </td> </tr>
                             ";
    }
    $content = $content . " </table> <form action='courses.php' method='post'>
                            <p class='padded'>";

    if ($_SESSION['role'] == 'coordinator') $content = $content . "<input type='hidden' name='createNewCourse' value=true; />
                                                                   <input type='submit' value='Create a new course'; />";
    $content = $content . "</p> </form>";    
    return $content;    
  }

}
