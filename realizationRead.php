<?php
   
  /* Controller for reading realization details. */

  session_start();

  require_once("views/realizationsView.php");
  require_once("views/realizationDetailsView.php");
  require_once("libs/models/realizationCatalog.php");
  require_once("libs/models/realization.php");
  require_once '../tietokantayhteys.php';
  
  if ( isset($_SESSION['username']) ) {
    
    $id = $_GET['id'];
    $courseName = $_GET['courseName'];
    $realizationCatalog = new realizationCatalog();
    $searchResults = $realizationCatalog->findRealizationById($id);


    $view = new realizationDetailsView($searchResults, $courseName);
    $view->display();
  
    if ($_POST['action'] == 'Edit this realization') {
      $realization = $searchResults[0];
      header("Location: ../realizationEdit.php/?id={$realization->getId()}&courseId={$realization->
              getCourseId()}&courseName={$courseName}&beginDate={$realization->getBeginDate()}&endDate={$realization->
              getEndDate()}&personInCharge={$realization->getPersonInCharge()}");
    } else if ($_POST['action'] == 'Delete this realization') {
      $view->confirmDeletion();
    }
  
  } else {
    header("Location: index.php");
  }
