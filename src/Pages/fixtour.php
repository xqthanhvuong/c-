
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update tours</title>
    <link rel="icon" href="/web-tour/src/Image/logo.png" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family:  ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";;
        }
        input::-webkit-input-placeholder{
            font-family: 'Delicious Handrawn', cursive;
        }
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }
        .container {
            margin: 30px auto;

            padding: 30px;
            width: 700px !important;
            border: solid 1px #ccc;
            display: flex;
            flex-direction: column;
            box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.2);
            -webkit-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.2);
            -moz-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.2);
        }
        .container *{
            margin: 5px 5px 0 0;
        }
        input,select,textarea{
            border-bottom:rgba(0,0,0,0.17) solid 1px;
        }
        .money {
            display: flex;
        }
        .inp {
            display: flex;
            width: 100%;
            flex-direction:column ;
        }
        .transportation > div {
            display: flex;
            justify-content: space-around;
        }
        #submit {
            background: #0EA5E9;
            width: 150px;
            height: 40px;
            font-size: large;
            font-weight: bold;
            color: aliceblue;
            border-radius: 20px;
            margin: 35px;
            margin-top: 10px;
            margin-left: 0;
            transition: 0.05s ease-in-out;
        }
        .post #submit:hover {
            transform: scale(0.95);
        }

    </style>
    <script src="../Lib/ckeditor/ckeditor.js"></script>

</head>

<?php include '../Components/Header/Header.php';
      include '../config/connectDB.php';  
    if(isset($_GET['q'])){
        $sql='SELECT * FROM tours WHERE tour_id='.$_GET['q'];
        $rs=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($rs);
        $tour_title=$row['tour_title'];
        $tour_reviews=$row['tour_reviews'];
        $tour_price=$row['tour_price'];
        $tour_discount_rate=$row['tour_discount_rate'];
        $tour_quantity=$row['tour_quantity'];
        $tour_place=$row['tour_place'];
        $tour_region=$row['tour_region'];
        $tour_type=$row['tour_type'];
        $tour_times=$row['tour_times'];
        $tour_hashtag=$row['tour_hastag'];
        $sql='SELECT * FROM transportation WHERE tour_id='.$_GET['q'];
        $rs=mysqli_query($conn,$sql);
        $tour_trans=array();
        while($row=mysqli_fetch_assoc($rs)){
            $tour_trans[]=$row['transportation_name'];
        }
        $sql='SELECT * FROM tour_images WHERE tour_id='.$_GET['q'];
        $rs=mysqli_query($conn,$sql);
        $tour_img=array();
        $tour_img_id=array();
        while($row=mysqli_fetch_assoc($rs)){
            $tour_img[]=$row['tour_image'];
            $tour_img_id[]=$row['tour_image_id'];
        }
    }
    
