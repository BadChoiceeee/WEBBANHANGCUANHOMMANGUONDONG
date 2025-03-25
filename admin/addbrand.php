<?php
require('../db/connectDB.php');


    $name =  $_POST['name'];
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));

   

    // Thêm sản phẩm vào database (Sửa lỗi tên cột `discounted_price`)
    $sql_str = "INSERT INTO `brands` (`name`, `slug`, `status`) 
VALUES ('$name', '$slug', 'Active');";
    
    mysqli_query($conn, $sql_str);
       
    // Chuyển hướng khi thêm thành công
    header("location: listbrands.php");

?>
