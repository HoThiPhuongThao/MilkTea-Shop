<?php
session_start();

if (!isset($_SESSION['user_email'])) { // Kiểm tra nếu chưa đăng nhập
    header("Location: login.php"); // Chuyển hướng về trang đăng nhập
    exit();
}
?>
