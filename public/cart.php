<?php
session_start();
require('header.php');
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffe4e3;
            color: black;
        }
        .cart-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fef4f1;
            border: 1px solid #ddd;
            border-radius: 30px;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
        }
        .cart-header {
            font-weight: bold;
            margin-bottom: 20px;
            font-size: 1.5em;
            text-align: center;
            color: #ff2190;
        }
        .cart-item {
            display: flex;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #ddd;
        }
        .cart-item img {
            width: 80px;
            height: auto;
            border-radius: 5px;
            margin-right: 15px;
        }
        .cart-item-details {
            flex: 1;
            display: flex;
            flex-direction: column;
            color: black;
        }
        .cart-item-name {
            font-weight: bold;
            font-size: 1.1em;
        }
        .cart-item-price {
            font-weight: bold;
            color: #ff2190;
            margin-top: 5px;
        }
        .cart-item-quantity {
            display: flex;
            align-items: center;
        }
        .quantity-btn {
            background-color: #f7bfd8;
            color: black;
            border: none;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border-radius: 5px;
            font-size: 1.2em;
            margin: 0 5px;
        }
        .quantity-btn:hover {
            background-color: #ff89c4;
        }
        .cart-item-actions {
            display: flex;
            align-items: center;
            margin-left: 10px;
        }
        .cart-item-actions i {
            font-size: 1.5em;
            color: #555;
            cursor: pointer;
        }
        .cart-item-actions i:hover {
            color: black;
        }
        .cart-total {
            display: flex;
            justify-content: space-between;
            font-weight: bold;
            padding: 15px 0;
            font-size: 1.2em;
            color: #ff2190;
        }
        .checkout-container {
            display: flex;
            justify-content: center;
        }
        .checkout-button {
            width: 100%;
            padding: 15px;
            background-color: #f7bfd8;
            color: #ff2190;
            font-size: 1.2em;
            font-weight: bold;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            text-align: center;
            margin-top: 20px;
        }
        .checkout-button:hover {
            background-color: #ff89c4;
        }
    </style>
</head>
<body>
    <div class="cart-container">
        <div class="cart-header">Giỏ Hàng</div>
        <?php
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            $total_price = 0;
            
            foreach ($_SESSION['cart'] as $item) {
                $item_price = isset($item['price']) ? $item['price'] : 0;
                $item_quantity = isset($item['quantity']) ? $item['quantity'] : 1;
                $item_thumbnail = isset($item['thumbnail']) ? $item['thumbnail'] : 'no_image.jpg';
                $item_title = isset($item['title']) ? $item['title'] : 'Tên sản phẩm không xác định';
                $item_total = $item_price * $item_quantity;
                $total_price += $item_total;
                ?>
                <div class="cart-item">
                  <img src="../admin/images/<?php echo htmlspecialchars($item_thumbnail); ?>" alt="<?php echo htmlspecialchars($item_title); ?>" class="thumbnail-img">
                  <div class="cart-item-details">
                      <div class="cart-item-name"><?php echo htmlspecialchars($item_title); ?></div>
                      <div class="cart-item-price"><?php echo number_format($item_price, 0, ',', '.'); ?> đ</div>
                  </div>
                  <div class="cart-item-quantity">
                      <button class="quantity-btn" onclick="changeQuantity('<?php echo $item['id']; ?>', -1)">-</button>
                      <input type="text" id="quantity-<?php echo $item['id']; ?>" value="<?php echo $item_quantity; ?>" style="width: 30px; text-align: center;" readonly>
                      <button class="quantity-btn" onclick="changeQuantity('<?php echo $item['id']; ?>', 1)">+</button>
                  </div>
                  <div class="cart-item-actions">
                    <a href="delete_cart.php?id=<?php echo htmlspecialchars($item['id']); ?>"><i class='bx bx-trash'></i></a>
                </div>
              </div>
                <?php
            }
            ?>
            <div class="cart-total">
                <span>Tổng cộng:</span>
                <span id="total-price"><?php echo number_format($total_price, 0, ',', '.'); ?> đ</span>
            </div>
            <div class="checkout-container">
            <a href="checkout.php" class="checkout-button">Tiến hành thanh toán</a>
            </div>
            <?php
        } else {
            echo "<p>Giỏ hàng trống</p>";
        }
        ?>
    </div>

    <script>
        function changeQuantity(productId, change) {
            var quantityInput = document.getElementById('quantity-' + productId);
            var currentQuantity = parseInt(quantityInput.value);
            var newQuantity = currentQuantity + change;

            if (newQuantity < 1) {
                newQuantity = 1; // Không cho phép số lượng âm
            }

            quantityInput.value = newQuantity;

            var pricePerUnit = <?php echo json_encode(array_column($_SESSION['cart'], 'price', 'id')); ?>[productId];
            var newTotal = pricePerUnit * newQuantity;

            var totalPriceElement = document.getElementById('total-price');
            var currentTotal = parseInt(totalPriceElement.innerText.replace(/\./g, '').replace(' đ', ''));
            var newOverallTotal = currentTotal + (change * pricePerUnit);
            totalPriceElement.innerText = newOverallTotal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') + ' đ';
        }
    </script>

</body>
</html>

<?php require('footer1.php'); ?>
