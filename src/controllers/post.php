<?php
header("Content-type: application/json");
if (isset($_POST['sqlTours']) && isset($_POST['sqlImage'])) {
    $sqlTour = $_POST['sqlTours'];
    $sqlImage = $_POST['sqlImage'];
    $sqlTrans = $_POST['sqlTrans'];
    include '../config/connectDB.php';
    try {
        $result = mysqli_query($conn, $sqlTour);
        $resultImage = mysqli_query($conn, $sqlImage);
        $resultTrans = mysqli_query($conn, $sqlTrans);
        echo $status = 200;
    } catch (\Throwable $th) {
        // echo $status = 500;
        echo $th;
    }
} else {
    $response = array("success" => false, "message" => "No data");
    echo json_encode($response);
}
