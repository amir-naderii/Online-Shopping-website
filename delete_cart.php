<?php
    include 'queries.php';
    $sql = "DELETE FROM cart WHERE id=".$_GET['id'];
    mysqli_query($conn,$sql);
    header('location: cart.php');