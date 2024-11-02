<?php 
session_start(); // Bắt đầu session
// Kiểm tra nếu chưa đăng nhập
if (!isset($_SESSION['user_email'])) {
    header("Location: login.php"); // Chuyển hướng về trang đăng nhập
    exit();
}
require('includes/header.php'); // Gọi header
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <style>
        body {
            background-color: white; 
            margin: 0;
            padding: 0;
            color: black; 
        }
        
        h1 {
            text-align: center;
            font-weight: bold; /* In đậm chữ */
            margin-top: 50px; /* Thêm khoảng cách trên cùng */
        }
        
        .center {
            text-align: center;
            margin-top: 20px; /* Thêm khoảng cách giữa tiêu đề và hình ảnh */
        }
        
        img {
            width: 50%; 
            height: auto;
            border-radius: 10px; /* Thêm bo góc cho hình ảnh */
        }
    </style>
</head>
<body>

<h1>Trang chủ admin</h1>
<div class="center">
    <img src="images/admin1.jpg" alt="Trang chủ">
</div>

<?php
require('includes/footer.php'); // Gọi footer
?>
</body>
</html>
