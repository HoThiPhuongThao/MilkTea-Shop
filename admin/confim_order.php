<?php 
require('../db/conn.php');

// Lấy id_order từ URL
$id_order = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Cập nhật trạng thái đơn hàng thành 1
$sql_update = "UPDATE orders SET trang_thai = 1 WHERE id = $id_order AND trang_thai = 0"; 
$result = mysqli_query($conn, $sql_update);

// Kiểm tra xem truy vấn có thành công hay không
if ($result && mysqli_affected_rows($conn) > 0) {
    // Chuyển hướng về trang danh sách đơn hàng
    header("Location: order.php");
    exit();
} else {
    die("Cập nhật trạng thái thất bại: " . mysqli_error($conn));
}
?>
