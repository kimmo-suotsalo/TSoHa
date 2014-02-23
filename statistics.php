<?php
   
  /* Statistics page controller. */

  session_start();

  require_once("views/statisticsView.php");
  
  if ( isset($_SESSION['username']) ) {

    $view = new statisticsView();
    $view->display();      
    
  } else {
    header("Location: index.php");
  }
