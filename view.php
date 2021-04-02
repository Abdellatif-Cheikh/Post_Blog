<?php
    include "connect.php";
    session_start();
    if(!isset($_SESSION["user_name"])){
        header('location: err.php');
        exit();
    }
    $id = $_GET["id"];
    $data = $maBase->query("SELECT * FROM comment WHERE id_post = $id ORDER BY id_post DESC ");
    $data_post = $maBase->query("SELECT * FROM poste WHERE id_post = $id");
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="all.min.css" rel="stylesheet"> <!--load all styles -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>View page!!</title>
  </head>
<body>
    <a  class="logout" href="logout.php">Logout</a>
    <div class="container">
        <?php
            while($donnees = $data_post->fetch()){
        ?>
        <div class="row view_page">
            <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="view_Uname"><i class="fas fa-user"></i> <?php echo $_SESSION["user_name"];?></div>
                    <img class="card-img-top offset-3" src="news.JPG" alt="Card image cap">
                    <h5 class="card-title"><?php echo $donnees['title'];?></h5>
                    <p class="card-text"><?php echo $donnees['post_content'];?></p>
                    <div class="img_comment">
                        <img src="user.PNG" class="card-img-top" alt="Not found">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $_SESSION["user_name"];?></h5>
                    <?php   
                        $data1 = $maBase->query("SELECT * FROM comment where id_post = $id");
                        while($donnees = $data1->fetch()){
                            echo "<div class='content_comment'>".$donnees['content']."<span class='date_class'>".$donnees['date_commentaire']."</span></div><br>";
                        }
                    ?>                     
            </div>
        <?php
            }
        ?>
                </div>
            </div>
            </div>
            
        </div>
    <script defer src="all.min.js"></script>
    </div>
</body>
</html>