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
    $sql = "DELETE FROM `transport`  WHERE `number`= '$idtodelete'";
    $sql = "DELETE FROM `places`  WHERE `number_trans`= '$idtodelete'";
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
        <a href="dashboard.php" class="brand-logo marginleft">Trans</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            
            <li><a href="transport.php">Add Trans </a></li>
            <li>
                <form  method="POST">
                    <button name="logout" class="marginright btn indigo lighten-1" type="submit" >Log out</button>
                </form>
            </li>
        </ul>
    </nav>
    <div class="row margintop">
    </div>
    <div class="row margintop">
        <div class="col s1  "></div>
        <div class="col s10  ">
            <table class="centered responsive-table highlight striped">
                <thead>
                    <tr>
                        <th>Number</th>
                        <th>Maximum</th>
                        <th>place</th>
                        <th>Size</th>
                        <th>status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php    
                    $sql = "SELECT * FROM transport ";
                    $result = mysqli_query($conn , $sql);
                    while($row = mysqli_fetch_assoc($result)){
                        $id2 = $row['number'];
                        $sql2 = "SELECT * FROM places WHERE `number_trans` = $id2";
                        $result2 = mysqli_query($conn , $sql2);
                        while($row2 = mysqli_fetch_assoc($result2)){
                        ?>
                                <tr>
                                    <td><?php echo $row['number']; ?></td>
                                    <td><?php echo $row['max']; ?></td>
                                    <td><?php echo $row2['place']; ?></td>
                                    <td><?php echo $row['size']; ?></td>
                                    <td><?php
                                     if($row['size'] == $row['max']){ echo " <button  class='btn green darken-2  waves-effect waves-light'>Plan </button>";}
                                       else if ($row['size'] < $row['max']){ echo " <button  class='btn yellow darken-2  waves-effect waves-light'>Still </button>";}
                                        else {echo " <button  class='btn red darken-2  waves-effect waves-light'>something wrong</button>";}
                                     ?></td>
                                    <td>
                                        <form method="POST">
                                            <input type="hidden" name="id" value="<?php echo $row['number']; ?>">
                                            <button type='submit' name="deletBook" class="btn red darken-1">Delete</button>
                                        </form>
                                    </td>
                                </tr>
            
                    <?php } }?>
                </tbody>
            </table>

          
           
        </div>
        <div class="col s1 "></div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>