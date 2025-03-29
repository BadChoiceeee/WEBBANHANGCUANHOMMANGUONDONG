<?php
session_start();
require('../db/connectDB.php');

// Kiểm tra id hợp lệ
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID không hợp lệ!");
}
$id = (int) $_GET['id']; // Ép kiểu để đảm bảo id là số nguyên

// Lấy dữ liệu từ CSDL
$sql_str = "SELECT * FROM admins WHERE id=$id";
$res = mysqli_query($conn, $sql_str);
$admin = mysqli_fetch_assoc($res);

if (isset($_POST['btnUpdate'])) {
    // Lấy dữ liệu từ form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $type = $_POST['type'];

    // Cập nhật dữ liệu vào CSDL
    $sql_str2 = "UPDATE admins SET name='$name', email='$email', phone='$phone', address='$address', type='$type'";

    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql_str2 .= ", password='$hashed_password'";
    }

    $sql_str2 .= " WHERE id='$id'";

    if (mysqli_query($conn, $sql_str2)) {
        header("location: listusers.php");
        exit();
    } else {
        echo "Lỗi cập nhật: " . mysqli_error($conn);
    }
}

require('includes/header.php');

if ($_SESSION['user']['type'] != 'Admin') {
    echo "<h2>Bạn không có quyền truy cập nội dung này</h2>";
} else {
?>
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Cập nhật người quản trị</h1>
                            </div>
                            <form class="user" method="post" action="#">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="name" name="name" value="<?= htmlspecialchars($admin['name']) ?>" placeholder="Tên">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="email" name="email" value="<?= htmlspecialchars($admin['email']) ?>" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Nhập mật khẩu mới (nếu có)">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="phone" name="phone" value="<?= htmlspecialchars($admin['phone']) ?>" placeholder="Số điện thoại">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="address" name="address" value="<?= htmlspecialchars($admin['address']) ?>" placeholder="Địa chỉ">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Quyền:</label>
                                    <select class="form-control" name="type">
                                        <option>Chọn quyền</option>
                                        <option value="Admin" <?php if ($admin['type'] == 'Admin') echo "selected"; ?>>Quản trị</option>
                                        <option value="Staff" <?php if ($admin['type'] == 'Staff') echo "selected"; ?>>Nhân viên</option>
                                    </select>
                                </div>
                                <button class="btn btn-primary" name="btnUpdate">Cập nhật</button>
                            </form>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
require('includes/footer.php');
?>
