<?php 
require('includes/header.php');
require('../db/conn.php'); // Kết nối tới database

// Kiểm tra nếu form được submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $id = $_POST['id'];
    $tendanhmuc = $_POST['tendanhmuc'];

    // Kiểm tra xem tên danh mục có rỗng không
    if (!empty($tendanhmuc)) {
        // Kiểm tra xem tên danh mục đã tồn tại trong database chưa
        $sql_check = "SELECT * FROM category WHERE name='$tendanhmuc'";
        $result_check = mysqli_query($conn, $sql_check);

        if (mysqli_num_rows($result_check) > 0) {
            // Nếu tồn tại danh mục trùng
            echo "<div class='alert alert-danger'>Tên danh mục đã tồn tại! Vui lòng chọn tên khác.</div>";
        } else {
            // Câu lệnh SQL để thêm dữ liệu vào bảng
            $sql = "INSERT INTO category (id, name) VALUES ('$id', '$tendanhmuc')";

            // Thực thi câu lệnh SQL và kiểm tra nếu thành công
            if ($conn->query($sql) === TRUE) {
                echo "<div class='alert alert-success'>Thêm mới danh mục thành công!</div>";
            } else {
                echo "<div class='alert alert-danger'>Lỗi: " . $sql . "<br>" . $conn->error . "</div>";
            }
        }
    } else {
        echo "<div class='alert alert-warning'>Vui lòng nhập tên danh mục!</div>";
    }
}
?>

<div class="row">
    <div class="col-lg-12">
        <form class="form-inline" role="form" action="category.php"> <!-- Điều hướng về trang trước -->
            <button type="submit" class="btn btn-danger">Quay lại</button>
        </form>
        <section class="panel">
            <header class="panel-heading">
                Thêm mới danh mục
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="" method="post">
                        <div class="form-group">
                            <label for="exampleInputEmail1">ID</label>
                            <input type="text" name="id" class="form-control" id="exampleInputEmail1" placeholder="Nhập ID" readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" name="tendanhmuc" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên danh mục">
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
