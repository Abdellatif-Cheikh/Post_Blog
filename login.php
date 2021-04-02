<?php
    include "connect.php";
    session_start();
    if(isset($_POST['login'])){

      //-----variables initiated and set to empty----
      $username = $_POST['username'];
      $password = $_POST['password'];

      //----insert into database-----
      $response = $maBase->prepare('SELECT * FROM users WHERE user_name = :login AND password=:pass ');

      $response->execute( [
      'login'=>$username,
      'pass'=> $password
      ] );

      $donnees = $response->fetch();

      $_SESSION["user_id"] = $donnees["ID"];
      $_SESSION["user_name"] = $username;  
      if($response->rowCount() == 1){    
          $_SESSION['SESSION_role'] = $donnees['rule'];
          if( $_SESSION['SESSION_role'] == "1"){
                  header('location: admin.php');
          } else {
                  header('location: home.php');
          }
      } else {
          // Display an error message if username doesn't exist
          echo "<center>
                  <div class='alert alert-danger' role='alert'>
                      The username or password is incorrect.
                  </div>
              </center>";  
      }
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="files/fonts/icomoon/style.css">

    <link rel="stylesheet" href="files/css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="files/css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="files/css/style.css">

    <title>Login</title>
  </head>
  <body>
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6 order-md-2">
          <img src="files/images/undraw_file_sync_ot38.svg" alt="Image" class="img-fluid">
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
              <h3>Sign In to <strong>Blog</strong></h3></div>
            <form method="post">
              <div class="form-group first">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username">

              </div>
              <div class="form-group last mb-4">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password">
                
              </div>
              
              <div class="d-flex mb-5 align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                  <input type="checkbox" checked="checked"/>
                  <div class="control__indicator"></div>
                </label>
              </div>

              <input type="submit" name="login" value="Log In" class="btn text-white btn-block btn-primary">

              <span class="d-block text-left my-4 text-muted"> or sign in with</span>
              
              <div class="social-login">
                <a href="#" class="facebook">
                  <span class="icon-facebook mr-3"></span> 
                </a>
                <a href="#" class="twitter">
                  <span class="icon-twitter mr-3"></span> 
                </a>
                <a href="#" class="google">
                  <span class="icon-google mr-3"></span> 
                </a>
              </div>
            </form>
            </div>
          </div>
          
        </div>
        
      </div>
    </div>
  </div>
  
    <script src="files/js/jquery-3.3.1.min.js"></script>
    <script src="files/js/popper.min.js"></script>
    <script src="files/js/bootstrap.min.js"></script>
    <script src="files/js/main.js"></script>
  </body>
</html>