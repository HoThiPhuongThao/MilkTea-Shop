<?php
session_start();

// Kiểm tra xem ID sản phẩm có được gửi không
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Kiểm tra xem giỏ hàng có tồn tại trong session không
    if (isset($_SESSION['cart'])) {
        // Duyệt qua giỏ hàng để tìm sản phẩm cần xóa
        foreach ($_SESSION['cart'] as $key => $item) {
            // Nếu tìm thấy sản phẩm, xóa nó khỏi giỏ hàng
            if ($item['id'] == $product_id) {
                unset($_SESSION['cart'][$key]);
                break; // Thoát khỏi vòng lặp sau khi xóa
            }
        }
    }
}

// Chuyển hướng người dùng về trang giỏ hàng
header("Location: cart.php");
exit();
?>
