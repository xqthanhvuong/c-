<?php
include "mail/PHPMailer/src/PHPMailer.php";
include "mail/PHPMailer/src/Exception.php";
include "mail/PHPMailer/src/OAuth.php";
include "mail/PHPMailer/src/POP3.php";
include "mail/PHPMailer/src/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: /web-tour/index.php");
}
if (isset($_POST['username']) && isset($_POST['emailForgot'])) {
    include "../config/connectDB.php";
    $username = $_POST['username'];
    $email = $_POST['emailForgot'];
    $check_user = "SELECT * from users where user_username = '$username' and user_email = '$email'";
    $check_user_result = mysqli_query($conn, $check_user);
    if (mysqli_num_rows($check_user_result) == 0) {
        echo "<script>alert('Sai thông tin')</script>";
        echo "<script>window.location.href = '/web-tour/src/Pages/ForgotPassword.php'</script>";
    } else {
        $row = mysqli_fetch_assoc($check_user_result);
        $user_id = $row['user_id'];
        $user_username = $row['user_username'];
        $user_email = $row['user_email'];
        $pass = rand(100000, 999999);
        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
        //Server settings
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'epicescapesnews@gmail.com';                 // SMTP username
        $mail->Password = 'zrtoehywklazjaui';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to
    
        //Recipients
        $mail->setFrom('epicescapesnews@gmail.com', 'Epic Escapes');
        $mail->addAddress($user_email, $user_username);     // Add a recipient
        $mail->isHTML(true); 
        $subject = "Cấp lại mật khẩu";
        $mail->Subject = "=?UTF-8?B?" . base64_encode($subject) . "?=";
        $mail->Body    = "Xin chào $user_username, mật khẩu mới của bạn là: <bold>$pass</bold>. \n Vui lòng đăng nhập và đổi mật khẩu mới để đảm bảo an toàn tài khoản!";
    
    
        $mail->send();
        $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
        $update_pass = "UPDATE users SET user_password = '$pass_hash' WHERE user_id = $user_id";
        mysqli_query($conn, $update_pass);
        echo "<script>alert('Mật khẩu mới đã được gửi về email của bạn')</script>";
        echo "<script>window.location.href = '/web-tour/src/Pages/Login.php'</script>";
            
        } catch (Exception $e) {
            echo "<script>alert('Gửi email không thành công')</script>";
            echo "<script>window.location.href = '/web-tour/src/Pages/ForgotPassword.php'</script>";
        }

    }
    mysqli_close($conn);
}
