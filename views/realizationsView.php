<?php

/* Course realizations view. */

require_once("template.php");

class RealizationsView {

  private $pageName;
  private $courseId;
  private $courseName;
  private $content;

  public function __construct($created, $updated, $deleted, $courseId, $courseName, $searchResults) {
    $this->pageName = "Realizations";
    if ($created) $this->content = $this->addMessage("created");
    else if ($updated) $this->content = $this->addMessage("updated");
    else if ($deleted) $this->content = $this->addMessage("deleted");
    $this->courseId = $courseId;
    $this->courseName = $courseName;
    $this->content = $this->content . $this->addContent($courseId, $courseName, $searchResults);
  }

  public function display() {
    $navigationTree = "<a class='navLink' href='../courses.php'> Courses </a> > <a class='navLink' href='../courseRead.php/?" .
                      "id={$this->courseId}'> Course details </a> >";
    $template = new Template($this->pageName, $navigationTree);
    $template->displayTop();
    echo $this->content;
    $template->displayBottom();
  }

  private function addMessage($action) {
    return "<div class='message'> Realization " . $action . " succesfully. </div>";
  }

  private function addContent($courseId, $courseName, $searchResults) {
    $content = "<h2 class='padded'> Realizations for course $courseId ($courseName) </h2> <p class='padded'> Select an id to view";
    
    if ($_SESSION['role'] == 'coordinator') $content = $content . ", edit or delete";
    
    $content = $content . " realization details. </p> <table> <tr> <th> Realization id </th> <th> Begin date </th>" . 
                          "<th> End date </th> <th> Person in charge </th> </tr>";
                                
    foreach ($searchResults as $realization) $content = $content . "<tr> <td class='tableItem'> <a class='tableItem' " .
                                                                   "href='../realizationRead.php/?id={$realization->getId()}&" .
                                                                   "courseName={$this->courseName}'> {$realization->getId()} </td>" .
                                                                   "<td> {$realization->getBeginDate()} </td> <td>" .
                                                                   "{$realization->getEndDate()} </td> <td>" .
                                                                   "{$realization->getfirstName()} {$realization->getLastName()} </td> </tr>";
    $content = $content . "</table>";
                           
    if ($_SESSION['role'] == 'coordinator') $content = $content . "<form action='../realizations.php/?' method='get'> <p class='padded'> " .
                                                                  "<input type='hidden' name='courseId' value='{$this->courseId}' /> " .
                                                                  "<input type='hidden' name='courseName' value='{$this->courseName}' /> " .
                                                                  "<input type='submit' name='action' value='Create a new realization' /> " .
                                                                  "</p> </form>";
    return $content;
  }

}

