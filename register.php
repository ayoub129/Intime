<?php 
     // database config
    require_once('config.php');

    //  button check
    if(isset($_POST['register'])){
          // get variables
        $email = $_POST["email"];
        $firstname = $_POST["firstname"];
        $last = $_POST["lastname"];
        $password = $_POST["password"];
        $password2 = $_POST["password2"];

            // validation
        if($email == ''){
            $emailerr = "<p class='red-text lighten-4'>email is required</p>";
        } 
        if(!filter_var($email , FILTER_VALIDATE_EMAIL)){
            $emailerr = "<p class='red-text lighten-4'>email is not valid</p>";
        }
        if($firstname == ''){
            $firstnameerr = "<p class='red-text lighten-4'>firstname is required</p>";
        }
        if($password == ''){
            $passworderr = "<p class='red-text lighten-4'>password is required</p>";
        }
        if($password != $password2){
            $passworderr2 = "<p class='red-text lighten-4'>passwords should be the same </p>";
        }
        if($last == ''){
            $lasterr = "<p class='red-text lighten-4'>lastname is required</p>";
        }
         // query
        if( $lasterr == null && $firstnameerr == null && $passworderr == null && $emailerr == null && $passworderr2 == null){
            $sql = "INSERT INTO `users` (`firstname` , `lastname` , `password` , `email`) VALUES ('$firstname' , '$last' , '$password' , '$email')";

            if(mysqli_query($conn , $sql)){
                header("Location: index.php");
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
        <h5 class="center-align indigo-text">Register</h5>
      <div class="row ">
        <div class="input-field col s6">
          <input name="firstname"  id="first_name" type="text">
          <label for="first_name">First Name</label>
          <?php if(isset( $firstnameerr)){echo $firstnameerr;} ?>
        </div>
        <div class="input-field col s6">
          <input name="lastname" id="last_name" type="text">
          <label for="last_name">Last Name</label>
          <?php if(isset( $lasterr)){echo $lasterr;} ?>
        </div>
      </div>
     
      <div class="row">
        <div class="input-field col s12">
          <input name="email" id="email" >
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
      <div class="row">
        <div class="input-field col s12">
          <input name="password2" id="password2" type="password">
          <label for="password2">Repeat Password</label>
          <?php if(isset( $passworderr2)){echo $passworderr2;} ?>
        </div>
      </div>
      <div class="row">
          <div class="col s5"></div>
          <div class="col s2">
              <button name="register" type="submit" class="btn indigo lighten-2">Register</button>
          </div>
          <div class="col s5"></div>
      </div>
      <p> Already have an account ? <a href="index.php">Login</a>  </p>
    </form>
    <div class="col s1 m3 l4"></div>
  </div>
            

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

</body>
</html>