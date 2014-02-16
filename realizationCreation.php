<?php
   
  /* Course realization creation controller. */

  session_start();

  require_once("views/realizationsView.php");
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
        header("Location: ../realizations.php/?courseId={$_GET['courseId']}&courseName={$_GET['courseName']}");
      } else {
        askForValidInput($beginDate, $endDate, $personInCharge);
      }
    } else if ($_GET['action'] == 'Cancel') {
      header("Location: ../realizations.php/?courseId={$_GET['courseId']}&courseName={$_GET['courseName']}");
    } else {
      $courseId = $_GET['courseId'];
      $courseName = $_GET['courseName'];
      $view = new realizationCreationView($courseId, $courseName, "", "", "");
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

  function askForValidInput($beginDate, $endDate, $username) {
      $user = new user($username, "");
      if ( !empty($username) && !$user->isTeacher() ) {
        $view = new realizationCreationView($_GET['courseId'], $_GET['courseName'], $beginDate, $endDate, "");
        $errorMsg = "<p class='padded' id='error'> The username you provided does not match any teacher in the system. 
                    You must provide a valid username or leave the field empty. </p>";
      } else if ( !empty($beginDate) && !DateTime::createFromFormat('Y-m-d', $beginDate) ) {
        $view = new realizationCreationView($_GET['courseId'], $_GET['courseName'], "", $endDate, $username);
        $errorMsg = "<p class='padded' id='error'> You must provide a valid begin date or leave the field empty. </p>";
      } else if ( !empty($endDate) && !DateTime::createFromFormat('Y-m-d', $endDate) ) {
        $view = new realizationCreationView($_GET['courseId'], $_GET['courseName'], $beginDate, "", $username);
        $errorMsg = "<p class='padded' id='error'> You must provide a valid end date or leave the field empty. </p>";
      }
      $view->display();
      echo $errorMsg;      
  }
  
  function createNewRealization($courseId, $beginDate, $endDate, $personInCharge) {
    $realizationCatalog = new realizationCatalog($courseId);
    $realizationCatalog->createNewRealization($beginDate, $endDate, $personInCharge);
  }
