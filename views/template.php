<?php

/* Template for other views. */

class Template {

  private $pageName;
  private $pageTop;
  private $pageBottom;

  public function __construct($pageName) {
    $this->pageName = $pageName;
    $this->pageTop = $this->createPageTop();
    $this->pageBottom = $this->createPageBottom();
  }
  
  public function displayTop() {
    echo $this->pageTop;
  }
  
  public function displayBottom() {
    echo $this->pageBottom;
  }        
  
  private function createPageTop() {
    return "
    <!DOCTYPE html>
    <html>        
      <head>
        {$this->createHead()}
      </head>

      <body>		
        {$this->createMenuBar()}
        {$this->createNavLinks()}
      <br>";          
  }    
     
  private function createHead() {
    return "
  	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
  	<link rel='stylesheet' href='css/genericStyles.css'>
  	<title> Course feedback system | {$this->pageName} </title>";
  }     
     
  private function createMenuBar() {
    return "
    <ul class='menuBar'>          
      <li class='menuItem' id='active'> <a class='menuLink' href='main.php'> Main page </a> </li>
      <li class='menuItem'> <a class='menuLink' href='courses.php'> Courses </a> </li>
      <li class='menuItem'> <a class='menuLink' href='statistics.php'> Statistics </a> </li>
      <li class='menuItem'> <a class='menuLink' href='index.php'> Logout </a> </li>
    </ul>";
  }
  
  private function createNavLinks() {
    return "
    <div class='smallFont'>
      <a class='navLink' href='main.php'> {$this->pageName} </a> >
    </div>";
  }
     
  private function createPageBottom() {
    return "
      </body>

    </html>";
  }
  
}
