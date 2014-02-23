<?php

  /* Course realizations controller. */

  session_start();

  require_once("views/realizationsView.php");
  require_once("libs/models/realizationCatalog.php");
  require_once("libs/models/realization.php");
  require_once '../tietokantayhteys.php';
  
  if ( isset($_SESSION['username']) ) {

    $realizationCatalog = new realizationCatalog($_GET['courseId']);
    $searchResults = $realizationCatalog->findAll();
    
    if ($_GET['action'] == 'Create a new realization') {
      header("Location: ../realizationCreation.php/?courseId={$_GET['courseId']}&courseName={$_GET['courseName']}");
    } else {

      if ( isset($_POST['deleteId']) ) {
        $realizationCatalog->deleteRealization($_POST['deleteId']);
        $searchResults = $realizationCatalog->findAll();
      }
      
      if ( isset($_POST['courseId']) && isset($_POST['courseName']) )
        $view = new realizationsView($_GET['createdNew'], $_GET['updated'], $_GET['deleted'], $_GET['courseId'],
                                     $_GET['courseName'], $searchResults);
      else $view = new realizationsView($_GET['createdNew'], $_GET['updated'], $_GET['deleted'], $_GET['courseId'],
                                        $_GET['courseName'], $searchResults);     
      
      $view->display();      
    }

  } else {
    header("Location: index.php");
  }
  
