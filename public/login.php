<?php
session_start();
include_once('../db/conn.php');

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $_SESSION['user']['id'] = $user['id'];
        $_SESSION['user']['fullname'] = $user['fullname'];
        header("location: index.php");
        exit();
    } else {
        $error = 'Wrong email or password';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin - Đăng Nhập</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        .login-card {
            max-width: 400px;
            margin: 5% auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            background-color: #fef4f1;
        }
        .login-card h2 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .login-card input {
            margin-bottom: 15px;
            height: 45px;
            border-radius: 5px;
        }
        .login-card .btn-login {
            width: 100%;
            background-color: #ff758c;
            color: #fff;
            font-weight: bold;
            height: 45px;
            border: none;
            border-radius: 5px;
        }
        .register-link {
            text-align: center;
            margin-top: 15px;
        }
        .register-link a {
            color: #ff758c;
            text-decoration: none;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container">
        <!-- Outer Row -->
        <div class="login-card">
            <div class="text-center">
                <h2>LOGIN NOW</h2>
            </div>

            <!-- Hiển thị thông báo lỗi nếu có -->
            <?php if (isset($_SESSION['error_message'])): ?>
                <div class="alert alert-danger">
                    <?php 
                        echo $_SESSION['error_message']; 
                        unset($_SESSION['error_message']); // Xóa thông báo sau khi hiển thị
                    ?>
                </div>
            <?php endif; ?>

            <form action="add_login.php" method="POST">
                <input type="email" class="form-control" name="email" placeholder="Nhập email của bạn" required>
                <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu" required>
                <button type="submit" class="btn-login">Đăng Nhập</button>
            </form>

            <div class="register-link">
                <p>Bạn chưa có tài khoản? <a href="register.php">Đăng ký ngay!</a></p>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
</body>
</html>
