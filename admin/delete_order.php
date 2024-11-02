<?php
// Kết nối cơ sở dữ liệu
require('../db/conn.php');

// Kiểm tra nếu có tham số 'id' được gửi qua URL và kiểm tra tính hợp lệ của nó
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']); // Chuyển id về kiểu số nguyên

    // Bắt đầu giao dịch
    mysqli_begin_transaction($conn);

    try {
        // Xóa dữ liệu từ bảng order_details trước
        $sql_details = "DELETE FROM order_details WHERE order_id = $id";
        mysqli_query($conn, $sql_details);

        // Xóa dữ liệu từ bảng orders
        $sql_order = "DELETE FROM orders WHERE id = $id";
        mysqli_query($conn, $sql_order);

        // Xác nhận giao dịch
        mysqli_commit($conn);

        // Chuyển hướng sau khi xóa thành công
        header("Location: order.php?delete_order=1");
        exit;
    } catch (Exception $e) {
        // Hoàn tác giao dịch nếu có lỗi
        mysqli_rollback($conn);
        echo "Lỗi khi xóa dữ liệu: " . $e->getMessage();
    }
} else {
    echo "ID không hợp lệ.";
}

// Đóng kết nối
mysqli_close($conn);
?>
