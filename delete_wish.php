<?php
    include 'queries.php';
    $sql = "DELETE FROM wishlist WHERE id=".$_GET['id'];
    mysqli_query($conn,$sql);
    header('location: wish_list.php');