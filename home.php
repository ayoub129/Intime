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

 if(isset($_POST['AddBook'])){
    $name = $_POST['bookname'];
    $author = $_POST['Author'];
    $pages = $_POST['pages'];
    $date = $_POST['date'];
    $user_id = $_SESSION['id'];
    if($name == ''){
        $booknameerr = "<p class='red-text lighten-4'>Book name is required</p>";
    }
    if($author == ''){
        $Authorerr = "<p class='red-text lighten-4'>author is required</p>";
    }
   
    if( $booknameerr == null && $Authorerr == null){
        $sql = "INSERT INTO `books` (`user_id` , `name` , `author` , `pages` , `date`) Values ('$user_id' , '$name' , '$author' , '$pages' , '$date')";
        if(mysqli_query($conn , $sql)){
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
        <a href="books.php" class="brand-logo marginleft">my-Books</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            
            <li><a href="home.php">add book</a></li>
            <li><a href="books.php">Books</a></li>
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
        <h5 class="center-align indigo-text">New Book</h5>
      <div class="row ">
        <div class="input-field col s6">
          <input name="bookname"  id="bookname" type="text">
          <label for="bookname">Book Name</label>
          <?php if(isset( $booknameerr)){echo $booknameerr;} ?>
        </div>
        <div class="input-field col s6">
          <input name="Author" id="Author" type="text">
          <label for="Author">Author</label>
          <?php if(isset( $Authorerr)){echo $Authorerr;} ?>
        </div>
      </div>
     
      <div class="row">
        <div class="input-field col s12">
          <input name="pages" id="pages" type="number">
          <label for="pages">pages</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input name="date" id="date" type="date">
          <label for="date">date</label>
        </div>
      </div>
      <div class="row">
          <div class="col s5"></div>
          <div class="col s2">
              <button name="AddBook" type="submit" class="btn indigo lighten-2">Add Book</button>
          </div>
          <div class="col s5"></div>
      </div>
    </form>
    <div class="col s1 m3 l4"></div>
  </div>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>