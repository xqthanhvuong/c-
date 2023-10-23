<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_POST['name']) && isset($_POST['emailRegister']) && isset($_POST['username']) && isset($_POST['password'])) {
    include "../config/connectDB.php";
    if ($_POST['username']) {
        $username = $_POST['username'];
        $sql = "SELECT * FROM users WHERE user_username = '$username'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $error = "Tên tài khoản đã tồn tại";
            echo "<script type='text/javascript'>alert('$error');</script>";
            echo "<script type='text/javascript'>window.location.href = '/web-tour/src/Pages/Register.php';</script>";
            exit();
        }
    }
    $name = $_POST['name'];
    $parts = explode(" ", $name);
    $last_name = array_pop($parts);
    $first_name = implode(" ", $parts);
    $emailRegister = $_POST['emailRegister'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (user_firstname, user_lastname, user_email, user_username, user_password, user_role) VALUES 
                ('$first_name', '$last_name', '$emailRegister', '$username', '$password', 'user')";
    if (mysqli_query($conn, $sql)) {
        echo "
            <script>
                alert('Bạn đã đăng ký thành công!!!');
                window.location.href = '/web-tour/src/Pages/Login.php';
            </script>";
    } else {
        $error = "Error: " . $sql . "<br>" . mysqli_error($conn);
        echo $error;
    }
    mysqli_close($conn);
} else {
    $error = "Vui lòng nhập đầy đủ thông tin!";
    echo "<script type='text/javascript'>alert('$error');</script>";
}
