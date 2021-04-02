<?php
    include "connect.php";

    session_start();
    
    if(isset($_POST['submit'])){

    $user_name = $_POST['name'];
    $user_pass = $_POST['password'];
    $user_email = $_POST['email'];
    $re_password = $_POST['re_password'];

        if($user_name ==''){
        echo "<script>alert('Please enter your name!')</script>";
        exit();
        }

        if($user_email==''){
        echo "<script>alert('Please enter a email!')</script>";
        exit();
        }

        if($user_pass==''){
        echo "<script>alert('Please enter your password!')</script>";
        exit();
        }
        if($re_password != $user_pass){
            echo "<script>alert('Please check your first password!')</script>";
            exit();
        }


    // Validation and field insertion

    $check_email = "select * from users where email = :email";
    $check_email = $maBase->prepare($check_email);
    $check_email->execute(array(':email'=>$user_email));
    if($check_email->rowCount() > 0){
        echo "<script>alert('Email $user_email already exist!')</script>";
        exit();
    }

    $query = "insert into users(user_name,email,password) values (?, ?, ?)";
    $query = $maBase->prepare($query);
    $query->bindParam('1', $user_name);
    $query->bindParam('2', $user_email);
    $query->bindParam('3', $user_pass);
    $query->execute();
        if($query->rowCount() > 0) {
            echo "<script>alert('Your Subscribing Was Successful')</script>";
            echo "<script>window.open('login.php','_self')</script>";
            exit();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by Colorlib</title>
    <!-- Font Icon -->
    <link rel="stylesheet" href="files1/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="files1/css/style.css">
</head>
<body>

    <div class="main">

        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content">
                    <form method="POST" id="signup-form" class="signup-form">
                        <h2 class="form-title">Create account</h2>
                        <div class="form-group">
                            <input type="text" class="form-input" name="name" id="name" placeholder="Your Name"/>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-input" name="email" id="email" placeholder="Your Email"/>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="password" id="password" placeholder="Password"/>
                            <span toggle="#password" class="zmdi field-icon toggle-password zmdi-eye-off"></span>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="re_password" id="re_password" placeholder="Repeat your password"/>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                            <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Sign up"/>
                        </div>
                    </form>
                    <p class="loginhere">
                        Have already an account ? <a href="#" class="loginhere-link">Login here</a>
                    </p>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="files1/vendor/jquery/jquery.min.js"></script>
    <script src="files1/js/main.js"></script>
</body>
</html>