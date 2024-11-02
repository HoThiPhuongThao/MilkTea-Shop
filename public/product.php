<?php
require('header.php');
require('../db/conn.php');  // Kết nối đến cơ sở dữ liệu

// Truy vấn 3 sản phẩm mới nhất
$newProductsSql = "SELECT product.*, category.name AS category_name 
                   FROM product 
                   JOIN category ON product.category_id = category.id 
                   ORDER BY product.id DESC 
                   LIMIT 3";
$newProductsResult = $conn->query($newProductsSql);

// Truy vấn 3 sản phẩm nổi bật
$featuredProductsSql = "SELECT product.*, category.name AS category_name, SUM(order_details.num) AS total_sold 
                        FROM product 
                        JOIN order_details ON product.id = order_details.product_id 
                        JOIN category ON product.category_id = category.id 
                        GROUP BY product.id 
                        ORDER BY total_sold DESC 
                        LIMIT 3";
$featuredProductsResult = $conn->query($featuredProductsSql);
?>

<link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
<style>
    body { 
        font-family: Arial, sans-serif; 
    }
    .product-container { 
        padding: 40px;
        background-color: #ffe4e3; 
    }
    .product-container h2 {
        text-align: center;
        color: #337357;
        margin-bottom: 40px;
        font-family: Arial, sans-serif; 
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
        text-align: left;
        margin-bottom: 5px;
    }
    .product-image img { 
        border-radius: 40px; 
        object-fit: cover; 
        margin-bottom: 20px; 
    }
    .featured-products {
        margin-top: 60px; 
    }
    .price-cart {
        display: flex;
        align-items: center;
        margin-top: 5px;
    }
    .price {
        font-size: 16px; 
        color: #ff2190; 
        font-weight: bold;
    }
    .cart-add {
        margin-left: auto; 
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
</style>

<div class="product-container">
    <h2>Sản phẩm mới nhất</h2>
    <div class="product-list">
        <?php
        if ($newProductsResult->num_rows > 0) {
            while ($row = $newProductsResult->fetch_assoc()) {
                echo '<div class="product-card">';
                echo '<div class="product-content">';
                echo '<div class="product-image"><img src="../admin/images/' . $row["thumbnail"] . '" alt="' . htmlspecialchars($row["title"]) . '"></div>';
                echo '<h2><a href="product_detail.php?id=' . $row["id"] . '" style="color: black; text-decoration: none;">' . htmlspecialchars($row["title"]) . '</a></h2>';
                echo '<div class="price-cart">';
                echo '<span class="price">' . number_format($row["price"], 0, ',', '.') . ' VND</span>';
                echo '<button class="cart-add"><a href="confim_add_cart.php?id=' . $row["id"] . '" class="cart-link"><i class="bx bx-cart-add"></i></a></button>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "Không có sản phẩm mới.";
        }
        ?>
    </div>

    <h2 class="featured-products">Sản phẩm nổi bật</h2>
    <div class="product-list">
        <?php
        if ($featuredProductsResult->num_rows > 0) {
            while ($row = $featuredProductsResult->fetch_assoc()) {
                echo '<div class="product-card">';
                echo '<div class="product-content">';
                echo '<div class="product-image"><img src="../admin/images/' . $row["thumbnail"] . '" alt="' . htmlspecialchars($row["title"]) . '"></div>';
                echo '<h2><a href="product_detail.php?id=' . $row["id"] . '" style="color: black; text-decoration: none;">' . htmlspecialchars($row["title"]) . '</a></h2>';
                echo '<div class="price-cart">';
                echo '<span class="price">' . number_format($row["price"], 0, ',', '.') . ' VND</span>';
                echo '<button class="cart-add"><a href="confim_add_cart.php?id=' . $row["id"] . '" class="cart-link"><i class="bx bx-cart-add"></i></a></button>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "Không có sản phẩm nổi bật.";
        }
        ?>
    </div>
</div>

<?php
require('footer1.php');
$conn->close();  // Đóng kết nối
?>
