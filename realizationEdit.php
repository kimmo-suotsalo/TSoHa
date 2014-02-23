<?php
   
  /* Realization editing controller. */

  session_start();

  require_once("views/realizationEditView.php");
  require_once("libs/models/realizationCatalog.php");
  require_once("libs/models/realization.php");
  require_once("libs/models/user.php");
  require_once '../tietokantayhteys.php';
  
  if ( isset($_SESSION['username']) ) {

    if ($_GET['action'] == 'Save changes') {
      $beginDate = htmlspecialchars( trim($_GET['beginDate']) );
      $endDate = htmlspecialchars( trim($_GET['endDate']) );
      $personInCharge = htmlspecialchars( trim($_GET['personInCharge']) );

      if ( isValidInput($beginDate, $endDate, $personInCharge) ) {
        updateRealization($_GET['id'], $_GET['courseId'], $beginDate, $endDate, $personInCharge);
        header("Location: ../realizations.php/?updated=true&courseId={$_GET['courseId']}&courseName={$_GET['courseName']}");
      } else {
        RealizationEditView::askForValidInput($_GET['id'], $_GET['courseId'], $beginDate, $endDate, $personInCharge);
      }
      
    } else if ($_GET['action'] == 'Cancel') {
      header("Location: ../realizationRead.php/?id={$_GET['id']}&courseId={$_GET['courseId']}&courseName={$_GET['courseName']}");
    } else {
      $view = new realizationEditView($_GET['id'], $_GET['courseId'], $_GET['courseName'], $beginDate, $endDate, $personInCharge);
      $view->display();
    }
    
  } else {
    header("Location: index.php");
  }
  

  function isValidInput($beginDate, $endDate, $username) {
      $user = new user($username, "");
      if ( empty($username) || $user->isTeacher() ) {
        if ( empty($beginDate) || DateTime::createFromFormat('Y-m-d', $beginDate) ) {
          if ( empty($endDate) || DateTime::createFromFormat('Y-m-d', $endDate) ) {
            return true;
          }
        }
      }  
      return false;
  }

  function updateRealization($id, $courseId, $beginDate, $endDate, $personInCharge) {
    $realizationCatalog = new realizationCatalog($courseId);
    $realizationCatalog->updateRealization($beginDate, $endDate, $personInCharge, $id);
  }
