<?php 
require('includes/header.php');
require('../db/conn.php'); // Kết nối tới database

// Lấy ID người dùng từ query string hoặc request
$id = isset($_GET['id']) ? $_GET['id'] : '';

// Lấy thông tin người dùng hiện tại từ database
$sql_user = "SELECT * FROM user WHERE id='$id'";
$result_user = mysqli_query($conn, $sql_user);
$user = mysqli_fetch_assoc($result_user);

// Lấy danh sách role
$sql1 = "SELECT id, name FROM role";
$result1 = mysqli_query($conn, $sql1);

// Kiểm tra nếu form được submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $tk = $_POST['taikhoan'];
    $mk = $_POST['password'];
    $ten = $_POST['fullname']; 
    $phone = $_POST['phone_number']; 
    $address = $_POST['address'];
    $email = $_POST['email'];
    $role_id = $_POST['role_id'];

    // Câu lệnh SQL để cập nhật dữ liệu người dùng
    $sql = "UPDATE user SET taikhoan='$tk', password='$mk', fullname='$ten', phone_number='$phone', address='$address', email='$email', role_id='$role_id' WHERE id='$id'";

    // Thực thi câu lệnh SQL và kiểm tra nếu thành công
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Cập nhật khách hàng thành công!</div>";
    } else {
        echo "<div class='alert alert-danger'>Lỗi: " . $sql . "<br>" . $conn->error . "</div>";
    }
}
?>

<div class="row">
    <div class="col-lg-12">
        <form class="form-inline" role="form" action="user.php">
            <button type="submit" class="btn btn-danger">Quay lại</button>
        </form>
        <section class="panel">
            <header class="panel-heading">
                Chỉnh sửa khách hàng
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="" method="post">
                        <div class="form-group">
                            <label>ID</label>
                            <input type="text" name="id" class="form-control" value="<?php echo $user['id']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Tài khoản</label>
                            <input type="text" name="taikhoan" class="form-control" value="<?php echo $user['taikhoan']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Mật khẩu</label>
                            <input type="text" name="password" class="form-control" value="<?php echo $user['password']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Tên khách hàng</label>
                            <input type="text" name="fullname" class="form-control" value="<?php echo $user['fullname']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Số điện thoại</label>
                            <input type="text" name="phone_number" class="form-control" value="<?php echo $user['phone_number']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Địa chỉ</label>
                            <input type="text" name="address" class="form-control" value="<?php echo $user['address']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" value="<?php echo $user['email']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Quyền</label>
                            <select name="role_id" class="form-control" required>
                                <?php
                                if (mysqli_num_rows($result1) > 0) {
                                    while ($row = mysqli_fetch_assoc($result1)) {
                                        $selected = ($user['role_id'] == $row['id']) ? 'selected' : '';
                                        echo "<option value='" . $row['id'] . "' $selected>" . $row['name'] . "</option>";
                                    }
                                } else {
                                    echo "<option value=''>Không có danh mục nào</option>";
                                }
                                ?>
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-info">Cập nhật</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>

<?php
require('includes/footer.php');
?>
