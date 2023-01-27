<?php
include "queries.php";
session_start();
if(!isset($_SESSION['Username']) || !isset($_SESSION['Password'])){
    session_unset();
    session_destroy();
    header("location: login.php");
}
$sql = "SELECT * FROM cart WHERE user_id=".$_SESSION['id'];
$res = mysqli_query($conn,$sql);
$objects = [];
while($row = mysqli_fetch_assoc($res)){
    $objects[] = $row;
}
$sql = "DELETE FROM cart WHERE user_id=".$_SESSION['id'];
$res = mysqli_query($conn,$sql);
$sum = $_POST['sum'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>
    
</body>
</html>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark my-nav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="index.php">Start Bootstrap</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                </ul>
                <form class="d-flex">
                    <a class="btn btn-outline-light" href="logout.php" style="margin-right:2px;">
                        <i class="bi bi-person-circle me-1"></i>
                        Logout
                    </a>
                </form>
            </div>
        </div>
    </nav>
<div class="card">
  <div class="card-body mx-4">
    <div class="container">
      <p class="my-5 mx-5" style="font-size: 30px;">Thanks for your purchase</p>
      <div class="row">
        <ul class="list-unstyled">
          <li class="text-black"><?php echo $_SESSION['Username']?></li>
          <li class="text-muted mt-1"><span class="text-black">Invoice</span></li>
          <li class="text-black mt-1"><?php
            $date = date('d-m-20y');
            echo $date;
          ?></li>
        </ul>
        <?php
        foreach($objects as $value){
            $sql = "SELECT * FROM items WHERE id =".$value['item_id'];
            $res = mysqli_query($conn,$sql);
            $it = mysqli_fetch_assoc($res);
            echo '<hr>
                <div class="col-xl-10">
                    <p>'.$it["title"].'</p>
                </div>
                <div class="col-xl-8">
                    <p>'.$value['num'].'x</p>
                </div>
                <div class="col-xl-2">
                    <p class="float-end">'.$it["price"].'$</p>
                </div>';    
        }
        ?>
      </div> 
      <div class="row text-black">
      <hr style="border: 2px solid black;">
        <div class="col-xl-12">
          <p class="float-end fw-bold">Total: <?php echo $sum?>
          </p>
        </div>
        <hr style="border: 2px solid black;">
      </div>
      <div class="text-center" style="margin-top: 90px;">
        <a><u class="text-info">View in browser</u></a>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>
      </div>

    </div>
  </div>
</div>