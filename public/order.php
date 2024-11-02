<?php 
require('includes/header.php');
?>

<div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách đơn hàng</h6> 
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Số hóa đơn</th> 
                            <th>Tên khách hàng</th> 
                            <th>Số điện thoại</th> 
                            <th>Ngày mua</th> 
                            <th>Giá tiền</th> 
                            <th>Trạng thái</th>  
                            <th>Chỉnh sửa</th> 
                        </tr>
                    </thead>
                    <tbody>
<?php 
    require('../db/conn.php');

    // Kiểm tra kết nối
    if (!$conn) {
        die("Kết nối thất bại: " . mysqli_connect_error());
    }

    // Truy vấn lấy dữ liệu từ bảng orders và tổng giá tiền từ bảng order_details
    $sql_str = "
        SELECT o.*, COALESCE(SUM(od.total_money), 0) AS total_money 
        FROM `orders` o 
        LEFT JOIN order_details od ON o.id = od.order_id 
        GROUP BY o.id 
        ORDER BY o.id"; 
    $result = mysqli_query($conn, $sql_str);

    // Kiểm tra xem truy vấn có thành công hay không
    if (!$result) {
        die("Truy vấn thất bại: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) > 0) { // Kiểm tra nếu có bản ghi
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td>
                    <a href="details_order.php?id=<?= $row['id'] ?>">
                        <?= htmlspecialchars($row['id']) ?>
                    </a>
                </td>
                <td><?= htmlspecialchars($row['fullname']) ?></td>
                <td><?= htmlspecialchars($row['phone_number']) ?></td>
                <td><?= htmlspecialchars($row['ngay_lap']) ?></td>  
                <td><?= htmlspecialchars($row['total_money']) ?></td> <!-- Sử dụng total_money đã tính tổng -->
                <td>
                    <?php
                    // Kiểm tra trạng thái và hiển thị tương ứng
                    if ($row['trang_thai'] == 0) {
                        echo '<span style="color: red;">Chưa xử lý</span>';
                    } else {
                        echo '<span style="color: green;">Đã xử lý</span>'; // Hiển thị trạng thái đã xử lý
                    }
                    ?>
                </td>
                <td>
                    <a class="btn btn-danger" 
                       href="delete_order.php?id=<?= $row['id'] ?>"
                       onclick="return confirm('Bạn chắc chắn muốn xóa mục này?');">Xóa</a>
                       </td>
            </tr>
            <?php
        }
    } else {
        echo "<tr><td colspan='7'>Không có đơn hàng nào.</td></tr>"; // Thông báo nếu không có đơn hàng
    }
?>                                 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
require('includes/footer.php');
?>