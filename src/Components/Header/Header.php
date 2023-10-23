<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['user_id'])) {
    $role = $_SESSION['role'];
    $status_login = true;
} else {
    $status_login = false;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- tailwindcss -->
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <script src="../../Lib/tailwind.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .body {
            background-color: #f2f2f2;
        }

        .header__header {
            background-color: #154054;
            height: 110px;
        }

        /* Search, Logo */
        .header__box {
            display: flex;
            justify-content: space-around;
            align-items: center;
            height: 66%;
            border-bottom: 1px solid #9CCFF4;
        }

        .header__logo {
            margin-left: 20px;
        }

        .header__logo img {
            width: 165px;
            height: 70px;
        }

        .header__search {
            display: flex;
            justify-content: space-around;
            align-items: center;
            height: 40%;
            /* border-bottom: 1px solid #fff; */
        }

        .header__input_search {
            width: 515px;
            padding: 5.5px 5.5px 5.5px 15px;
        }

        .header__icon_search {
            color: #fff;
            font-size: 16px;
            padding: 10px;
            background-color: #32AAD6;
        }

        /* Navbar */
        .header__nav {
            padding: 0 !important;
            height: 19px !important;
            margin-top: 3px;
            margin: 0 13%;
        }

        .header__nav_item {
            font-size: 14px;
        }

        .header__nav_item:hover {
            background-color: #32AAD6;
        }

        .header__container {
            margin: 0 20%;
        }

        .header__ul {
            display: flex;
            justify-content: space-around;
            align-items: center;
            height: 40%;
            list-style-type: none;
        }

    </style>
</head>

