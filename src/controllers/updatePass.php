<?php
    session_start();
    if(!$_SESSION['user_id']){
        header("Location: /web-tour/src/Pages/login.php");
    }

    if($_POST["oldPass"] && $_POST["newPass"] && $_POST["newPass2"]) {
        $id = $_SESSION['user_id'];
        $newPass = $_POST["newPass"];
        $newPass2 = $_POST["newPass2"];
        if($newPass != $newPass2){
            echo "<script>alert('Mật khẩu mới không trùng nhau')</script>";
            exit();
        } 
        include "../config/connectDB.php";
        $oldPass = $_POST["oldPass"];
        $sql = "SELECT user_password FROM users WHERE user_id = $id";
        $result = mysqli_query($conn, $sql);
        if(password_verify($oldPass, mysqli_fetch_assoc($result)['user_password'])){
            $newPass = password_hash($newPass, PASSWORD_DEFAULT);
            $sqlUpdatePass = "update users set user_password = '$newPass' where user_id = '$id'";
            if(mysqli_query($conn, $sql)){
                echo "<script>alert('Đổi mật khẩu thành công')</script>";
                header("Location: /web-tour/index.php");
            } else {
                echo "<script>alert('Đổi mật khẩu thất bại')</script>";
                header("Location: /web-tour/src/Pages/UpdatePassword.php");
            }
        } else {
            echo "<script>alert('Mật khẩu cũ không đúng')</script>";
            header("Location: /web-tour/src/Pages/UpdatePassword.php");
        }
    }
?>