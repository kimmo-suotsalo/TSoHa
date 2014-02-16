<?php

/* Realization details view. */

require_once("template.php");

class RealizationDetailsView {

  private $pageName;
  private $id;
  private $courseId;
  private $courseName;
  private $content;

  public function __construct($searchResults, $courseName) {
    $this->pageName = "Realization details";
    $realization = $searchResults[0];
    $this->id = $realization->getId();
    $this->courseId = $realization->getCourseId();
    $this->courseName = $courseName;
    $this->content = $this->addContent($searchResults);
  }
  
  public function display() {
    $navigationTree = "<a class='navLink' href='../courses.php'> Courses </a> >
                       <a class='navLink' href='../courseRead.php/?id={$this->courseId}'> Course details </a> >
                       <a class='navLink' href='../realizations.php/?courseId={$this->courseId}&courseName={$this->courseName}'> Realizations </a> >";
    $template = new Template($this->pageName, $navigationTree);
    $template->displayTop();
    echo $this->content;
    $template->displayBottom();
  }    
  
  private function addContent($searchResults) {
    $realization = $searchResults[0];
    $content = "<table> <tr> <th> Realization id </th> <th> Begin date </th> <th> End date </th> <th> Person in charge </th> </tr>";
                
      $content = $content . "<tr> <td class='centered'> {$realization->getId()} </td>
                             <td> {$realization->getBeginDate()} </td> <td> {$realization->getEndDate()} </td>                             
                             <td> {$realization->getfirstName()} {$realization->getLastName()} </td> </tr> </table>";
                             
    if ($_SESSION['role'] == 'coordinator') {
      $content = $content . " <form action='../realizationRead.php/?id={$realization->getId()}&courseName={$this->courseName}' method='post'>
                              <p class='padded'>
                              <input type='submit' name='action' value='Edit this realization'; />
                              <input type='submit' name='action' value='Delete this realization'; />
                            </p> </form>";
    }    
    return $content;    
  }

  public function confirmDeletion() {
    echo "<p class='padded' id='error'> Are you sure you want to permanently delete this realization? </p>";
    echo "<p class='padded'>";
    echo "<form class='padded' action='../realizations.php/?courseId={$this->courseId}&courseName={$this->courseName}' method='post'>            
          <input type='hidden' name='deleteId' value='{$this->id}'; />
          <input type='submit' value='Yes, delete'; /> </form> <p> <p >";
    echo "<form class='padded' action='../realizationRead.php/?id={$this->id}&courseName={$this->courseName}' method='post'>            
          <input type='submit' value='Cancel'; /> </form> </p> ";
  }


}
