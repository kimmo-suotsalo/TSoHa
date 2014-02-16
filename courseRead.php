<?php
   
  /* Controller for reading course details. */

  session_start();

  require_once("views/coursesView.php");
  require_once("views/courseCreationView.php");
  require_once("views/courseDetailsView.php");
  require_once("libs/models/courseCatalog.php");
  require_once("libs/models/course.php");
  require_once '../tietokantayhteys.php';
  
  if ( isset($_SESSION['username']) ) {
    
    $courseId = $_GET['id'];
    $courseCatalog = new courseCatalog();
    $searchResults = $courseCatalog->findCourseById($courseId);

    $view = new courseDetailsView($searchResults);
    $view->display();
  
    if ($_POST['action'] == 'Edit this course') {
      header("Location: ../courseEdit.php/?id={$searchResults[0]->getId()}&".
             "name={$searchResults[0]->getName()}&credits={$searchResults[0]->getCredits()}");
    } else if ($_POST['action'] == 'Delete this course') {
      $view->confirmDeletion();
    } else if ($_POST['action'] == 'Show realizations') {
      header("Location: ../realizations.php/?courseId={$searchResults[0]->getId()}&".
             "courseName={$searchResults[0]->getName()}");
    }
  
  } else {
    header("Location: index.php");
  }
