<?php
function Get(string $sql)
{
    include "../config/connectDB.php";
    $tours_image = "SELECT tour_image_id, tour_id, tour_image FROM tour_images";
    $tour_trans = "SELECT transportation_name, tour_id FROM transportation";
    $result_tours = mysqli_query($conn, $sql);
    $result_tours_image = mysqli_query($conn, $tours_image);
    $result_trans = mysqli_query($conn, $tour_trans);
    $trans = array();
    $tours_image = array();

    if (mysqli_num_rows($result_tours_image) > 0) {
        while ($row = mysqli_fetch_assoc($result_tours_image)) {
            $tours_image[$row['tour_id']] = $row['tour_image'];
        }
    }
    if (mysqli_num_rows($result_trans) > 0) {
        while ($row = mysqli_fetch_array($result_trans)) {
            $tour_id = $row['tour_id'];
            $transportation_name = $row['transportation_name'];
            // Nếu mảng $trans chưa có phần tử tương ứng với tour_id
            // thì thêm phần tử đó vào mảng
            if (!isset($trans[$tour_id])) {
                $trans[$tour_id] = array();
            }

            // Thêm phương tiện vào mảng $trans tương ứng với tour_id
            array_push($trans[$tour_id], $transportation_name);
        }
    }
    return array($result_tours, $tours_image, $trans);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/web-tour/src/Image/logo.png" type="image/png">
    <title>Tour du lịch</title>
    <!-- Tailwind -->
    <script src="../Lib/tailwind.js"></script>
    <style>
        .clip-path {
            clip-path: polygon(0 0, 100% 0, 100% 100%, 50% 65%, 0 100%);
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
    </style>
</head>

<body>
    <?php include "../Components/Header/Header.php" ?>
    <div>
        <div class="my-5">
            <h1 class="font-bold text-sky-500 text-3xl text-center my-10">Tour du lịch</h1>
            <div class='flex'>
                <?php include "../Components/Filter.php" ?>
                <div>
                    <h2 class="font-bold text-xl uppercase block text-sky-500">Tour du lịch <?php echo isset($_GET['search']) ? $_GET['search'] : null ?></h2>
                    <div class="flex flex-wrap mt-2 tours" id="filter">
                        <?php
                        include "../config/connectDB.php";
                        $rs=mysqli_query($conn,"SELECT * FROM tours");
                        if(mysqli_num_rows($rs)>0){

                            if (isset($_GET['search'])) {
                                $search = $_GET['search'];
                                $tours_search = "SELECT tour_id, tour_title, tour_price, tour_discount_rate FROM tours WHERE tour_title LIKE '%$search%' OR tour_reviews LIKE '%$search%'  OR tour_times LIKE '%$search%' OR tour_type LIKE '%$search%' OR tour_place LIKE '%$search%'";
                            $result_tours = Get($tours_search)[0];
                            $tours_image = Get($tours_search)[1];
                            $trans = Get($tours_search)[2];
                            if (mysqli_num_rows($result_tours) > 0) {
                                while ($row = mysqli_fetch_assoc($result_tours)) {
                                    $transport = $trans[$row['tour_id']];
                                    if (array_key_exists($row['tour_id'], $tours_image)) {
                                        $image = $tours_image[$row['tour_id']];
                                    }
                                    $title = $row['tour_title'];
                                    $price = $row['tour_price'];
                                    $sale = $row['tour_discount_rate'];
                                    $id = $row['tour_id'];
                                    include "../Components/Item/Item1.php";
                                }
                            } else {
                                echo "<h1 class='text-center text-3xl text-red-500 my-10 uppercase font-bold w-full'>Không có tour nảo phù hợp!</h1>";
                            }
                        } else if (isset($_GET['filter'])) {
                            $filter = $_GET['filter'];
                            $tours_filter = "SELECT tour_id, tour_title, tour_price, tour_discount_rate FROM tours WHERE tour_hastag LIKE '%$filter%'";
                            $result_tours = Get($tours_filter)[0];
                            $tours_image = Get($tours_filter)[1];
                            $trans = Get($tours_filter)[2];
                            if (mysqli_num_rows($result_tours) > 0) {
                                while ($row = mysqli_fetch_assoc($result_tours)) {
                                    $transport = $trans[$row['tour_id']];
                                    if (array_key_exists($row['tour_id'], $tours_image)) {
                                        $image = $tours_image[$row['tour_id']];
                                    }
                                    $title = $row['tour_title'];
                                    $price = $row['tour_price'];
                                    $sale = $row['tour_discount_rate'];
                                    $id = $row['tour_id'];
                                    include "../Components/Item/Item1.php";
                                }
                            } else {
                                echo "<h1 class='text-center text-3xl text-red-500 my-10 uppercase font-bold w-full'>Không có tour nảo phù hợp!</h1>";
                            }
                        }
                        else {
                            $count = mysqli_query($conn, "SELECT COUNT(tour_id) as total FROM tours");
                            $row = mysqli_fetch_assoc($count);
                            $total_records = $row['total'];
                            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                            $limit = 6;
                            $total_page = ceil($total_records / $limit);
                            if ($current_page > $total_page) {
                                $current_page = $total_page;
                            } else if ($current_page < 1) {
                                $current_page = 1;
                            }
                            $start = ($current_page - 1) * $limit;
                            $tours = "SELECT tour_id, tour_title, tour_price, tour_discount_rate FROM tours LIMIT $start, $limit";
                            
                            $result_tours = Get($tours)[0];
                            $tour_image = Get($tours)[1];
                            $trans = Get($tours)[2];
                            
                            if (mysqli_num_rows($result_tours) > 0) {
                                while ($row = mysqli_fetch_assoc($result_tours)) {
                                    $transport = $trans[$row['tour_id']];
                                    if (array_key_exists($row['tour_id'], $tour_image)) {
                                        $image = $tour_image[$row['tour_id']];
                                    } else {
                                        $image = $transport[rand(0, 1)];
                                    }
                                    $title = $row['tour_title'];
                                    $price = $row['tour_price'];
                                    $sale = $row['tour_discount_rate'];
                                    $id = $row['tour_id'];
                                    include "../Components/Item/Item1.php";
                                }
                                echo ' <div class="w-full flex justify-center items-center"><div class="w-1/3 my-5 flex justify-between items-center">';
                                
                                echo ($current_page > 1 ? '<a href="AllTour.php?page=1" class="bg-sky-500 py-1 px-3 text-white rounded hover:opacity-70 mr-3">First</a> <a href="AllTour.php?page=' . $current_page - 1 . '" class="bg-sky-500 py-1 px-3 text-white rounded hover:opacity-70 mr-3">Prev</a>' : '');
                                
                                echo '<div class="flex items-center w-2/3 justify-between">';
                                
                                for ($i = 1; $i <= $total_page; $i++) {
                                    if ($i == $current_page) {
                                        echo '<a href="AllTour.php?page=' . $i . '" class="bg-sky-500 py-1 px-3 text-white rounded hover:opacity-70">' . $i . '</a>';
                                    } else {
                                        echo '<a href="AllTour.php?page=' . $i . '" class="bg-gray-200 py-1 px-3 text-black rounded hover:opacity-70">' . $i . '</a>';
                                    }
                                }
                                echo '
                                </div>';
                                echo ($current_page < $total_page ? '<a href="AllTour.php?page=' . $current_page + 1 . '" class="bg-sky-500 py-1 px-3 text-white rounded hover:opacity-70 ml-3">Next</a> <a href="AllTour.php?page=' . $total_page . '" class="bg-sky-500 py-1 px-3 text-white rounded hover:opacity-70 ml-3">Last</a>' : '');
                                
                                echo '</div></div>';
                            }
                        }
                    } else {
                        echo "<h1 class='text-center text-3xl text-red-500 my-10 uppercase font-bold w-full'>Không có tour nảo!!!</h1>";
                    }
                        mysqli_close($conn);
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <script src="../js/DeleteTour.js"></script>
        <?php include "../Components/Footer/Footer.php" ?>
        <?php include "../Components/Zalo.php" ?>
</body>

</html>