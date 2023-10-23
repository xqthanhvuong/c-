<?php
session_start();
require '../config/connectDB.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <link rel="icon" href="/web-tour/src/Image/logo.png" type="image/png">
    <title>Epic Escapes</title>
    <script src="/web-tour/src/Lib/tailwind.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- css -->
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        .field__input {
            writing-mode: horizontal-tb !important;
            width: 100%;
            height: 44px;
            display: block;
            box-sizing: border-box;
            padding-left: 12px;
            border: 1px #d9d9d9 solid;
            border-radius: 4px;
            background-color: #fff;
            color: #333;
            font: inherit;
            font-size: 14px
        }
        .label-item {
            position: absolute;

            width: 100%;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            box-sizing: border-box;
            color: #999;
            z-index: 1;
            user-select: none;
            pointer-events: none;
            font-size: 1em;
            transform: translateY(6px);
            transform: none;
            font-size: .84em;
            padding-left: 0.9em;
        }

        .select-item {
            height: 46px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .main .field {
            padding: 0.4em;
        }

        .field {
            padding: 5.6px;
            float: left;
            width: 100%;
            box-sizing: border-box;
        }

        .main {
            width: 50%;
            display: flex;
            flex-direction: column;
            padding: 0 2em 0 2em;
        }

        .main__context {
            padding-bottom: 1.5em;
        }

        .article {
            display: blocks;
        }

        .row {
            margin-left: -10px;
            margin-right: -10px;
        }

        .row::after {
            content: "";
            display: table;
            clear: both;
        }

        .wrap {
            display: block;
            width: 100%;
            box-sizing: border-box;
            padding: 0 1em;
            font-size: 14px;
            max-width: 40em;
            margin: 0 auto;
        }

        .section__content::after {
            clear: both;
        }

        .section__content::before {
            content: "";
            display: table;
        }

        .fieldset {
            margin: -0.4em;
        }

        .fieldset::after {
            clear: both;
        }

        .fieldset::after {
            content: "";
            display: table;
        }

        .field__input::-moz-focus-inner {
            outline: none;
            border-color: #66afe9;
            box-shadow: 0 0 0 1px #66afe9;
        }


        .sidebar__body {
            font-size: 14px;
        }

        .content__item {
            width: 240px;
        }

        .sidebar__header {
            border-bottom: 1px solid #ccc;
        }

        .content {
            border-bottom: 1px solid #ccc;
        }

        .function {
            border-bottom: 1px solid #ccc;
        }

        .ingredient {
            border-bottom: 1px solid #ccc;
        }
        .content__img img{
            min-width: 132px;
            max-width: 132px;
            height: 70px;
        }



        .button input:hover {
            background-color: #00aeef;

        }
    </style>


</head>

<body>
<?php include "../Components/Header/Header.php" ?>
<h1 class="my-5 text-sky-500 text-center text-3xl font-semibold">Thông tin đơn hàng</h1>
    <div class="mx-40 flex justify-content-around my-10">
        <main class="main">
            <div class="main__context flex justify-around items-center">
                <article class="animate-floating-labels row">
                    <form action="../controllers/code.php" method="post">
                        <section class="section">
                            <div class="section__header flex" style="justify-content: space-between ; color:#333;font-size:18px;">
                            <div class="section__content ">
                                <div class="fieldset ">

                                    
                                        <?php
                                            if (isset($_SESSION['user_id'])) {
                                                $rs=mysqli_query($conn,"SELECT * From users where user_id=".$_SESSION['user_id']);
                                                $rowrs=mysqli_fetch_assoc($rs);
                                                echo '
                                                <div class=" field ">
                                                <input class="field__input" type="email" name="gmail" value="'.$rowrs['user_email'].'" id="" placeholder="Email" required>
                                                </div>
                                                <div class="field">
                                                <input class="field__input" name="name" value="'.$rowrs['user_firstname'].' '.$rowrs['user_lastname'].'" type="text" placeholder="Họ và tên" required>
                                                </div>';
                                            }
                                            else{
                                                echo '
                                                <div class=" field ">
                                                <input class="field__input" type="email" name="gmail" value="" id="" placeholder="Email" required>
                                                </div>
                                                <div class="field">
                                                <input class="field__input" name="name" value="" type="text" placeholder="Họ và tên" required>
                                                </div>';
                                            }
                                         ?>
                                    <div class="field flex w-full " style="justify-content: space-between;">
                                       
                                        <input class="field__input" type="text" name="number" id="" placeholder="Số điện thoại" required>
                                        
                                    </div>
                                    <div class="field ">
                                        <input class="field__input" type="text" name="diachi" id="" placeholder="Địa chỉ" required>
                                    </div>
                                    <div class=" field  pt-px ">
                                        <div class="">
                                            <select class="select-item form-select form-select-sm" name="city" id="city" aria-label=".form-select-sm" required>
                                                <option value="" selected>Chọn tỉnh thành</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <div class=" ">
                                            <select class="select-item form-select form-select-sm" name="district" id="district" aria-label=".form-select-sm" required>
                                                <option value="" selected>Chọn quận huyện</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <div class=" ">
                                            
                                            <select class="select-item form-select form-select-sm" name="ward" id="ward" aria-label=".form-select-sm" required>
                                                <option value="" selected>Chọn phường xã</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <div class="fieldset ">
                                    <h3 class="visually-hidden"></h3>
                                    <div class="field w-full " data-bind-class="{'field--show-floating-label': note}">
                                        <div class="field__input-wrapper w-full">
                                            <textarea class="w-full" style=" resize:none;  min-height:100px;border: 1px solid #ccc; padding-left: 12px;border-radius:4px; font-size:14px " name="note" id="note" class="field__input" data-bind="note" placeholder="Ghi chú"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                </article>
            </div>

        </main>

        <aside class="aside" style="width: 50%;
            padding: 1em 2em 2rem 2em; height: 100%; background-color:#F5F5F5">
            <div class="sidebar__header">
                <h1 class="sidebar__title" style="font-size: 1.15rem;">
                    Đơn hàng
                </h1>
            </div>
            <div class="sidebar__body mt-2">
                <?php
                $total = 0;
                if (isset($_SESSION['user_id'])) {
                    $user_id = $_SESSION['user_id'];
                    $query = "SELECT * FROM cart WHERE  user_id = '$user_id' ";
                    $query_run = mysqli_query($conn, $query);
                    $check=mysqli_num_rows($query_run);
                    if($check == 0){
                       echo "<div><h4>Chưa có tour nào được chọn</h4></div>";
                    }
                    else{
                        while ($value = mysqli_fetch_assoc($query_run)) {
                            $id = $value['tour_id'];
                            $qrimg = "select tour_image from tour_images where tour_id=$id";
                            $tour_title = "select tour_title from tours where tour_id=$id";
                            $quantity = $value['cart_quantity'];

                            $price = "select tour_price from tours where tour_id=$id";
                            $result_img = mysqli_query($conn, $qrimg);
                            $result_title = mysqli_query($conn, $tour_title);
                            // $result_quantity=mysqli_query($conn,$quantity);
                            $result_price = mysqli_query($conn, $price);
                ?>
                            <div class="content flex items-center">
                                <div class="content__img mr-4 w-40">
                                    <th class="item--content ">
                                        <?php
                                        $row_img = mysqli_fetch_assoc($result_img);
                                        $path = $row_img['tour_image'];
                                        echo "<img id='father' class='w-full h-16' src='$path' alt='ảnh'>";
                                        ?>
                                    </th>

                                </div>
                                <div class="content__item--money my-2">
                                    <div class="content__item--title">
                                        <p class="font-semibold">Tên tour: <span class="font-medium"><?php
                                        $row_title = mysqli_fetch_assoc($result_title);
                                        $path_title = $row_title['tour_title'];
                                        echo "$path_title ";
                                        ?></span> </p>    
                                    </div>

                                    <div class="money flex justify-between my-2">
                                        <p class="font-semibold">Số lượng người: <span class="font-medium"><?php
                                                $people = $value['cart_quantity'];
                                                echo "$people";
                                            ?></span> người </p>
                                    </div>
                                    <div class="time my-2">
                                        <p class="font-semibold">Ngày đi: <span><?php
                                        $date = $value['date_start'];
                                            echo "$date ";
                                        ?></span> </p>
                                    </div>
                                </div>
                            </div>
                <?php
                            $row_price = mysqli_fetch_assoc($result_price);
                            $path_price = $row_price['tour_price'];
                            $total = $total + $path_price * $quantity;
                        }
                    }
                }
                ?>

                <div class="ingredient mt-5 mb-5">
                    <div class="flex justify-between">
                        <div>
                            <p>Tạm tính</p>
                        </div>
                        <div>
                            <p class="font-semibold"><?= number_format($total, 0, " ", ".") ?> VNĐ</p>
                        </div>
                    </div>
                </div>
                <div class="function__order mt-5 ">
                    <div class="flex justify-between my-2">
                        <div>
                            <p>Tổng cộng</p>
                        </div>
                        <div>
                            <h2 class="font-semibold"><?= number_format($total, 0, " ", ".") ?> VNĐ</h2>
                        </div>
                    </div>
                    <?php 
                    if($check!=0){
                     ?>
                    <div class="flex justify-end">
                     <button style="width:100px;height:45px;border:1px solid; border-radius:0.25rem;margin-left: 10px;background-color:#2f71a9;color:#fff;" type="submit" name="mail">Đặt hàng</button>
                    </div>
                    <?php }?>
                    </form>
                </div>
            </div>
        </aside>
    </div>
    <?php include "../Components/Footer/Footer.php" ?>
    <?php include "../Components/Zalo.php" ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script>
        var citis = document.getElementById("city");
        var districts = document.getElementById("district");
        var wards = document.getElementById("ward");
        var Parameter = {
            url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json",
            method: "GET",
            responseType: "application/json",
        };
        var promise = axios(Parameter);
        promise.then(function(result) {
            renderCity(result.data);
        });

        function renderCity(data) {
            console.log(data);
            for (const x of data) {
                citis.options[citis.options.length] = new Option(x.Name, x.Name);
            }
            citis.onchange = function() {
                district.length = 1;
                ward.length = 1;
                if (this.value != "") {
                    const result = data.filter(n => n.Name === this.value);
                    for (const k of result[0].Districts) {
                        district.options[district.options.length] = new Option(k.Name, k.Name);
                    }
                }
            };
            district.onchange = function() {
                ward.length = 1;
                const dataCity = data.filter(n => n.Name === citis.value);
                if (this.value != "") {
                    const dataWards = dataCity[0].Districts.filter(n => n.Name === this.value)[0].Wards;

                    for (const w of dataWards) {
                        wards.options[wards.options.length] = new Option(w.Name, w.Name);
                    }
                }
            };
        }
    </script>

</body>

</html>