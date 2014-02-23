<?php

/* Courses view. */

require_once("template.php");

class CoursesView {

  private $pageName;
  private $content;

  public function __construct($created, $updated, $deleted, $searchResults) {
    $this->pageName = "Courses";
    if ($created) $this->content = $this->addMessage("created");
    else if ($updated) $this->content = $this->addMessage("updated");
    else if ($deleted) $this->content = $this->addMessage("deleted");
    $this->content = $this->content . $this->addContent($searchResults);
  }
  
  public function display() {
    $template = new Template($this->pageName);
    $template->displayTop();    
    echo $this->content;
    $template->displayBottom();
  }    
  
  private function addMessage($action) {
    return "<div class='message'> Course " . $action . " succesfully. </div>";
  }
  
  private function addContent($searchResults) {
    $content = "<h2 class='padded'> Available courses </h2> <p class='padded'> Select a course id to ";
    
    if ($_SESSION['role'] == 'coordinator') $content = $content . "view, edit or delete a course. </p>";
    else $content = $content . "view course details. </p>";

    $content = $content . "<table> <tr> <th> Id </th> <th> Name </th> <th> Credits </th> </tr>";
        
    foreach ($searchResults as $course) $content = $content . "<tr> <td class='tableItem'> <a class='tableItem'" .
                                                              "href='courseRead.php/?id={$course->getId()}'> {$course->getId()}" .
                                                              "</td> <td> {$course->getName()} </td> <td class='centered'>" .
                                                              "{$course->getCredits()} </td> </tr>";

    $content = $content . "</table> <form action='courses.php' method='post'> <p class='padded'>";

    if ($_SESSION['role'] == 'coordinator') $content = $content . "<input type='hidden' name='createNewCourse' value=true; />
                                                                   <input type='submit' value='Create a new course'; />";
    return $content . "</p> </form>";
  }

}
