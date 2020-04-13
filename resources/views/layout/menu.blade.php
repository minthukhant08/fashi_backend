<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-light navbar-primary">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
    {{-- <li class="nav-item d-none d-sm-inline-block">
      <a href="index3.html" class="nav-link">Home</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="#" class="nav-link">Contact</a>
    </li> --}}
  </ul>

  <!-- SEARCH FORM -->
  {{-- <form class="form-inline ml-3">
    <div class="input-group input-group-sm">
      <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
      <div class="input-group-append">
        <button class="btn btn-navbar" type="submit">
          <i class="fas fa-search"></i>
        </button>
      </div>
    </div>
  </form> --}}

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">

    <li class="nav-item">
      <div class="user-panel pb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block" style="color:white">{{ Auth::user()->name }}</a>
        </div>
        <div class="image">
          <img src="{{url('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>

      </div>
    </li>
  </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4 sidebar-dark-warning">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="{{url('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light">Online Shopping</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->


    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->

        <a href="/" class="nav-link">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Dashboard
          </p>
        </a>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Setups
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/brand" class="nav-link">
                <i class="ion ion-ios-glasses-outline"></i>
                <p>Brand</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/type" class="nav-link">
                <i class="ion ion-ios-albums"></i>
                <p>Type</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/category" class="nav-link">
                <i class="ion ion-ios-list"></i>
                <p>Category</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/product" class="nav-link">
                <i class="ion ion-bag"></i>
                <p>Product</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/promotion" class="nav-link">
                <i class="ion-ios-pricetags-outline"></i>
                <p>Promotion</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/supplier" class="nav-link">
                <i class="ion ion-ios-people-outline"></i>
                <p>Supplier</p>
              </a>
            </li>
          </ul>
        </li>
        <a href="/order" class="nav-link">
          <i class="ion ion-ios-cart-outline"></i>
          <p>
            Orders
          </p>
        </a>
        <a href="/order/delivery" class="nav-link">
          <i class="ion ion-android-bicycle"></i>
          <p>
            Delivery
          </p>
        </a>
        <a href="/product/restock" class="nav-link">
          <i class="ion ion-alert"></i>
          <p>
            Restock Products
          </p>
        </a>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
