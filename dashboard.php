<?php
require_once("config.php");
session_start();
$user_id = $_SESSION['id'];
if($_SESSION['id'] === null){
    header("Location: index.php");
}

if(isset($_POST['logout'])){
    session_destroy();
    header("Location: index.php");
}
if(isset($_POST["fileToUpload"])) {
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image

  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
    $uploadOk = 0;
  }


// Check if file already exists
if (file_exists($target_file)) {
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {

// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    $id = $_GET['id'];
    $sql = "UPDATE `books` SET `image` = '$target_file' WHERE `books`.`id`='$id'";
    if(mysqli_query($conn , $sql)){
         header("Location: books.php");
    }  
  } else {
  }
}
}

if(isset($_POST['edit'])){
    $editid=$_GET['id'];
    $descript = $_POST['descript'];
   $sql = "UPDATE `books` SET `descript` = '$descript' WHERE `books`.`id`='$editid'";
   if(mysqli_query($conn , $sql)){
        header("Location: books.php");
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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

    <?php  if(isset($_POST['description'])){?>
        <div class="row margintop">
            <div class="col s1 m3 l4"></div>
                <form method="POST" class="col s10 m6 l4 card">
                    <h5 class="center-align indigo-text">Edit description</h5>
                <div class="row ">
                    <div class="input-field col s12">
                    <input name="descript"  id="descript" type="text" value="<?php echo $_POST['descript']; ?>">
                    <label for="descript">description</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s5"></div>
                    <div class="col s2">
                        <button name="edit" type="submit" class="btn indigo lighten-2">Edit description</button>
                    </div>
                    <div class="col s5"></div>
                </div>
                </form>
             <div class="col s1 m3 l4"></div>
        </div>
      <?php } ?>
<?php


$id = $_GET['id'];
$sql = "SELECT * FROM books WHERE `id` = '$id'";
$result = mysqli_query($conn , $sql);
while($row = mysqli_fetch_assoc($result)){?>

<div class="row margintop">
    <div class="col s1 l2 ">

    </div>
    <div class="col s10 l8 ">
    <div class="card row" style="padding: 40px;" >
        <div class="col s12 m5 l4 ">
            <?php if($row['image']) { ?>
                <img src="<?php echo $row['image']; ?>" style="width:100%" >
            <?php } else { ?> 
            <form method="POST" enctype="multipart/form-data">
                <div class="file-field input-field">
                <div class="btn">
                    <span>File</span>
                    <input type="file" name="fileToUpload">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
                </div>
            </form>
            <?php } ?>
        </div>
        <form method='POST' class="col m5 s12 l7 ">
         <p> Book name : <br> <?php echo $row['name']; ?></p>
         <p> Book Author : <br> <?php echo $row['author']; ?></p>
         <p> date of start reading : <br> <?php echo $row['date']; ?></p>
         <div class="row">
             <div class="col s10"> Description : <br> <?php echo $row['descript']; ?></div>
             <input type="hidden" name="descript" value="<?php echo $row['descript']; ?>">
             <button type='submit' name="description"  class="btn yellow darken-2 col s2 waves-effect waves-light">
                Edit 
            </button>
         </div>
        </form>
    </div>
    </div>
</div>

<?php }?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

</body>
</html>