<body>
    <header class="header__header">
        <div class="header__box">
            <div class="header__logo">
                <img class="header__img" src="/web-tour/src/Image/logo.png" alt="logo">
            </div>
            <form action="/web-tour/src/Pages/AllTour.php" method="get" class="header__search">
                <input class="header__input_search focus:outline-none" type="search" placeholder="Từ khóa tìm kiếm" id="search" name="search">
                <button type="submit"><i class="fas fa-search header__icon_search"></i></button>
            </form>
            <div class="flex items-center">
                <?php
                echo $status_login
                    ? '<div class = "text-white text-sm sm:block" id="login">
                    <span>Xin chào, </span>
                    <a href="#">
                        ' . $_SESSION['username'] . '
                    </a>
                    <span>/</span>
                    <a href="/web-tour/src/Pages/UpdatePassword.php">Đổi mật khẩu</a>
                    <span>/</span>
                    <a href="/web-tour/src/controllers/Logout.php">
                        Đăng xuất
                    </a>'
                    : '<div class = "text-white text-sm hidden sm:block" id="login">
                    <a href="/web-tour/src/Pages/Login.php">
                        Đăng Nhập
                    </a>
                    <span>/</span>
                    <a href="/web-tour/src/pages/Register.php">
                        Đăng ký
                    </a>
                </div>'
                ?>
            </div>
        </div>
        </div>
        <nav class="sm:h-8">
            <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
                <div class="relative flex sm:h-9 items-center justify-between">
                    <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                        <!-- Mobile menu button-->
                        <button type="button" class="inline-flex items-center justify-center rounded-md p-1 text-white hover:bg-sky-500 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false" id="btn-nav">
                            <span class="sr-only">Open main menu</span>

                            <svg class="block h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>

                            <svg class="hidden h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex sm:items-stretch sm:justify-start h-9">
                        <div class="hidden m-0 sm:ml-6 sm:block">
                            <div class="flex h-full relative text-sm">

                                <a href="/web-tour/index.php" class="hover:bg-sky-500 hover:text-white text-white py-2 px-2 text-sm font-medium w-24 text-center" aria-current="page">Trang chủ</a>

                                <a href="/web-tour/src/Pages/Introduce.php" class="text-white hover:bg-sky-500 hover:text-white py-2 px-2 text-sm font-medium w-24 text-center">Giới
                                    thiệu</a>

                                <a href="/web-tour/src/Pages/AllTour.php" class="text-white hover:bg-sky-500 hover:text-white py-2 px-2 text-sm font-medium w-24 text-center " id="group-dropdown-button">Tour
                                    du lịch
                                </a>

                                <div class="absolute text-white flex flex-col top-9 z-50 hidden" id="dropdown-box" style="background-color: #154054; top: 2.4rem; left: 34%;">
                                    <div class="p-2 hover:bg-sky-500 group-dropdown z-50" style="min-width: 160px;">
                                        <a href="/web-tour/src/Pages/AllTour.php?search=miền bắc">Miền Bắc</a>
                                        <div class="absolute text-white flex flex-col top-9 hidden z-50" style="background-color: #154054; top: 0; left: 100%; min-width: 160px;">
                                            <a href="/web-tour/src/Pages/AllTour.php?search=ninh bình" class="p-2 hover:bg-sky-500">Ninh Bình</a>
                                            <a href="/web-tour/src/Pages/AllTour.php?search=sa pa" class="p-2 hover:bg-sky-500">Sa Pa</a>
                                            <a href="/web-tour/src/Pages/AllTour.php?search=cao bằng" class="p-2 hover:bg-sky-500">Cao Bằng</a>
                                            <a href="/web-tour/src/Pages/AllTour.php?search=lạng sơn" class="p-2 hover:bg-sky-500">Lạng Sơn</a>
                                        </div>
                                    </div>
                                    <div class="p-2 hover:bg-sky-500 group-dropdown z-50" style="min-width: 160px;">
                                        <a href="/web-tour/src/Pages/AllTour.php?search=miền trung">Miền Trung, Tây Nguyên</a>
                                        <div class="absolute text-white flex flex-col top-9 hidden z-50" style="background-color: #154054; top: 2.2rem; left: 100%; min-width: 160px;">
                                            <a href="/web-tour/src/Pages/AllTour.php?search=đà nẵng" class="p-2 hover:bg-sky-500">Đà Nẵng</a>
                                            <a href="/web-tour/src/Pages/AllTour.php?search=hội an" class="p-2 hover:bg-sky-500">Hội An</a>
                                            <a href="/web-tour/src/Pages/AllTour.php?search=quy nhơn" class="p-2 hover:bg-sky-500">Quy Nhơn</a>
                                            <a href="/web-tour/src/Pages/AllTour.php?search=gia lai" class="p-2 hover:bg-sky-500">Gia Lai</a>
                                            <a href="/web-tour/src/Pages/AllTour.php?search=kon tum" class="p-2 hover:bg-sky-500">Kon Tum</a>
                                        </div>
                                    </div>
                                    <div class="p-2 hover:bg-sky-500 group-dropdown z-50" style="min-width: 160px;">
                                        <a href="/web-tour/src/Pages/AllTour.php?search=miền nam">Miền Nam</a>
                                        <div class="absolute text-white flex flex-col top-9 hidden z-50" style="background-color: #154054; top: 4.4rem; left: 100%;">
                                            <a href="/web-tour/src/Pages/AllTour.php?search=vũng tàu" class="p-2 hover:bg-sky-500" style="min-width: 160px;">Vũng Tàu</a>
                                            <a href="/web-tour/src/Pages/AllTour.php?search=tây ninh" class="p-2 hover:bg-sky-500" style="min-width: 160px;">Tây Ninh</a>
                                            <a href="/web-tour/src/Pages/AllTour.php?search=cần thơ" class="p-2 hover:bg-sky-500" style="min-width: 160px;">Cần Thơ</a>
                                        </div>
                                    </div>
                                </div>

                                <a href="/web-tour/src/Pages/Cart.php" class="text-white hover:bg-sky-500 hover:text-white py-2 px-2 text-sm font-medium w-24 text-center " id="group-dropdown-button">
                                    Giỏ hàng
                                </a>

                                <?php
                                echo $status_login && $role === 'admin' ?
                                    '<a href="/web-tour/src/Pages/PostTour.php" class="text-white hover:bg-sky-500 hover:text-white py-2 px-2 text-sm font-medium w-24 text-center">Thêm tour</a>
                                    <a href="/web-tour/src/Pages/PostTourWithForm.php" class="text-white hover:bg-sky-500 hover:text-white py-2 px-2 text-sm font-medium  text-center">Form thêm tour</a>
                                    <a href="/web-tour/src/Pages/Orders.php" class="text-white hover:bg-sky-500 hover:text-white py-2 px-2 text-sm font-medium w-24 text-center">Đơn hàng</a>
                                    <a href="/web-tour/src/controllers/backup.php" class="text-white hover:bg-sky-500 hover:text-white py-2 px-2 text-sm font-medium  text-center">Backup database</a>' : '';
                                ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <script>
        const btn = document.getElementById("btn-nav");
        const nav = document.getElementById("nav-mobile");
        let showMenu = false;
        btn.addEventListener('click', toggleMenu);

        function toggleMenu() {
            if (!showMenu) {
                nav.classList.remove("hidden");
                showMenu = true;
            } else {
                nav.classList.add("hidden");
                showMenu = false;
            }
        }
        const drop_down = document.getElementById("group-dropdown-button");
        const drop_down_box = document.getElementById("dropdown-box");
        drop_down.addEventListener('mouseover', function() {
            drop_down_box.classList.remove("hidden");
        });
        drop_down.addEventListener('mouseout', function() {
            drop_down_box.classList.add("hidden");
        });
        drop_down_box.addEventListener('mouseover', function() {
            drop_down_box.classList.remove("hidden");
        });
        drop_down_box.addEventListener('mouseout', function() {
            drop_down_box.classList.add("hidden");
        });

        const group = document.getElementsByClassName("group-dropdown");
        for (let i = 0; i < group.length; i++) {
            group[i].addEventListener('mouseover', function() {
                group[i].children[1].classList.remove("hidden");
            });
            group[i].addEventListener('mouseout', function() {
                group[i].children[1].classList.add("hidden");
            });
        }
    </script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'sky-1000': '#154054'
                    },
                    zIndex: {
                        '1000': '1000',
                    }
                }
            }
        }
    </script>
</body>

</html>