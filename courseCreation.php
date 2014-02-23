<?php
   
  /* Course creation controller. */

  session_start();

  require_once("views/courseCreationView.php");
  require_once("libs/models/courseCatalog.php");
  require_once '../tietokantayhteys.php';
  
  if ( isset($_SESSION['username']) ) {
  
    if ($_POST['action'] == 'Create this course') {
    
      $id = htmlspecialchars( trim($_POST['id']) );
      $name = htmlspecialchars( trim($_POST['name']) );
      $credits = htmlspecialchars( trim($_POST['credits']) );      

      if ( isValidInput($id, $name, $credits) ) {
        createNewCourse($id, $name, $credits);
        header("Location: courses.php?createdNew='true'");
      } else {
        CourseCreationView::askForValidInput($id, $name, $credits);
      }
      
    } else if ($_POST['action'] == 'Cancel') {
      header("Location: courses.php");
    } else {
      $view = new courseCreationView("", "", "");
      $view->display();
    }
    
  } else {
    header("Location: index.php");
  }
  
  
  function isValidInput($id, $name, $credits) {
    if ( is_numeric($id) && !empty($name) && is_numeric($credits) ) return true;
    return false;
  }
  
  function createNewCourse($id, $name, $credits) {
    $courseCatalog = new courseCatalog();
    $courseCatalog->createNewCourse($id, $name, $credits);
  }
