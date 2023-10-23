<?php
session_start();
include "../config/connectDB.php";
if(isset($_GET['q'])){
    $tourid=$_GET['q'];
    mysqli_query($conn,"DELETE FROM comments where tour_id=".$tourid);
    mysqli_query($conn,"DELETE FROM detail__orders where tour_id=".$tourid);
    $sql="SELECT * FROM tour_images where tour_id=$tourid";
    $rs=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($rs)){
        $image=$row['tour_image'];
        if (file_exists($image)) {
            unlink($image);
        }
    }
    mysqli_query($conn,"DELETE FROM tour_images where tour_id=".$tourid);
    mysqli_query($conn,"DELETE FROM transportation where tour_id=".$tourid);
    mysqli_query($conn,"DELETE FROM tours where tour_id=".$tourid);
    header('location: '.$_SERVER['HTTP_REFERER']);
}
else {
    echo '    <script>
    alert("Có lỗi xảy ra");
    </script>
    <script>window.location.href = document.referrer;</script>';
}

?>