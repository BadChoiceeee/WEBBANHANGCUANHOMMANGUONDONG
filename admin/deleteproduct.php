<?php

//lay id goi den
$delid = $_GET['id'];

//ket noi csdl
require('../db/connectDB.php');
//tìm các hình ảnh của sản phẩm và xóa
$sql1 = "select images from products where id=$delid";
$rs = mysqli_query($conn, $sql1);
$row = mysqli_fetch_assoc($rs);

//danh sach cac anh
$images_arr =  explode(';', $row['images']);
//print_r($images_arr); exit;
//xoa cac anh
foreach($images_arr as $img){
    unlink($img);
}

$sql_str = "delete from products where id=$delid";
mysqli_query($conn, $sql_str);

//trở về trang liệt kê brands
header("location: listsanpham.php");