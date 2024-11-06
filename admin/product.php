<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Admin</title>

    <!-- Custom fonts for this template-->
    <link
      href="vendor/fontawesome-free/css/all.min.css"
      rel="stylesheet"
      type="text/css"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
      rel="stylesheet"
    />

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet" />
  </head>

  <body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
      <!-- Sidebar -->
     <!-- Sidebar -->
<ul
        class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion"
        id="accordionSidebar"
      >
        <!-- Sidebar - Brand -->
        <a
          class="sidebar-brand d-flex align-items-center justify-content-center"
          href="index.php"
        >
          <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
          </div>
          <div class="sidebar-brand-text mx-3">Admin <sup></sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0" />

        <!-- Divider -->
        <hr class="sidebar-divider" />

        <!-- Heading -->
        <div class="sidebar-heading">Chức năng chính:</div>

        <!-- Nav Item - Pages Collapse Menu -->
        
        </li>
        <li class="nav-item">
          <a class="nav-link" href="role.php">
          <i class="far fa-share-square"></i></i>
            <span>Role</span></a
          >
        </li>

        <li class="nav-item ">
          <a
            class="nav-link collapsed"
            href="#"
            data-toggle="collapse"
            data-target="#collapseThree"
            aria-expanded="true"
            aria-controls="collapseTwo"
          >
          <i class="fas fa-store"></i>
            <span>Quản lý sản phẩm</span>
          </a>
          <div
            id="collapseThree"
            class="collapse"
            aria-labelledby="headingTwo"
            data-parent="#accordionSidebar"
          >
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Các chức năng:</h6>
              <a class="collapse-item" href="category.php">Danh mục sản phẩm</a>
              <a class="collapse-item" href="product.php">Sản phẩm</a>
            </div>
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="order.php">
          <i class="fas fa-shipping-fast"></i></i>
            <span>Đơn hàng</span></a
          >
        </li>

        <li class="nav-item">
          <a class="nav-link" href="user.php">
          <i class="fas fa-users"></i></i>
            <span>Khách hàng</span></a
          >
        </li>
        <!-- <li class="nav-item">
          <a
            class="nav-link collapsed"
            href="#"
            data-toggle="collapse"
            data-target="#collapseFour"
            aria-expanded="true"
            aria-controls="collapseTwo"
          >
            <i class="fas fa-wallet"></i>
            <span>Authentication</span>
          </a>
          <div
            id="collapseFour"
            class="collapse"
            aria-labelledby="headingTwo"
            data-parent="#accordionSidebar"
          >
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Các chức năng:</h6>
              <a class="collapse-item" href="login.php">Login</a>
              
            </div>
          </div>
        </li> -->

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block" />

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
      </ul>
      <!-- End of Sidebar -->
      <!-- End of Sidebar -->
      
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
          <!-- Topbar -->
          <nav
            class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow"
          >
            <!-- Sidebar Toggle (Topbar) -->
            <button
              id="sidebarToggleTop"
              class="btn btn-link d-md-none rounded-circle mr-3"
            >
              <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Search -->
                        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="product.php" method="GET">
                <div class="input-group">
                    <input
                        type="text"
                        name="search"
                        class="form-control bg-light border-0 small"
                        placeholder="Search for..."
                        aria-label="Search"
                        aria-describedby="basic-addon2"
                    />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>


            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
              <!-- Nav Item - Search Dropdown (Visible Only XS) -->
              <li class="nav-item dropdown no-arrow d-sm-none">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="searchDropdown"
                  role="button"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <i class="fas fa-search fa-fw"></i>
                </a>
                <!-- Dropdown - Messages -->
                <div
                  class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                  aria-labelledby="searchDropdown"
                >
                  <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                      <input
                        type="text"
                        class="form-control bg-light border-0 small"
                        placeholder="Search for..."
                        aria-label="Search"
                        aria-describedby="basic-addon2"
                      />
                      <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                          <i class="fas fa-search fa-sm"></i>
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </li>
              <!-- Nav Item - User Information -->
              <li class="nav-item dropdown no-arrow">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="userDropdown"
                  role="button"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <span class="mr-2 d-none d-lg-inline text-gray-600 small"
                    >DaMin</span
                  >
                  <img
                    class="img-profile rounded-circle"
                    src="img/undraw_profile.svg"
                  />
                </a>
                <!-- Dropdown - User Information -->
                <div
                  class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                  aria-labelledby="userDropdown"
                >
                  
                  
                  
                  <a
                    class="dropdown-item"
                    href="#"
                    data-toggle="modal"
                    data-target="#logoutModal"
                  >
                    <i
                      class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"
                    ></i>
                    Logout
                  </a>
                </div>
              </li>
            </ul>
          </nav>
          <!-- End of Topbar -->
                    <!-- Begin Page Content -->
                    <div class="container-fluid"></div>
