<?php
include "queries.php";
session_start();
    if(!isset($_SESSION['Username']) || !isset($_SESSION['Password'])){
        session_unset();
        session_destroy();
        header("location: login.php");
    }
    if(isset($_POST["add_cart"])){
        $sql = "INSERT INTO `cart`(`user_id`,`item_id`) 
        VALUES(".$_SESSION['id'].",".$_POST['add_cart'].")";
        $exec = mysqli_query($conn,$sql);
        if(!$exec){
            $msg = mysqli_error($conn);
            echo $msg;
        }
    }
    $sql = "SELECT * FROM cart WHERE user_id =".$_SESSION['id'];
    $res = mysqli_query($conn,$sql);
    $cart_list = [];
    while($row = mysqli_fetch_assoc($res)){
        $cart_list[] = $row;
    }
    $cart_num = count($cart_list);
    $sql = "SELECT * FROM wishlist WHERE user_id =".$_SESSION['id'];
    $res = mysqli_query($conn,$sql);
    $wish_list = [];
    while($row = mysqli_fetch_assoc($res)){
        $wish_list[] = $row;
    }
    $wish_num = count($wish_list);
    $sql = 'SELECT * FROM wishlist WHERE user_id ='. $_SESSION['id'];
    $res = mysqli_query($conn,$sql);
    $items_wish = [];
    while($row = mysqli_fetch_assoc($res)){
        $items_wish[] = $row;
    }

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
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark my-nav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="index.php">Start Bootstrap</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                </ul>
                <form class="d-flex">
                <a class="btn btn-outline-light" href="cart.php" type="submit" style="margin-right:1rem;">
                        <i class="bi-cart-fill me-1"></i>
                        Cart
                        <span class="badge bg-dark text-white ms-1 rounded-pill"><?php echo $cart_num ?></span>
                    </a>
                    <a class="btn btn-outline-light" href="wish_list.php" type="submit" style="margin-right:1rem;">
                        <i class="bi bi-heart me-1"></i>
                        Wishes
                        <span class="badge bg-dark text-white ms-1 rounded-pill"><?php echo $wish_num ?></span>
                    </a>
                    <a class="btn btn-outline-light" href="logout.php" style="margin-right:2px;">
                        <i class="bi bi-person-circle me-1"></i>
                        Logout
                    </a>
                </form>
            </div>
        </div>
    </nav>
    <section class="h-100 gradient-custom">
        <div class="container py-5">
            <div class="row d-flex justify-content-center my-4">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header py-3">
                            <h5 class="mb-0">wishes - <?php echo count($items_wish) ?> items</h5>
                        </div>
                        <div class="card-body">
                            <!-- Single item -->
                            <?php
                                foreach($items_wish as $its){
                                    $sql = "SELECT * FROM items WHERE id=".$its['item_id'];
                                    $res = mysqli_query($conn,$sql);
                                    $object = mysqli_fetch_assoc($res);
                                    echo '<div class="row">
                                        <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                                    <!-- Image -->
                                            <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                                            <img src="'.$object['location'].'" class="w-100" alt="pic" />
                                            <a href="#!">
                                                <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                                            </a>
                                            </div>
                                    <!-- Image -->
                                        </div>

                                        <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                                    <!-- Data -->
                                            <p><strong>'. $object['title'] .'</strong></p>
                                                <a href="delete_wish.php?id='.$its["id"].'" type="button" class="btn btn-primary btn-sm me-1 mb-2" data-mdb-toggle="tooltip" title="Remove item">
                                                <i class="bi bi-trash-fill"></i>
                                                </a>
                                                <form method="post" action="wish_list.php">
                                                <input type="hidden" value="'.$object["id"].'" name="add_cart">
                                                <button type="submit" class="btn btn-danger btn-sm mb-2" data-mdb-toggle="tooltip" title="Move to the cart">
                                                <i class="bi bi-cart-fill"></i>
                                                </button>
                                                </form> 
                                    <!-- Data -->
                                        </div>

                                        <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                                    <!-- Price -->
                                            <p class="text-start text-md-center">
                                            <strong>'.$object['price'].'$</strong>
                                            </p>
                                    <!-- Price -->
                                        </div>
                                    </div>
                                    <hr class="my-4" />';
                                }
                                ?>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="./js/scripts.js"></script>
</html>