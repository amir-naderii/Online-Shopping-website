<?php
session_start();
include "queries.php";
if (!isset($_SESSION['Username']) || !isset($_SESSION['Password'])) {
    session_unset();
    session_destroy();
    header("location: login.php");
}
$sql = "SELECT * FROM cart WHERE user_id =" . $_SESSION['id'];
$res = mysqli_query($conn, $sql);
$cart_list = [];
while ($row = mysqli_fetch_assoc($res)) {
    $cart_list[] = $row;
}
$cart_num = count($cart_list);
$sql = "SELECT * FROM wishlist WHERE user_id =" . $_SESSION['id'];
$res = mysqli_query($conn, $sql);
$wish_list = [];
while ($row = mysqli_fetch_assoc($res)) {
    $wish_list[] = $row;
}
$wish_num = count($wish_list);
$sql = 'SELECT * FROM items WHERE id = ' . $_GET['id'];
$res = mysqli_query($conn, $sql);
$theItem = mysqli_fetch_assoc($res);
$sql = 'SELECT * FROM categories WHERE id =' . $theItem['category_id'];
$res = mysqli_query($conn, $sql);
$cat = mysqli_fetch_assoc($res);
$sql = 'SELECT * FROM reviews WHERE item_id =' . $theItem['id'];
$res = mysqli_query($conn, $sql);
$reviews = [];
while ($row = mysqli_fetch_assoc($res)) {
    $reviews[] = $row;
}
if (isset($_POST['cart'])) {
    $sql = "INSERT INTO `cart`(`user_id`,`item_id`) 
        VALUES(" . $_SESSION['id'] . "," . $_GET['id'] . ")";
    $exec = mysqli_query($conn, $sql);
    if (!$exec) {
        $msg = mysqli_error($conn);
        echo $msg;
    }
    header('location: details.php?id=' . $_GET['id']);
}
if (isset($_POST["add_wish"])) {
    $sql = "INSERT INTO `wishlist`(`user_id`,`item_id`) 
        VALUES(" . $_SESSION['id'] . "," . $_POST['add_wish'] . ")";
    $exec = mysqli_query($conn, $sql);
    if (!$exec) {
        $msg = mysqli_error($conn);
        echo $msg;
    }
}
if (isset($_POST['review'])) {
    $sql = "INSERT INTO `reviews`(`user_id`,`item_id`,`comment`) 
        VALUES(" . $_SESSION['id'] . "," . $_GET['id'] . ",'" . $_POST['review'] . "')";
    $exec = mysqli_query($conn, $sql);
    if (!$exec) {
        $msg = mysqli_error($conn);
        echo $msg;
    }
    header('location: details.php?id=' . $_GET['id']);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Shop Item - Start Bootstrap Template</title>
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
    <!-- Product section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" <?php echo "src=" . $theItem['location'] ?> alt="..." /></div>
                <div class="col-md-6">
                    <div class="small mb-1"><?php echo $cat['title'] ?></div>
                    <h1 class="display-5 fw-bolder"><?php echo $theItem['title'] ?></h1>
                    <div class="fs-5 mb-5">
                        <span><?php echo $theItem['price'] . "$" ?></span>
                    </div>
                    <form <?php echo 'action="details.php?id=' . $_GET['id'] . '"' ?> method="post">
                        <div class="d-flex">
                            <?php
                            if ($theItem['stock'] == 0) {
                                echo '<p>sold out</p>';
                            } else {
                            ?>
                            <input name="cart" type="hidden" <?php echo 'value="' . $theItem['id'] . '"' ?>>
                            <button class="btn btn-outline-dark flex-shrink-0" type="submit">
                                <i class="bi-cart-fill me-1"></i>
                                Add to cart
                            </button>
                            <?php } ?>
                        </div>
                    </form>
                    <form <?php echo 'action="details.php?id=' . $_GET['id'] . '"' ?> method="post">
                        <div class="d-flex" style="margin-top:1rem;">
                            <input name="add_wish" type="hidden" <?php echo 'value="' . $theItem['id'] . '"' ?>>
                            <button class="btn btn-outline-dark flex-shrink-0" type="submit">
                                <i class="bi-heart me-1"></i>
                                Add to wish list
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <div class="form-group p-4 p-md-5 text-center text-lg-start shadow-1-strong rounded">
        <?php
        echo '<form action="details.php?id=' . $_GET['id'] . '" method="post"> 
                <label for="exampleFormControlTextarea1" style="margin-bottom:1rem;">Your Review</label>
                <textarea name="review" placeholder="leave a review" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                <button class="btn btn-outline-dark flex-shrink-0" type="submit" style="margin-top:2rem;">
                <i class="bi bi-chat"></i>
                    submit
                </button>
                </form>';
        ?>

    </div>
    <section class="p-4 p-md-5 text-center text-lg-start shadow-1-strong rounded" style="
                background-image: url(https://mdbcdn.b-cdn.net/img/Photos/Others/background2.webp);
            ">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <?php
                foreach ($reviews as $review) {

                    $sql = "SELECT * FROM user WHERE id = " . $review['user_id'];
                    $res = mysqli_query($conn, $sql);
                    $user = mysqli_fetch_assoc($res);
                    echo '<div class="card">
                                <div class="card-body m-3">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <p class="text-muted fw-light mb-4">
                                                ' . $review['comment'] . '
                                            </p>
                                            <p class="fw-bold lead mb-2"><strong>' . $user['username'] . '</strong></p>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                }
                ?>
            </div>
        </div>
    </section>
    <!-- Related items section-->
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