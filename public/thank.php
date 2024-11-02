<?php
session_start();
require('header.php');
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cảm ơn</title>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffe4e3;
            color: black;
            text-align: center;
            padding: 50px;
        }
        .thank-you-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fef4f1;
            border: 1px solid #ddd;
            border-radius: 20px;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
        }
        .thank-you-header {
            font-size: 2em;
            color: #ff2190;
            margin-bottom: 20px;
        }
        .thank-you-message {
            font-size: 1.2em;
            margin-bottom: 20px;
        }
        .thank-you-button {
            padding: 10px 20px;
            background-color: #ff2190;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 1.2em;
        }
        .thank-you-button:hover {
            background-color: #e6007e;
        }
    </style>
</head>
<body>
    <div class="thank-you-container">
        <div class="thank-you-header">Cảm ơn bạn!</div>
        <div class="thank-you-message">
            Đơn hàng của bạn đã được thanh toán thành công.<br>
            Chúng tôi sẽ xử lý đơn hàng của bạn trong thời gian sớm nhất.
        </div>
        <a href="index.php" class="thank-you-button">Quay lại trang chủ</a>
    </div>
</body>
</html>

<?php require('footer1.php'); ?>
