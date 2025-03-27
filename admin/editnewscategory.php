<?php
session_start();

// Lấy ID danh mục từ URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Kết nối CSDL
require('../db/connectDB.php');

// Truy vấn thông tin danh mục
$sql_str = "SELECT * FROM newscategories WHERE id = $id";
$res = mysqli_query($conn, $sql_str);

if (!$res || mysqli_num_rows($res) == 0) {
    $_SESSION['error_message'] = "Danh mục không tồn tại!";
    header("location: ./listnewscats.php");
    exit();
}

$cat = mysqli_fetch_assoc($res);

// Xử lý cập nhật
if (isset($_POST['btnUpdate'])) {
    $name = trim($_POST['name']);
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));

    if (!empty($name)) {
        $sql_str2 = "UPDATE newscategories SET name='$name', slug='$slug' WHERE id=$id";

        if (mysqli_query($conn, $sql_str2)) {
            $_SESSION['success_message'] = "Cập nhật danh mục thành công!";
        } else {
            $_SESSION['error_message'] = "Lỗi cập nhật: " . mysqli_error($conn);
        }
    } else {
        $_SESSION['error_message'] = "Tên danh mục không được để trống!";
    }

    // Giữ nguyên trang để hiển thị thông báo
    header("location: ".$_SERVER['PHP_SELF']."?id=".$id);
    exit();
}

require('includes/header.php');
?>

<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Cập nhật danh mục tin tức</h1>
                        </div>

                        <!-- Hiển thị thông báo -->
                        <?php if (isset($_SESSION['success_message'])): ?>
                            <div class="alert alert-success text-center">
                                <?= $_SESSION['success_message']; unset($_SESSION['success_message']); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['error_message'])): ?>
                            <div class="alert alert-danger text-center">
                                <?= $_SESSION['error_message']; unset($_SESSION['error_message']); ?>
                            </div>
                        <?php endif; ?>

                        <form class="user" method="post" action="">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="name" name="name"
                                    placeholder="Tên danh mục tin tức" value="<?= htmlspecialchars($cat['name']); ?>">
                            </div>
                            <button class="btn btn-primary" name="btnUpdate">Cập nhật</button>
                            <a href="./listnewscats.php" class="btn btn-secondary">Đóng</a>
                        </form>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require('includes/footer.php'); ?>
