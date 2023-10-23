<?php
    $tours = $_POST['sql'];
    include "../config/connectDB.php";
    $tour_image = "SELECT tour_image_id, tour_id, tour_image FROM tour_images";
    $result_tours = mysqli_query($conn, $tours);
    $result_tour_image = mysqli_query($conn, $tour_image);
    $tour_image = array();
    if (mysqli_num_rows($result_tour_image) > 0) {
        while($row = mysqli_fetch_assoc($result_tour_image)) {
            $tour_image[$row['tour_id']] = $row['tour_image'];
        }
    };
    $result = array();
    if (mysqli_num_rows($result_tours) > 0) {
        while($row = mysqli_fetch_assoc($result_tours)) {
            $transport = array("train", "plane");
            if (array_key_exists($row['tour_id'], $tour_image)) {
                $image = $tour_image[$row['tour_id']];
            } else {
                $image = $transport[rand(0, 1)];
            }
            $title = $row['tour_title'];
            $price = $row['tour_price'];
            $sale = $row['tour_discount_rate'];
            $id = $row['tour_id'];
            $result[] = array(
                'image' => $image,
                'title' => $title,
                'price' => $price,
                'sale' => $sale,
                'id' => $id
            );
        }
    };
    header('Content-Type: application/json');
    echo json_encode($result);
?>