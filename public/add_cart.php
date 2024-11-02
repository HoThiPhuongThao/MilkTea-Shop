<?php
session_start();
require('../db/conn.php');

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $product_id = intval($_GET['id']);
    
    $stmt = $conn->prepare("SELECT * FROM product WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity']++;
        } else {
            $_SESSION['cart'][$product_id] = [
                'id' => $product['id'],
                'title' => $product['title'],
                'price' => $product['price'],
                'thumbnail' => $product['thumbnail'],
                'quantity' => 1
            ];
        }

        header("Location: cart.php");
        exit;
    } else {
        echo "Sản phẩm không tồn tại!";
    }
} else {
    echo "ID sản phẩm không hợp lệ!";
}

$conn->close();
?>
