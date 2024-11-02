<?php
session_start(); // Bắt đầu session
require('header.php');

// Kiểm tra nếu có ID sản phẩm trong URL
if (isset($_GET['id'])) {
    require('../db/conn.php');  // Kết nối đến cơ sở dữ liệu

    $product_id = intval($_GET['id']); // Chuyển đổi ID sản phẩm thành số nguyên để bảo mật

    // Lấy thông tin sản phẩm từ cơ sở dữ liệu
    $sql_product = "SELECT * FROM product WHERE id = ?";
    $stmt = $conn->prepare($sql_product);
    $stmt->bind_param("i", $product_id); // Thực hiện truy vấn với chuẩn bị tham số
    $stmt->execute();
    $result_product = $stmt->get_result();
    $product = $result_product->fetch_assoc();

    // Nếu sản phẩm không tồn tại
    if (!$product) {
        echo "<div class='alert alert-danger'>Sản phẩm không tồn tại!</div>";
        exit;
    }

    // Kiểm tra nếu có yêu cầu thêm vào giỏ hàng
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $quantity = intval($_POST['quantity']);
        $item = [
            'id' => $product['id'],
            'title' => $product['title'],
            'price' => $product['price'],
            'thumbnail' => $product['thumbnail'],
            'quantity' => $quantity
        ];

        // Thêm sản phẩm vào giỏ hàng
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        
        // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
        if (isset($_SESSION['cart'][$product['id']])) {
            $_SESSION['cart'][$product['id']]['quantity'] += $quantity; // Tăng số lượng
        } else {
            $_SESSION['cart'][$product['id']] = $item; // Thêm sản phẩm mới
        }

        // Chuyển hướng đến trang giỏ hàng
        header("Location: cart.php");
        exit;
    }
} else {
    echo "<div class='alert alert-danger'>ID sản phẩm không hợp lệ!</div>";
    exit;
}
?>

<style>
    /* Các kiểu CSS của bạn */
    body {
        font-family: Arial, sans-serif;
        background-color: #ffe4e3;
    }

    .product-confirm {
        width: 100%;
        max-width: 1200px;
        margin: 20px auto;
        padding: 50px;
        border-radius: 30px;
        background-color: #fef4f1;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        position: relative;
        display: flex;
        align-items: center;
    }

    .product-image {
        flex: 0 0 150px;
        text-align: center;
        margin-right: 30px;
    }

    .product-image img {
        border-radius: 50%;
        width: 150px;
        height: auto;
    }

    .product-info {
        flex: 1;
    }

    .product-item {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .product-item strong {
        width: 120px;
        color: #333;
        font-family: Arial, sans-serif;
    }

    .product-item span, .product-item input {
        flex: 1;
        color: #555;
    }

    .confirm-btn {
        display: block;
        width: 100%;
        padding: 12px;
        margin-top: 20px;
        border: none;
        border-radius: 5px;
        background-color: #f7bfd8;
        color: white;
        font-size: 16px;
        cursor: pointer;
    }

    .confirm-btn:hover {
        background-color: #ff89c4;
    }
</style>

<div class="product-confirm">
    <div class="product-image">
        <img src="../admin/images/<?php echo htmlspecialchars($product['thumbnail']); ?>" alt="<?php echo htmlspecialchars($product['title']); ?>">
    </div>
    
    <div class="product-info">
        <div class="product-item">
            <strong>Tên sản phẩm: </strong>
            <span><?php echo htmlspecialchars($product['title']); ?></span>
        </div>
        <div class="product-item">
            <strong>Giá:</strong>
            <span><?php echo number_format($product['price'], 0, ',', '.'); ?> VND</span>
        </div>
        <div class="product-item">
            <strong>Số lượng:</strong>
            <form action="" method="post"> <!-- Thay đổi action thành "" để gửi đến chính trang này -->
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['id']); ?>">
                <input type="hidden" name="title" value="<?php echo htmlspecialchars($product['title']); ?>">
                <input type="hidden" name="price" value="<?php echo htmlspecialchars($product['price']); ?>">
                <input type="hidden" name="thumbnail" value="<?php echo htmlspecialchars($product['thumbnail']); ?>">
                <input type="number" name="quantity" value="1" min="1" max="10" required>
                <button type="submit" class="confirm-btn">Xác Nhận Thêm Vào Giỏ Hàng</button>
            </form>
        </div>
    </div>
</div>

<?php
require('footer1.php');
$conn->close();  // Đóng kết nối
?>
