<?php
if(isset($_GET['q'])){
    if(isset($_POST['tourtitle'])){
        include '../config/connectDB.php';
        $title=$_POST['tourtitle'];
        $tourprice=$_POST['tourprice'];
        $discount=$_POST['discount'];
        $quantity=$_POST['quantity'];
        $place=$_POST['place'];
        $region=$_POST['region'];
        $type=$_POST['type'];
        $times=$_POST['times'];
        $review=$_POST['review'];
        $hashtag=$_POST['hashtag'];
        $stmt=mysqli_stmt_init($conn);
        $tour_id=$_GET['q'];
        $query="UPDATE tours 
        SET tour_title=?, tour_reviews=?, tour_price=? ,tour_discount_rate=? ,tour_quantity=? ,tour_place=? ,tour_region=? ,tour_type=? ,tour_times=? ,tour_hastag=? 
        WHERE
        tour_id = ?";
        mysqli_stmt_prepare($stmt, $query);
        mysqli_stmt_bind_param($stmt, "ssiiisssssi", $title, $review,$tourprice,$discount,$quantity,$place,$region,$type,$times,$hashtag,$tour_id);
    
        if(!mysqli_stmt_execute($stmt)){
            echo 'errol';
        }

        //xử lý phương tiện
        mysqli_query($conn,'DELETE FROM transportation where tour_id='.$tour_id);
        foreach($_POST['trans'] as $trans){
            $query="INSERT INTO transportation (tour_id,transportation_name) VALUES(?,?);";
            mysqli_stmt_prepare($stmt,$query);
            mysqli_stmt_bind_param($stmt,'is',$tour_id,$trans);
            if(!mysqli_stmt_execute($stmt)){
                echo 'errol';
            }
        }



        //xử lý ảnh 
        $imageSelected = $_POST['image_selected'];
        $newImages = $_FILES['img'];
        $target_dir = "../Image/library/";
        for ($i = 0, $j=0; $i < count($imageSelected); $i++) {
            $imgold = $_POST['imgold'][$i];
            $isSelected = $imageSelected[$i];
            if ($isSelected == "1") {
                $newImage = $newImages['tmp_name'][$j];
                $target_file = $target_dir.rand(). basename($newImages["name"][$j]);
                $j++;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                if ($newImages["size"][$j] > 500000) {
                    echo "Sorry, your file is too large.";
                    exit();
                    }
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" ) {
                     echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                     exit();
                    }
                    if (!move_uploaded_file($newImage , $target_file)) {
                        echo "Sorry, there was an error uploading your file.";
                    }
                    else{
                        if($imgold != ' '){
                            $query="UPDATE tour_images SET tour_image = ? WHERE tour_image = ?";
                            mysqli_stmt_prepare($stmt, $query);
                            mysqli_stmt_bind_param($stmt,'ss',$target_file,$imgold);
                            if(!mysqli_stmt_execute($stmt)){
                                echo 'errol';
                            }
                            if (file_exists($imgold)) {
                                unlink($imgold);
                            }
                        }
                        else{
                            $query="INSERT INTO tour_images (tour_id, tour_image) VALUE (?,?)";
                            mysqli_stmt_prepare($stmt, $query);
                            mysqli_stmt_bind_param($stmt,'is',$tour_id,$target_file);
                            if(!mysqli_stmt_execute($stmt)){
                                echo 'errol';
                            }
                        }
                    }
            
            }
        }
        header('location: ../pages/posttourwithform.php');



    }
}
?>