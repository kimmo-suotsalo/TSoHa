<?php

  /* Login page controller. */
  
  session_start();
  
  if ( isset($_SESSION['username']) ) {
    session_destroy();  
  }
      
  require_once("views/loginView.php");
  require_once '../tietokantayhteys.php';
  require_once("libs/models/user.php");
 
  $view = new LoginView();
  $view->display(); 
  
  if ($_POST["username"] != "") {
  
    $user = new User($_POST["username"], $_POST["password"]);

    if ( $user->hasAccess() ) {
      $_SESSION['username'] = $user->getUsername();
      $_SESSION['firstName'] = $user->getFirstName();
      $_SESSION['lastName'] = $user->getLastName();
      $_SESSION['role'] = $user->getRole();      
      header("Location: main.php");
    } else {
      $view->displayError();
    }          
    
  }
    


