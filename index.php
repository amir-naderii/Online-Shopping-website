<?php
    include "queries.php";
    session_start();
    if(!isset($_SESSION['Username']) || !isset($_SESSION['Password'])){
        session_unset();
        session_destroy();
        header("location: login.php");
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
    $filter = [];
    foreach($categories as $cat){
        if(isset($_POST[$cat['id']])){
            $filter[] = $cat["id"];
        }
    }
    if($_POST["min"] != $_POST["max"]){
        if(empty($filter)){
            $sql = "SELECT * FROM items WHERE price BETWEEN ".$_POST["min"]." AND
             ".$_POST["max"];
        }
        else{
            $ids = join("','",$filter); 
            $sql = "SELECT * FROM items WHERE price BETWEEN ".$_POST["min"]." AND 
            ".$_POST["max"]." AND category_id IN ('$ids')";
        }
    }else{
        if(!empty($filter)){
            $ids = join("','",$filter); 
            $sql = "SELECT * FROM items WHERE category_id IN ($ids)";
        }
        else{
            $sql = "SELECT * FROM items";
        }
    }
    if(isset($_POST['search'])){
        $sql = "SELECT * FROM items WHERE title LIKE '%".$_POST['search']."%'";
    }
    $res = mysqli_query($conn,$sql);
    $item1 = [];
    while($row = mysqli_fetch_assoc($res)){;
        $item1[] = $row;
    }
    unset($_POST); 

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Shop Homepage - Start Bootstrap Template</title>
    <!-- Favicon-->
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
    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Shop in style</h1>
                <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage website</p>
            </div>
        </div>
    </header>
    <!-- Section-->
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <?php include "sidebar.php";
            ?>
            <section class="py-5 col">
                <form method="post" action="index.php">
                    <div class="input-group justify-content-end">
                            <div class="form-outline">
                                <input name="search" type="search" id="form1" class="form-control" placeholder="Search" />
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-search"></i>
                            </button>
                    </div>
                </form>
                    <div class="container px-4 px-lg-5 mt-5">
                        <div class="grided-items">
                            <?php
                            foreach($item1 as $item){
                                echo '<div class="col mb-5">
                                        <div class="card h-100 shadowy">
                                            <!-- Product image-->
                                            <img class="card-img-top" src="'.$item["location"].'" alt="..." />
                                            <!-- Product details-->
                                            <div class="card-body p-4">
                                                <div class="text-center">
                                                    <!-- Product name-->
                                                    <h5 class="fw-bolder">'.$item["title"].'</h5>
                                                    <!-- Product price-->
                                                    $'.$item["price"].'
                                                </div>
                                            </div>
                                            <!-- Product actions-->
                                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                                <div class="text-center">
                                                    <form method="get" action="details.php">
                                                        <button class="btn btn-outline-dark mt-auto" href="#">details</button>
                                                        <input name="id" type="hidden" value='.$item["id"].'>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                            }
                            ?>
                        </div>
                    </div>
            </section>
        </div>
    </div>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>