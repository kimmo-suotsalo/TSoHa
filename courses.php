<?php
   
  /* Courses page controller. */

  session_start();

  require_once("views/coursesView.php");
  require_once("views/courseCreationView.php");
  require_once("libs/models/courseCatalog.php");
  require_once("libs/models/course.php");
  require_once '../tietokantayhteys.php';
  
  if ( isset($_SESSION['username']) ) {

    $courseCatalog = new courseCatalog();
    $searchResults = $courseCatalog->findAll();
    
    if ($_POST['createNewCourse']) {
      header("Location: courseCreation.php");   
    } else {

      if ( isset($_POST['deleteId']) ) {
        $courseCatalog->deleteCourse($_POST['deleteId']);
        $searchResults = $courseCatalog->findAll();
      }
      
      $view = new coursesView($searchResults);
      $view->display();      
    }
    
  } else {
    header("Location: index.php");
  }
  
