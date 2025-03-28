<?php
session_start();
$php_errormsg = "";
if(isset($_POST['btSubmit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    require_once('../db/connectDB.php');

    $sql = "SELECT * FROM admins WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user'] = $row;
        header('Location: index.php');
    } else {
        $php_errormsg = "Sai email hoặc mật khẩu!";
        require_once('includes/loginform.php');
    }
}else{
    require_once('includes/loginform.php');
} ?>