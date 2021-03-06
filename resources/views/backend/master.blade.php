<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@if(Route::is('dashboard')) Dashboard @elseif(Route::is('categories')) Categories @elseif(Route::is('AddCategory')) Add Category @elseif(Route::is('editCategory')) Edit Category @elseif(Route::is('trashedCategories')) Categories Trash @elseif(Route::is('viewSubcategories')) Subcategories @elseif(Route::is('addSubcategory')) Add Subcategory @elseif(Route::is('editSubcategory')) Edit Subcategory @elseif(Route::is('trashedSubcategory')) Subcategoryies Trash @elseif(Route::is('viewProducts')) Products @elseif(Route::is('addProducts')) Add Product @elseif(Route::is('editProduct')) Edit Product @elseif(Route::is('coupon.index')) Coupon @elseif(Route::is('coupon.create')) Add Coupon @elseif(Route::is('coupon.show')) Coupon Details @elseif(Route::is('coupon.edit')) Edit Coupon @elseif(Route::is('coupon.trash')) Coupon Trash @elseif(Route::is('coupon.trash.details')) Trash Details @elseif(Route::is('role.index')) Roles @elseif(Route::is('role.create')) Add Role @elseif(Route::is('role.show')) Role Details @elseif(Route::is('role.edit')) Edit Role @elseif(Route::is('assign.user')) Assign User @elseif(Route::is('add.user')) Add User @elseif(Route::is('orders.index')) My Orders @endif |  Tohoney </title>

  <!-- Google Font: Source Sans Pro -->
  {{-- <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> --}}
  <link rel="stylesheet" href="{{ asset('assets\dist\css/fonts.googleapis.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  {{-- <link rel="stylesheet" href="//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> --}}
  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/ionicons.min.css') }}">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }} ">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}} ">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/jqvmap/jqvmap.min.css')}} ">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css')}} ">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}} ">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css')}} ">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css')}} ">
  <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css')}} ">
  @yield('internal_style')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src=" {{ asset('assets/dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('dashboard') }}" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{ asset('assets/dist/img/user1-128x128.jpg') }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{ asset('assets/dist/img/user8-128x128.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{ asset('assets/dist/img/user3-128x128.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('dashboard') }}" class="brand-link">
      <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">@if(Auth::user()) {{ Auth::user()->name }} @else Unknown User @endif</a>
          <p style="color:#c2c7d0">@foreach (Auth::user()->roles as $role) <em>({{ $role->name }})</em> @endforeach</p>
        </div>
      </div>
      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
            {{--  Dashboard  --}}
            <li class="nav-item">
                <a href="{{ url('dashboard') }}" class="nav-link @yield('dashboardActive')">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item @yield('categoryOpen')">
                <a href="{{ route('frontend') }}" class="nav-link" target="_blank">
                    <i class="nav-icon fa fa-eye"></i>
                    <p> View Website </p>
                </a>
            </li>
            @if(auth()->user()->roles()->first()->name == "Customer")
                <li class="nav-item">
                    <a href="{{ route('orders.index') }}" class="nav-link @if(Route::is('orders.index')) active @endif">
                        <i class="nav-icon fa fa-shopping-cart"></i>
                        <p>My Orders</p>
                    </a>
                </li>
            @endif
           {{-- Categories --}}
            @if (auth()->user()->can('add category')||auth()->user()->can('view category')||auth()->user()->can('view trash category'))
                <li class="nav-item @yield('categoryOpen')">
                    <a href="#" class="nav-link @yield('categoryActive')">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Categories
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="@yield('categoryDBlock') background-color:#343A2C">
                        @can('add category')
                            <li class="nav-item">
                                <a href="{{ url('add-category') }}" class="nav-link @yield('addCategoryActive')">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p>Add Category</p>
                                </a>
                            </li>
                        @endcan
                        @can('view category')
                            <li class="nav-item">
                                <a href="{{ url('categories') }}" class="nav-link @yield('viewCategoryActive')">
                                    <i class="fas fa-eye nav-icon"></i>
                                    <p>View Category</p>
                                </a>
                            </li>
                        @endcan
                        @can('view trash category')
                            <li class="nav-item">
                                <a href="{{ url('category-trashed') }}" class="nav-link @yield('trashCategoryActive')">
                                <i class="fas fa-trash nav-icon"></i>
                                <p>Trashed Category</p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endif

          {{-- Sub Category --}}
            @if (auth()->user()->can('add subcategory')||auth()->user()->can('view subcategory')||auth()->user()->can('view trash subcategory'))
            <li class="nav-item @yield('subcategoryOpened')">
                <a href="#" class="nav-link @yield('subcategoryActive')">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                    Subcategories
                    <i class="fas fa-angle-left right"></i>
                </p>
                </a>
                <ul class="nav nav-treeview" style="@yield('subcategoryDBlock') background-color:#343A2C ">
                    @can('add subcategory')
                        <li class="nav-item">
                            <a href="{{ url('add-subcategory') }}" class="nav-link @yield('addSubcategoryActive')">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>Add Subcategory</p>
                            </a>
                        </li>
                    @endcan
                    @can('view subcategory')
                        <li class="nav-item">
                        <a href="{{ url('subcategories') }}" class="nav-link @yield('viewSubcategoryActive')">
                            <i class="fas fa-eye nav-icon"></i>
                            <p>View Subcategory</p>
                        </a>
                        </li>
                    @endcan
                    @can('view trash subcategory')
                        <li class="nav-item">
                            <a href="{{ url('subcategory-trashed') }}" class="nav-link @yield('trashSubcategoryActive')">
                            <i class="fas fa-trash nav-icon"></i>
                            <p>Trashed Subcategory</p>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
            @endif
            {{-- Products  --}}
            @if (auth()->user()->can('add product')||auth()->user()->can('view product')||auth()->user()->can('stock out product'))
                <li class="nav-item @yield('productOpened')">
                    <a href="#" class="nav-link @yield('productActive')">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                        Products
                        <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="@yield('productDBlock') background-color:#343A2C ">
                        @can('add product')
                            <li class="nav-item">
                                <a href="{{ url('add-product') }}" class="nav-link @yield('addProductActive')">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p>Add Product</p>
                                </a>
                            </li>
                        @endcan
                        @can('view product')
                            <li class="nav-item">
                                <a href="{{ url('products-list') }}" class="nav-link @yield('viewProductActive')">
                                    <i class="fas fa-eye nav-icon"></i>
                                    <p>View Products</p>
                                </a>
                            </li>
                        @endcan
                        @can('stock out product')
                            <li class="nav-item">
                                <a href="{{ route('viewStockOutProducts') }}" class="nav-link @yield('trashProductActive')">
                                    <img width="25" src="{{ asset('assets/dist/img/stock-out.png') }}" alt="stock out">
                                    <p>Stock Out Products</p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endif
          {{--  Coupon  --}}
            @if (auth()->user()->can('add coupon')||auth()->user()->can('view coupon')||auth()->user()->can('view trash coupon'))
                <li class="nav-item @if(Route::is('coupon.index')|| Route::is('coupon.create') || Route::is('coupon.show') || Route::is('coupon.edit') || Route::is('coupon.trash')||Route::is('coupon.trash.details')) menu-is-opening menu-open @endif">
                    <a href="#" class="nav-link @if(Route::is('coupon.index')|| Route::is('coupon.create') || Route::is('coupon.show') || Route::is('coupon.edit')|| Route::is('coupon.trash')||Route::is('coupon.trash.details')) active @endif">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                        Coupon
                        <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="background-color:#343A2C">
                        @can('add coupon')
                            <li class="nav-item">
                                <a href="{{ route('coupon.create') }}" class="nav-link @if(Route::is('coupon.create')) active @endif">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p>Add Coupon</p>
                                </a>
                            </li>
                        @endcan
                        @can('view coupon')
                            <li class="nav-item">
                                <a href="{{ route('coupon.index') }}" class="nav-link  @if(Route::is('coupon.index')||Route::is('coupon.index')||Route::is('coupon.show')||Route::is('coupon.edit')) active @endif">
                                    <i class="fas fa-eye nav-icon"></i>
                                    <p>View Coupon</p>
                                </a>
                            </li>
                        @endcan
                        @can('view trash coupon')
                            <li class="nav-item ">
                                <a href="{{ route('coupon.trash') }}" class="nav-link @if(Route::is('coupon.trash')||Route::is('coupon.trash.details')) active @endif">
                                    <i class="fas fa-trash nav-icon"></i>
                                    <p>Trash</p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endif

           {{--  User Role Management  --}}
           @can('role management')
            <li class="nav-item @if(Route::is('assign.user')||Route::is('add.user')||Route::is('role.index')||Route::is('role.create')||Route::is('role.show')||Route::is('role.edit')) menu-is-opening menu-open @endif">
                <a href="#" class="nav-link @if(Route::is('assign.user')||Route::is('add.user')||Route::is('role.index')||Route::is('role.create')||Route::is('role.show')||Route::is('role.edit')) active @endif" >
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Role Managemanet
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="background-color:#343A2C">
                    <li class="nav-item">
                        <a href="{{ route('role.create') }}" class="nav-link @if(Route::is('role.create')) active @endif">
                            <i class="fas fa-plus nav-icon"></i>
                            <p>Add Role</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('role.index') }}" class="nav-link @if(Route::is('role.index')||Route::is('role.edit')) active @endif">
                            <i class="fas fa-eye nav-icon"></i>
                            <p>View Roles</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('assign.user') }}" class="nav-link @if(Route::is('assign.user')) active @endif">
                            <i class="fas fa-plus-circle nav-icon"></i>
                            <p>Assign User</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('add.user') }}" class="nav-link @if(Route::is('add.user')) active @endif">
                            <i class="fas fa-plus-circle nav-icon"></i>
                            <p>Add User</p>
                        </a>
                    </li>
                </ul>
            </li>
           @endcan
            <li class="nav-item">
                <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
                <i class="nav-icon fa fa-sign-out-alt"></i>
                <p>Log Out</p>
                </a>
            </li>
            {{--  Logout Form   --}}
             <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
            </form>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  @yield('content')
  <!-- /.content-wrapper -->
  <footer class="main-footer">
      @php
         $currentYear = date('Y')
      @endphp
    <strong>Copyright &copy; {{ $currentYear.'-'.($currentYear+1) }} <span class="text-muted">All rights reserved.</span> <span>Developed by</span> <a target="_blank" title="https://anikkumarnandi.com" href="https://aniknandi.com">Anik Kumar Nandi</a>.</strong>

    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('assets/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{ asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('assets/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('assets/dist/js/demo.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('assets/dist/js/pages/dashboard.js') }}"></script>
<script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
{{-- <script src="//unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
<script src="{{ asset('assets/dist/js/sweetalert.min.js') }}"></script>

@yield('footer_js')
</body>
</html>