?>  
<body>
    <form action="../controllers/fixtour.php?q=<?php echo $_GET['q']?>" method="POST" class="container" enctype="multipart/form-data">
         <h1 class="text-3xl text-sky-500 text-center font-bold mt-8  uppercase">update tour</h1>
        <div class="tourtt">
        <label for="tourtitle">
            Nhập tên tour:
            <span style="color: red;">*</span>
        </label>
        <input type="text" name="tourtitle" id="tourtitle" value="<?php echo $tour_title ?>" required placeholder="Tourname">
    </div>
    <div class="money">
    <div class="tourprice">
        <label for="tourprice">
            Nhập giá tiền:
            <span style="color: red;">*</span>
        </label>
        <input type="number" name="tourprice" id="tourprice" value="<?php echo $tour_price ?>" required placeholder="Tourprice">
    </div>
    <div class="discount">
        <label for="discount">
            Nhập giảm giá tính theo %(nếu có):
        </label>
        <input type="number" name="discount" id="discount"  placeholder="0%" value="<?php echo $tour_discount_rate ?>">
    </div>
    </div>
    <div class="quantity ">
        <label for="quantity">
            Nhập số lượng tour:
            <span style="color: red;">*</span>
        </label>
        <input type="number" name="quantity" id="quantity" value="<?php echo $tour_quantity ?>" required placeholder="0">
    </div>
    <div class="place inp">
        <label for="place">
            Nhập điểm đến:
            <span style="color: red;">*</span>
        </label>
        <input type="text" name="place" id="place" value="<?php echo $tour_place ?>" required placeholder="Tour_Place">
    </div>
    <div class="region inp">
        <label for="region">
            Chọn miền:
            <span style="color: red;">*</span>
        </label>
        <select name="region" id="region" required>
            <?php
            $regions = array("Miền Bắc", "Miền Trung", "Miền Nam");
            foreach($regions as $region){
                $selected="";
                if($region == $tour_region){
                    $selected="selected";
                }
                echo "<option $selected value='$region'>$region</option>";
            }
            ?>
        </select>
    </div>
    <div class="type inp">
        <label for="type">Chọn loại du lịch:
            <span style="color: red;">*</span>
        </label>
        <select name="type" id="type" required>
        <?php
            $types = array("Du lịch mạo hiểm", "Du lịch biển", "Du lịch thông thường");
            foreach($types as $type){
                $selected="";
                if($type == $tour_type){
                    $selected="selected";
                }
                echo "<option $selected value='$type'>$type</option>";
            }
            ?>
        </select>
    </div>
    <div class="times inp">
        <label for="times">
            Nhập số ngày đi:
            <span style="color: red;">*</span>
        </label>
        <input type="text" name="times" id="times" placeholder="VD:3 ngày 2 đêm" value="<?php echo $tour_times?>" required>
    </div>
    <div class="hashtag inp">
        <label for="hashtag">
            Nhập hashtag:
        </label>
        <input type="text" name="hashtag" id="hashtag" value="<?php echo $tour_hashtag  ?>" placeholder="Hashtag">
    </div>
    <div class="img" style="display: flex; flex-wrap:wrap">
        <?php
            for($i=0;$i<5;$i++){
                if(isset($tour_img[$i])){
                echo 
                '<div style="display:flex">
                <label for="img'.$i.'">
                Ảnh về tour :
                </label>
                <img src="'.$tour_img[$i].'" style="width:70px; height:50px" alt="">
                </div>
                <input type="file" class="inpimg" id="img'.$i.'" style="display: none;" name="img[]">
                <input type="hidden" name="imgold[]" value="'.$tour_img[$i].'">
                <input type="hidden" name="image_selected[]" class="check" value="0">
                <label for="img'.$i.'" style="display: block; width: 100px; height: 30px; line-height: 30px; background-color: gray; color: white; text-align: center; border-radius: 5px; cursor: pointer;">Choose File</label>';
                }
                else
                {  
                echo 
                '<div style="display:flex">
                <label for="im">
                Ảnh về tour :
                </label>
                <img src="" style="width:70px; height:50px" alt="">
                </div>
                <input type="file" class="inpimg" id="img'.$i.'" style="display: none;" name="img[]" accept="image/*">
                <input type="hidden" name="imgold[]" value=" ">
                <input type="hidden" name="image_selected[]" class="check" value="0">
                <label for="img'.$i.'" style="display: block; width: 100px; height: 30px; line-height: 30px; background-color: gray; color: white; text-align: center; border-radius: 5px; cursor: pointer;">Choose File</label>';
                }
            }
        ?>
        <script>
            const img = document.querySelectorAll('.inpimg')
            const check = document.querySelectorAll('.check');
            for(let i =0;i<img.length;i++){
                img[i].addEventListener('change',()=>{
                    if(img[i].value){
                        check[i].value= 1;
                    }
                    else{
                        check[i].value= 0;
                    }
                })
            }
        </script>

    </div>
    <div class="transportation">
        <label for="">
            Chọn phương tiện di chuyển:
            <span style="color: red;">*</span>
        </label>
        <br>
      <div>
      <?php
            $trans = array('Boat','Plane','Train','oto');
            $transport_list = array(
                'Boat' => '',
                'Plane' => '',
                'Train' => '',
                'Car' => '',
            );
            foreach($trans as $tran){
                foreach($tour_trans as $tour_tran){
                    if($tran==$tour_tran){
                        $transport_list["$tran"]='checked';
                    }
                }
            }
            ?>
        <div> <input type="checkbox" name="trans[]" <?php echo $transport_list['Boat'] ?> value="Boat" class="trans"> Thuyền</div>
        <div><input type="checkbox" name="trans[]" <?php echo $transport_list['Plane'] ?> value="Plane" class="trans"> Máy bay</div>
        <div> <input type="checkbox" name="trans[]" <?php echo $transport_list['Train'] ?> value="Train" class="trans"> Tàu hỏa</div>
        <div>  <input type="checkbox" name="trans[]" <?php echo $transport_list['Car'] ?> value="oto" class="trans"> Ô tô</div>
      </div>
    </div>
    <div class="err" style="color: red;"></div>
    <div class="review inp">
        <label for="editor1">Nhập nội dung tour: <span style="color: red;">*</span></label>
        <textarea name="review"  id="editor1" cols="30" rows="1"></textarea>
    </div>
    <script>
                CKEDITOR.replace( 'editor1' );
                var content = <?php echo json_encode($tour_reviews);?>;
                document.getElementById('editor1').value = content;
                 CKEDITOR.instances.editor1.setData(content);
     </script>

    <div class="post">
        <button type="submit" id="submit" class="uppercase">
            update
        </button>
    </div>

    <script>
        const trans=document.getElementsByClassName('trans');
        const submit = document.getElementById('submit');
        const err=document.querySelector('.err');
        const discount=document.getElementById('discount');
        const tourprice=document.getElementById('tourprice');
        const quantity=document.getElementById('quantity');
        quantity.addEventListener('change',()=>{
            if(quantity.value<0){
                quantity.value='';
            }
        })
        tourprice.addEventListener('change',()=>{
            if(tourprice.value<=0){
                tourprice.value='';
            }
        })
        discount.addEventListener('change',()=>{
            if(discount.value>=100){
                discount.value=99;
            }
            if(discount.value<0){
                discount.value='';
            }
        })
        submit.addEventListener('click',(event)=>{
            let check=false;
            Array.from(trans).forEach(function(element) {
            if(element.checked){
                check=true;
            }
          });
          if(!check){
            event.preventDefault();
            err.innerHTML='Hãy chọn ít nhất 1 trong các phương tiện trên';
          }
        })

    </script>



   </form>
    </body>
    <?php include '../Components/Footer/Footer.php'; ?>
</html>