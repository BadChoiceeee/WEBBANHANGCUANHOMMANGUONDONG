<?php
session_start();

// Lấy ID tin tức từ URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Kết nối CSDL
require('../db/connectDB.php');

// Truy vấn tin tức
$sql_str = "SELECT * FROM news WHERE id = $id";
$res = mysqli_query($conn, $sql_str);

if (!$res || mysqli_num_rows($res) == 0) {
    $_SESSION['error_message'] = "Tin tức không tồn tại!";
    header("location: ./listnews.php");
    exit();
}

$news = mysqli_fetch_assoc($res);

// Xử lý cập nhật tin tức
if (isset($_POST['btnUpdate'])) {
    $name = trim($_POST['title']);
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));
    $summary = trim($_POST['summary']);
    $description = trim($_POST['description']);
    $danhmuc = intval($_POST['danhmuc']);

    // Kiểm tra nếu có tải ảnh mới
    if (!empty($_FILES['anh']['name'])) {
        // Xóa ảnh cũ
        if (!empty($news['avatar']) && file_exists($news['avatar'])) {
            unlink($news['avatar']);
        }

        // Xử lý upload ảnh mới
        $filename = $_FILES['anh']['name'];
        $location = "uploads/news/" . uniqid() . $filename;
        $extension = strtolower(pathinfo($location, PATHINFO_EXTENSION));
        $valid_extensions = array("jpg", "jpeg", "png");

        if (in_array($extension, $valid_extensions)) {
            if (move_uploaded_file($_FILES['anh']['tmp_name'], $location)) {
                $sql_update = "UPDATE news SET 
                    title='$name', 
                    slug='$slug', 
                    description='$description', 
                    sumary='$summary', 
                    avatar='$location', 
                    newscategory_id=$danhmuc, 
                    updated_at=NOW() 
                    WHERE id=$id";
            }
        }
    } else {
        // Cập nhật nếu không thay đổi ảnh
        $sql_update = "UPDATE news SET 
            title='$name', 
            slug='$slug', 
            description='$description', 
            sumary='$summary', 
            newscategory_id=$danhmuc, 
            updated_at=NOW() 
            WHERE id=$id";
    }

    // Thực thi câu lệnh SQL
    if (mysqli_query($conn, $sql_update)) {
        $_SESSION['success_message'] = "Cập nhật tin tức thành công!";
    } else {
        $_SESSION['error_message'] = "Lỗi cập nhật: " . mysqli_error($conn);
    }

    // Giữ nguyên trang để hiển thị thông báo
    header("location: " . $_SERVER['PHP_SELF'] . "?id=" . $id);
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
                            <h1 class="h4 text-gray-900 mb-4">Cập nhật tin tức</h1>
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

                        <form class="user" method="post" action="" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="title" name="title"
                                    placeholder="Tên tin tức" value="<?= htmlspecialchars($news['title']); ?>">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Ảnh đại diện</label>
                                <input type="file" class="form-control form-control-user" id="anh" name="anh">
                                <br> Ảnh hiện tại:
                                <img src="<?= $news['avatar']; ?>" height="100px" />
                            </div>

                            <div class="form-group">
                                <label class="form-label">Tóm tắt tin:</label>
                                <textarea name="summary" class="form-control"
                                    placeholder="Nhập..."><?= htmlspecialchars($news['sumary']); ?></textarea>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Nội dung tin:</label>
                                <textarea name="description" class="form-control"
                                    placeholder="Nhập..."><?= htmlspecialchars($news['description']); ?></textarea>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Danh mục tin tức:</label>
                                <select class="form-control" name="danhmuc">
                                    <option>Chọn danh mục</option>
                                    <?php 
                                        $sql_category = "SELECT * FROM newscategories ORDER BY name";
                                        $result = mysqli_query($conn, $sql_category);
                                        while ($row = mysqli_fetch_assoc($result)){
                                    ?>
                                        <option value="<?= $row['id']; ?>"
                                            <?= ($row['id'] == $news['newscategory_id']) ? "selected" : ""; ?>>
                                            <?= htmlspecialchars($row['name']); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <button class="btn btn-primary" name="btnUpdate">Cập nhật</button>
                            <a href="./listnews.php" class="btn btn-secondary">Đóng</a>
                        </form>
                        <hr>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
