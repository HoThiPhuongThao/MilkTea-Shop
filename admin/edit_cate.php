<?php
// Kết nối cơ sở dữ liệu
require('../db/conn.php');

// Kiểm tra nếu có tham số 'id' được gửi qua URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    // Truy vấn lấy thông tin danh mục theo ID
    $sql = "SELECT * FROM category WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $category = mysqli_fetch_assoc($result);

    if (!$category) {
        echo "Không tìm thấy danh mục.";
        exit;
    }
} else {
    echo "ID không hợp lệ.";
    exit;
}

// Xử lý khi form được submit để cập nhật thông tin
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tendanhmuc = $_POST['tendanhmuc'];

    // Cập nhật thông tin danh mục
    $update_sql = "UPDATE category SET name = '$tendanhmuc' WHERE id = $id";
    if (mysqli_query($conn, $update_sql)) {
        header("Location: category.php?update_success=1");
        exit;
    } else {
        echo "Lỗi khi cập nhật: " . mysqli_error($conn);
    }
}
?>

<?php 
require('includes/header.php');
?>

<div class="container">
    <h2>Chỉnh sửa danh mục</h2>
    <form action="" method="post">
        <div class="form-group">
            <label for="tendanhmuc">Tên danh mục</label>
            <input type="text" name="tendanhmuc" class="form-control" id="tendanhmuc" value="<?=$category['name']?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="category.php" class="btn btn-secondary">Quay lại</a>
    </form>
</div>

<?php 
require('includes/footer.php');
?>
