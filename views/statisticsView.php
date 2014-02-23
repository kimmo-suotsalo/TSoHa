<?php

/* Statistics page view. */

require_once("template.php");

class StatisticsView {

  private $pageName;
  private $content;

  public function __construct() {
    $this->pageName = "Statistics";
    $this->content = $this->addContent();
  }
  
  public function display() {
    $template = new Template($this->pageName, "");
    $template->displayTop();
    echo $this->content;
    $template->displayBottom();
  }    
  
  private function addContent() {
    return "<h3 class='message'> Statistics will be available later. Thank you for your patience. </h3>";
  }

}
