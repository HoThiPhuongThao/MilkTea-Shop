<?php
session_start();
require('../db/conn.php'); // Kết nối đến cơ sở dữ liệu

// Kiểm tra xem user_id có tồn tại không
if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    $user_id = $_SESSION['user']['id'];
} else {
    echo "User ID không tồn tại trong session. Vui lòng đăng nhập lại.";
    exit();
}

// Lấy thông tin người dùng từ cơ sở dữ liệu nếu chưa có trong $_POST
if (empty($_POST['fullname']) || empty($_POST['email']) || empty($_POST['phone_number']) || empty($_POST['address'])) {
    $sql_user = "SELECT fullname, email, phone_number, address FROM user WHERE id = ?";
    $stmt_user = $conn->prepare($sql_user);
    $stmt_user->bind_param("i", $user_id);
    $stmt_user->execute();
    $result_user = $stmt_user->get_result();

    if ($result_user->num_rows > 0) {
        $user_info = $result_user->fetch_assoc();
        $fullname = $user_info['fullname'];
        $email = $user_info['email'];
        $phone_number = $user_info['phone_number'];
        $address = $user_info['address'];
    } else {
        echo "Không tìm thấy thông tin người dùng.";
        exit();
    }
} else {
    // Lấy thông tin người dùng từ form
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
}

// Ghi chú từ người dùng nếu có
$note = $_POST['note'] ?? '';
$ngay_lap = date('Y-m-d H:i:s');
$trang_thai = 0; // Trạng thái đơn hàng

// Lưu thông tin vào bảng orders
$sql_order = "INSERT INTO orders (user_id, fullname, email, phone_number, address, note, ngay_lap, trang_thai) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql_order);
$stmt->bind_param("issssssi", $user_id, $fullname, $email, $phone_number, $address, $note, $ngay_lap, $trang_thai);

if ($stmt->execute()) {
    $order_id = $stmt->insert_id; // Lấy ID đơn hàng vừa tạo

    // Lưu thông tin vào bảng order_details
    foreach ($_SESSION['cart'] as $item) {
        $product_id = $item['id'];
        $price = $item['price'];
        $num = $item['quantity'];
        $total_money = $price * $num;

        $sql_order_detail = "INSERT INTO order_details (order_id, product_id, price, num, total_money) VALUES (?, ?, ?, ?, ?)";
        $stmt_detail = $conn->prepare($sql_order_detail);
        $stmt_detail->bind_param("iiidd", $order_id, $product_id, $price, $num, $total_money);
        $stmt_detail->execute();
    }

    // Xóa giỏ hàng
    unset($_SESSION['cart']);

    // Chuyển hướng tới trang cảm ơn hoặc thông báo
    header("Location: thank.php"); // Thay đổi đến trang cảm ơn
    exit();
} else {
    echo "Có lỗi xảy ra khi lưu đơn hàng.";
}

require('footer1.php');
?>
