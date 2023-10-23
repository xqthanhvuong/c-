<style>
    .footer__container {
        background-image: url("https://bizweb.dktcdn.net/100/315/268/themes/857513/assets/bg_brand.png?1666237949898");
        background-size: cover;
        padding: 50px 0;
        position: relative;
        min-height: 270px;
        background-repeat: no-repeat;
    }

    .footer__container::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
    }

    @media screen and (max-width: 480px) {
        .footer__container_box {
            margin: 0 20px !important;
        }

        .footer__container_register {
            margin-top: 15px;
        }

        .footer__container_box_input {
            padding: 0;
            font-size: 12px;
            width: 208px;
        }

        .footer__container_box_button {
            font-size: 12px;
        }

        .footer__box_info {
            flex-direction: column;
        }

        .footer__box_info_item {
            width: 100%;
            margin: 5px;
        }

        .footer__box_info_item_box {
            flex-direction: row;
        }
    }
</style>

<body>
    <footer>
        <div class="footer__container w-full">
            <div class="position: relative z-1 sm:mx-28 footer__container_box">
                <h1 class="text-3xl text-white font-bold text-center mb-2">Đăng ký nhận tin</h1>
                <h2 class="lg:text-base text-white text-center sm:text-sm ">Tổng hợp những chương trình tour theo tháng,
                    du lịch vòng
                    quanh thế giới với mức chi phí cực rẻ. Để
                    nhận
                    ngay những thông tin chương trình tour hot. Quý khách hàng vui lòng nhập thông tin email tại
                    đây !
                    Thanks</h2>
                <div class="flex mt-10 sm:mt-5 footer__container_register">
                    <div class="flex content-center mx-auto">
                        <input class="p-2 md:w-80 footer__container_box_input focus:outline-none" type="email" placeholder="Email nhận tin" aria-placeholder="Email nhận tin" name="email" id="email_sale" />
                        <button class="p-2 bg-sky-500 text-white footer__container_box_button" type="submit" id="btnSubmitSale">Đăng ký</button>
                    </div>
                </div>
                <script>
                    const email = document.getElementById("email_sale");
                    const btnSubmit = document.getElementById("btnSubmitSale");
                    const s = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    btnSubmit.addEventListener("click", function() {
                        if (email.value == "") {
                            alert("Vui lòng nhập email");
                        } else if (!s.test(email.value.trim())) {
                            alert("Vui lòng nhập đúng email");
                        } else {
                            const xhr = new XMLHttpRequest();
                            xhr.open("POST", "/web-tour/src/controllers/RegisterSale.php", true);
                            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                            xhr.onload = function() {
                                if (this.status == 200) {
                                    if (this.responseText == "Success") {
                                        alert("Đăng ký thành công");
                                        email.value='';

                                    } else if (this.responseText == "Email been used") {
                                        alert(`Email: ${email.value} đã tồn tại! Vui lòng nhập email khác.`);
                                    } else {
                                        alert("Có lỗi xảy ra! Vui lòng thử lại sau");
                                    }
                                }
                            };
                            xhr.send(`email=${email.value}`);
                        }
                    });
                </script>
            </div>
        </div>
        <div class="h-80 xl:mx-36 md:mx-10 lg:mx-20">
            <div class="flex justify-between mt-12 footer__box_info">
                <div class="w-64 footer__box_info_item">
                    <h1 class="text-sky-500 font-bold uppercase footer__box_info_item_title">Liên hệ</h1>
                    <p class="text-sm mt-2">
                        <span class="font-bold">Địa chỉ:</span>
                        Supreme tower, 124 Mai Hac De Street, Quy Nhon City, Binh Dinh
                    </p>
                    <p class="text-sm mt-2">
                        <span class="font-bold">Điện thoại:</span>
                        037 422 9607
                    </p>
                    <p class="text-sm mt-2">
                        <span class="font-bold">Email:</span>
                        epicescapesnews@gmail.com
                    </p>
                    <p class="text-sm mt-2">
                        <span class="font-bold">Giờ làm việc:</span>
                        8:00 - 17:00 (T2 - T7)
                    </p>
                </div>
                <div class="w-56 footer__box_info_item">
                    <h1 class="text-sky-500 font-bold uppercase">Kết nối với chúng tôi</h1>
                    <a href="https://www.facebook.com/profile.php?id=100091060750993"><i class="fa-brands fa-facebook text-blue-900 p-2 text-2xl "></i></a>
                    <a href="#"><i class="fab fa-instagram text-rose-500 p-2 text-2xl"></i></a>
                    <a href="#"><i class="fa-brands fa-twitter text-blue-500 p-2 text-2xl"></i></a>
                    <a href="https://www.youtube.com/@dulichquynhon-binhinh2299"><i class="fa-brands fa-youtube text-red-700 p-2 text-2xl"></i></a>
                    <h1 class="text-sky-500 font-bold uppercase">Chấp nhận thanh toán</h1>
                    <div class="flex-wrap">
                        <img src="https://bizweb.dktcdn.net/100/315/268/themes/857513/assets/img_payment_1.png?1671122588148" alt="visa" class="inline mt-1">
                        <img src="https://bizweb.dktcdn.net/100/315/268/themes/857513/assets/img_payment_2.png?1671122588148" alt="visa" class="inline mt-1">
                        <img src="https://bizweb.dktcdn.net/100/315/268/themes/857513/assets/img_payment_3.png?1671122588148" alt="visa" class="inline mt-1">
                        <img src="https://bizweb.dktcdn.net/100/315/268/themes/857513/assets/img_payment_4.png?1671122588148" alt="visa" class="inline mt-1">
                        <img src="https://bizweb.dktcdn.net/100/315/268/themes/857513/assets/img_payment_5.png?1671122588148" alt="visa" class="inline mt-1">
                        <img src="https://bizweb.dktcdn.net/100/315/268/themes/857513/assets/img_payment_6.png?1671122588148" alt="visa" class="inline mt-1">
                        <img src="https://bizweb.dktcdn.net/100/315/268/themes/857513/assets/img_payment_7.png?1671122588148" alt="visa" class="inline mt-1">
                        <img src="https://bizweb.dktcdn.net/100/315/268/themes/857513/assets/img_payment_8.png?1671122588148" alt="visa" class="inline mt-1">
                    </div>
                </div>
                <div class="footer__box_info_item">
                    <h1 class="text-sky-500 font-bold uppercase">Trong nước</h1>
                    <div class="flex flex-col footer__box_info_item_box">
                        <a href="/web-tour/src/Pages/AllTour.php?search=quy nhơn">
                            <p class="text-sm mt-1">Quy Nhơn</p>
                        </a>
                        <a href="/web-tour/src/Pages/AllTour.php?search=phú quốc">
                            <p class="text-sm mt-1">Phú Quốc</p>
                        </a>
                        <a href="/web-tour/src/Pages/AllTour.php?search=đà lạt">
                            <p class="text-sm mt-1">Đà Lạt</p>
                        </a>
                        <a href="/web-tour/src/Pages/AllTour.php?search=đà nẵng">
                            <p class="text-sm mt-1">Đà Nẵng</p>
                        </a>
                        <a href="/web-tour/src/Pages/AllTour.php?search=sapa">
                            <p class="text-sm mt-1">Sapa</p>
                        </a>
                        <a href="/web-tour/src/Pages/AllTour.php?search=vịnh hạ long">
                            <p class="text-sm mt-1">Vịnh hạ long</p>
                        </a>
                        <a href="#">
                            <p class="text-sm mt-1">Thanh Hóa</p>
                        </a>
                    </div>
                </div>
                <div class="footer__box_info_item">
                    <h1 class="text-sky-500 font-bold uppercase">Ngoài nước</h1>
                    <div class="flex flex-col footer__box_info_item_box">
                        <a href="#" class="text-sm mt-1 mx-1">
                            Tây Ban Nha
                        </a>
                        <a href="#" class="text-sm mt-1 mx-1">
                            Hàn Quốc
                        </a>
                        <a href="#" class="text-sm mt-1 mx-1">
                            Trung Quốc
                        </a>
                        <a href="#" class="text-sm mt-1 mx-1">
                            Triều Tiên
                        </a>
                        <a href="#" class="text-sm mt-1 mx-1">
                            Thái Lan
                        </a>
                        <a href="#" class="text-sm mt-1 mx-1">
                            Pháp
                        </a>
                    </div>
                </div>
                <div class="footer__box_info_item">
                    <h1 class="text-sky-500 font-bold uppercase">Thông tin</h1>
                    <div class="flex flex-col footer__box_info_item_box">
                        <a href="https://www.vietravel.com/vn/tin-tuc.aspx" class="text-sm mt-1">
                            Tin tức
                        </a>
                        <a href="https://www.vietravel.com/vn/media/tap-chi-du-lich.aspx" class="text-sm mt-1">
                            Tạp chí du lịch
                        </a>
                        <a href="https://www.vietravel.com/vn/tin-tuc/du-lich-bang-hinh-anh.aspx" class="text-sm mt-1">
                            Cẩm nang du lịch
                        </a>
                        <a href="https://vnexpress.net/cam-nang-du-lich-quy-nhon-4119727.html" class="text-sm mt-1">
                            Kinh nghiệm du lịch
                        </a>
                        <a href="https://zalo.me/0347276151" class="text-sm mt-1">
                            Liên hệ
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</body>