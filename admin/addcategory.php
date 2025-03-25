<?php
require('../db/connectDB.php');

$name = $_POST['name'];
$slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));

// Kiểm tra xem slug đã tồn tại chưa
$check_query = "SELECT * FROM categories WHERE slug = '$slug'";
$result = mysqli_query($conn, $check_query);

if (mysqli_num_rows($result) > 0) {
    echo "Lỗi: Danh mục đã tồn tại!";
} else {
    $sql_str = "INSERT INTO categories (name, slug, status) VALUES ('$name', '$slug', 'Active')";
    if (mysqli_query($conn, $sql_str)) {
        header("Location: listcategories.php");
        exit();
    } else {
        echo "Lỗi khi thêm danh mục: " . mysqli_error($conn);
    }
}

?>
