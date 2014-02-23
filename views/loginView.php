<?php

/* Login view. */

class LoginView {

  private $pageTop = '
  <!DOCTYPE html>
  <html>
    <head>
    	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    	<link rel="stylesheet" href="css/login.css">
      <title> Course feedback system | Login </title>
    </head>';
    
  private $loginForm = '   
    <body>
      <div class="bordered">		
        <h1> Login </h1>
      	<form action="index.php" method="post">
          <p> username <input type="text" name="username" maxlength="14"/> </p>
          <p> password <input type="password" name="password" maxlength="14"/> </p>
    	    <p> <input type="submit" value="Submit" /> </p>
        </form>
      </div>';
   
  private $pageBottom = '
    </body>
  </html>';

  private $errorMessage = '<div class="centered" id="error"> Login failed. Try again. </div>';
  
  private $logoutMessage = '<div class="centered"> You have been logged out. </div>';

  public function display($loggedOut) {
    echo $this->pageTop;
    echo $this->loginForm;
    echo $this->pageBottom;
    if ($loggedOut) echo "<h2 class='message'> You have been logged out. </h2>";
  }    

  public function displayError() {
    echo $this->errorMessage;
  }    
  
  public function displayLogout() {
    echo $this->logoutMessage;
  }     

}
