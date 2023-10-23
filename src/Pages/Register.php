<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/web-tour/src/Lib/tailwind.js"></script>
    <link rel="icon" href="/web-tour/src/Image/logo.png" type="image/png">
    <title>Đăng ký</title>
    <style>

        @keyframes sliderIn {
            0% {
                top: 50%;
            }

            100% {
                top: 0px;
            }
        }

        .animationIn {
            animation: sliderIn 0.5s ease-in-out;
            animation-fill-mode: forwards;
        }

        @keyframes sliderOut {
            0% {
                top: -0.5px;
            }

            100% {
                top: 50%;
            }
        }

        .animationOut {
            animation: sliderOut 0.5s ease-in-out;
            animation-fill-mode: forwards;
        }
    </style>
</head>

<body>
    <?php include "../Components/Header/Header.php" ?>

    <div class="flex justify-center h-full my-5">
        <form onsubmit="submit()" action="../controllers/register.php" class="flex flex-col py-10 px-5 border" method="post">
            <h1 class="uppercase font-bold text-2xl text-center my-5">Đăng ký tài khoản</h1>
            <div class="relative my-1">
                <input type="text" name="name" id="name" value="" class="border p-2 my-2 focus:outline-none text-sm w-80 " required>
                <label for="username" class="absolute left-2.5 top-1/2 transform -translate-y-1/2 text-gray-400 " id="labelName">Họ và tên</label>
            </div>
            <div class="relative my-1">
                <input type="email" name="emailRegister" id="emailRegister" value="" class="border p-2 my-2 focus:outline-none text-sm w-80" required>
                <label for="emailRegister" class="absolute left-2.5 top-1/2 transform -translate-y-1/2 text-gray-400 " id="labelEmail">Email</label>
            </div>
            <div class="relative my-1">
                <input type="text" name="username" id="username" value="" class="border p-2 my-2 focus:outline-none text-sm w-80" name="username" required>
                <label for="username" class="absolute left-2.5 top-1/2 transform -translate-y-1/2 text-gray-400 " id="labelUsername">Tên tài khoản</label>
            </div>
            <div class="relative my-1">
                <input type="password" name="password" id="password" value="" class="border p-2 my-2 focus:outline-none text-sm w-80" name="password" required>
                <label for="password" class="absolute left-2.5 top-1/2 transform -translate-y-1/2 text-gray-400 " id="labelPassword">Mật khẩu</label>
            </div>
            <button type="submit" class="bg-sky-500 text-white font-bold uppercase p-2 rounded mt-2 " id="btnSubmitRegister">Đăng
                ký</button>
            <h2 class="text-sm text-gray-500 text-center mt-3">Đã có tài khoản đăng nhập tại đây <a href="/web-tour/src/Pages/Login.php" class="text-sky-500">tại đây</a></h2>
        </form>
    </div>
    <?php include "../Components/Footer/Footer.php" ?>
    <script>
        const name = document.getElementById('name');
        const emailRegister = document.getElementById('emailRegister');
        const username = document.getElementById('username');
        const password = document.getElementById('password');
        const labelForName = document.getElementById('labelName');
        const labelForEmail = document.getElementById('labelEmail');
        const labelForUsername = document.getElementById('labelUsername');
        const labelForPassword = document.getElementById('labelPassword');

        if (name.value !== '') {
            labelForName.classList.add('animationIn');
        }
        if (emailRegister.value !== '') {
            labelForEmail.classList.add('animationIn');
        }
        if (username.value !== '') {
            labelForUsername.classList.add('animationIn');
        }
        if (password.value !== '') {
            labelForPassword.classList.add('animationIn');
        }
        //animation for input name
        name.addEventListener('focus', () => {
            labelForName.classList.remove('animationOut');
            labelForName.classList.add('animationIn');
        });
        name.addEventListener('focusout', () => {
            labelForName.classList.remove('animationIn');
            labelForName.classList.add('animationOut');
            if (name.value !== '') {
                labelForName.classList.add('animationIn');
                labelForName.classList.remove('animationOut');
            }
        });
        //animation for input emailRegister
        emailRegister.addEventListener('focus', () => {
            labelForEmail.classList.remove('animationOut');
            labelForEmail.classList.add('animationIn');

        });
        emailRegister.addEventListener('focusout', () => {
            labelForEmail.classList.remove('animationIn');
            labelForEmail.classList.add('animationOut');
            if (emailRegister.value !== '') {
                labelForEmail.classList.remove('animationOut');
                labelForEmail.classList.add('animationIn');
            }
        });
        //animation for input username
        username.addEventListener('focus', () => {
            labelForUsername.classList.remove('animationOut');
            labelForUsername.classList.add('animationIn');
        });
        username.addEventListener('focusout', () => {
            labelForUsername.classList.remove('animationIn');
            labelForUsername.classList.add('animationOut');
            if (username.value !== '') {
                labelForUsername.classList.remove('animationOut');
                labelForUsername.classList.add('animationIn');
            }
        });
        //animation for input password
        password.addEventListener('focus', () => {
            labelForPassword.classList.remove('animationOut');
            labelForPassword.classList.add('animationIn');
        });
        password.addEventListener('focusout', () => {
            labelForPassword.classList.remove('animationIn');
            labelForPassword.classList.add('animationOut');
            if (password.value !== '') {
                labelForPassword.classList.remove('animationOut');
                labelForPassword.classList.add('animationIn');
            }
        });

        window.onload = function() {
            if (name.value !== '') {
                labelForName.classList.add('animationIn');
                labelForName.classList.remove('animationOut')
            }
            if (emailRegister.value !== '') {
                labelForEmail.classList.add('animationIn');
                labelForEmail.classList.remove('animationOut')
            }
            if (username.value !== '') {
                labelForUsername.classList.add('animationIn');
                labelForUsername.classList.remove('animationOut')
            }
            if (password.value !== '') {
                labelForPassword.classList.add('animationIn');
                labelForPassword.classList.remove('animationOut')
            }
        }
        
    </script>
</body>

</html>