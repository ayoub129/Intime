<?php
 require_once('config.php');
 session_start();
 if($_SESSION['id'] === null){
    header("Location: index.php");
}

if(isset($_POST['logout'])){
    session_destroy();
    header("Location: index.php");
 }

 $Authorerr ='';
 $maxerr ='';

 if(isset($_POST['Add'])){
    $number = $_POST['number'];
    $max = $_POST['max'];
  
    if($number == ''){
        $Authorerr = "<p class='red-text lighten-4'>Number is required</p>";
    }
    if($max == ''){
        $maxerr = "<p class='red-text lighten-4'>max is required</p>";
    }
  
   
    if(  $Authorerr == null  && $maxerr ==null){
        $sql = "INSERT INTO transport ( `max`, `number` , `size`) VALUES ('$max', '$number' , 0)";
        $sql2 = "INSERT INTO places ( `place`, `number_trans`) VALUES (1, '$number')";
        if(mysqli_query($conn , $sql) && mysqli_query($conn , $sql2) ){
            header("Location: dashboard.php");
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
    <title>Books</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<nav class="bg-primary">
        <a href="dashboard.php" class="brand-logo  marginleft">
            <img src="logo.png" alt="" class="logo">
        </a>
        <ul id="nav-mobile" class="right  hide-on-med-and-down">
            
            <li><a href="transport.php">Add Trans </a></li>
            <li>
                <form  method="POST">
                    <button name="logout" class="marginright btn bg-secondary waves-effect waves-light" type="submit" >Log out</button>
                </form>
            </li>
        </ul>
    </nav>

    <div class="row margintop">
    <div class="col s1 m3 l4"></div>
    <form method="POST" class="col s10 m6 l4 card">
        <h5 class="center-align text-primary"> Add Transport </h5>
      <div class="row ">
        <div class="input-field col s12">
          <input name="number" id="Author" type="text">
          <label for="Author">Trans Number</label>
          <?php if(isset( $Authorerr)){echo $Authorerr;} ?>
        </div>
        <div class="input-field col s12">
          <input name="max"  id="max" type="text">
          <label for="max">Maximun</label>
          <?php if(isset( $maxerr)){echo $maxerr;} ?>
        </div>
      </div>
      <div class="row">
          <div class="col s5"></div>
          <div class="col s2">
              <button name="Add" type="submit" class="btn bg-secondary lighten-2">Add_Trans </button>
          </div>
          <div class="col s5"></div>
      </div>
    </form>
    <div class="col s1 m3 l4"></div>
  </div>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>