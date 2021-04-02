<?php
  include "connect.php";
  session_start();
    if(isset($_POST["submit"])){
      $title = filter_var($_POST["title"],FILTER_SANITIZE_STRING);
      $content = filter_var($_POST["content"],FILTER_SANITIZE_STRING);
      if($title !="" && $content !="" ){
          $req = $maBase->prepare("insert into poste(title,post_content,date_post) values ('$title','$content', NOW())");
          $req->execute();
          header('location: home.php?info=added');
        exit();
      }else {
        echo "<center>
                <div class='alert alert-danger' role='alert'>
                 You must write a title and content for your poste !!!
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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Create page!</title>
  </head>
  <body>
    <a  class="logout" href="logout.php">Logout</a>
    <h2 class="text-center mt-5">Create Your Own Poste </h2>
    <div class="container mt-5">
        <form method="post">
            <input type="text" name ="title" placeholder="Blog title" class="form-control bg-dark text-white my-3 text-center ">
            <textarea name = "content" class="form-control bg-dark text-white my-3" cols="30" rows="10"></textarea>
            <button name="submit" class="btn btn-dark">Add Poste</button>
        </form>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

  </body>
</html>