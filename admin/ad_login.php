<?php
session_start(); // Bắt đầu session
require('../db/conn.php'); // Kết nối với cơ sở dữ liệu

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy thông tin đăng nhập từ form
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Truy vấn để kiểm tra thông tin đăng nhập
    $sql = "SELECT * FROM user WHERE email='$email' AND password='$password' AND role_id=(SELECT id FROM role WHERE name='admin')";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Đăng nhập thành công
        $_SESSION['user_email'] = $email; // Lưu email vào session
        header("Location: index.php"); // Chuyển hướng tới trang chính
        exit();
    } else {
        // Đăng nhập không thành công
        $_SESSION['error_message'] = 'Thông tin đăng nhập không chính xác!'; // Thiết lập thông báo lỗi
        header("Location: login.php"); // Chuyển hướng về trang đăng nhập
        exit();
    }
}
?>
