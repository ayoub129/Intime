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


if(isset($_POST['deletBook'])){
    $idtodelete = $_POST["id"];
    $time =  date("h:i:s");
    $sql2 = "UPDATE `places` SET `time` = '$time' WHERE `places`.`number_trans` = '$idtodelete'";
   mysqli_query($conn , $sql2); 
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
        <a href="dashboard.php" class="brand-logo marginleft">InTime</a>
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
    </div>
    <div class="row margintop">
        <div class="col s1  "></div>
        <div class="col s10  ">
            <table class="centered responsive-table highlight striped indigo  white-text">
                <thead>
                    <tr>
                        <th>Number</th>
                        <th>Maximum</th>
                        <th>Size</th>
                        <th>Action</th>
                        <th>status</th>
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
                                    <td><?php echo $row['size']; ?></td>
                                   
                                    <td>
                                        <form method="POST" >
                                            <input type="hidden" name="id" value="<?php echo $row['number']; ?>">
                                            <button type='submit' name="deletBook" class="btn send waves-effect waves-light red darken-1" >
                                                send 
                                            </button>
                                        </form>
                                    </td>
                                            <td><?php
                                             if($row['size'] == $row['max']){ echo " <button  class='btn blue darken-2  waves-effect waves-light'>Full </button>";}
                                             else if ($row['size'] < $row['max']){ echo " <button  class='btn green darken-2  waves-effect waves-light'>Still Places </button>";}
                                             else {echo " <button  class='btn red darken-2  waves-effect waves-light'>something wrong</button>";}
                                             ?>
                                             </td>
                                </tr>
                    <?php } }?>
                </tbody>
            </table>

          
           
        </div>
        <div class="col s1 "></div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>