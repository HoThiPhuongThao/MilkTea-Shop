<?php 
require('includes/header.php');
require('../db/conn.php'); // Kết nối tới database

// Kiểm tra nếu form được submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $id = $_POST['id'];
    $ten = $_POST['ten'];

    // Kiểm tra xem tên danh mục có rỗng không
    if (!empty($ten)) {
        // Câu lệnh SQL để thêm dữ liệu vào bảng
        $sql = "INSERT INTO role (id, name) VALUES ('$id', '$ten')";

        // Thực thi câu lệnh SQL và kiểm tra nếu thành công
        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success'>Thêm mới danh mục thành công!</div>";
        } else {
            echo "<div class='alert alert-danger'>Lỗi: " . $sql . "<br>" . $conn->error . "</div>";
        }
    } else {
        echo "<div class='alert alert-warning'>Vui lòng nhập tên danh mục!</div>";
    }
}
?>

<div class="row">
    <div class="col-lg-12">
        <form class="form-inline" role="form" action="role.php"> <!-- Điều hướng về trang trước -->
            <button type="submit" class="btn btn-danger">Quay lại</button>
        </form>
        <section class="panel">
            <header class="panel-heading">
                Thêm mới quyền
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="" method="post">
                        <div class="form-group">
                            <label for="exampleInputEmail1">ID</label>
                            <input type="text" name="id" class="form-control" id="exampleInputEmail1" placeholder="Nhập ID" readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên</label>
                            <input type="text" name="ten" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên">
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
