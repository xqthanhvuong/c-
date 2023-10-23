<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="icon" href="/web-tour/src/Image/logo.png" type="image/png">
    <!-- tailwindcss -->
    <script src="/web-tour/src/Lib/tailwind.js"></script>
    <!-- Custome styles -->
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    @keyframes animation {
        0% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-10px);
        }

        100% {
            transform: translateY(0);
        }
    }

    .animation-btn {
        animation: animation 1s infinite;
    }

    .animation_title {
        transform: translate(-50%, -50%);
        animation: typing 3s steps(52),
            blink step-end 0.5s infinite alternate;
    }

    @keyframes typing {
        from {
            width: 0;
        }
    }

    @keyframes blink {
        50% {
            border-color: transparent;
        }
    }

    @font-face {
        font-family: 'lora';
        src: url("./Font/Lora-SemiBold.ttf");
    }

    .font-lora {
        font-family: 'lora';
    }

    </style>
    <title>Home</title>
</head>

<body class="relative">
    <?php include 'src/Components/Header/Header.php' ?>
    <div>
        <div class="relative">
            <div class="absolute inset-0 bg-black opacity-30 relative z-negative"></div>
            <h1 class="absolute top-1/2 left-1/2 text-white text-center xl:text-6xl font-bold block w-full overflow-hidden whitespace-nowrap font-lora animation_title
                        md:text-5xl sm:text-4xl z-10">
                Chào mừng bạn đến với Epic Escapes! </h1>
            <img src="https://cdn.vietnambiz.vn/171464876016439296/2020/10/19/quynhonnhintucangotua-nguyen-dung-1603075894101769523040.jpg"
                alt="background" class="w-full h-96 relative z-negative">
        </div>
    </div>
    <div class="mt-12 ">
        <div class="mb-12 title relative mx-24">
            <h1 class="font-bold text-sky-500 text-center text-3xl py-2">Tour hot</h1>
            <p class="text-center">Bạn đang tìm kiếm một tour du lịch trong nước đang hot nhất hiện nay? Nếu câu trả lời là có, hãy cùng chúng tôi tham khảo những tour du lịch sau đây</p>
        </div>
        <div class="flex justify-around flex-wrap mx-16">
            <?php
                include "src/config/connectDB.php";
                $tours = "SELECT tour_id, tour_title, tour_price, tour_discount_rate FROM tours order by tour_visited desc  limit 3";
                $tour_image = "SELECT tour_image_id, tour_id, tour_image FROM tour_images";
                $result_tours = mysqli_query($conn, $tours);
                $result_tour_image = mysqli_query($conn, $tour_image);
                $tour_image = array();
                if (mysqli_num_rows($result_tour_image) > 0) {
                    while($row = mysqli_fetch_assoc($result_tour_image)) {
                        $tour_image[$row['tour_id']] = $row['tour_image'];
                    }
                } else {
                    echo "0 results";
                }
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
                        include "src/Components/Item/Item.php";
                    }
                } else {
                    echo "0 results";
                }
                mysqli_close($conn);
            ?>
        </div>
    </div>
    <div class="mt-5">
        <h1 class="text-sky-500 text-3xl font-bold text-center">Điểm đến yêu thích</h1>
        <div class="flex my-10 w-full h-full">
            <div class="h-full w-1/2 lg:w-1/3 relative">
                <img src="src/Image/banner.png" alt="banner">
                <div class="absolute left-1/2 top-1/2 h-9 w-9 z-50" id="play">
                    <i class="fas fa-regular fa-play text-4xl text-white hover:cursor-pointer"></i>
                </div>
                <div class="absolute top-0 left-0 w-full h-full bg-black bg-opacity-20 z-0"></div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-0 lg:w-2/3 w-5/6">
                <div class="relative group">
                    <img class="h-full w-full" src="src/Image/place_image1.png" alt="Vịnh Hạ Long">
                    <div
                        class="absolute top-0 left-0 w-full h-full flex justify-center items-center text-xl font-bold text-white z-50 flex-col group-hover:bg-sky-500 transition duration-500 ease-in-out">
                        <div class="p-2 mb-2 group-hover:-translate-y-50 transition duration-500 ease-in-out">Vịnh Hạ
                            Long</div>
                        <button
                            class="hidden group-hover:block w-28 h-9 p-1 bg-sky-500 border rounded-3xl border-solid border-white text-white font-bold text-sm group-hover:cursor-pointer text-center z-50">
                            <a href="/web-tour/src/Pages/AllTour.php?search=vịnh hạ long">Khám phá</a>
                        </button>
                    </div>
                    <div class="absolute top-0 left-0 w-full h-full bg-opacity-30 bg-black"></div>
                </div>
                <div class="relative group">
                    <img class="h-full w-full" src="src/Image/place_image2.png" alt="Vịnh Hạ Long">
                    <div
                        class="absolute top-0 left-0 w-full h-full flex justify-center items-center text-xl font-bold text-white z-50 flex-col group-hover:bg-sky-500 transition duration-500 ease-in-out">
                        <div class="p-2 mb-2 group-hover:-translate-y-50">Sapa</div>
                        <button
                            class="hidden group-hover:block w-28 h-9 p-1 bg-sky-500 border rounded-3xl border-solid border-white text-white font-bold text-sm group-hover:cursor-pointer text-center z-50">
                            <a href="/web-tour/src/Pages/AllTour.php?search=sapa">Khám phá</a>
                        </button>
                    </div>
                    <div class="absolute top-0 left-0 w-full h-full bg-opacity-30 bg-black"></div>
                </div>
                <div class="relative group">
                    <img class="h-full w-full" src="src/Image/place_image_3.png" alt="Vịnh Hạ Long">
                    <div
                        class="absolute top-0 left-0 w-full h-full flex justify-center items-center text-xl font-bold text-white z-50 flex-col group-hover:bg-sky-500 transition duration-500 ease-in-out">
                        <div class="p-2 mb-2 group-hover:-translate-y-50">Đà Nẵng</div>
                        <button
                            class="hidden group-hover:block w-28 h-9 p-1 bg-sky-500 border rounded-3xl border-solid border-white text-white font-bold text-sm group-hover:cursor-pointer text-center z-50">
                            <a href="/web-tour/src/Pages/AllTour.php?search=đà nẵng">Khám phá</a>
                        </button>
                    </div>
                    <div class="absolute top-0 left-0 w-full h-full bg-opacity-30 bg-black"></div>
                </div>
                <div class="relative group">
                    <img class="h-full w-full" src="src/Image/place_image_4.png" alt="Vịnh Hạ Long">
                    <div
                        class="absolute top-0 left-0 w-full h-full flex justify-center items-center text-xl font-bold text-white z-50 flex-col group-hover:bg-sky-500 transition duration-500 ease-in-out">
                        <div class="p-2 mb-2 group-hover:-translate-y-50">Đà Lạt</div>
                        <button
                            class="hidden group-hover:block w-28 h-9 p-1 bg-sky-500 border rounded-3xl border-solid border-white text-white font-bold text-sm group-hover:cursor-pointer text-center z-50">
                            <a href="/web-tour/src/Pages/AllTour.php?search=đà lạt">Khám phá</a>
                        </button>
                    </div>
                    <div class="absolute top-0 left-0 w-full h-full bg-opacity-30 bg-black"></div>
                </div>
                <div class="relative group">
                    <img class="h-full w-full" src="src/Image/place_image_5.png" alt="Vịnh Hạ Long">
                    <div
                        class="absolute top-0 left-0 w-full h-full flex justify-center items-center text-xl font-bold text-white z-50 flex-col group-hover:bg-sky-500 transition duration-500 ease-in-out">
                        <div class="p-2 mb-2 group-hover:-translate-y-50">Quy Nhơn</div>
                        <button
                            class="hidden group-hover:block w-28 h-9 p-1 bg-sky-500 border rounded-3xl border-solid border-white text-white font-bold text-sm group-hover:cursor-pointer text-center z-50">
                            <a href="/web-tour/src/Pages/AllTour.php?search=quy nhơn">Khám phá</a>
                        </button>
                    </div>
                    <div class="absolute top-0 left-0 w-full h-full bg-opacity-30 bg-black"></div>
                </div>
                <div class="relative group">
                    <img class="h-full w-full" src="src/Image/place_image_6.png" alt="Vịnh Hạ Long">
                    <div
                        class="absolute top-0 left-0 w-full h-full flex justify-center items-center text-xl font-bold text-white z-50 flex-col group-hover:bg-sky-500 transition duration-500 ease-in-out">
                        <div class="p-2 mb-2 group-hover:-translate-y-50">Phú Quốc</div>
                        <button
                            class="hidden group-hover:block w-28 h-9 p-1 bg-sky-500 border rounded-3xl border-solid border-white text-white font-bold text-sm group-hover:cursor-pointer text-center z-50">
                            <a href="/web-tour/src/Pages/AllTour.php?search=phú quốc">Khám phá</a>
                        </button>
                    </div>
                    <div class="absolute top-0 left-0 w-full h-full bg-opacity-30 bg-black"></div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="mt-12 min-h-screen">
        <div class="mb-12 title relative">
            <h1 class="font-bold text-sky-500 text-center text-3xl py-2">Tour miền bắc</h1>
            <p class="text-center py-2">Sale off tất cả các tour trong tháng này. Nhanh tay đặt tour để cho gia đình
                mình cùng quây quần bên nhau.</p>
        </div>
        <div class="flex justify-around flex-wrap mx-16">
            <?php
                include "src/config/connectDB.php";
                $tours = "SELECT tour_id, tour_title, tour_price, tour_discount_rate FROM tours where tour_region = 'Miền Bắc' limit 3";
                $tour_image = "SELECT tour_image_id, tour_id, tour_image FROM tour_images";
                $result_tours = mysqli_query($conn, $tours);
                $result_tour_image = mysqli_query($conn, $tour_image);
                $tour_image = array();
                if (mysqli_num_rows($result_tour_image) > 0) {
                    while($row = mysqli_fetch_assoc($result_tour_image)) {
                        $tour_image[$row['tour_id']] = $row['tour_image'];
                    }
                } else {
                    echo "0 results";
                }
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
                        include "src/Components/Item/Item.php";
                    }
                } else {
                    echo "0 results";
                }
                mysqli_close($conn);
            ?>
        </div>
    </div>
    <div class="hidden absolute w-full h-full top-0 left-0 bg-black bg-opacity-50 z-50" id="video-wallpaper">
        <div class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
            <div class="text-white text-2xl float-right -translate-y-7 cursor-pointer" id="close">
                <i class="fas fa-light fa-circle-xmark"></i>
            </div>
            <iframe src="https://www.youtube.com/embed/6PcncoCqTGU" width="520" height="520" controls></iframe>
        </div>
    </div>
       <?php include 'src/Components/Footer/Footer.php' ?>
    <script>
    //JS
    const videoWapper = document.getElementById('video-wallpaper');
    const playBtn = document.getElementById('play');
    const closeBtn = document.getElementById('close');
    playBtn.addEventListener('click', () => {
        videoWapper.classList.remove('hidden');
        videoWapper.querySelector('iframe').src = 'https://www.youtube.com/embed/6PcncoCqTGU';
    })
    closeBtn.addEventListener('click', () => {
        videoWapper.classList.add('hidden');
        videoWapper.querySelector('iframe').src = 'https://www.youtube.com/embed/6PcncoCqTGU';
    })
    //config tailwind
    tailwind.config = {
        theme: {
            extend: {
                zIndex: {
                    'negative': '-1',
                },
                colors: {
                    'sky-1000': '#154054'
                }
            }
        }
    }
    </script>
</body>

</html>