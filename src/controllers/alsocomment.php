<?php 
    include '../config/connectDB.php';
    if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sql="SELECT * from comments where tour_id=$id ORDER BY comment_id DESC";
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
?>