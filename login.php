<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
$php_errormsg = "";
if(isset($_POST['btSubmit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    require_once('./db/connectDB.php');
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user'] = $row;
        header('Location: http://localhost:8000/index.php');
        exit;
    } else {
        $php_errormsg = "Sai email hoặc mật khẩu!";
        require_once('loginform.php');
    }
}else{
    require_once('loginform.php');
} ?>