<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-comments"></i>
                <span class="badge badge-danger navbar-badge">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- Messages -->
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
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
                <!-- Message separator -->
                <div class="dropdown-divider"></div>

                <!-- Additional messages... -->

                <!-- See All Messages -->
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
                <!-- Notifications -->
                <span class="dropdown-item dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>

                <!-- Individual notifications... -->

                <!-- See All Notifications -->
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="javascript:;" class="brand-link" style="text-align: center;">
        <span class="brand-text font-weight-light" style="font-weight: bold !important; font-size: 20px;">SeriGemilangHub</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{Auth::user()->name}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- Admin-specific menu items -->
                @if(Auth::user()->user_type == 1)
                <li class="nav-item">
                    <a href="/admin/dashboard" class="nav-link @if(Request::segment(2) =='dashboard' ) active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/admin/list" class="nav-link @if(Request::segment(2) =='admin' ) active @endif">
                        <i class="nav-icon far fa-user"></i>
                        <p>Admin</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/student/list" class="nav-link @if(Request::segment(2) =='student' ) active @endif">
                        <i class="nav-icon far fa-user"></i>
                        <p>Student</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/class/list" class="nav-link @if(Request::segment(2) =='class' ) active @endif">
                        <i class="nav-icon far fa-user"></i>
                        <p>Class</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/change_password" class="nav-link @if(Request::segment(2) =='change_password' ) active @endif">
                        <i class="nav-icon far fa-user"></i>
                        <p>Change Password</p>
                    </a>
                </li>
                <!-- End Admin-specific menu items -->

                <!-- Teacher-specific menu items -->
                @elseif(Auth::user()->user_type == 2)
                <li class="nav-item">
                    <a href="/teacher/dashboard" class="nav-link @if(Request::segment(2) =='dashboard' ) active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/teacher/change_password" class="nav-link @if(Request::segment(2) =='change_password' ) active @endif">
                        <i class="nav-icon far fa-user"></i>
                        <p>Change Password</p>
                    </a>
                </li>
                <!-- End Teacher-specific menu items -->

                <!-- Student-specific menu items -->
                @elseif(Auth::user()->user_type == 3)
                <li class="nav-item">
                    <a href="/student/dashboard" class="nav-link @if(Request::segment(2) =='dashboard' ) active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/student/change_password" class="nav-link @if(Request::segment(2) =='change_password' ) active @endif">
                        <i class="nav-icon far fa-user"></i>
                        <p>Change Password</p>
                    </a>
                </li>
                <!-- End Student-specific menu items -->
                @endif

                <!-- Logout menu item -->
                <li class="nav-item">
                    <a href="/logout" class="nav-link">
                        <i class="nav-icon far fa-user"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>