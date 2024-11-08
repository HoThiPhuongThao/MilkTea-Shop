<?php 
require('includes/header.php');
require('../db/conn.php'); // Kết nối tới database

// Kiểm tra nếu có ID sản phẩm trong URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Lấy thông tin sản phẩm từ cơ sở dữ liệu
    $sql_product = "SELECT * FROM product WHERE id = '$product_id'";
    $result_product = mysqli_query($conn, $sql_product);
    $product = mysqli_fetch_assoc($result_product);

    // Nếu sản phẩm không tồn tại, chuyển hướng về trang danh sách sản phẩm
    if (!$product) {
        header("Location: product.php");
        exit;
    }

    // Lấy danh mục sản phẩm
    $sql1 = "SELECT id, name FROM category";
    $result1 = mysqli_query($conn, $sql1);

    // Kiểm tra nếu form được submit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Lấy dữ liệu từ form
        $ten = $_POST['title'];
        $cate_id = $_POST['category_id'];
        $soluong = (int)$_POST['soluong']; // Chuyển đổi thành số
        $gia = (float)$_POST['price']; // Chuyển đổi thành số thực
        $anh = $product['thumbnail']; // Giữ lại tên tệp cũ
        $mota = $_POST['description'];

        // Kiểm tra nếu tên sản phẩm mới đã tồn tại trong cơ sở dữ liệu (ngoài sản phẩm hiện tại)
        $sql_check = "SELECT * FROM product WHERE title = '$ten' AND id != '$product_id'";
        $result_check = mysqli_query($conn, $sql_check);
        if (mysqli_num_rows($result_check) > 0) {
            echo "<div class='alert alert-danger'>Lỗi: Sản phẩm có tên '$ten' đã tồn tại trong bảng sản phẩm!</div>";
        } else {
            // Xử lý tải lên hình ảnh nếu có
            if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] == 0) {
                $upload_dir = 'images/'; // Đường dẫn đến thư mục lưu trữ
                $file_name = basename($_FILES['thumbnail']['name']); // Lấy tên tệp hình ảnh
                $anh = $file_name; // Chỉ lưu tên tệp, không cần đường dẫn

                // Di chuyển tệp tải lên vào thư mục mong muốn
                if (move_uploaded_file($_FILES['thumbnail']['tmp_name'], $upload_dir . $file_name)) {
                    // Nếu tải lên thành công, cập nhật thông tin sản phẩm
                    $ngay = date('Y-m-d H:i:s'); // Thiết lập ngày giờ hiện tại

                    // Câu lệnh SQL để cập nhật dữ liệu vào bảng
                    $sql = "UPDATE product SET thumbnail = '$anh', title = '$ten', category_id = '$cate_id', soluong = $soluong, price = $gia, updated_at = '$ngay', description = '$mota' WHERE id = '$product_id'";

                    // Thực thi câu lệnh SQL và kiểm tra nếu thành công
                    if ($conn->query($sql) === TRUE) {
                        echo "<div class='alert alert-success'>Cập nhật sản phẩm thành công!</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Lỗi: " . $sql . "<br>" . $conn->error . "</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>Lỗi tải lên hình ảnh!</div>";
                }
            } else {
                // Nếu không có hình ảnh mới, cập nhật thông tin sản phẩm mà không thay đổi ảnh
                $ngay = date('Y-m-d H:i:s'); // Thiết lập ngày giờ hiện tại
                $sql = "UPDATE product SET title = '$ten', category_id = '$cate_id', soluong = $soluong, price = $gia, updated_at = '$ngay', description = '$mota' WHERE id = '$product_id'";

                // Thực thi câu lệnh SQL và kiểm tra nếu thành công
                if ($conn->query($sql) === TRUE) {
                    echo "<div class='alert alert-success'>Cập nhật sản phẩm thành công!</div>";
                } else {
                    echo "<div class='alert alert-danger'>Lỗi: " . $sql . "<br>" . $conn->error . "</div>";
                }
            }
        }
    }
} else {
    header("Location: product.php"); // Chuyển hướng nếu không có ID sản phẩm
    exit;
}
?>

<!-- Các phần HTML còn lại không thay đổi -->
