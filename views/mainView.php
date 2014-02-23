<?php

/* Main page view. */

require_once("template.php");

class MainView {

  private $pageName;
  private $content;

  public function __construct() {
    $this->pageName = "Main page";
    $this->content = $this->addContent();
  }
  
  public function display() {
    $template = new Template($this->pageName);
    $template->displayTop();
    echo $this->content;
    $template->displayBottom();
  }    
  
  private function addContent() {
    $content = "<h1 class='padded'> Course feedback system </h1> <p class='padded'> Your login information: </p> <table class='padded'>" .
               "<tr> <th> First name </th> <th> Last name </th> <th> User role </th> </tr> <tr> <td> {$_SESSION['firstName']} </td>" .
               "<td> {$_SESSION['lastName']} </td> <td> {$_SESSION['role']} </td> </tr> </table> <p> <br> <br> <div class='padded'>" .
               "As a {$_SESSION['role']} you may <p> <div class='padded'>";
    
    if ($_SESSION['role'] == "coordinator") $content = $content . "<li class='padded'> view, create, edit and delete courses </li>" .
                                                                  "<li class='padded'> view, create, edit and delete realizations </li>";
    else if ($_SESSION['role'] == "teacher") $content = $content . "<li class='padded'> view courses </li> <li class='padded'> view ". 
                                                                   "realizations </li> <li class='padded'> view, create, edit and delete " .
                                                                   "queries </li> ";        
    else if ($_SESSION['role'] == "student") $content = $content . "<li class='padded'> view courses </li> <li class='padded'> view " .
                                                                   "realizations </li> "; 
    return $content;
  }

}
