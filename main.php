<?php
   
  /* Main page controller. */

  session_start();

  require_once("views/mainView.php");
  
  if ( isset($_SESSION['username']) ) {
    $view = new mainView();
    $view->display();
  } else {
    header("Location: index.php");
  }
  