<div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Sản phẩm</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <form action="add_pro.php" method="GET">
                    <button class="btn btn-success" type="submit">Thêm mới</button>
                </form>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Hình ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Danh mục</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Ngày tạo</th>
                            <th>Chỉnh sửa</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
require('../db/conn.php');

// Số bản ghi mỗi trang
$limit = 5; 

// Xác định trang hiện tại (mặc định là trang 1)
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start_from = ($page - 1) * $limit;

// Kiểm tra nếu có từ khóa tìm kiếm
$search = isset($_GET['search']) ? $_GET['search'] : '';
$search = mysqli_real_escape_string($conn, $search); // Bảo mật SQL Injection

// Lấy tổng số bản ghi có tìm kiếm
$total_query = "SELECT COUNT(id) AS total FROM product WHERE title LIKE '%$search%'";
$total_result = mysqli_query($conn, $total_query);
$total_row = mysqli_fetch_assoc($total_result);
$total_records = $total_row['total'];

// Tổng số trang
$total_pages = ceil($total_records / $limit);

// Truy vấn lấy dữ liệu phân trang có tìm kiếm
$sql_str = "SELECT product.*, category.name AS category_name 
            FROM product 
            JOIN category ON product.category_id = category.id 
            WHERE product.title LIKE '%$search%' 
            ORDER BY product.id 
            LIMIT $start_from, $limit";
    $result = mysqli_query($conn, $sql_str);
    while ($row = mysqli_fetch_assoc($result)){
?>

                        <tr>
                            <td><?=$row['id']?></td>
                            <td>
                                <img style="width: 100px;" src="images/<?php echo $row['thumbnail'];?>">
                            </td>
                            <td><?=$row['title']?></td>
                            <td><?=$row['category_name']?></td>
                            <td><?=$row['soluong']?></td>
                            <td><?=$row['price']?></td>
                            <td><?=$row['created_at']?></td>
                            <td>
                                <a class="btn btn-warning" href="edit_pro.php?id=<?=$row['id']?>">Edit</a> 
                                <a class="btn btn-danger" href="delete_pro.php?id=<?=$row['id']?>" onclick="return confirm('Bạn chắc chắn muốn xóa mục này?');">Delete</a>
                            </td>
                        </tr>
<?php
    }
?>                                  
                    </tbody>
                </table>

                <!-- Tạo phân trang -->
                <nav>
                <ul class="pagination justify-content-center">
        <?php 
        if ($total_pages > 1) {
            // Hiển thị nút Previous
            if ($page > 1) {
                echo "<li class='page-item'><a class='page-link' href='?page=".($page - 1)."&search=".urlencode($search)."'> &laquo; </a></li>";
            }

            // Hiển thị trang đầu tiên
            echo "<li class='page-item'><a class='page-link' href='?page=1&search=".urlencode($search)."'>1</a></li>";

            // Hiển thị dấu "..." nếu có trang trước đó
            if ($page > 3) {
                echo "<li class='page-item'><span class='page-link'>...</span></li>";
            }

            // Hiển thị trang hiện tại và 2 trang xung quanh
            for ($i = max(2, $page - 1); $i <= min($page + 1, $total_pages - 1); $i++) {
                if ($i == $page) {
                    echo "<li class='page-item active'><a class='page-link' href='?page=".$i."&search=".urlencode($search)."'>".$i."</a></li>";
                } else {
                    echo "<li class='page-item'><a class='page-link' href='?page=".$i."&search=".urlencode($search)."'>".$i."</a></li>";
                }
            }

            // Hiển thị dấu "..." nếu còn trang sau đó
            if ($page < $total_pages - 2) {
                echo "<li class='page-item'><span class='page-link'>...</span></li>";
            }

            // Hiển thị trang cuối cùng
            echo "<li class='page-item'><a class='page-link' href='?page=".$total_pages."&search=".urlencode($search)."'>".$total_pages."</a></li>";

            // Hiển thị nút Next
            if ($page < $total_pages) {
                echo "<li class='page-item'><a class='page-link' href='?page=".($page + 1)."&search=".urlencode($search)."'>&raquo;</a></li>";
            }
        }
        ?>
    </ul>
</nav>

            </div>
        </div>
    </div>
</div>

<?php
require('includes/footer.php');
?>
