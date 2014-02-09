<?php
   
  /* Course editing controller. */

  session_start();

  require_once("views/coursesView.php");
  require_once("views/courseEditView.php");
  require_once("libs/models/courseCatalog.php");
  require_once("libs/models/course.php");
  require_once '../tietokantayhteys.php';
  
  if ( isset($_SESSION['username']) ) {
  
    $courseId = $_GET['id'];
    $courseName = $_GET['name'];
    $courseCredits = $_GET['credits'];
  
    if ($_POST['action'] == 'Save changes') {
      $oldId = $_POST['oldId'];
      $name = htmlspecialchars( trim($_POST['name']) );
      $credits = htmlspecialchars( trim($_POST['credits']) );      

      if ( isValidInput($oldId, $name, $credits) ) {
        updateCourse($name, $credits, $oldId);
        header("Location: ../courses.php");
      } else {
        askForValidInput($oldId, $name, $credits);
      }
      
    } else if ($_POST['action'] == 'Cancel') {
      header("Location: ../courseRead.php/?id={$_POST['oldId']}");
    } else {
      $view = new courseEditView($courseId, $courseName, $courseCredits);
      $view->display();
    }
    
  } else {
    header("Location: index.php");
  }
  
  
  function isValidInput($id, $name, $credits) {
      if ( is_numeric($id) && !empty($name) && is_numeric($credits) ) return true;
      return false;
  }
  
  function askForValidInput($id, $name, $credits) {
      if ( !is_numeric($id) ) {
        $view = new courseEditView("", $name, $credits);
        $errorMsg = "<p class='padded' id='error'> You must provide a course id that contains only numerals (0-9). </p>";
      } else if ( empty($name) ) {
        $view = new courseEditView($id, "", $credits);
        $errorMsg = "<p class='padded' id='error'> You must provide a course name. </p>";
      } else if ( !is_numeric($credits) ) {
        $view = new courseEditView($id, $name, "");
        $errorMsg = "<p class='padded' id='error'> You must provide number of credits containing only numerals (0-9). </p>";
      }
      $view->display();
      echo $errorMsg;      
  }
  
  function updateCourse($name, $credits, $oldId) {
    $courseCatalog = new courseCatalog();
    $courseCatalog->updateCourse($name, $credits, $oldId);
  }
