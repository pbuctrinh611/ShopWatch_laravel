<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4 ">
  <!-- Brand Logo -->
  <a href="{{route('admin.home')}}" class="brand-link">
    <img src="{{ asset('admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
      class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Trang quản trị</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('admin/dist/img/avatar.jpg') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{Auth::user()->name}}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        {{-- Dashboard --}}
        <li class="nav-item">
          <a href="" class="nav-link" id="link-home">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>

        {{-- User --}}
        <li class="nav-item">
          <a href="{{route('admin.user.index')}}" class="nav-link" id="link-user">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Quản lý người dùng
            </p>
          </a>
        </li>
        
        <li class="nav-item">
          <a href="{{ route('admin.brand.index') }}" class="nav-link" id="link-brand">
            <i class="nav-icon fas fa-list"></i>
            <p>
              Thương hiệu sản phẩm
            </p>
          </a>
        </li>
        
        <li class="nav-item">
          <a href="{{ route('admin.category.index') }}" class="nav-link" id="link-category">
            <i class="nav-icon fas fa-list"></i>
            <p>
              Danh mục sản phẩm
            </p>
          </a>
        </li>
        
        <li class="nav-item">
          <a href="{{ route('admin.product.index' )}}" class="nav-link" id="link-brand">
            <i class="nav-icon fas fa-list"></i>
            <p>
              Quản lý sản phẩm
            </p>
          </a>
        </li>
        
        <li class="nav-item">
          <a href="{{ route('admin.blog.index') }}" class="nav-link" id="link-blog">
            <i class="nav-icon fas fa-list"></i>
            <p>
              Quản lý Bài viết
            </p>
          </a>
        </li>
 
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>