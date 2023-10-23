<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="/web-tour/src/Image/logo.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/web-tour/src/Lib/tailwind.js"></script>
    <title>Quên mật khẩu</title>
</head>
<body>
    <?php include "../Components/Header/Header.php"?>
    
    <div class="flex justify-center h-full my-5">
    <form action="../controllers/forgotPass.php" class="flex flex-col py-10 px-5 border" method="post">
            <h1 class="uppercase font-bold text-2xl text-center my-5">Quên mật khẩu</h1>
            <div class="relative mt-2">
                <label class="absolute left-2.5 top-1/2 transform -translate-y-1/2 text-gray-400 " for="username"></label>
                <input id="username" name="username" class="border rounded p-2 my-2 focus:outline-none text-sm w-80" type="text" placeholder="Tài khoản đã đăng ký" required>
            </div>
            <div class="relative mt-2 mb-2">
                <label class="absolute left-2.5 top-1/2 transform -translate-y-1/2 text-gray-400 " for="emailForgot"></label>
                <input id="emailForgot" name="emailForgot" class="border rounded p-2 my-2 focus:outline-none text-sm w-80" type="email"placeholder="Nhập email của bạn" required>
            </div>
            <button type="submit" class="bg-sky-500 text-white font-bold uppercase p-2 rounded" id="btnSubmitForgot">Gửi</button>
    </form>
    </div>
    <?php include "../Components/Footer/Footer.php"?>
    
</body>
</html>