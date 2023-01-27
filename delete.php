<?php
error_reporting(0);

$msg = "";

include 'queries.php';

if(isset($_GET['item_del'])){
    $sql = "DELETE FROM items WHERE id=".$_GET['delete'];
    $res = mysqli_query($conn,$sql);
    header('location: dashboard.php');
}elseif(isset($_GET['cat_del'])){
    $sql = "DELETE FROM categories WHERE id=".$_GET['delete'];
    $res = mysqli_query($conn,$sql);
    header('location: dashboard.php');
}

?>
