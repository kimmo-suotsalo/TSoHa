<?php
   
  /* Course realization creation controller. */

  session_start();

  require_once("views/realizationCreationView.php");
  require_once("libs/models/realizationCatalog.php");
  require_once("libs/models/realization.php");
  require_once("libs/models/user.php");
  require_once '../tietokantayhteys.php';
  
  if ( isset($_SESSION['username']) ) {
  
    if ($_GET['action'] == 'Create this realization') {
    
      $beginDate = htmlspecialchars( trim($_GET['beginDate']) );
      $endDate = htmlspecialchars( trim($_GET['endDate']) );
      $personInCharge = htmlspecialchars( trim($_GET['personInCharge']) );

      if ( isValidInput($beginDate, $endDate, $personInCharge) ) {
        createNewRealization($_GET['courseId'], $beginDate, $endDate, $personInCharge);
        header("Location: ../realizations.php/?createdNew='true'&courseId={$_GET['courseId']}&courseName={$_GET['courseName']}");
      } else {
        RealizationCreationView::askForValidInput($beginDate, $endDate, $personInCharge);
      }
    } else if ($_GET['action'] == 'Cancel') {
      header("Location: ../realizations.php/?courseId={$_GET['courseId']}&courseName={$_GET['courseName']}");
    } else {
      $view = new realizationCreationView($_GET['courseId'], $_GET['courseName'], "", "", "");
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

  function createNewRealization($courseId, $beginDate, $endDate, $personInCharge) {
    $realizationCatalog = new realizationCatalog($courseId);
    $realizationCatalog->createNewRealization($beginDate, $endDate, $personInCharge);
  }
