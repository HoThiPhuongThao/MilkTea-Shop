<?php
require('header.php');
require('../db/conn.php');  // Kết nối đến cơ sở dữ liệu

// Số sản phẩm trên mỗi trang
$productsPerPage = 6;

// Xác định trang hiện tại (nếu có), nếu không mặc định là trang 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $productsPerPage;

// Lấy tổng số sản phẩm trong danh mục
$totalProductsSql = "SELECT COUNT(*) as total FROM product WHERE category_id = 115";
$totalResult = $conn->query($totalProductsSql);
$totalRow = $totalResult->fetch_assoc();
$totalProducts = $totalRow['total'];

// Tính tổng số trang
$totalPages = ceil($totalProducts / $productsPerPage);

// Truy vấn lấy các sản phẩm cho trang hiện tại
$sql = "SELECT * FROM product WHERE category_id = 115 LIMIT $start, $productsPerPage";
$result = $conn->query($sql);
?>

<link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
<style>
    body {
        font-family: Arial, sans-serif;
    }
    .product-container {
        padding: 40px;
        background-color: #ffe4e3; /* Nền chung cho cả danh sách sản phẩm và phân trang */
    }
    .product-list {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
    }
    .product-card {
        flex: 1 1 400px;
        max-width: 350px;
        background-color: #fef4f1;
        border-radius: 30px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        text-align: left;
        margin: 20px;
        transition: transform 0.2s;
    }
    .product-card:hover {
        transform: scale(1.05);
    }
    .product-content h2 {
        font-size: 20px;
        color: black;
    }
    .product-content .price {
        font-size: 16px;
        color: #ff2190;
        font-weight: bold;
    }
    .product-image img {
        border-radius: 40px;
        object-fit: cover;
        margin-bottom: 20px;
    }
    .cart-add {
        background-color: #fef4f1;
        border: none;
        padding: 10px;
        border-radius: 50%;
        cursor: pointer;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #333;
    }
    .cart-add i {
        font-size: 20px;
        color: #333;
    }
    .cart-add:hover {
        background-color: #ff89c4;
    }
    .product-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 10px;
    }
    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }
    .pagination a {
        color: #333;
        padding: 8px 16px;
        text-decoration: none;
        margin: 0 4px;
        border: 1px solid #ddd;
        border-radius: 100%;
        transition: background-color 0.3s;
    }
    .pagination a.active {
        background-color: #ff2190;
        color: white;
        border: 1px solid #ff2190;
        border-radius: 100%;
    }
    .pagination a:hover:not(.active) {
        background-color: #ffe4e3;
    }
</style>

<div class="product-container">
    <div class="product-list">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="product-card">';
                echo '<div class="product-content">';
                echo '<div class="product-image"><img src="../admin/images/' . $row["thumbnail"] . '" alt="' . htmlspecialchars($row["title"]) . '"></div>';
                echo '<h2><a href="product_detail.php?id=' . $row["id"] . '" style="color: black; text-decoration: none;">' . htmlspecialchars($row["title"]) . '</a></h2>';
                echo '<div class="product-actions">';
                echo '<span class="price">' . number_format($row["price"], 0, ',', '.') . ' VND</span>';
                echo '<button class="cart-add"><a href="confim_add_cart.php?id=' . $row["id"] . '" class="cart-link"><i class="bx bx-cart-add"></i></a></button>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "Không có sản phẩm nào.";
        }
        ?>
    </div>

    <!-- Phân trang -->
    <div class="pagination">
        <?php
        if ($page > 1) {
            echo '<a href="?page=' . ($page - 1) . '">&laquo; </a>';
        }

        for ($i = 1; $i <= $totalPages; $i++) {
            $active = ($i == $page) ? 'active' : '';
            echo '<a href="?page=' . $i . '" class="' . $active . '">' . $i . '</a>';
        }

        if ($page < $totalPages) {
            echo '<a href="?page=' . ($page + 1) . '"> &raquo;</a>';
        }
        ?>
    </div>
</div>

<?php
require('footer1.php');
$conn->close();  // Đóng kết nối
?>
