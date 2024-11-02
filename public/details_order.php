<?php 
require('header.php');
require('../db/conn.php');

// Lấy id_order từ URL
$id_order = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Truy vấn lấy dữ liệu từ bảng order_details và product với điều kiện id_order
$sql_str = "SELECT order_details.price, order_details.num, order_details.total_money, product.title, product.thumbnail 
            FROM order_details 
            JOIN product ON order_details.product_id = product.id
            WHERE order_details.order_id = $id_order
            ORDER BY order_details.id"; 
$result = mysqli_query($conn, $sql_str);

// Truy vấn trạng thái của đơn hàng
$status_sql = "SELECT trang_thai FROM orders WHERE id = $id_order";
$status_result = mysqli_query($conn, $status_sql);
$status_row = mysqli_fetch_assoc($status_result);
$order_status = $status_row['trang_thai'] ?? 0; // Mặc định là 0 nếu không tìm thấy
?>
<style>
/* CSS cho body */
body {
    background-color: #fff4eb; /* Màu nền cho toàn bộ trang */
}

/* CSS cho card */
.card {
    margin-left: 70px; /* Khoảng cách bên trái */
    margin-right: 70px; /* Khoảng cách bên phải */
}

/* CSS cho card header */
.card-header {
    margin-top: 30px;
    text-align: center; /* Căn giữa văn bản trong tiêu đề */
    background-color: #fff4eb; /* Màu nền cho tiêu đề */
    color: black; /* Màu chữ trắng */
    padding: 15px; /* Khoảng cách bên trong tiêu đề */

}

.card-header h6 {
    margin: 0; /* Xóa khoảng cách mặc định */
    font-size: 20px; /* Kích thước chữ tiêu đề */
    font-weight: bold; 
    font-family: 'Poppins', sans-serif;
}

/* CSS cho bảng */
.table-bordered th {
    background-color: #f2a7ad; /* Màu hồng nhạt cho tiêu đề bảng */
    color: #ffffff; /* Màu trắng cho chữ */
    font-weight: bold;
    text-align: center;
}

.table-bordered td {
    background-color: #ffe4e3; /* Màu nền nhẹ nhàng cho ô dữ liệu */
    color: #333; /* Màu chữ chính */
    text-align: center; /* Căn giữa văn bản */
    font-size: 16px;
}

/* Màu chữ cho chi tiết đơn hàng */
.card-body {
    color: black; /* Màu chữ đen cho toàn bộ nội dung trong card-body */
    font-family: Arial, sans-serif; /* Đặt font chữ, có thể thay đổi thành font khác nếu cần */
}

.table-responsive {
    margin-top: 20px; /* Giảm khoảng cách phía trên bảng */
    margin-bottom: 70px; /* Khoảng cách phía dưới bảng */
}

/* CSS cho trạng thái đơn hàng */
.status-pending {
    color: red; /* Màu đỏ cho trạng thái "Chưa xử lý" */
    font-weight: bold;
}

/* CSS cho hình ảnh sản phẩm */
.product-image {
    width: 50px; /* Điều chỉnh kích thước hình ảnh */
    height: auto; /* Giữ tỷ lệ khung hình */
}
</style>
<div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Chi tiết đơn hàng</h6> 
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Hình ảnh</th> 
                            <th>Tên sản phẩm</th> 
                            <th>Giá</th> 
                            <th>Số sản phẩm</th> 
                            <th>Tổng tiền</th> 
                        </tr>
                    </thead>
                    <?php 
                    // Kiểm tra xem truy vấn có thành công hay không
                    if (!$result) {
                        die("Truy vấn thất bại: " . mysqli_error($conn));
                    }
                    ?>
                    <tbody>
                    <?php 
                        // Khởi tạo biến để lưu tổng cộng
                        $total_sum = 0;

                        if (mysqli_num_rows($result) > 0) { // Kiểm tra nếu có bản ghi
                            while ($row = mysqli_fetch_assoc($result)) {
                                // Cộng tổng tiền của từng hàng vào biến $total_sum
                                $total_sum += $row['total_money'];
                                ?>
                                <tr>
                                    <td><img class="product-image" src="../admin/images/<?= htmlspecialchars($row['thumbnail']) ?>" alt="<?= htmlspecialchars($row['title']) ?>"></td> <!-- Sử dụng class CSS để điều chỉnh kích thước -->
                                    <td><?= htmlspecialchars($row['title']) ?></td>
                                    <td><?= htmlspecialchars($row['price']) ?></td>
                                    <td><?= htmlspecialchars($row['num']) ?></td>  
                                    <td><?= htmlspecialchars($row['total_money']) ?></td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "<tr><td colspan='5'>Không có chi tiết đơn hàng nào.</td></tr>"; // Thông báo nếu không có sản phẩm
                        }
                    ?>                                 
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" style="text-align: right;"><strong>Tổng cộng:</strong></td>
                            <td><strong><?= htmlspecialchars($total_sum) ?></strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>
    </div>
</div>

<?php
require('footer1.php');
?>
