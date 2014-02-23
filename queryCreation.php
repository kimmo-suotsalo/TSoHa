<?php
   
  /* Query creation controller. */

  session_start();

  require_once("views/queryCreationView.php");
  require_once("libs/models/queryCatalog.php");
  require_once("libs/models/query.php");
  require_once '../tietokantayhteys.php';
  
  if ( isset($_SESSION['username']) ) {

    if ($_GET['action'] == 'Create this query') {
      $status = htmlspecialchars( trim($_GET['status']) );
      $openingTime = htmlspecialchars( trim($_GET['openingTime']) );
      $closingTime = htmlspecialchars( trim($_GET['closingTime']) );

      if ( isValidInput($status, $openingTime, $closingTime) ) {
        createNewQuery($_GET['realizationId'], $_SESSION['username'], $status, $openingTime, $closingTime);
        header("Location: ../queries.php/?created='true'&realizationId={$_GET['realizationId']}&" .
               "courseId={$_GET['courseId']}&courseName={$_GET['courseName']}");
      } else { 
        QueryCreationView::askForValidInput($_GET['realizationId'], $_GET['courseId'], $_GET['courseName'], $status,
                                            $openingTime, $closingTime);
      }
    } else if ($_GET['action'] == 'Cancel') {
      header("Location: ../queries.php/?realizationId={$_GET['realizationId']}&courseId={$_GET['courseId']}&" .
             "courseName={$_GET['courseName']}");
    } else {
      $view = new queryCreationView($_GET['realizationId'], $_GET['courseId'], $_GET['courseName'], $_GET['status'],
                                    $_GET['openingTime'], $_GET['closingTime']);
      $view->display();
    }
    
  } else {
    header("Location: index.php");
  }

  function isValidInput($status, $openingTime, $closingTime) {
    if ( empty($openingTime) || DateTime::createFromFormat('Y-m-d H:i:s', $openingTime) ) {
        if ( empty($closingTime) || DateTime::createFromFormat('Y-m-d H:i:s', $closingTime) ) {
          return true;
        }
    }
    return false;
  }
 
  function createNewQuery($realizationId, $editor, $status, $openingTime, $closingTime) {
    $queryCatalog = new queryCatalog($realizationId);
    $queryCatalog->createNewQuery($editor, $status, $openingTime, $closingTime);
  }
