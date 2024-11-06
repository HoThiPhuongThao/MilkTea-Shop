<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Damin Tea Website - Trà sữa</title>
    <link rel="stylesheet" href="css/style_header.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>
<body>
<!-- Navbar-->
<header>
    <?php
    $search = isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '';
    ?>
    <a href="index.php" class="logo">
        <i class='bx bxs-leaf'></i>
    </a>
    <ul class="navbar">
        <li><a href="index.php">Trang chủ</a></li>
        <li class="dropdown">
            <a href="product.php">Sản phẩm</a>
            <ul class="dropdown-content">
                <li><a href="milk_tea.php">Trà sữa</a></li>
                <li><a href="tea.php">Trà</a></li>
                <li><a href="cake.php">Bánh ngọt</a></li>
            </ul>
        </li>
        <li><a href="about_us.php">Về chúng tôi</a></li>
    </ul>
    <div class="search-bar">
        <input type="text" placeholder="Tìm kiếm món..." class="search-input" id="searchInput" value="<?php echo htmlspecialchars($search); ?>" />
    </div>
    <div class="header-icon">
        <i class='bx bx-search' id="search-icon" onclick="searchProduct()"></i>
        <a href="cart.php" title="Giỏ hàng">
            <i class='bx bx-cart-alt'></i>
        </a>
        <?php
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            if (isset($_SESSION['user'])) {
                echo '<a href="profile.php" title="Thông tin tài khoản" style="font-size: 14px; color: #ff2190; text-decoration: none;">' . htmlspecialchars($_SESSION['user']['fullname']) . '</a>';
                echo '<a href="logout.php" title="Đăng xuất"><i class="bx bx-log-out"></i></a>';
            } else {
                echo '<a href="login.php" title="Tài khoản"><i class="bx bx-user-circle"></i></a>';
            }
        ?>
    </div>
</header>

<script>
    function searchProduct() {
        const searchInput = document.getElementById('searchInput').value;
        if (searchInput) {
            window.location.href = 'milk_tea.php?search=' + encodeURIComponent(searchInput);
        }
    }
</script>

<?php
require('../db/conn.php');

$productsPerPage = 6;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $productsPerPage;

// Kiểm tra từ khóa tìm kiếm
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $searchQuery = $conn->real_escape_string($_GET['search']);
    $sql = "SELECT * FROM product WHERE category_id = 114 AND title LIKE '%$searchQuery%' LIMIT $start, $productsPerPage";
    $countSql = "SELECT COUNT(*) as total FROM product WHERE category_id = 114 AND title LIKE '%$searchQuery%'";
} else {
    $sql = "SELECT * FROM product WHERE category_id = 114 LIMIT $start, $productsPerPage";
    $countSql = "SELECT COUNT(*) as total FROM product WHERE category_id = 114";
}

$totalResult = $conn->query($countSql);
$totalRow = $totalResult->fetch_assoc();
$totalProducts = $totalRow['total'];
$totalPages = ceil($totalProducts / $productsPerPage);
$result = $conn->query($sql);
?>

<style>
    body {
        font-family: Arial, sans-serif;
    }
    .product-container {
        padding: 40px;
        background-color: #ffe4e3;
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
            echo "<h2>Không tìm thấy sản phẩm nào.</h2>";
        }
        ?>
    </div>

    <div class="pagination">
        <?php
        if ($page > 1) {
            echo '<a href="?page=' . ($page - 1) . '&search=' . urlencode($search) . '">&laquo;</a>';
        }

        for ($i = 1; $i <= $totalPages; $i++) {
            $active = ($i == $page) ? 'active' : '';
            echo '<a href="?page=' . $i . '&search=' . urlencode($search) . '" class="' . $active . '">' . $i . '</a>';
        }

        if ($page < $totalPages) {
            echo '<a href="?page=' . ($page + 1) . '&search=' . urlencode($search) . '">&raquo;</a>';
        }
        ?>
    </div>
</div>

<?php
require('footer1.php');
$conn->close();
?>
</body>
</html>