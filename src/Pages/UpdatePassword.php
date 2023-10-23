<?php
    session_start();
    if(!$_SESSION['user_id']){
        header("Location: /web-tour/src/Pages/login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/web-tour/src/Image/logo.png" type="image/png">
    <script src="/web-tour/src/Lib/tailwind.js"></script>
    <title>Thay đổi mật khẩu</title>
</head>
<body>
    <?php include "../Components/Header/Header.php"?>
    <div class="flex justify-center h-full my-5">
    <form action="../controllers/updatePass.php" class="flex flex-col py-10 px-5 border" method="post">
            <h1 class="uppercase font-bold text-2xl text-center my-5">Thay đổi mật khẩu</h1>
            <div class="relative mt-2">
                <label class="absolute left-2.5 top-1/2 transform -translate-y-1/2 text-gray-400 " for="oldPass"></label>
                <input name="oldPass" id="oldPass" class="border rounded p-2 my-2 focus:outline-none text-sm w-80" type="password" placeholder="Mật khẩu cũ" required>
            </div>
            <div class="relative mt-2">
                <label class="absolute left-2.5 top-1/2 transform -translate-y-1/2 text-gray-400 " for="newPass"></label>
                <input id="newPass" name="newPass" class="border rounded p-2 my-2 focus:outline-none text-sm w-80" type="password"placeholder="Mật khẩu mới" required>
            </div>
            <div class="relative mt-2">
                <label class="absolute left-2.5 top-1/2 transform -translate-y-1/2 text-gray-400 " for="newPass2"></label>
                <input id="newPass2" name="newPass2" class="border rounded p-2 my-2 focus:outline-none text-sm w-80" type="password" placeholder="Nhập lại mật khẩu mới" required>
            </div>
            <button type="submit" class="bg-sky-500 text-white font-bold uppercase p-2 rounded" id="btnSubmitForgot">Đặt lại mật khẩu mới</button>
            
    </form>
    </div>
    <?php include "../Components/Footer/Footer.php"?>
    
</body>
</html>