<?php
    session_start();
    include "../config/connectDB.php";
    if (isset($_GET['action'])) {
        if ($_GET['action'] == "remove") {
            $cart_id = $_GET['id'];
            $user_id = $_SESSION['user_id'];
            $delete = "DELETE FROM cart WHERE  $cart_id =cart_id and  user_id = $user_id ";
            $delete_run = mysqli_query($conn, $delete);
        }
        header("Location: /web-tour/src/Pages/cart.php");
    }
    ?>