<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .register-form {
            background: #fef4f1;
            padding: 20px;
            border-radius: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 500px;
            text-align: left;
            margin: 0 auto;
        }
        .register-form h2 {
            margin: 0 0 20px;
            font-size: 24px;
            text-align: center;
        }
        .register-form input, .register-form select {
            width: 100%;
            padding: 10px;
            margin: 15px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .register-form button {
            width: 100%;
            padding: 10px;
            background-color: #ff6b6b;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        .register-form button:hover {
            background-color: #ff4d4d;
        }
        .register-form p {
            margin-top: 10px;
            font-size: 14px;
            text-align: center;
        }
        .register-form p a {
            color: #ff6b6b;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="register-form">
        <h2>REGISTER NOW</h2>
        <?php 
        session_start();
        require('../db/conn.php'); 

        // Xác định quyền mặc định
        $sql1 = "SELECT id, name FROM role WHERE name = 'customer' LIMIT 1";
        $result1 = mysqli_query($conn, $sql1);
        $customerRole = mysqli_fetch_assoc($result1);

        // Xử lý form đăng ký
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $tk = $_POST['taikhoan'];
            $mk = $_POST['password'];
            $ten = $_POST['fullname']; 
            $phone = $_POST['phone_number']; 
            $address = $_POST['address'];
            $email = $_POST['email'];
            $role_id = $customerRole['id']; // Gán trực tiếp role_id là 'customer'
            $ngay = date('Y-m-d H:i:s');

            // Chèn dữ liệu người dùng vào bảng user
            $sql = "INSERT INTO user (taikhoan, password, fullname, phone_number, address, email, role_id, created_at) 
                    VALUES ('$tk', '$mk', '$ten', '$phone', '$address', '$email', '$role_id', '$ngay')";

            if ($conn->query($sql) === TRUE) {
                // Lấy user_id của người dùng vừa đăng ký
                $user_id = $conn->insert_id;
                // Lưu user_id vào session
                $_SESSION['user_id'] = $user_id;

                // Chuyển hướng về trang đăng nhập
                header("Location: login.php");
                exit();
            } else {
                echo "<div class='alert alert-danger'>Lỗi: " . $sql . "<br>" . $conn->error . "</div>";
            }
        }
        ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Tài khoản</label>
                <input type="text" name="taikhoan" class="form-control" placeholder="Nhập tài khoản" required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword">Mật khẩu</label>
                <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu" required>
            </div>
            <div class="form-group">
                <label for="fullname">Tên khách hàng</label>
                <input type="text" name="fullname" class="form-control" placeholder="Nhập tên khách hàng" required>
            </div>
            <div class="form-group">
                <label for="phone">Số điện thoại</label>
                <input type="text" name="phone_number" class="form-control" placeholder="Nhập số điện thoại" required>
            </div>
            <div class="form-group">
                <label for="address">Địa chỉ</label>
                <input type="text" name="address" class="form-control" placeholder="Nhập địa chỉ" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Nhập Email" required>
            </div>
            <!-- Ẩn trường chọn quyền -->
            <input type="hidden" name="role_id" value="<?php echo $customerRole['id']; ?>">
            <button type="submit" class="btn btn-info">Lưu</button>
        </form>
        <p>Already have an account? <a href="login.php">Login now</a></p>
    </div>
</body>
</html>
