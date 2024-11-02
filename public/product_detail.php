<?php
require('header.php');  // Đảm bảo đường dẫn này là chính xác
require('../db/conn.php');  // Kết nối đến cơ sở dữ liệu

// Kiểm tra nếu có ID sản phẩm được gửi qua URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM product WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "Không tìm thấy sản phẩm!";
        exit;
    }
} else {
    echo "Không có ID sản phẩm!";
    exit;
}

// Truy vấn 4 sản phẩm khác để hiển thị bên dưới
$related_stmt = $conn->prepare("SELECT * FROM product WHERE id != ? LIMIT 4");
$related_stmt->bind_param("i", $product_id);
$related_stmt->execute();
$related_result = $related_stmt->get_result();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Chi tiết sản phẩm tại Damin Tea">
    <meta name="keywords" content="trà, trà sữa, sản phẩm trà">
    <title>Damin Tea Website</title>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <style>
        /* CSS styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #ffe4e3;
            margin: 0;
            padding: 20px;
        }

        .product-detail {
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #fef4f1;
            border-radius: 30px;
            padding: 20px;
            max-width: 400px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 60px auto;
            margin-bottom: 10px;
        }

        .product-detail img {
            width: 70%;
            height: auto;
            border-radius: 20px;
            margin-bottom: 10px;
        }

        .product-detail h2 {
            font-size: 24px;
            color: black;
            margin: 10px 0;
            font-family: Arial, sans-serif;
        }

        .product-price {
            font-size: 20px;
            color: #ff2190;
            font-weight: bold;
            margin: 5px 0;
        }

        .product-description {
            font-size: 16px;
            color: #666;
            margin: 10px 0;
            line-height: 1.6;
        }

        .product-actions {
            display: flex;
            justify-content: center;
            width: 100%;
            margin-top: 10px;
        }

        .buy-button {
            display: inline-block;
            text-align: center;
            background-color: #f7bfd8;
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 20px;
            text-decoration: none; /* Bỏ gạch chân */
        }

        .buy-button:hover {
            background-color: #ff89c4;
        }

        .related-products {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin-top: 50px;
            margin-bottom: 100px;
        }

        .related-product-item {
            width: 200px; /* Tăng chiều rộng khung sản phẩm */
            text-align: center;
            background-color: #fef4f1;
            border-radius: 30px;
            padding: 15px; /* Tăng padding để khung rộng hơn */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Có thể tăng độ mờ của bóng */
        }

        .related-product-item img {
            width: 100%; /* Giữ nguyên, nhưng sẽ có thêm không gian do khung lớn hơn */
            height: auto; /* Đảm bảo tỷ lệ khung hình không bị biến dạng */
            border-radius: 20px;
        }

        .related-product-info {
            margin-top: 15px; /* Tăng khoảng cách trên giữa ảnh và thông tin sản phẩm */
        }

        .related-product-info h4 {
            margin: 5px 0 0;
            font-size: 20px;
            color: black; /* Giữ nguyên màu chữ tiêu đề */
            font-family: Arial, sans-serif;
            text-align: left;
        }

        /* Định dạng cho giá tiền và nút giỏ hàng */
        .price-and-cart {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 5px;
        }

        .price-and-cart p {
            font-size: 16px;
            color: #ff2190; /* Màu vàng cho giá */
            font-weight: bold;
        }

        .cart-add {
            background-color: #fef4f1;
            border: none;
            padding: 10px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 16px;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333; /* Đổi màu biểu tượng thành đen để nổi bật */
        }

        .cart-add i {
            font-size: 20px; /* Đặt kích thước cho biểu tượng */
            color: #333; /* Đặt màu cho biểu tượng, bạn có thể thay đổi màu tùy ý */
        }

        .cart-add:hover {
            background-color: #ff89c4;
        }
    </style>
</head>
<body>

<div class="product-detail">
    <?php if (isset($product)): ?>
        <img src="../admin/images/<?php echo htmlspecialchars($product['thumbnail']); ?>" alt="<?php echo htmlspecialchars($product['title']); ?>" class="product-thumbnail">
        <h2 class="product-title"><?php echo htmlspecialchars($product['title']); ?></h2>
        <p class="product-price">Giá: <?php echo number_format($product['price'], 0, ',', '.'); ?> VND</p>
        <p class="product-description">Mô tả: <?php echo htmlspecialchars($product['description']); ?></p>
        
        <div class="product-actions">
            <a href="add_cart.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="buy-button">MUA</a>
        </div>
    <?php else: ?>
        <p>Không có sản phẩm nào!</p>
    <?php endif; ?>
</div>

<div class="related-products">
    <?php while ($related_product = $related_result->fetch_assoc()): ?>
        <div class="related-product-item">
            <a href="product_detail.php?id=<?php echo htmlspecialchars($related_product['id']); ?>">
                <img src="../admin/images/<?php echo htmlspecialchars($related_product['thumbnail']); ?>" alt="<?php echo htmlspecialchars($related_product['title']); ?>">
                <div class="related-product-info">
                    <h4><?php echo htmlspecialchars($related_product['title']); ?></h4>
                    
                    <!-- Bọc giá tiền và nút giỏ hàng trong một div -->
                    <div class="price-and-cart">
                        <p><?php echo number_format($related_product['price'], 0, ',', '.'); ?> VND</p>
                        <button class="cart-add">
                            <a href="confim_add_cart.php?id=<?php echo htmlspecialchars($related_product['id']); ?>" class="cart-link">
                                <i class="bx bx-cart-add"></i>
                            </a>
                        </button>
                    </div>
                </div>
            </a>
        </div>
    <?php endwhile; ?>
</div>

<?php
$stmt->close();
$related_stmt->close();
require('footer1.php');
$conn->close();
?>
</body>
</html>
