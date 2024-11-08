<?php 
require('includes/header.php');
require('../db/conn.php'); // Kết nối tới database

$sql1 = "SELECT id, name FROM role";
$result1 = mysqli_query($conn, $sql1);

// Kiểm tra nếu form được submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $id = $_POST['id'];
    $tk = $_POST['taikhoan'];
    $mk = $_POST['password'];
    $ten = $_POST['fullname']; 
    $phone = $_POST['phone_number']; 
    $address = $_POST['address'];
    $email = $_POST['email'];
    $role_id = $_POST['role_id'];
    $ngay = date('Y-m-d H:i:s'); // Thiết lập ngày giờ hiện tại
    $check_Sql = "SELECT * FROM user WHERE  taikhoan = '$tk'";
    $check_Result = mysqli_query($conn, $check_Sql);
         if (mysqli_num_rows($check_Result) > 0) {
            echo "<div class='alert-danger'>Tài khoản đã tồn tại.Vui lòng tạo tài khoản khác.</div>";}
            else {  
                // Câu lệnh SQL để thêm dữ liệu vào bảng
                $sql = "INSERT INTO user (id, taikhoan, password, fullname, phone_number, address, email, role_id, created_at) 
                        VALUES ('$id', '$tk', '$mk', '$ten', '$phone', '$address', '$email', '$role_id', '$ngay')";

                // Thực thi câu lệnh SQL và kiểm tra nếu thành công
                if ($conn->query($sql) === TRUE) {
                    echo "<div class='alert alert-success'>Thêm mới khách hàng thành công!</div>";
                } else {
                    echo "<div class='alert alert-danger'>Lỗi: " . $sql . "<br>" . $conn->error . "</div>";
                }
            }
        }
?>

<div class="row">
    <div class="col-lg-12">
        <form class="form-inline" role="form" action="user.php"> <!-- Điều hướng về trang trước -->
            <button type="submit" class="btn btn-danger">Quay lại</button>
        </form>
        <section class="panel">
            <h1 style="text-align: center;">
                Thêm mới khách hàng
            </h1>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="" method="post"> <!-- Bỏ enctype vì không cần upload file -->
                        <div class="form-group">
                            <label for="exampleInputEmail1">ID</label>
                            <input type="text" name="id" class="form-control" id="exampleInputEmail1" placeholder="Nhập ID" readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tài khoản</label>
                            <input type="text" name="taikhoan" class="form-control" id="exampleInputEmail1" placeholder="Nhập tài khoản" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mật khẩu</label>
                            <input type="text" name="password" class="form-control" id="exampleInputEmail1" placeholder="Nhập mật khẩu" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên khách hàng</label>
                            <input type="text" name="fullname" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên khách hàng" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số điện thoại</label>
                            <input type="text" name="phone_number" class="form-control" id="exampleInputEmail1" placeholder="Nhập số điện thoại" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Địa chỉ</label>
                            <input type="text" name="address" class="form-control" id="exampleInputEmail1" placeholder="Nhập địa chỉ" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="text" name="email" class="form-control" id="exampleInputEmail1" placeholder="Nhập Email" required>
                        </div>
                        <div class="form-group">
                            <label for="role">Quyền</label>
                            <select name="role_id" class="form-control" id="roleSelect" required>
                                <?php
                                // Kiểm tra nếu có dữ liệu trả về
                                if (mysqli_num_rows($result1) > 0) {
                                    // Lặp qua từng dòng dữ liệu và tạo thẻ <option>
                                    while ($row = mysqli_fetch_assoc($result1)) {
                                        echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                    }
                                } else {
                                    echo "<option value=''>Không có danh mục nào</option>";
                                }
                                ?>
                            </select>
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
