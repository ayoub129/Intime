<?php 
    session_start();
    
        if(isset($_SESSION['id']) && $_SESSION['id'] != ''){
            header("Location: books.php");
    }
    // database config
     require_once('config.php');

    //  button check
    if (isset($_POST['login']))
    {
        // get variables
    $email = $_POST["email"];
    $password = $_POST["password"];

    $passworderr = '';
    $emailerr = '';
    // validation
    if($email == ''){
        $emailerr = "<p class='red-text lighten-4'>email is required</p>";
    } 
    if(!filter_var($email , FILTER_VALIDATE_EMAIL)){
        $emailerr = "<p class='red-text lighten-4'>email is not valid</p>";
    }
    if($password == ''){
        $passworderr = "<p class='red-text lighten-4'>password is required</p>";
    }

    // query
    if(  $passworderr == '' && $emailerr == ''){
        $sql = "SELECT * FROM `users` WHERE `email`='$email' AND  `password`='$password' AND `isAdmin` = 'admin'";
        $result = mysqli_query($conn , $sql);
        $count = mysqli_num_rows($result);

        if($count = 1){
           while($row = mysqli_fetch_assoc($result)){
            $_SESSION['id'] = $row['id'];
            header("Location: dashboard.php");
            }
        } 
        

        $sql2 = "SELECT * FROM `users` WHERE `email`='$email' AND  `password`='$password'";
        $result2 = mysqli_query($conn , $sql2);
        $count2 = mysqli_num_rows($result2);

        if($count2 = 1){
           while($row2 = mysqli_fetch_assoc($result2)){
            $_SESSION['id'] = $row2['id'];
            header("Location: books.php");
            }
        } 


        else {
            $err = "<p class='red-text lighten-4'>email or password is wrong </p>";
        }

  
    }


    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>

<div class="row margin">
    <div class="col s1 m3 l4"></div>
    <form method="POST" class="col s10 m6 l4 card">
        <h5 class="center-align indigo-text">Login</h5>
        <div class="row">
          <div class="input-field col s12">
            <input name="email" id="email" type="text">
            <label for="email">Email</label>
            <?php if(isset( $emailerr)){echo $emailerr;} ?>
          </div>
        </div>
      <div class="row">
        <div class="input-field col s12">
          <input name="password" id="password" type="password">
          <label for="password">Password</label>
          <?php if(isset( $passworderr)){echo $passworderr;} ?>
        </div>
      </div>
      
      <?php if(isset( $err)){echo $err;} ?>
      <div class="row">
          <div class="col s5"></div>
          <div class="col s2">
              <button type="submit" name="login" class="btn indigo lighten-2">Login</button>
          </div>
          <div class="col s5"></div>
      </div>
      <p> Don't have an account ? <a href="register.php">Register</a>  </p>
    </form>
    <div class="col s1 m3 l4"></div>
  </div>
            

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

</body>
</html>