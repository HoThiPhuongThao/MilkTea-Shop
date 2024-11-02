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
          <div class="sidebar-brand-text mx-3">Admin</div>
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
          <i class="far fa-share-square"></i>
            <span>Role</span></a
          >
        </li>

        <li class="nav-item ">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
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
        <li class="nav-item">
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
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block" />

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
      </ul>
      <!-- End of Sidebar -->