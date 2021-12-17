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

 $booknameerr ='';
 $Authorerr ='';
 $placeerr ="";

 if(isset($_POST['book'])){
    $name = $_POST['bookname'];
    $number = $_POST['number'];
    $place = $_POST['place'];
    $user_id = $_SESSION['id'];
    if($name == ''){
        $booknameerr = "<p class='red-text lighten-4'> name is required</p>";
    }
    if($number == ''){
        $Authorerr = "<p class='red-text lighten-4'>Number is required</p>";
    }
    if($place == ''){
        $placeerr = "<p class='red-text lighten-4'>place is required</p>";
    }
   
    if( $booknameerr == null && $Authorerr == null){
        $sql = "INSERT INTO `books` ( `name`, `number` , `place` , `user_id`) VALUES ('$name', '$number', '$place' , '$user_id')";

        
        if(mysqli_query($conn , $sql)){
            $sql2 = "SELECT size FROM transport WHERE 'number' = '$number'";
            $result = $conn->query($sql2);
    
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    $siz = $row['size'] + 1;
                    $sql3 = "UPDATE `transport` SET `size` = '$siz'";
                    $conn->query($sql3);
                }
            }

            header("Location: books.php");
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
        <a href="books.php" class="brand-logo marginleft">Trans</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            
            <li><a href="home.php">Book A Ticket </a></li>
            <li>
                <form  method="POST">
                    <button name="logout" class="marginright btn indigo lighten-1" type="submit" >Log out</button>
                </form>
            </li>
        </ul>
    </nav>

    <div class="row margintop">
    <div class="col s1 m3 l4"></div>
    <form method="POST" class="col s10 m6 l4 card">
        <h5 class="center-align indigo-text"> Book A Ticket</h5>
      <div class="row ">
        <div class="input-field col s12">
          <input name="bookname"  id="bookname" type="text">
          <label for="bookname">Your Name</label>
          <?php if(isset( $booknameerr)){echo $booknameerr;} ?>
        </div>
        <div class="input-field col s12">
          <input name="number" id="Author" type="text">
          <label for="Author">Trans Number</label>
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
</body>
</html>