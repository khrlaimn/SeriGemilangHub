<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->

    <!-- Logout Button -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a href="/logout" class="nav-link">
                <i class="nav-icon far fa-sign-out-alt"></i>
                Logout
            </a>
        </li>

    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="javascript:;" class="brand-link" style="text-align: center;">
        <img src="/dist/img/SGHLogo.png" alt="SeriGemilangHub Logo" height="40">
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
                    <a href="/admin/dashboard" class="nav-link {{ (request()->is('admin/dashboard')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-header">MANAGEMENT</li>
                <!-- Admin Section -->
                <li class="nav-item {{ (request()->is('admin/admin*')) ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link {{ (request()->is('admin/admin*')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>
                            Admin
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/admin/list" class="nav-link {{ (request()->is('admin/admin/list')) ? 'active' : '' }}">
                                <i class="far fa-list nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/admin/add" class="nav-link {{ (request()->is('admin/admin/add')) ? 'active' : '' }}">
                                <i class="far fa-plus nav-icon"></i>
                                <p>Add Admin</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Teacher Section -->
                <li class="nav-item {{ (request()->is('admin/teacher*')) ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link {{ (request()->is('admin/teacher*')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                        <p>
                            Teacher
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/teacher/list" class="nav-link {{ (request()->is('admin/teacher/list')) ? 'active' : '' }}">
                                <i class="far fa-list nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/teacher/add" class="nav-link {{ (request()->is('admin/teacher/add')) ? 'active' : '' }}">
                                <i class="far fa-plus nav-icon"></i>
                                <p>Add Teacher</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Student Section -->
                <li class="nav-item {{ (request()->is('admin/student*')) ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link {{ (request()->is('admin/student*')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-graduate"></i>
                        <p>
                            Student
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/student/list" class="nav-link {{ (request()->is('admin/student/list')) ? 'active' : '' }}">
                                <i class="far fa-list nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/student/add" class="nav-link {{ (request()->is('admin/student/add')) ? 'active' : '' }}">
                                <i class="far fa-plus nav-icon"></i>
                                <p>Add Student</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Class Section -->
                <li class="nav-item {{ (request()->is('admin/class*')) ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link {{ (request()->is('admin/class*')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chalkboard"></i>
                        <p>
                            Class
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/class/list" class="nav-link {{ (request()->is('admin/class/list')) ? 'active' : '' }}">
                                <i class="far fa-list nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/class/add" class="nav-link {{ (request()->is('admin/class/add')) ? 'active' : '' }}">
                                <i class="far fa-plus nav-icon"></i>
                                <p>Add Class</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/assign_homeroom_teacher/list" class="nav-link {{ (request()->is('admin/assign_homeroom_teacher/list')) ? 'active' : '' }}">
                                <i class="nav-icon far fa-user-plus"></i>
                                <span style="white-space: nowrap;">Assign Homeroom Teacher</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-header">MY ACCOUNT</li>
                <!-- My Account Section -->
                <li class="nav-item {{ (request()->is('admin/account*') || request()->is('admin/change_password*')) ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link {{ (request()->is('admin/account*') || request()->is('admin/change_password*')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-circle"></i>
                        <p>
                            Profile
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/account" class="nav-link {{ (request()->is('admin/account')) ? 'active' : '' }}">
                                <i class="far fa-id-card nav-icon"></i>
                                <p>My Profile</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/change_password" class="nav-link {{ (request()->is('admin/change_password')) ? 'active' : '' }}">
                                <i class="far fa-key nav-icon"></i>
                                <p>Change Password</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- End Admin-specific menu items -->

                <!-- Teacher-specific menu items -->
                @elseif(Auth::user()->user_type == 2)
                <li class="nav-item">
                    <a href="/teacher/dashboard" class="nav-link {{ (request()->is('teacher/dashboard')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-header">MY ACCOUNT</li>
                <!-- My Account Section -->
                <li class="nav-item {{ (request()->is('teacher/account*') || request()->is('teacher/change_password*')) ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link {{ (request()->is('teacher/account*') || request()->is('teacher/change_password*')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-circle"></i>
                        <p>
                            Profile
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/teacher/account" class="nav-link {{ (request()->is('teacher/account')) ? 'active' : '' }}">
                                <i class="far fa-id-card nav-icon"></i>
                                <p>My Profile</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/teacher/change_password" class="nav-link {{ (request()->is('teacher/change_password')) ? 'active' : '' }}">
                                <i class="far fa-key nav-icon"></i>
                                <p>Change Password</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="/teacher/my_student" class="nav-link {{ (request()->is('teacher/my_student')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-graduate"></i>
                        <p>My Student</p>
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
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>