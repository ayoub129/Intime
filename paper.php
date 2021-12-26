<?php 
 require_once('config.php');
 ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link rel="stylesheet" href="css/style.css">
        <title>Print page</title>
    </head>
    <body >
        <?php 
        $sql = "SELECT * FROM books ORDER BY id DESC LIMIT 0,1";
        $result = mysqli_query($conn , $sql);
         while ($row = mysqli_fetch_assoc($result) ) { ?>
        
        <div class="row" >
            <div class="col s6">
            <div class="card blue-grey darken-1">
                <div class="card-content white-text">
                <span class="card-title"> Transport Number : <?php echo $row['number'] ?></span>
                <p class="mt-3"> Place You Book The Trans: <?php echo $row['place'] ?></p>
                <div >
                <?php 
                    $num = $row['number'];
                    $sql3 = "SELECT * FROM places WHERE `number_trans` = '$num'";
                    $result3 = mysqli_query($conn , $sql3);
                    while($row3 = mysqli_fetch_assoc($result3)){ 
                        $sql2 = "SELECT * FROM transport WHERE `number` = '$num'";
                        $result2 = mysqli_query($conn , $sql2);
                        while($row2 = mysqli_fetch_assoc($result2)){ 
                            $size = $row2['size'];
                            echo "<p class='mt-3'> Place : " . $size . "</p> ";
                            $time_start = $row3['time'];
                            $place = $row['place'];
                            if($place == 1) {
                                $endTime = strtotime("+15 minutes", strtotime($time_start));
                                  echo  "<p class='mt-3'> Expected Time : " .date('h:i:s', $endTime) . "</p> ";
                                } else if ($place == 2) {
                                    $endTime = strtotime("+30 minutes", strtotime($time_start));
                                    echo  "<p class='mt-3'> Expected Time : " .date('h:i:s', $endTime) . "</p> ";
                                } else {
                                    $endTime = strtotime("+45 minutes", strtotime($time_start));
                                    echo  "<p class='mt-3'> Expected Time : " .date('h:i:s', $endTime) . "</p> ";
                                }
                        }
                    }?>
                </div>
                </div>
                <div class="card-action">
                    <a href="#">Price : </a>
                    <a href="#">3.50 DH</a>
                </div>
               
            </div>
            </div>
        </div>
    <?php }?>

    <script>
        window.onload(
            window.print()
        )
    </script>
</body>
</html>