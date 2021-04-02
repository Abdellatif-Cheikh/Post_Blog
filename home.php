<?php
    include "connect.php";
    session_start();
    if(!isset($_SESSION["user_name"])){
      header('location: err.php');
      exit();
  }
    $post_info = $maBase->query("select * from poste");
    $post_donnes = $post_info->fetchAll();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <title>Home page!</title>
  </head>
  <body>
    <a class="logout" href="logout.php">Logout</a>
    <div class="container">
    <?php if(isset($_REQUEST["info"])){?>
      <?php if($_REQUEST["info"]=="added"){?>
        <div class="alert alert-success text-center" role="alert">
          The Post Has Been Added Successfully!
        </div>
      <?php }?>
    <?php } ?>
    <div class="text-center mt-5">
        <a href="create.php" class="btn btn-outline-info">+ Create a new poste</a>
    </div>
    <div class="row">
      <?php foreach( $post_donnes as $q){?>
      <div class="col-6 d-flex justify-content-center">
        <div class="card mt-5 mycard">
            <img class="card-img-top" src="news.JPG" alt="Card image cap">
            <div class="card-body" style="width: 18rem;">
              <h5 class="card-title"><?php echo $q["title"]?></h5>
              <p class="card-text"><?php echo $q["post_content"]?></p>
              <form method="post">
                <textarea name="comment"cols="30" rows="2" placeholder="Add Comment"></textarea>
                <button name="submit" class="btn btn-dark">Add</button>
                <input type="text" hidden name="id" value="<?php echo $q["id_post"];?>">
                <a href="view.php?id=<?php echo $q["id_post"];?>" class="btn btn-light">Go</a>
              </form>
            </div>
        </div>
      </div>
      <?php }?>
      <?php
        if(isset($_POST["submit"])){
          $post_id = $_POST["id"];
          $userid =$_SESSION["user_id"];
          $comment = $_POST["comment"];
          $req1 = $maBase->prepare("insert into comment(id_post,id_user,content,date_commentaire) values ('$post_id','$userid','$comment', NOW())");
          $req1->execute();
      }
      ?>
    </div>
    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

  </body>
</html>