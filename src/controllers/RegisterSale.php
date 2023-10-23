<?php
include '../config/connectDB.php';
$email = $_POST['email'];
$result_email = mysqli_query($conn, "SELECT * FROM email_sales where email_sale='$email'");
if (mysqli_num_rows($result_email)==0) {
    $sql = "INSERT INTO email_sales (email_sale) VALUES ('$email')";
    $result = mysqli_query($conn, $sql);
        echo "Success";
} else {
    echo "Email been used";
}
mysqli_close($conn);
