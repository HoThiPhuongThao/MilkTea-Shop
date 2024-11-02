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

    if (!$conn) {
        die("Kết nối thất bại: " . mysqli_connect_error());
    }

    $limit = 6;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $limit;

    $sql_str = "
        SELECT o.*, COALESCE(SUM(od.total_money), 0) AS total_money 
        FROM `orders` o 
        LEFT JOIN order_details od ON o.id = od.order_id 
        GROUP BY o.id 
        ORDER BY o.id 
        LIMIT $limit OFFSET $offset";
    $result = mysqli_query($conn, $sql_str);

    if (!$result) {
        die("Truy vấn thất bại: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td>
                    <a href="order_detail.php?id=<?= $row['id'] ?>">
                        <?= htmlspecialchars($row['id']) ?>
                    </a>
                </td>
                <td><?= htmlspecialchars($row['fullname']) ?></td>
                <td><?= htmlspecialchars($row['phone_number']) ?></td>
                <td><?= htmlspecialchars($row['ngay_lap']) ?></td>  
                <td><?= htmlspecialchars($row['total_money']) ?></td>
                <td>
                    <?php
                    if ($row['trang_thai'] == 0) {
                        echo '<span style="color: red;">Chưa xử lý</span>';
                    } else {
                        echo '<span style="color: green;">Đã xử lý</span>';
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
        echo "<tr><td colspan='7'>Không có đơn hàng nào.</td></tr>";
    }
?>                                 
                    </tbody>
                </table>
                
                <!-- Phân trang nằm giữa -->
                <div class="pagination" style="display: flex; justify-content: center; margin-top: 20px;">
                    <?php
                    $total_orders_query = "SELECT COUNT(*) as total FROM `orders`";
                    $total_orders_result = mysqli_query($conn, $total_orders_query);
                    $total_orders_row = mysqli_fetch_assoc($total_orders_result);
                    $total_orders = $total_orders_row['total'];
                    $total_pages = ceil($total_orders / $limit);

                    // Nút điều hướng trang trước
                    if ($page > 1): ?>
                        <a href="?page=<?= $page - 1 ?>" class="btn btn-light"><<</a>
                    <?php endif;

                    // Hiển thị số trang
                    for ($i = 1; $i <= $total_pages; $i++): ?>
                        <a href="?page=<?= $i ?>" 
                           class="btn <?= ($i == $page) ? 'btn-primary' : 'btn-light' ?>">
                           <?= $i ?>
                        </a>
                    <?php endfor;

                    // Nút điều hướng trang sau
                    if ($page < $total_pages): ?>
                        <a href="?page=<?= $page + 1 ?>" class="btn btn-light">>></a>
                    <?php endif; ?>
                </div>
                
            </div>
        </div>
    </div>
</div>

<?php
require('includes/footer.php');
?>
