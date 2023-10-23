<?php
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
    $query="INSERT INTO tours (tour_title,tour_reviews,tour_price,tour_discount_rate,tour_quantity,tour_place,tour_region
    ,tour_type,tour_times,tour_hastag) VALUES (?,?,?,?,?,?,?,?,?,?)";
    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_bind_param($stmt, "ssiiisssss", $title, $review,$tourprice,$discount,$quantity,$place,$region,$type,$times,$hashtag);

    if(!mysqli_stmt_execute($stmt)){
        echo 'errol';
    }
    $tourid=mysqli_insert_id($conn);

    if(isset($_FILES['img']['name'])){
        for($i=0;$i<sizeof($_FILES['img']['name']);$i++){
            $target_dir = "../Image/library/";
            $target_file = $target_dir.rand(). basename($_FILES["img"]["name"][$i]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // Check if file already exists
            if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            exit();
            }
        
            // Check file size
            if ($_FILES["img"]["size"][$i] > 500000) {
            echo "Sorry, your file is too large.";
            exit();
            }
        
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
             echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
             exit();
            }

           if (!move_uploaded_file($_FILES["img"]["tmp_name"][$i], $target_file)) {
                    echo "Sorry, there was an error uploading your file.";
                } 
            else{
                $query="INSERT INTO tour_images (tour_id, tour_image) VALUE (?,?)";
                mysqli_stmt_prepare($stmt, $query);
                mysqli_stmt_bind_param($stmt,'is',$tourid,$target_file);
                if(!mysqli_stmt_execute($stmt)){
                    echo 'errol';
                }
            }
            }
            }

            foreach($_POST['trans'] as $trans){
                $query="INSERT INTO transportation (tour_id,transportation_name) VALUES(?,?);";
                mysqli_stmt_prepare($stmt,$query);
                mysqli_stmt_bind_param($stmt,'is',$tourid,$trans);
                if(!mysqli_stmt_execute($stmt)){
                    echo 'errol';
                }
            }
        header('location: ../pages/posttourwithform.php');
    }


?>