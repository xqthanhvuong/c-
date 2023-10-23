<?php
include '../config/connectDB.php';
session_start();
if (isset($_GET['q'])) {
    $id = intval($_GET['q']);
} else {
    $id = 1;
}
mysqli_query($conn, "update tours set tour_visited = tour_visited + 1 where tour_id = $id");
$sql = "select * from tours where tour_id = $id";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($query);
$tiltle = $row['tour_title'];
$tour_review = $row['tour_reviews'];
$hashtag = $row['tour_hastag'];
$hashtag = explode("#", $hashtag);
array_shift($hashtag);
$quantity = intval($row['tour_quantity']);
$tien = intval($row['tour_price']);
$discount = intval($row['tour_discount_rate']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $tiltle; ?></title>
    <link rel="icon" href="/web-tour/src/Image/logo.png" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../css/styledetailTour.css">
</head>

<body>
    <?php include '../Components/Header/Header.php'; ?>
    <div class="rowtt">
        <div class="head">
            <div class="head__title">
                <h2 class="title__head"><?php echo $tiltle; ?>
                </h2>

            </div>
            <div class="head__conner">
            </div>
            <div class="head__inventory">
                <span>
                    <?php
                    if ($quantity > 0)
                        echo "còn tour";
                    else
                        echo "hết tour";

                    ?>
                </span>
            </div>
        </div>

        <?php
        $qrimg = "select tour_image from tour_images where tour_id=$id limit 5";
        $result_img = mysqli_query($conn, $qrimg);
        ?>

        <div class="img">
            <?php
            $row_img = mysqli_fetch_assoc($result_img);
            $path = $row_img['tour_image'];
            echo "<img id='father' src='$path' alt='ảnh'>";
            ?>
        </div>
        <div class="item">
            <?php
            echo "<div class='item__son'><img src='$path' data-src='$path' alt=''></div>";
            while ($row_img = mysqli_fetch_assoc($result_img)) {
                $path = $row_img['tour_image'];
                echo "<div class='item__son'><img src='$path' data-src='$path' alt=''></div>";
            }
            ?>
        </div>
        <script>
            var img = document.getElementById("father");
            var item = document.querySelector(".item");

            item.addEventListener("click", function(event) {
                if (event.target.tagName === "IMG") {
                    var src = event.target.getAttribute("data-src");
                    img.setAttribute("src", src);
                }
            });
        </script>
        <div class="content">
            <div class="content__infor">
                <ul class="ul__dacbiet">
                    <?php
                    $query = "SELECT * FROM `transportation` WHERE tour_id = ? limit 3";
                    $stmt = mysqli_stmt_init($conn);
                    mysqli_stmt_prepare($stmt, $query);
                    mysqli_stmt_bind_param($stmt, 'i', $id);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    while ($rowtrans = mysqli_fetch_assoc($result)) {
                        switch ($rowtrans['transportation_name']) {
                            case 'Plane':
                            case 'plane':
                                $trans = 'máy bay';
                                break;
                            case 'Train':
                            case 'train':
                                $trans = 'tàu lửa';
                                break;
                            case 'Boat':
                            case 'boat':
                                $trans = 'thuyền';
                                break;
                            default:
                                $trans = 'ô tô';
                                break;
                        }
                        echo ' <li class="tagdacbiet"><b>Di chuyển bằng:</b> Di chuyển bằng ' . $trans . '</li>';
                    }
                    ?>
                </ul>
            </div>
            <div class="content__describe">
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    var describe = document.querySelectorAll('.topic__content__rte p');
                    if (describe.length > 0) {
                        const viewdescribe = document.querySelector('.content__describe');
                        let html = '';
                        let j = 0;
                        for (let i = 0; i < describe.length; i++) {
                            let text = describe[i]?.textContent;
                            if (text?.length > 130) {
                                text = text.slice(0, 130) + '....';
                                html += '<p>-\t' + text + '</p>';
                                j++;
                            }
                            if (j >= 2) {
                                break;
                            }
                        }
                        viewdescribe.innerHTML = html;
                    }
                });
            </script>
            <?php
            if ($quantity == 0) {
                echo '<div class="content__contact">
                 <span>Vui lòng liên hệ </span>
                 <b style="color: #333;">0374229607</b>
                 <span> để đặt Tour </span>
                </div>';
            } else {
            ?>

            <?php
                $max = $quantity;
                echo "
                    <div>
                    <div class='w-1/2'>
                    <form method='post' action='../controllers/bookTour.php'>
                     <table class='cart mt-3'>
                   <thead class='border border-b-2'>
                        <td class='text-center p-1 '>Số lượng người</td>
                        <td class='text-center p-1 '>Đơn giá</td>
                        <td class='text-center p-1 '>Thành tiền</td>  
                        </thead>
                        <tbody>
                            <tr class='text-sm '>
                                <td>
                                    <input  type='number' name='quantity'  value='1' min='1' max='$max' class='w-full text-center focus:outline-none' id='numberPerson'>
                                </td>
                                <td class='text-center'>
                                <label for=''>" . number_format(($tien * (100 - $discount) / 100), 0, '', '.') . "<span  id='giatour' data-value='" . ($tien * (100 - $discount) / 100) . "'> VNĐ</span></label>
                            </td>
                            <td class='text-center'>
                            <label for='' class='text-sky-500 font-bold tongtien'>" . number_format(($tien * (100 - $discount) / 100), 0, '', '.') . " <span>VND</span></label>
                        </td>
                    </tr>
                    </table>
                    <div class='container1'>
                    <div class='date'>
                    <label for='date'>
                        Ngày đi :
                    </label>
                    <input type='date' name='date'min=" . date('Y-m-d') . " required>
                    </div>
                    <div class='total_money'>
                    <h4>Tổng tiền : 
                    <strong id='ttmn'>" . number_format(($tien * (100 - $discount) / 100), 0, '', '.') . " VNĐ
                    </strong>
                    </h4>
                    </div>
                    </div>
                    <div class='sm'>
                    <input type='hidden' id='idtour' name='idtour' value='$id' readonly>
                    <input type='hidden' id='totalPrice' name='toltalPrice' value='" . ($tien * (100 - $discount) / 100) . "' readonly>
                    <input type='submit' value='BOOK TOUR' name='booktour'>
                    </div>
                    </form>
                    </div>
                    </div>
                    ";
            }
            ?>
            <script>
                var max = Number(document.getElementById('numberPerson').max);
                var tien = Number(document.getElementById('giatour').dataset.value);
                var toltalpricedisplay = document.getElementById('ttmn');
                var toltalPrice = document.getElementById('totalPrice');
                const numberPerson = document.getElementById('numberPerson');
                const price = document.getElementsByClassName('tongtien');
                numberPerson.addEventListener('change', function() {
                    if (numberPerson.value > max) {
                        numberPerson.value = max;
                    }
                    if (numberPerson.value < 1) {
                        numberPerson.value = 1;
                    }
                    toltalpricedisplay.innerHTML = (numberPerson.value * tien).toLocaleString('vi-VN') + " VND";
                    price[0].innerHTML = (numberPerson.value * tien).toLocaleString('vi-VN') + " VND";
                    toltalPrice.value = numberPerson.value * tien;
                })
            </script>
        </div>
    </div>
    <div class="topic">
        <div class="topic__content">
            <div class="topic__head">
                <h2>CHƯƠNG TRÌNH TOUR</h2>
            </div>
            <div class="topic__content__rte">
                <?php
                echo $tour_review;
                ?>
            </div>
        </div>
        <div class="tournb">
            <div class="sticky">
                <h3>TOUR NỔI BẬT</h3>
                <?php
                $sqll = "select * from tours order by tour_visited desc limit 6";
                $queryl = mysqli_query($conn, $sqll);
                while ($row_nb = mysqli_fetch_assoc($queryl)) {
                    $tt = $row_nb['tour_title'];
                    $price = $row_nb['tour_price'];
                    $tour_idnb = $row_nb['tour_id'];
                    $sqlnb = "select * from tour_images where tour_id=$tour_idnb";
                    $querynb = mysqli_query($conn, $sqlnb);
                    $row_img = mysqli_fetch_assoc($querynb);
                    $path = $row_img['tour_image'];
                    $rate = $row_nb['tour_discount_rate'];
                    $discount = $price * (100 - $rate) / 100;
                    $tour_id = $row_nb['tour_id'];
                    $sv = basename($_SERVER['PHP_SELF']);
                    if ($discount != $price)
                        echo "<div class='tour__son'><a href='./$sv?q=$tour_id'>
                        <img src='$path' alt=''></a>
                        <div class='tour__infor'> <h3><a href='./$sv?q=$tour_id' title='$tt' >$tt </a></h3> 
                        <span class='price'> " . number_format($discount, 0, '', '.') . " VNĐ</span> <span class='old__price'>" . number_format($price, 0, '', '.') . " VNĐ</span>  </div> </div> ";
                    else
                        echo "<div class='tour__son'>
                            <a href='./$sv?q=$tour_id'>
                                <img src='$path' alt=''>
                            </a>
                            <div class='tour__infor'>
                                <h3><a href='./$sv?q=$tour_id' title='$tt' >$tt</a></h3>
                                <span class='price'> " . number_format($price, 0, '', '.') . " VNĐ </span>
                            </div>
                         </div> ";

                    //gioi han hien thi 6 tour
                }
                ?>
            </div>
        </div>
    </div>
    <div class="hashtag">
        <div class="hashtag__head">
            <h3>Hashtag</h3>
        </div>
        <div class="hashtag__list">
            <?php
            for ($i = 0; $i < count($hashtag); $i++) {
                echo "<div class='hashtag__item'>
                <a href='./AllTour.php?filter=" . $hashtag[$i] . "'>#" . $hashtag[$i] . "</a>
                </div>";
            }
            ?>
        </div>
    </div>
    <div class="tourcl">
        <div class="tourcl__head">
            <h3>Tour cùng loại</h3>
        </div>
        <div class="tourcl__father">
            <?php
            $mien = $row['tour_region'];
            $querycl = "select * from tours where tour_region = '$mien' and tour_id != $id limit 3";
            $resultcl = mysqli_query($conn, $querycl);
            while ($row = mysqli_fetch_assoc($resultcl)) {
                $tt = $row['tour_title'];
                $price = $row['tour_price'];
                $rate = $row['tour_discount_rate'];
                $discount = $price - ($price * $rate) / 100;
                $tour_idnb = $row['tour_id'];
                $sqlnb = "select * from tour_images where tour_id=$tour_idnb";
                $querynb = mysqli_query($conn, $sqlnb);
                $row_img = mysqli_fetch_assoc($querynb);
                $path = $row_img['tour_image'];
                $sv = basename($_SERVER['PHP_SELF']);
                if ($rate != 0)
                    echo "<div class='tourcl__son'> <div class='img__'> <a href='./$sv?q=$tour_idnb'> <img src='$path' alt=''>   </a>
                <div class='chitiet'><a href='./$sv?q=$tour_idnb'> <button title='Chi tiết' type='button'> <span>Chi tiết</span></button> </a>
                </div> </div> <div class='tourcl__infor'> <h3><a href='./$sv?q=$tour_idnb' title='$tt'>$tt</a></h3> <span class='price'>" . number_format($discount, 0, '', '.') . " VNĐ</span> <span class='old__price' >" . number_format($price, 0, '', '.') . " VNĐ </span></div> 
                </div>";
                else
                    echo "<div class='tourcl__son'> <div class='img__'> <a href='./$sv?q=$tour_idnb'> <img src='$path' alt=''>   </a>
                <div class='chitiet'><a href='./$sv?q=$tour_idnb'>  <button title='Chi tiết' type='button'> <span>Chi tiết</span></button>   </a>
                </div> </div> <div class='tourcl__infor'> <h3><a href='./$sv?q=$tour_idnb' title='$tt'>$tt</a></h3> <span class='price'>" . number_format($price, 0, '', '.') . " VNĐ</span></div> 
                </div>";
            }
            ?>
        </div>
    </div>
    <div class="comment__container">
        <div class="comment__head">
            <h5>Bình luận</h5>
        </div>
        <!-- form coment -->
        <form action="" method="post" id="comment-form">
            <div class="comment__bag">
                <div class="comment__avt">
                    <img src="https://secure.gravatar.com/avatar/?s=56&d=mm&r=g" alt="avt">
                </div>
                <textarea id="comment" class="comment focus:outline-none " placeholder="Hãy nhập bình luận của bạn ở đây" name="comment" required></textarea>
            </div>

            <?php
            if (!isset($_SESSION['username'])) {
                echo '<div class="information">
                    <div class="name"> <label for="name">Name:</label><input class="focus:outline-none" type="text" id="name" name="name" required placeholder="Name"></div>
                    </div>';
            } else {
                echo '<div class="information" style="opacity: 0; visibility: hidden; display:none;"> 
                    <div class="name"> <label for="name">Name:</label><input class="focus:outline-none" type="text" id="name" value="' . $_SESSION['username'] . '" name="name" required placeholder="Name"></div>
                    </div>';
            }
            ?>

            <input type="submit" value="Bình luận" style="margin-top : 15px;">
        </form>
        <ul id="comment-list">
            <?php
            $sql = "SELECT * from comments where tour_id=$id ORDER BY comment_id DESC";
            $rsqr = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($rsqr)) {
                $name = $row['name_comment'];
                $comment = $row['comment_content'];
                echo " <li class='comment_item'><h4>$name</h4><div style='word-wrap:break-word'><p>$comment</p></div></li>";
            }
            ?>
        </ul>
        <script>
            // Hàm hiển thị danh sách bình luận
            window.onload=displayComments();
            function displayComments() {
            let allcomment = document.querySelectorAll('.comment_item');
            let commentList = document.querySelector('#comment-list');
            if (allcomment.length > 5) {
                for (let i = 5; i < allcomment.length; i++) {
                    allcomment[i].classList.add('hidden1');
                }
                commentList.innerHTML += '<div class="also"><button>Xem tất cả</button></div>';
                let alsobtn = document.querySelector('.also button');
                alsobtn.addEventListener('click', showAllComments);
            } else if (allcomment.length == 0) {
                commentList.innerHTML = '<li><h4 style="color:gray">chưa có bình luận nào</h4><p></p></li>';
            }

            function showAllComments() {
                let allcommentx = document.querySelectorAll('.hidden1');
                for (let i = 0; i < allcommentx.length; i++) {
                    allcommentx[i].classList.remove('hidden1');
                }
                this.remove();
                commentList.innerHTML += '<div class="btcollapse"><button>Thu gọn</button></div>'
                let btncollapse = document.querySelector('.btcollapse');
                btncollapse.addEventListener('click', collapComments);
            }
            function collapComments(){
                this.remove();
                let allcomment = document.querySelectorAll('.comment_item');
                for (let i = 5; i < allcomment.length; i++) {
                    allcomment[i].classList.add('hidden1');
                }
                commentList.innerHTML += '<div class="also"><button>Xem tất cả</button></div>';
                let alsobtn = document.querySelector('.also button');
                alsobtn.addEventListener('click', showAllComments);
            }
            }

            document.getElementById('comment-form').addEventListener('submit', (event) => {
                event.preventDefault(); //chặn sự kiện mặc định của form
                //tạo đối tượng XMLHttpRequest
                let xhr = new XMLHttpRequest();

                // gửi bằng phương thức post
                xhr.open('POST', '../controllers/process_comment.php', true);
                xhr.setRequestHeader("Content-type", "application/json");

                // định dạng dữ liệu thành chuỗi json
                var data = JSON.stringify({
                    name: document.getElementById('name').value,
                    comment: document.getElementById('comment').value,
                    id: document.getElementById('idtour').value,
                });
                xhr.onload = function() {
                    if (this.status == 200) {
                        let databack = JSON.parse(this.responseText);
                        let comment_list = document.getElementById('comment-list');
                        if (databack.length > 0) {
                            comment_list.innerHTML = '';
                            databack.forEach(function(item) {
                                let h4 = document.createElement('h4');
                                h4.innerHTML = item.name;
                                let p = document.createElement('p');
                                p.innerHTML = item.comment;
                                let div = document.createElement('div');
                                div.appendChild(p)
                                div.style.wordWrap = 'break-word';
                                let li = document.createElement('li');
                                li.classList.add('comment_item');
                                li.appendChild(h4);
                                li.appendChild(div);
                                comment_list.appendChild(li);
                            });
                            // xóa nội dung trong ô commnent
                            document.getElementById('comment').value = '';
                            document.getElementById('comment').focus();
                        }
                        displayComments();
                    }
                }
                xhr.send(data);
            })
        </script>
    </div>
    <?php include '../Components/Footer/Footer.php' ?>
    <?php include "../Components/Zalo.php" ?>
</body>

</html>