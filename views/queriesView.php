<?php

/* Queries view. */

require_once("template.php");

class QueriesView {

  private $pageName;
  private $realizationId;
  private $courseId;
  private $courseName;
  private $content;

  public function __construct($created, $realizationId, $courseId, $courseName, $searchResults) {
    $this->pageName = "Queries";
    if ($created) $this->content = $this->addMessage("created");
    $this->realizationId = $realizationId;
    $this->courseId = $courseId;
    $this->courseName = $courseName;
    $this->content = $this->content . $this->addContent($courseId, $courseName, $searchResults);
  }

  public function display() {
    $navigationTree = "<a class='navLink' href='../courses.php'> Courses </a> > <a class='navLink' href='../courseRead.php/?" . 
                      "id={$this->courseId}'> Course details </a> > <a class='navLink' href='../realizations.php/?courseId=" .
                      "{$this->courseId}&courseName={$this->courseName}'> Realizations </a> > <a class='navLink' " .
                      "href='../realizationRead.php/?id={$this->realizationId}&courseName={$this->courseName}'>" .
                      "Realization details </a> >";
    $template = new Template($this->pageName, $navigationTree);
    $template->displayTop();
    echo $this->content;
    $template->displayBottom();
  }

  private function addMessage($action) {
    return "<div class='message'> Query " . $action . " succesfully. </div>";
  }

  private function addContent($courseId, $courseName, $searchResults) {
    $content = "<h2 class='padded'> Queries for course realization {$this->realizationId} </h2> <table> <tr> <th> Query id </th>" .
               "<th> Status </th> <th> Opening time </th> <th> Closing time </th> </tr>";
                                
    foreach ($searchResults as $query) $content = $content . "<tr> <td class='centered'> {$query->getId()} </td> <td>" .
                                                             "{$query->getStatus()} </td> <td> {$query->getOpeningTime()} </td>" .
                                                             "<td> {$query->getClosingTime()} </td> </tr>";
    $content = $content . "</table>";
                           
    if ($_SESSION['role'] == 'teacher') $content = $content . "<form action='../queries.php/?' method='get'> <p class='padded'>" .
                                                              "<input type='hidden' name='realizationId' value='{$this->realizationId}' " .
                                                              "/> <input type='hidden' name='courseId' value='{$this->courseId}' /> " .
                                                              "<input type='hidden' name='courseName' value='{$this->courseName}' /> " .
                                                              "<input type='submit' name='action' value='Create a new query' /> " .
                                                              "</p> </form>";
    return $content;
  }

}

