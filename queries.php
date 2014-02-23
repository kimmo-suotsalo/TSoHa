<?php

  /* Queries controller. */

  session_start();

  require_once("views/queriesView.php");
  require_once("libs/models/queryCatalog.php");
  require_once("libs/models/query.php");
  require_once '../tietokantayhteys.php';
  
  if ( isset($_SESSION['username']) ) {    

    $queryCatalog = new queryCatalog($_GET['realizationId']);
    $searchResults = $queryCatalog->findAll();
    
    $view = new queriesView($_GET['created'], $_GET['realizationId'], $_GET['courseId'], $_GET['courseName'], $searchResults);
    $view->display();          

    if ($_GET['action'] == 'Create a new query') {
      header("Location: ../queryCreation.php/?realizationId={$_GET['realizationId']}&courseId={$_GET['courseId']}&" .
             "courseName={$_GET['courseName']}");
    } 

  } else {
    header("Location: index.php");
  }
  
