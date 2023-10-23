<?php
session_start();
include '../config/connectDB.php';

if (isset($_POST['booktour'])) {
    $userid = $_SESSION['user_id'];
    $tour_id = $_POST['idtour'];
    $cart_quantity = $_POST['quantity'];
    $cartdate = $_POST['date'];
    if (isset($_SESSION['username'])) {
        $sql="SELECT * from cart where user_id=$userid and tour_id=$tour_id and date_start='$cartdate'";
        $rs=mysqli_query($conn,$sql);
        if($row=mysqli_fetch_assoc($rs)){
            $cart_quantity=$row['cart_quantity']+$cart_quantity;
            $insert=mysqli_query($conn,"UPDATE cart SET cart_quantity =$cart_quantity where user_id=$userid and tour_id=$tour_id and date_start='$cartdate'");
        } else {
            $insert = mysqli_query($conn, "INSERT INTO cart ( user_id,tour_id,cart_quantity,date_start) VALUE
            ($userid,$tour_id,$cart_quantity,'$cartdate');");
        }
        header('location: /web-tour/src/Pages/cart.php');
    } else
        header('Location: ../pages/login.php');
}
mysqli_close($conn);