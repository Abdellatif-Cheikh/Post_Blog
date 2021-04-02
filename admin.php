<?php
    include "connect.php";
    session_start();
    if(!isset($_SESSION["user_name"])){
      if($_SESSION["user_id"]!=1){
        header('location: err.php');
        exit();
      }
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Admin !!</title>
  </head>
  <body>
  <a  class="logout" href="logout.php">Logout</a>
  <div class="container mt-5">
    <h1 class="text-center">ADMIN PAGE</h1>
    <table class="table">
    <h3 class="text-center">Poste_Data</h3>
    <thead class="thead-dark">
    <?php
        $selecPost = $maBase->query('SELECT * FROM poste');
        echo "<tr>
          <th scope='col'>ID</th> 
          <th scope='col'>title</th>
          <th scope='col'>post_content</th>
          <th scope='col'>date_post</th>
          <th scope='col'></th>
          <th scope='col'></th>
        </tr> 
        </thead>";
        while($donnees = $selecPost->fetch()){
            echo "<tr>
                <th scope='col'>".$donnees['id_post']."</th> 
                <th scope='col'>".$donnees['title']."</th>
                <th scope='col'>".$donnees['post_content']."</th>
                <th scope='col'>".$donnees['date_post']."</th>
                <form method='POST'>
                  <input type='text' hidden name='id' value='".$donnees['id_post']."'>
                  <th scope='col'><button class='btn btn-danger btnPost' name='delete'>Delete</button></th>
                </form>
            </tr>";
        }
        if (isset($_REQUEST['delete'])){
          $id = $_REQUEST['id'];
          $remove_post = $maBase->prepare("DELETE FROM poste WHERE id_post= :id ");
          $remove_post->bindParam(':id', $id);
          $remove_post->execute(); 
          echo " <div class='alert alert-danger text-center' role='alert'>
                    The Post Has Been Deleted Successfully!
                </div>";
        }


  ?>

  <tbody>
  </tbody>
</table>
 <table class="table">
 <h3 class="text-center">Comment_Data</h3>
    <thead class="thead-dark">
    <?php
        $selectComment = $maBase->query('SELECT * FROM comment');
        echo "<tr>
        <th scope='col'>id_commentaire</th>
        <th scope='col'>id_post</th>
        <th scope='col'>content</th>
        <th scope='col'>date_commentaire</th>
        <th scope='col'></th>
        </tr> 
        </thead>";
        while($donnees = $selectComment->fetch()){
            echo "<tr>
                <th scope='col'>".$donnees['id_commentaire']."</th> 
                <th scope='col'>".$donnees['id_post']."</th> 
                <th scope='col'>".$donnees['content']."</th>  
                <th scope='col'>".$donnees['date_commentaire']."</th>
                <form method='POST'>
                  <input type='text' hidden name='id' value='".$donnees['id_commentaire']."'>
                  <th scope='col'><button class='btn btn-danger' name='delete'>Delete</button></th>
                </form>
            </tr>";
        }
        if (isset($_REQUEST['delete'])){
            $id = $_REQUEST['id'];
            $remove_post = $maBase->prepare("DELETE FROM comment WHERE id_commentaire= :id ");
            $remove_post->bindParam(':id', $id);
            $remove_post->execute(); 
            echo " <div class='alert alert-danger text-center' role='alert'>
                      The Post Has Been Deleted Successfully!
                  </div>";
        }

       
    ?>
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>