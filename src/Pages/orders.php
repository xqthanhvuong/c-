<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/web-tour/src/Lib/tailwind.js"></script>
    <link rel="icon" href="/web-tour/src/Image/logo.png" type="image/png">
    <title>Đơn đặt hàng</title>
</head>

<body>
    <?php include "../Components/Header/Header.php" ?>
    <div class="mx-32 my-7">
        <h1 class="text-sky-500 text-center text-3xl font-semibold my-5">Đơn đặt hàng</h1>
            <?php
            include "../config/connectDB.php";
            $sql = "SELECT 
                tours.tour_id, 
                tours.tour_title, 
                orders.order_id,
                orders.order_name, 
                orders.order_phone,
                orders.order_email,
                orders.order_address,
                orders.order_date,
                detail__orders.order_quantity_person,
                detail__orders.order_date_start,
                orders.order_total_price FROM detail__orders inner join tours on detail__orders.tour_id = tours.tour_id join orders on detail__orders.order_id=orders.order_id";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                echo "
                        <table class='table-auto border w-full border-collapse'>
                        <thead class=' bg-gray-100 '>
                            <tr>
                                <th class='w-10 py-1 px-1 border'>STT</th>
                                <th class='w-2/12 py-1 px-1 border'>Tên khách hàng</th>
                                <th class='w-2/12 py-1 px-1 border'>Địa chỉ</th>
                                <th class='w-1/12 py-1 px-1 border'>Số điện thoại</th>
                                <th class='w-2/12 py-1 px-1 border'>Tên tour</th>
                                <th class='w-1/12 py-1 px-1 border'>Số người đi</th>
                                <th class='w-1/12 py-1 px-1 border'>Ngày đi</th>
                                <th class='w-1/12 py-1 px-1 border'>Ngày đặt hàng</th>
                                <th class='w-1/12 py-1 px-1 border'>Tổng tiền</th>
                                <th class='w-1/12 py-1 px-1 border'>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                    ";
                $i = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td class='w-10 py-1 px-1 text-center'>" . $i++ . "</td>";
                    echo "<td class='w-2/12 py-1 px-1 text-center'>" . $row['order_name'] . "</td>";
                    echo "<td class='w-2/12 py-1 px-1 truncate max-w-xs text-center'>" . $row['order_address'] . "</td>";
                    echo "<td class='w-1/12 py-1 px-1 text-center'>" . $row['order_phone'] . "</td>";
                    echo "<td class='w-2/12 py-1 px-1 truncate max-w-xs'>" . $row['tour_title'] . "</td>";
                    echo "<td class='w-1/12 py-1 px-1 text-center'>" . $row['order_quantity_person'] . "</td>";
                    echo "<td class='w-1/12 py-1 px-1 text-center'>" . $row['order_date_start'] . "</td>";
                    echo "<td class='w-1/12 py-1 px-1 text-center'>" . $row['order_date'] . "</td>";
                    echo "<td class='w-1/12 py-1 px-1 text-center'>" . $row['order_total_price'] . "</td>";
                    echo "<td>
                            <a href='/web-tour/Orders/Detail' class='text-sky-500 hover:text-red-500'>Chi tiết</a>
                            <span class='text-sky-500 hover:text-red-500'>|</span>
                            <a href='/web-tour/src/controllers/deleteOrder.php?id=" . $row['order_id'] . "' class='text-sky-500 hover:text-red-500'>Xóa</a>
                        </td>";
                    echo "</tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<h1 class='text-center my-5 text-5xl text-red-500'></h1>Hiện chưa có đơn hàng</h1>";
            }
            ?>
        </table>
    </div>
    <?php include "../Components/Footer/Footer.php" ?>
    <?php include "../Components/Zalo.php" ?>
</body>

</html>