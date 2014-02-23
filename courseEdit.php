<?php
   
  /* Course editing controller. */

  session_start();

  require_once("views/courseEditView.php");
  require_once("libs/models/courseCatalog.php");
  require_once '../tietokantayhteys.php';
  
  if ( isset($_SESSION['username']) ) {
  
    if ($_POST['action'] == 'Save changes') {
      $oldId = $_POST['oldId'];
      $name = htmlspecialchars( trim($_POST['name']) );
      $credits = htmlspecialchars( trim($_POST['credits']) );      

      if ( isValidInput($oldId, $name, $credits) ) {
        updateCourse($name, $credits, $oldId);
        header("Location: ../courses.php?updated='true'");
      } else {
        CourseEditView::askForValidInput($oldId, $name, $credits);
      }
      
    } else if ($_POST['action'] == 'Cancel') {
      header("Location: ../courseRead.php/?id={$_POST['oldId']}");
    } else {
      $view = new courseEditView($_GET['id'], $_GET['name'], $_GET['credits']);
      $view->display();
    }
    
  } else {
    header("Location: index.php");
  }
  
  
  function isValidInput($id, $name, $credits) {
      if ( is_numeric($id) && !empty($name) && is_numeric($credits) ) return true;
      return false;
  }
   
  function updateCourse($name, $credits, $oldId) {
    $courseCatalog = new courseCatalog();
    $courseCatalog->updateCourse($name, $credits, $oldId);
  }
