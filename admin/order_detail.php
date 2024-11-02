<?php 
require('includes/header.php');
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

// Truy vấn trạng thái và thông tin người mua từ đơn hàng
$status_sql = "SELECT fullname, email, phone_number, address, note, trang_thai FROM orders WHERE id = $id_order";
$status_result = mysqli_query($conn, $status_sql);
$status_row = mysqli_fetch_assoc($status_result);
$order_status = $status_row['trang_thai'] ?? 0; // Mặc định là 0 nếu không tìm thấy

// Lấy thông tin người mua
$fullname = $status_row['fullname'] ?? '';
$email = $status_row['email'] ?? '';
$phone_number = $status_row['phone_number'] ?? '';
$address = $status_row['address'] ?? '';

?>
<!-- Show người dùng ở đây -->
<div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thông tin người mua</h6> 
        </div>
        <div class="card-body">
            <p><strong>Họ tên:</strong> <?= htmlspecialchars($fullname) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
            <p><strong>Số điện thoại:</strong> <?= htmlspecialchars($phone_number) ?></p>
            <p><strong>Địa chỉ:</strong> <?= htmlspecialchars($address) ?></p>
           
    </div>
</div>
<!-- kết thúc show người dùng -->

<div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Chi tiết đơn hàng #<?= htmlspecialchars($id_order) ?></h6> 
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
                    <tbody>
<?php 
    // Kiểm tra xem truy vấn có thành công hay không
    if (!$result) {
        die("Truy vấn thất bại: " . mysqli_error($conn));
    }

    // Khởi tạo biến để lưu tổng cộng
    $total_sum = 0;

    if (mysqli_num_rows($result) > 0) { // Kiểm tra nếu có bản ghi
        while ($row = mysqli_fetch_assoc($result)) {
            // Cộng tổng tiền của từng hàng vào biến $total_sum
            $total_sum += $row['total_money'];
            ?>
            <tr>
                <td><img src="../admin/images/<?= htmlspecialchars($row['thumbnail']) ?>" alt="<?= htmlspecialchars($row['title']) ?>" width="50"></td>
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
            <div style="text-align: right; margin-top: 10px;">
                <?php if ($order_status == 0): // Hiển thị nút xác nhận nếu trạng thái là 0 ?>
                    <form action="confim_order.php" method="GET">
                        <input type="hidden" name="id" value="<?= $id_order ?>"> <!-- Sử dụng ID từ bảng orders -->
                        <button class="btn btn-success" type="submit">Xác nhận</button>
                    </form>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>

<?php
require('includes/footer.php');
?>
