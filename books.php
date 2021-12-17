<?php   
require_once('config.php');
session_start();
$user_id = $_SESSION['id'];
if($_SESSION['id'] === null){
    header("Location: index.php");
}

if(isset($_POST['logout'])){
    session_destroy();
    header("Location: index.php");
}

 if(isset($_POST['edit'])){
     $editid=$_POST['editid'];
     $read = $_POST['read'];
    $sql = "UPDATE `books` SET `reading` = '$read' WHERE `books`.`id`='$editid'";
    if(mysqli_query($conn , $sql)){
        header("Location: books.php");
    }
}

if(isset($_POST['deletBook'])){
    $idtodelete = $_POST["id"];
    $sql = "DELETE FROM `books`  WHERE `id`= '$idtodelete'";
    $result = mysqli_query($conn , $sql);

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
    <?php  if(isset($_POST['editBook'])){?>
        <div class="col s1 m3 l4"></div>
            <form method="POST" class="col s10 m6 l4 card">
                <h5 class="center-align indigo-text">Edit Book</h5>
            <div class="row ">
                <div class="input-field col s12">
                <input name="read"  id="read" type="number" value="<?php echo $_POST['name']; ?>">
                <input name="editid"  id="editid" type="hidden" value="<?php echo $_POST['id']; ?>">
                <label for="read">reading</label>
                </div>
            </div>
            <div class="row">
                <div class="col s5"></div>
                <div class="col s2">
                    <button name="edit" type="submit" class="btn indigo lighten-2">Edit Book</button>
                </div>
                <div class="col s5"></div>
            </div>
            </form>
         <div class="col s1 m3 l4"></div>
      <?php } ?>
    </div>
    <div class="row margintop">
        <div class="col s1  "></div>
        <div class="col s10  ">
            <table class="centered responsive-table highlight striped">
                <thead>
                    <tr>
                        <th>name</th>
                        <th>author</th>
                        <th>page</th>
                        <th>date</th>
                        <th>reading</th>
                        <th>status</th>
                        <th>actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php    
                    $sql = "SELECT * FROM books WHERE `user_id` = '$user_id'";
                    $result = mysqli_query($conn , $sql);
                    while($row = mysqli_fetch_assoc($result)){?>
                                <tr>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['author']; ?></td>
                                    <td><?php echo $row['pages']; ?></td>
                                    <td><?php echo $row['date']; ?></td>
                                    <td><?php echo $row['reading']; ?></td>
                                    <td><?php
                                     if($row['reading'] == $row['pages']){ echo " <button  class='btn green darken-2  waves-effect waves-light'>Finished </button>";}
                                       else if ($row['reading'] < $row['pages']){ echo " <button  class='btn yellow darken-2  waves-effect waves-light'>reading </button>";}
                                        else {echo " <button  class='btn red darken-2  waves-effect waves-light'>something wrong</button>";}
                                     ?></td>
                                    <td>
                                        <form method="POST">
                                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                            <input type="hidden" name="name" value="<?php echo $row['reading']; ?>">
                                            <button type='submit' name="editBook" class="btn yellow darken-2  waves-effect waves-light">
                                                    Edit
                                            </button>
                                            <button type='submit' name="deletBook" class="btn red darken-1">Delete</button>
                                            <button class="btn white darken-1">
                                                <a href="dashboard.php?id=<?php echo $row['id']; ?>">
                                                    more
                                                </a>
                                         </button>
                                        </form>
                                    </td>
                                </tr>
            
                    <?php  } ?>
                </tbody>
            </table>

          
           
        </div>
        <div class="col s1 "></div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>