
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post tour with form</title>
    <link rel="icon" href="/web-tour/src/Image/logo.png" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <script src="../Lib/ckeditor/ckeditor.js"></script>
    <link rel="stylesheet" href="../css/stylePostTour.css">

</head>

<?php include '../Components/Header/Header.php'; ?>  

<body>
    <form action="../controllers/PostTourWithForm.php" method="POST" class="container" enctype="multipart/form-data">
        
         <h1 class="text-3xl text-sky-500 text-center font-bold mt-8  uppercase">Post tour</h1>
        <div class="tourtt">
        <label for="tourtitle">
            Nhập tên tour:
            <span style="color: red;">*</span>
        </label>
        <input type="text" name="tourtitle" id="tourtitle" required placeholder="Tourname">
    </div>
    <div class="money">
    <div class="tourprice">
        <label for="tourprice">
            Nhập giá tiền:
            <span style="color: red;">*</span>
        </label>
        <input type="number" name="tourprice" id="tourprice" required placeholder="Tourprice">
    </div>
    <div class="discount">
        <label for="discount">
            Nhập giảm giá tính theo %(nếu có):
        </label>
        <input type="number" name="discount" id="discount" placeholder="0%" value="0">
    </div>
    </div>
    <div class="quantity ">
        <label for="quantity">
            Nhập số lượng tour:
            <span style="color: red;">*</span>
        </label>
        <input type="number" name="quantity" id="quantity" required placeholder="0">
    </div>
    <div class="place inp">
        <label for="place">
            Nhập điểm đến:
            <span style="color: red;">*</span>
        </label>
        <input type="text" name="place" id="place" required placeholder="Tour_Place">
    </div>
    <div class="region inp">
        <label for="region">
            Chọn miền:
            <span style="color: red;">*</span>
        </label>
        <select name="region" id="region" required>
            <option value="" selected>Choose</option>
            <option value="Miền Bắc">Miền Bắc</option>
            <option value="Miền Trung">Miền Trung</option>
            <option value="Miền Nam">Miền Nam</option>
        </select>
    </div>
    <div class="type inp">
        <label for="type">Chọn loại du lịch:
            <span style="color: red;">*</span>
        </label>
        <select name="type" id="type" required>
            <option value="" selected>Choose</option>
            <option value="Du lịch mạo hiểm">Du lịch mạo hiểm</option>
            <option value="Du lịch biển">Du lịch biển</option>
            <option value="Du lịch thông thường">Du lịch thông thường</option>
        </select>
    </div>
    <div class="times inp">
        <label for="times">
            Nhập số ngày đi:
            <span style="color: red;">*</span>
        </label>
        <input type="text" name="times" id="times" placeholder="VD:3 ngày 2 đêm" required>
    </div>
    <div class="hashtag inp">
        <label for="hashtag">
            Nhập hashtag:
        </label>
        <input type="text" name="hashtag" id="hashtag" placeholder="Hashtag">
    </div>
    <div class="img">
        <label for="img">
            Ảnh về tour :
        </label>
        <input type="file" id="img" name="img[]" multiple>
    </div>
    <div class="transportation">
        <label for="">
            Chọn phương tiện di chuyển:
            <span style="color: red;">*</span>
        </label>
        <br>
      <div>
        <div> <input type="checkbox" name="trans[]" value="Boat" class="trans"> Thuyền</div>
        <div><input type="checkbox" name="trans[]" value="Plane" class="trans"> Máy bay</div>
        <div> <input type="checkbox" name="trans[]" value="Train" class="trans"> Tàu hỏa</div>
        <div>  <input type="checkbox" name="trans[]" value="oto" class="trans"> Ô tô</div>
      </div>
    </div>
    <div class="err" style="color: red;"></div>
    <div class="review inp">
        <label for="editor1">Nhập nội dung tour: <span style="color: red;">*</span></label>
        <textarea name="review"  id="editor1" cols="30" rows="1"></textarea>
    </div>
    <script>
                CKEDITOR.replace( 'editor1' );
     </script>

    <div class="post">
        <button type="submit" id="submit" class="uppercase">
            Post tour
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