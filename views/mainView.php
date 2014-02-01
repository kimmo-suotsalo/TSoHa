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
    return "
    <h1 class='padded'> Course feedback system </h1>
    <p class='padded'> You are logged in. </p>
    <br>
    <table class='padded'>
      <tr> <th> First name </th> <th> Last name </th> <th> User role </th> </tr>
      <tr> <td> {$_SESSION['firstName']} </td> <td> {$_SESSION['lastName']} </td> <td> {$_SESSION['role']} </td> </tr>
    </table>";
  }

}
