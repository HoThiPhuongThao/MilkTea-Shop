<?php
// Kết nối cơ sở dữ liệu
require('../db/conn.php');

// Kiểm tra nếu có tham số 'id' được gửi qua URL và kiểm tra tính hợp lệ của nó
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']); // Chuyển id về kiểu số nguyên

    // Câu lệnh SQL để xóa dữ liệu
    $sql = "DELETE FROM product WHERE id = $id";

    // Thực thi câu lệnh xóa
    if (mysqli_query($conn, $sql)) {
        // Chuyển hướng sau khi xóa thành công
        header("Location: product.php?delete_success=1");
        exit;
    } else {
        echo "Lỗi khi xóa dữ liệu: " . mysqli_error($conn);
    }
} else {
    echo "ID không hợp lệ.";
}

// Đóng kết nối
mysqli_close($conn);
?>
