<?php
// Kết nối tới cơ sở dữ liệu
$servername = "localhost"; // Thay bằng tên máy chủ của bạn
$username = "username"; // Thay bằng tên người dùng của bạn
$password = "password"; // Thay bằng mật khẩu của bạn
$dbname = "web"; // Thay bằng tên cơ sở dữ liệu của bạn

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra xem có tìm kiếm không
if (isset($_GET['search'])) {
    $searchQuery = $_GET['search'];

    // Truy vấn cơ sở dữ liệu để tìm kiếm sản phẩm
    $sql = "SELECT * FROM products WHERE name LIKE '%$searchQuery%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Kết quả tìm kiếm cho: " . htmlspecialchars($searchQuery) . "</h2>";
        while ($row = $result->fetch_assoc()) {
            echo "<div class='product'>";
            echo "<h3>" . htmlspecialchars($row['name']) . "</h3>";
            echo "<p>" . htmlspecialchars($row['description']) . "</p>";
            echo "<p>Giá: " . htmlspecialchars($row['price']) . "</p>";
            echo "</div>";
        }
    } else {
        echo "<h2>Không tìm thấy sản phẩm nào.</h2>";
    }
} else {
    echo "<h2>Vui lòng nhập từ khóa tìm kiếm.</h2>";
}

$conn->close();
?>
