<?php
 require_once('config.php');
 session_start();


 $Authorerr ='';
 $placeerr ="";

 if(isset($_POST['book'])){
    $number = $_POST['number'];
    $place = $_POST['place'];

   
    if($number == ''){
        $Authorerr = "<p class='red-text lighten-4'>Number is required</p>";
    }
    if($place == ''){
        $placeerr = "<p class='red-text lighten-4'>place is required</p>";
    }
    
    if(  $Authorerr == null && $placeerr == null){

        $sql2 = "SELECT * FROM transport WHERE `number` = '$number'";
        $result = mysqli_query($conn , $sql2);
        while($row = mysqli_fetch_assoc($result)){
                if( $row['size'] < $row['max'] ) {
                    $siz =  $row['size'] + 1;
                    $sql3 = "UPDATE `transport` SET `size` = '$siz' WHERE `number` = '$number'";
                    $sql = "INSERT INTO `books` (  `number` , `place` ) VALUES ( '$number', '$place')";
                    if(mysqli_query($conn,$sql3) && mysqli_query($conn,$sql)){
                        header("Location: books.php");
                    }
                } 
                else {
                    $sql = "INSERT INTO `books` (  `number` , `place` ) VALUES ( '$number', '$place')";
                    if(mysqli_query($conn , $sql)){
                        header("Location: books.php");
                    }
                }
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
    <nav class=" indigo lighten-3">
        <a href="books.php" class="brand-logo marginleft">InTime</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            
            <li><a href="home.php">Book A Ticket </a></li>
            <li><a href="index.php">Admin </a></li>
           
        </ul>
    </nav>

    <div class="row margintop">
    <div class="col s1 m3 l4"></div>
    <form method="POST" class="col s10 m6 l4 card">
        <h5 class="center-align indigo-text"> Book A Ticket</h5>
      <div class="row ">
      <div class="input-field col s12">
            <select name="number">
                <option value="" disabled selected>Choose your Trans</option>
               <?php
                 $sql = "SELECT * FROM `transport`";
                 $result = mysqli_query($conn , $sql);
                 while ($row = mysqli_fetch_assoc($result)) { ?>
                    <option value="<?php echo $row['number'] ?>"><?php echo $row['number'] ?></option>
                <?php }        ?>
            </select>
            <?php if(isset( $Authorerr)){echo $Authorerr;} ?>
        </div>
        <div class="input-field col s12">
          <input name="place" id="place" type="text">
          <label for="place">Place</label>
          <?php if(isset( $placeerr)){echo $placeerr;} ?>
        </div>
      </div>
      <div class="row">
          <div class="col s5"></div>
          <div class="col s2">
              <button name="book" type="submit" class="btn indigo lighten-2">Book </button>
          </div>
          <div class="col s5"></div>
      </div>
    </form>
    <div class="col s1 m3 l4"></div>
  </div>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>