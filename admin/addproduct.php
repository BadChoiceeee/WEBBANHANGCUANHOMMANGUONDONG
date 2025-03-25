<?php
require('../db/connectDB.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $slug_base = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));
    $slug = $slug_base;

    // Kiểm tra slug có bị trùng không, nếu trùng thì thêm số phía sau
    $count = 1;
    while (mysqli_num_rows(mysqli_query($conn, "SELECT id FROM products WHERE slug = '$slug'")) > 0) {
        $slug = $slug_base . '-' . $count;
        $count++;
    }

    $sumary = mysqli_real_escape_string($conn, $_POST['sumary']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $stock = isset($_POST['stock']) ? intval($_POST['stock']) : 0;
    $giagoc = isset($_POST['giagoc']) ? floatval($_POST['giagoc']) : 0;
    $giaban = isset($_POST['giaban']) ? floatval($_POST['giaban']) : 0;
    $danhmuc = isset($_POST['danhmuc']) ? intval($_POST['danhmuc']) : 0;
    $thuonghieu = isset($_POST['thuonghieu']) ? intval($_POST['thuonghieu']) : 0;

    // Xử lý hình ảnh
    $imgs = '';
    if (isset($_FILES['anhs']) && !empty($_FILES['anhs']['name'][0])) {
        $uploadDir = "uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0775, true); // Tạo thư mục nếu chưa có
        }

        $countfiles = count($_FILES['anhs']['name']);
        for ($i = 0; $i < $countfiles; $i++) {
            $filename = $_FILES['anhs']['name'][$i];
            $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            $valid_extensions = array("jpg", "jpeg", "png");

            if (in_array($extension, $valid_extensions)) {
                $newFileName = uniqid() . "_" . $filename;
                $targetFilePath = $uploadDir . $newFileName;

                if (move_uploaded_file($_FILES['anhs']['tmp_name'][$i], $targetFilePath)) {
                    $imgs .= $targetFilePath . ";";
                }
            }
        }
        $imgs = rtrim($imgs, ";");
    }

    // Thêm sản phẩm vào database (Sửa lỗi tên cột `discounted_price`)
    $sql_str = "INSERT INTO `products` (`id`, `name`, `slug`, `description`, `summary`, `stock`, `price`, `disscounted_price`, `images`, `category_id`, `brand_id`, `status`, `created_at`, `updated_at`) 
                VALUES (NULL, '$name', '$slug', '$description', '$sumary', '$stock', '$giagoc', '$giaban', '$imgs', '$danhmuc', '$thuonghieu', 'Active', NOW(), NOW());";
    
    if (!mysqli_query($conn, $sql_str)) {
        die("Lỗi SQL: " . mysqli_error($conn));
    }

    // Chuyển hướng khi thêm thành công
    header("Location: ./listsanpham.php");
    exit();
}
?>
