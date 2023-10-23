<?php
if (!function_exists('create_slug')) {
    function create_slug($string)
    {
        $search = array(
            '#(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#',
            '#(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#',
            '#(ì|í|ị|ỉ|ĩ)#',
            '#(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#',
            '#(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#',
            '#(ỳ|ý|ỵ|ỷ|ỹ)#',
            '#(đ)#',
            '#(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#',
            '#(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#',
            '#(Ì|Í|Ị|Ỉ|Ĩ)#',
            '#(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#',
            '#(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#',
            '#(Ỳ|Ý|Ỵ|Ỷ|Ỹ)#',
            '#(Đ)#',
            "/[^a-zA-Z0-9\-\_]/",
        );
        $replace = array(
            'a',
            'e',
            'i',
            'o',
            'u',
            'y',
            'd',
            'A',
            'E',
            'I',
            'O',
            'U',
            'Y',
            'D',
            '-',
        );
        $string = preg_replace($search, $replace, $string);
        $string = preg_replace('/(-)+/', '-', $string);
        $string = strtolower($string);
        return $string;
    }
}
?>
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
<div class="xl:w-96 sm:w-10/12 md:w-1/3 h-96 border-2 drop-shadow my-5 mx-2">
    <div class="relative group">
        <?php
        if ($sale != 0) {
            echo '<div class="absolute top-0 left-3 bg-red-600 h-14 w-12 text-white pl-3 pt-2 clip-path">
                            ' . str_pad($sale, 2, '0', STR_PAD_LEFT) . '%
                            </div>';
        }
        ?>
        <div class="group">
            <img class="h-64 w-full" src=<?php echo $image ?> alt="place">
            <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-50 transition duration-500 ease-in-out">
            </div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                <div class="flex">
                    <button class="hidden group-hover:block w-24 h-8 rounded-3xl bg-sky-500 p-1 text-sm text-white font-semibold animation-btn">
                        <a href="/web-tour/src/Pages/DetailTour.php?q=<?php echo $id ?>">Chi tiết</a>
                    </button>
                    <?php
                    echo $status_login && $role === 'admin' ? '<button class="hidden group-hover:block w-24 h-8 rounded-3xl bg-sky-500 p-1 text-sm text-white font-semibold animation-btn">
                                    <a href="/web-tour/src/Pages/fixtour.php?q=' . $id . '">Sửa</a></button>' : '';
                    ?>
                </div>
                <div class="flex justify-center">
                    <?php
                    echo $status_login && $role === 'admin' ? '<button class="hidden group-hover:block w-24 h-8 rounded-3xl bg-sky-500 p-1 text-sm text-white font-semibold animation-btn">
                                    <a class="btndelete" href="/web-tour/src/controllers/Deletetour.php?q=' . $id . '">Xóa</a></button>' : '';
                    ?>
                </div>


            </div>
        </div>
        <div class="absolute bottom-3 right-3 flex">
            <?php
            foreach ($transport as $item) {
                if (strcmp($item, "train") == 0) {
                    echo '<div class="bg-white p-1 mr-2">
                                        <img
                                        src="https://bizweb.dktcdn.net/100/315/268/themes/857513/assets/tag_icon_1.png?1671122588148"
                                        alt="transport">
                                     </div>';
                }
                if (strcmp($item, "Plane") == 0) {
                    echo '<div class="bg-white p-1 mr-2">
                                        <img
                                        src="https://bizweb.dktcdn.net/100/315/268/themes/857513/assets/tag_icon_3.png?1671122588148"
                                        alt="transport">
                                    </div>';
                }
                if (strcmp($item, "ship") == 0) {
                    echo '<div class="bg-white p-1 mr-2">
                                        <img
                                        src="https://bizweb.dktcdn.net/100/315/268/themes/857513/assets/tag_icon_2.png?1671122588148"
                                        alt="transport">
                                    </div>';
                }
            }
            ?>
        </div>
    </div>
    <a href="#" title="<?php echo $title ?>" class="xl:text-base font-semibold p-2 truncate block cursor-pointer hover:text-sky-500">
        <?php echo $title ?>
    </a>
    <div class="flex border-t-2 p-1 mx-3 drop-shadow-none mt-4">
        <p class="xl:text-2xl text-sky-500 font-semibold mr-3 mt-2">
            <?php echo number_format($price - ($price * ($sale / 100)), 0, '', '.') ?> VNĐ
        </p>
        <?php
        if ($sale != 0) {
            echo '<p class="text-sm leading-8 text-gray-400 line-through mt-3">' . number_format($price, 0, '', '.') . 'VNĐ</p>';
        }
        ?>
    </div>
</div>