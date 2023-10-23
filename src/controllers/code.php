<?php
session_start();
include "../config/connectDB.php";
include "mail/PHPMailer/src/PHPMailer.php";
include "mail/PHPMailer/src/Exception.php";
include "mail/PHPMailer/src/OAuth.php";
include "mail/PHPMailer/src/POP3.php";
include "mail/PHPMailer/src/SMTP.php";
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if(isset($_POST['mail']) && isset($_POST['name']))
{   
    $userid=$_SESSION['user_id'];
    $gmail = $_POST['gmail'];
    $name = $_POST['name'];
    $phone = $_POST['number'];
    $addres = $_POST['diachi'];
    $city = $_POST['city'];
    $district = $_POST['district'];
    $ward = $_POST['ward'];
    $order_address=$addres.'-'.$ward.'-'.$district.'-'.$city;
    $order_date= date('Y-m-d');
    $rs=mysqli_query($conn,"SELECT * FROM cart JOIN tours ON cart.tour_id=tours.tour_id WHERE user_id = ".$userid);
    $order_total_price=0;
    $mail_content='';
    while($row=mysqli_fetch_assoc($rs)){
        $price = $row['tour_price']*((100-$row['tour_discount_rate'])/100)*$row['cart_quantity'];
        $order_total_price +=$price;
        $mail_content.=$row['tour_title'].'<br> với số lượng đặt là:'.$row['cart_quantity'].'<br> giá: '.$row['tour_price']*((100-$row['tour_discount_rate'])/100).'<br> ngày khởi hành: '.$row['date_start'].'<br>';
    }
    mysqli_query($conn,"INSERT INTO orders(order_name,order_phone,order_email,order_address,order_date,order_total_price)
     VALUES('$name','$phone','$gmail','$order_address','$order_date',$order_total_price)");
    $order_id=mysqli_insert_id($conn);
    $rs=mysqli_query($conn,"SELECT * from cart where user_id=".$userid);
    while($row=mysqli_fetch_assoc($rs)){
    $tour_id=$row['tour_id'];
    $order_quantity_person=$row['cart_quantity'];
    $order_date_start=$row['date_start'];
    mysqli_query($conn,"INSERT INTO detail__orders(order_id,tour_id,order_quantity_person,order_date_start) 
    VALUE($order_id,$tour_id,$order_quantity_person,'$order_date_start')");
    }
    mysqli_query($conn,"DELETE FROM cart WHERE user_id=".$userid);

    $mail = new PHPMailer(true);                           
    try {
    $mail->SMTPDebug = 0;                                 
    $mail->isSMTP();                                     
    $mail->Host = 'smtp.gmail.com'; 
    $mail->SMTPAuth = true;                             
    $mail->Username = 'epicescapesnews@gmail.com';                 
    $mail->Password = 'zrtoehywklazjaui';                          
    $mail->SMTPSecure = 'tls';                           
    $mail->Port = 587;                                   
    $mail->setFrom('epicescapesnews@gmail.com', 'Epic Escapes');
    $mail->addAddress($gmail, $name);     
    $mail->isHTML(true);
    $mail->CharSet='UTF-8';                                  
    $mail->Subject ='Xin chào '.$name.', Quý khách đã đặt tour du lịch ở Epic Escapes';
    $mail->Body    = 'Nội dung các tour bạn đặt là : <br>'.$mail_content.'Tổng số tiền phải trả : '.$order_total_price.'<br> Mong quý khách chú ý thời gian khởi hành. <br> Kích chúc quý khách có chuyến đi vui vẻ!!!';
    $mail->send();
    echo '<script>
    alert("bạn đã đặt hàng thành công");
    window.location.href="/web-tour/index.php"
</script>';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
}
?>

