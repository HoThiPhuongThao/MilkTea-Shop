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
        // Xử lý tải lên hình ảnh
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
            $sql = "UPDATE product SET title = '$ten', category_id = '$cate_id', soluong = $soluong, price = $gia, updated_at = '$ngay',description ='$mota' WHERE id = '$product_id'";

            // Thực thi câu lệnh SQL và kiểm tra nếu thành công
            if ($conn->query($sql) === TRUE) {
                echo "<div class='alert alert-success'>Cập nhật sản phẩm thành công!</div>";
            } else {
                echo "<div class='alert alert-danger'>Lỗi: " . $sql . "<br>" . $conn->error . "</div>";
            }
        }
    }
} else {
    header("Location: product.php"); // Chuyển hướng nếu không có ID sản phẩm
    exit;
}
?>

<div class="row">
    <div class="col-lg-12">
        <form class="form-inline" role="form" action="product.php"> <!-- Điều hướng về trang trước -->
            <button type="submit" class="btn btn-danger">Quay lại</button>
        </form>
        <section class="panel">
            <h1 style="text-align: center;">
                Chỉnh sửa sản phẩm
            </h1>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="" method="post" enctype="multipart/form-data"> <!-- Thêm enctype cho upload file -->
                        <div class="form-group">
                            <label for="exampleInputEmail1">ID</label>
                            <input type="text" name="id" class="form-control" id="exampleInputEmail1" placeholder="Nhập ID" value="<?php echo $product['id']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh</label>
                            <input type="file" name="thumbnail" class="form-control" id="exampleInputEmail1" placeholder="Nhập Ảnh">
                            <small>Hiện tại: <?php echo $product['thumbnail']; ?></small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" name="title" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên sản phẩm" value="<?php echo $product['title']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="category">Danh mục</label>
                            <select name="category_id" class="form-control" id="categorySelect" required>
                                <?php
                                // Kiểm tra nếu có dữ liệu trả về
                                if (mysqli_num_rows($result1) > 0) {
                                    // Lặp qua từng dòng dữ liệu và tạo thẻ <option>
                                    while ($row = mysqli_fetch_assoc($result1)) {
                                        $selected = ($row['id'] == $product['category_id']) ? 'selected' : '';
                                        echo "<option value='" . $row['id'] . "' $selected>" . $row['name'] . "</option>";
                                    }
                                } else {
                                    echo "<option value=''>Không có danh mục nào</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số lượng</label>
                            <input type="number" name="soluong" class="form-control" id="exampleInputEmail1" placeholder="Nhập số lượng" value="<?php echo $product['soluong']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá</label>
                            <input type="number" step="0.01" name="price" class="form-control" id="exampleInputEmail1" placeholder="Nhập giá" value="<?php echo $product['price']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mô tả</label>
                            <input type="text" name="description" class="form-control" id="exampleInputEmail1" placeholder="Nhập mô tả" value="<?php echo $product['title']; ?>" required>
                        </div>
                        <button type="submit" class="btn btn-info">Lưu</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>

<?php
require('includes/footer.php');
?>
