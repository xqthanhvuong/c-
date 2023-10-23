<?php       
            $data=json_decode(file_get_contents('php://input'),true);
            include '../config/connectDB.php';
            include '../function/function.php';
            $comment=test_input($data['comment']);
            $name=test_input($data['name']);
            $id=test_input($data['id']);
            $stmt=mysqli_stmt_init($conn);
            if($comment && $name && $id){
                $query='INSERT INTO comments (comment_content,name_comment,tour_id,comment_date) VALUES (?,?,?,NOw())';
                mysqli_stmt_prepare($stmt,$query);
                mysqli_stmt_bind_param($stmt,'ssi',$comment,$name,$id);
                mysqli_stmt_execute($stmt);
            }
            if(mysqli_stmt_affected_rows($stmt)>0){
            $sql="SELECT * from comments where tour_id=$id ORDER BY comment_id DESC ";
    
            $rsqr=mysqli_query($conn,$sql);
            $rs=array();
            while($row=mysqli_fetch_assoc($rsqr)){
                $rs[]=array(
                    'name'=>$row['name_comment'],
                    'comment'=>$row['comment_content']
                );
            }
            echo json_encode($rs);
        }
            // header("location: ../Pages/DetailTour.php?id=$id");
        ?>