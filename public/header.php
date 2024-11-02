<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Damin Tea Website</title>
    <link rel="stylesheet" href="css/style_header.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>
<body>
<!-- Navbar-->
<header>
    <?php
    // Định nghĩa biến $search
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
                // Chuyển đổi tên đăng nhập thành liên kết
                echo '<a href="profile.php" title="Thông tin tài khoản" style="font-size: 14px; color: #ff2190; text-decoration: none;" onmouseover="this.style.color=\'#ff2190\'; this.style.textDecoration=\'none\';" onmouseout="this.style.color=\'#ff2190\'; this.style.textDecoration=\'none\';">' . htmlspecialchars($_SESSION['user']['fullname']) . '</a>';

                echo '<a href="logout.php" title="Đăng xuất" id="logoutIcon"><i class="bx bx-log-out"></i></a>';
            } else {
                echo '<a href="login.php" title="Tài khoản" id="userIcon"><i class="bx bx-user-circle"></i></a>';
            }
            
        ?>
    </div>
</header>

<script src="js/header.js"></script>
<script>
    function searchProduct() {
        const searchInput = document.getElementById('searchInput').value;
        if (searchInput) {
            window.location.href = 'product.php?search=' + encodeURIComponent(searchInput);
        }
    }
</script>
</body>
</html>
