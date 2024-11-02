<?php
require('header.php');
require('../db/conn.php');  // Kết nối đến cơ sở dữ liệu
?>

<link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
<style>
/* Container chính cho thông tin người dùng */
.user-info-container {
    background-color: #ffe4e3; /* Màu nền nhẹ nhàng */
    border-radius: 15px;
    padding: 30px;
    max-width: 600px; /* Chiều rộng tối đa cho container */
    margin: 20px auto; /* Thêm khoảng cách trên dưới cho container */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Hiệu ứng bóng cho container */
    font-family: Arial, sans-serif;
    transition: transform 0.3s ease-in-out; /* Thêm hiệu ứng hover */
}

/* Hiệu ứng hover cho container */
.user-info-container:hover {
    transform: translateY(-5px); /* Nâng container lên khi hover */
}

/* Phong cách chung cho phần thông tin người dùng */
.user-info p {
    font-size: 16px;
    line-height: 1.7;
    color: #333; /* Màu chữ */
    margin: 10px 0;
    border-bottom: 1px solid #ddd; /* Thêm đường kẻ dưới mỗi thông tin */
    padding-bottom: 10px;
}

/* Phần tiêu đề như "Full name", "Email" đậm hơn */
.user-info p strong {
    font-weight: bold;
    color: #ff2190; /* Màu đậm cho tiêu đề */
}

/* Tùy chỉnh tiêu đề của thẻ thông tin */
.login-card h2 {
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 20px;
    color: #333;
    text-align: center; /* Căn giữa tiêu đề */
}

/* Tùy chỉnh chữ và khoảng cách trong thẻ */
.background-container {
    background-color: #fff4eb; /* Màu nền cho phần margin */
    padding: 40px 0; /* Thêm padding để tạo khoảng cách giữa các phần */
}

.login-card {
    margin-top: 0; /* Bỏ margin-top */
    margin-bottom: 0; /* Bỏ margin-bottom */
    background-color: #fff4eb; 
}

/* Tùy chỉnh bảng thông tin đơn hàng */
.order-table {
    margin-top: 20px;
    width: 100%;
}

.order-table th, .order-table td {
    padding: 10px;
    text-align: center;
}

.order-table th {
    background-color: #ffb3b3; /* Màu nền cho tiêu đề bảng */
    color: #fff; /* Màu chữ cho tiêu đề */
}

.order-table td {
    background-color: #ffe6e6; /* Màu nền cho ô dữ liệu */
    color: #333; /* Màu chữ cho ô dữ liệu */
}

/* Tùy chỉnh hiệu ứng khi hover vào các thông tin */
.user-info p:hover {
    background-color: #ffedf0; /* Thêm màu nền nhạt khi hover vào mỗi thông tin */
    border-bottom-color: #ff2190; /* Đổi màu đường kẻ dưới khi hover */
}

/* Tùy chỉnh hiệu ứng khi hover vào các hàng trong bảng thông tin đơn hàng */
.order-table tr:hover {
    background-color: #ffcccc; /* Màu nền khi hover vào hàng */
}

/* Phân trang */
.pagination {
    display: flex;
    justify-content: center;
    margin: 20px 0;
}

.pagination a {
    padding: 10px 15px;
    margin: 0 5px;
    border: 1px solid #ddd;
    color: #007bff;
    text-decoration: none;
    transition: background-color 0.3s;
}

.pagination a:hover {
    background-color: #007bff;
    color: white;
}

.pagination span {
    padding: 10px 15px;
    margin: 0 5px;
    border: 1px solid #ddd;
    color: #333;
    background-color: #f8f9fa;
}

</style>

<div class="background-container">
    <div class="login-card">
        <div class="text-center">
            <h2>Thông tin cá nhân</h2>
        </div>
        <div class="user-info-container">
            <?php
            // Kiểm tra nếu session chưa được khởi tạo thì khởi tạo session
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            if (isset($_SESSION['user'])) {
                $userId = $_SESSION['user']['id'];
                // Lấy thông tin người dùng từ cơ sở dữ liệu
                $sql = "SELECT * FROM user WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $userId);
                $stmt->execute();
                $result = $stmt->get_result();
                $user = $result->fetch_assoc();

                // Hiển thị thông tin người dùng
                echo '<div class="user-info">';
                echo '<p><strong>Full name:</strong> ' . htmlspecialchars($user['fullname']) . '</p>';
                echo '<p><strong>Email:</strong> ' . htmlspecialchars($user['email']) . '</p>';
                echo '<p><strong>Số điện thoại:</strong> ' . htmlspecialchars($user['phone_number']) . '</p>';
                echo '<p><strong>Địa chỉ:</strong> ' . htmlspecialchars($user['address']) . '</p>';
                echo '<p><strong>Tài khoản:</strong> ' . htmlspecialchars($user['taikhoan']) . '</p>';
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <!-- Bảng thông tin đơn hàng -->
    <div class="login-card">
        <div class="text-center">
            <h2>Thông tin đơn hàng</h2>
        </div>
        <div class="order-table">
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
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        // Truy vấn lấy dữ liệu từ bảng orders và tổng giá tiền từ bảng order_details
                        $sql_str = "
                            SELECT o.*, COALESCE(SUM(od.total_money), 0) AS total_money 
                            FROM `orders` o 
                            LEFT JOIN order_details od ON o.id = od.order_id 
                            WHERE o.user_id = ? 
                            GROUP BY o.id 
                            ORDER BY o.id"; 
                        
                        $stmt_orders = $conn->prepare($sql_str);
                        $stmt_orders->bind_param("i", $userId);
                        $stmt_orders->execute();
                        $result_orders = $stmt_orders->get_result();

                        // Kiểm tra xem truy vấn có thành công hay không
                        if ($result_orders->num_rows > 0) { // Kiểm tra nếu có bản ghi
                            while ($row = $result_orders->fetch_assoc()) {
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
require('footer1.php');
$conn->close();  // Đóng kết nối
?>
