<?php
   
  /* Realization editing controller. */

  session_start();

  require_once("views/realizationsView.php");
  require_once("views/realizationEditView.php");
  require_once("libs/models/realizationCatalog.php");
  require_once("libs/models/realization.php");
  require_once("libs/models/user.php");
  require_once '../tietokantayhteys.php';
  
  if ( isset($_SESSION['username']) ) {

    $id = $_GET['id'];
    $courseId = $_GET['courseId'];
    $courseName = $_GET['courseName'];
    $beginDate = $_GET['beginDate'];
    $endDate = $_GET['endDate'];
    $personInCharge = $_GET['personInCharge'];        
  
    if ($_GET['action'] == 'Save changes') {
      $id = $_GET['id'];
      $courseId = $_GET['courseId'];
      $courseName = $_GET['courseName'];      
      $beginDate = htmlspecialchars( trim($_GET['beginDate']) );
      $endDate = htmlspecialchars( trim($_GET['endDate']) );
      $personInCharge = htmlspecialchars( trim($_GET['personInCharge']) );

      if ( isValidInput($beginDate, $endDate, $personInCharge) ) {
        updateRealization($id, $courseId, $beginDate, $endDate, $personInCharge);
        header("Location: ../realizations.php/?courseId={$courseId}&courseName={$courseName}");
      } else {
        askForValidInput($id, $courseId, $beginDate, $endDate, $personInCharge);
      }
      
    } else if ($_GET['action'] == 'Cancel') {
      header("Location: ../realizationRead.php/?id={$id}&courseName={$courseName}");
    } else {
      $view = new realizationEditView($id, $courseId, $courseName, $beginDate, $endDate, $personInCharge);
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
  
  function askForValidInput($id, $courseId, $beginDate, $endDate, $username) {
      $user = new user($username, "");
      if ( !empty($username) && !$user->isTeacher() ) {
        $view = new realizationEditView($id, $courseId, $courseName, $beginDate, $endDate, "");
        $errorMsg = "<p class='padded' id='error'> The username you provided does not match any teacher in the system. 
                    You must provide a valid username or leave the field empty. </p>";
      } else if ( !empty($beginDate) && !DateTime::createFromFormat('Y-m-d', $beginDate) ) {
        $view = new realizationEditView($id, $courseId, $courseName, "", $endDate, $username);
        $errorMsg = "<p class='padded' id='error'> You must provide a valid begin date or leave the field empty. </p>";
      } else if ( !empty($endDate) && !DateTime::createFromFormat('Y-m-d', $endDate) ) {
        $view = new realizationEditView($id, $courseId, $courseName, $beginDate, "", $username);
        $errorMsg = "<p class='padded' id='error'> You must provide a valid end date or leave the field empty. </p>";
      }
      $view->display();
      echo $errorMsg;      
  }
  

  function updateRealization($id, $courseId, $beginDate, $endDate, $personInCharge) {
    $realizationCatalog = new realizationCatalog($courseId);
    $realizationCatalog->updateRealization($beginDate, $endDate, $personInCharge, $id);
  }
