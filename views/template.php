<?php

/* Template for other views. */

class Template {

  private $pageName;
  private $navigationTree;
  private $path;
  private $pageTop;
  private $pageBottom;

  public function __construct($pageName, $navigationTree) {
    $this->pageName = $pageName;
    $this->navigationTree = $navigationTree;
    if ($this->pageName == 'Course details' || $this->pageName == 'Edit course' || $this->pageName == 'Realizations' ||
        $this->pageName == 'Create a new realization' || $this->pageName == 'Realization details' ||
        $this->pageName == 'Edit realization' || $this->pageName == 'Queries' || $this->pageName == 'Create a new query')
        $this->path = "../";
    else $this->path = "./";
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
    return "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>" .
           "<link rel='stylesheet' href='{$this->path}css/genericStyles.css'>" .
           "<title> Course feedback system | {$this->pageName} </title>";
  }     
     
  private function createMenuBar() {
    $menuItemIDs = array("Main page" => "", "Courses" => "", "Statistics" => "");
    $page = $this->pageName;

    if ($page == "Main page") $menuItemIDs["Main page"] = "id='active'";
    else if ($page == "Statistics") $menuItemIDs["Statistics"] = "id='active'";
    else if ($page == "Courses" || $page == "Create a new course" || $page == "Course details" ||
             $page == "Edit course" || $page == "Create a new realization" ||
             $page == "Realizations" || $page == "Realization details" || $page == "Edit realization" ||
             $page == "Queries" || $page = "Create a new query")
                $menuItemIDs["Courses"] = "id='active'";
    
    return "
    <ul class='menuBar'>          
      <li class='menuItem' {$menuItemIDs["Main page"]} > <a class='menuLink' href='{$this->path}main.php'> Main page </a> </li>
      <li class='menuItem' {$menuItemIDs["Courses"]} > <a class='menuLink' href='{$this->path}courses.php'> Courses </a> </li>
      <li class='menuItem' {$menuItemIDs["Statistics"]} > <a class='menuLink' href='{$this->path}statistics.php'> Statistics </a> </li>
      <li class='menuItem'> <a class='menuLink' href='{$this->path}index.php'> Logout </a> </li>
    </ul>";
  }
  
  private function createNavLinks() {
    if ($this->pageName == "Main page") $href = "'main.php'";
    else if ($this->pageName == "Courses") $href = "'courses.php'";
    else if ($this->pageName == "Statistics") $href = "'statistics.php'";  
    return "
    <div class='smallFont'>
      {$this->navigationTree} <a class='navLink' href={$href}> {$this->pageName} </a> >
    </div>";
  }
     
  private function createPageBottom() {
    return "
      </body>

    </html>";
  }
  
}
