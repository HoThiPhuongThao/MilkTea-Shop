<?php 
require('includes/header.php');
require('../db/conn.php'); // Kết nối tới database

// Lấy ID từ URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Truy vấn lấy dữ liệu role từ ID
    $sql = "SELECT * FROM role WHERE id = '$id'";
    $result = $conn->query($sql);

    // Kiểm tra nếu role tồn tại
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<div class='alert alert-danger'>Quyền không tồn tại!</div>";
        exit;
    }
}

// Kiểm tra nếu form được submit để cập nhật dữ liệu
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ten = $_POST['ten'];

    // Kiểm tra xem tên có rỗng không
    if (!empty($ten)) {
        // Câu lệnh SQL để cập nhật dữ liệu
        $sql = "UPDATE role SET name = '$ten' WHERE id = '$id'";

        // Thực thi câu lệnh SQL và kiểm tra nếu thành công
        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success'>Cập nhật quyền thành công!</div>";
        } else {
            echo "<div class='alert alert-danger'>Lỗi: " . $conn->error . "</div>";
        }
    } else {
        echo "<div class='alert alert-warning'>Vui lòng nhập tên quyền!</div>";
    }
}
?>

<div class="row">
    <div class="col-lg-12">
        <form class="form-inline" role="form" action="role.php"> <!-- Điều hướng về trang trước -->
            <button type="submit" class="btn btn-danger">Quay lại</button>
        </form>
        <section class="panel">
            <h1 style="text-align: center;">
                Chỉnh sửa quyền
            </h1>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="" method="post">
                        <div class="form-group">
                            <label for="exampleInputEmail1">ID</label>
                            <input type="text" name="id" class="form-control" id="exampleInputEmail1" value="<?php echo $row['id']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên</label>
                            <input type="text" name="ten" class="form-control" id="exampleInputEmail1" value="<?php echo $row['name']; ?>" placeholder="Nhập tên">
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