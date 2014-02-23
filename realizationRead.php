<?php
   
  /* Controller for reading realization details. */

  session_start();

  require_once("views/realizationDetailsView.php");
  require_once("libs/models/realizationCatalog.php");
  require_once("libs/models/realization.php");
  require_once '../tietokantayhteys.php';
  
  if ( isset($_SESSION['username']) ) {
    
    $realizationCatalog = new realizationCatalog();
    $searchResults = $realizationCatalog->findRealizationById($_GET['id']);

    $view = new realizationDetailsView($searchResults, $_GET['courseName']);
    $view->display();
  
    if ($_POST['action'] == 'Edit this realization') {
      $realization = $searchResults[0];
      header("Location: ../realizationEdit.php/?id={$realization->getId()}&courseId={$realization->getCourseId()}&" .
             "courseName={$_GET['courseName']}&beginDate={$realization->getBeginDate()}&endDate={$realization->getEndDate()}&" . 
             "personInCharge={$realization->getPersonInCharge()}");
    } else if ($_POST['action'] == 'Delete this realization') {
      $view->confirmDeletion();
    } else if ($_POST['action'] == 'Show queries') {
      $realization = $searchResults[0];
      header("Location: ../queries.php/?realizationId={$realization->getId()}&courseId={$realization->getCourseId()}&" . 
             "courseName={$courseName}&beginDate={$realization->getBeginDate()}&endDate={$realization->getEndDate()}&" .
             "personInCharge={$realization->getPersonInCharge()}");
    }
  
  } else {
    header("Location: index.php");
  }
