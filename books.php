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

$id = $_GET['id'];
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
        <div class="col s1  "></div>
        <div class="col s10  ">
            <table class="centered responsive-table bg-primary white-text highlight striped">
                <thead>
                    <tr>
                        <th>Number</th>
                        <th>size</th>
                        <th>place</th>
                        <th>expected time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php    
                    $sql = "SELECT * FROM books WHERE `number` = '$id'";
                    $result = mysqli_query($conn , $sql);
                    while($row = mysqli_fetch_assoc($result)){
                        $num = $row['number'];
                        $sql2 = "SELECT * FROM transport WHERE `number` = '$num'";
                        $result2 = mysqli_query($conn , $sql2);
                        while($row2 = mysqli_fetch_assoc($result2)){
                        ?>
                                <tr>
                                    <td><?php echo $row['number']; ?></td>
                                    <td><?php echo $row2['size']; ?></td>
                                    <td><?php echo $row['place']; ?></td>
                                    <td>
                                        <?php 
                                         $sql3 = "SELECT * FROM places WHERE `number_trans` = '$num'";
                                         $result3 = mysqli_query($conn , $sql3);
                                         while($row3 = mysqli_fetch_assoc($result3)){ 
                                            $time_start = $row3['time'];
                                            $place = $row['place'];
                                            if($place == 1) {
                                                $endTime = strtotime("+15 minutes", strtotime($time_start));
                                                echo date('h:i:s', $endTime);
                                            } else if ($place == 2) {
                                                $endTime = strtotime("+30 minutes", strtotime($time_start));
                                                echo date('h:i:s', $endTime);
                                            } else {
                                                $endTime = strtotime("+45 minutes", strtotime($time_start));
                                                echo date('h:i:s', $endTime);
                                            }
                                         }
                                        ?>
                                    </td>
                                    <td>
                                       <div >
                                            <a href="paper.php?id=<?php echo $row['id']; ?>" class="btn bg-secondary darken-1">print</a>
                                        </div>
                                    </td>
                                </tr>
            
                    <?php  } }?>
                </tbody>
            </table>

          
           
        </div>
        <div class="col s1 "></div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

</body>
</html>