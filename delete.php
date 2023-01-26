<?php
error_reporting(0);

$msg = "";

$conn = new mysqli('127.0.0.1', 'admin', 'admin', 'storedb');
if ($conn->connect_error) {
    die('connection failed: ' . $conn->connect_error);
}

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
