<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

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

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="javascript:;" class="brand-link" style="text-align: center;">
        <!-- <img src="/dist/img/SGHLogo.png" alt="SeriGemilangHub Logo" height="40"> -->
        <span class="brand-text font-weight-light" style="font-weight: bold !important; font-size: 20px;">SeriGemilangHub</span>
    </a>


    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image mr-3">
                <img src="{{ Auth::user()->getProfile() }}" class="img-circle elevation-2" alt="User Image" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
            </div>

            <div class="info">
                <a href="#" class="d-block">{{Auth::user()->name}}</a>
            </div>
        </div>


        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- Admin -->
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
                            Administrator
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
                                <p>Add Administrator</p>
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

                <li class="nav-header">HOMEROOM</li>

                <!-- Homeroom Section -->
                <li class="nav-item {{ (request()->is('admin/assign_homeroom_teacher*')) ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link {{ (request()->is('admin/assign_homeroom_teacher*')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chalkboard"></i>
                        <p>
                            Homeroom Teacher
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-- List -->
                        <li class="nav-item">
                            <a href="/admin/assign_homeroom_teacher/list" class="nav-link {{ (request()->is('admin/assign_homeroom_teacher/list')) ? 'active' : '' }}">
                                <i class="far fa-list nav-icon"></i>
                                <span style="white-space: nowrap;">List</span>
                            </a>
                        </li>
                        <!-- Add Homeroom Teacher -->
                        <li class="nav-item">
                            <a href="/admin/assign_homeroom_teacher/add" class="nav-link {{ (request()->is('admin/assign_homeroom_teacher/add')) ? 'active' : '' }}">
                                <i class="far fa-plus nav-icon"></i>
                                <p>Add</p>
                            </a>
                        </li>
                    </ul>
                </li>



                <!-- <li class="nav-header">ATTENDANCE</li>

                Attendance Section
                <li class="nav-item {{ (request()->is('admin/attendance*')) ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link {{ (request()->is('admin/attendance*')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-graduate"></i>
                        <p>
                            Student
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/attendance/student" class="nav-link {{ (request()->is('admin/attendance/student*')) ? 'active' : '' }}">
                                <i class="far fa-calendar-check nav-icon"></i>
                                <p>Attendance</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/admin/attendance/report" class="nav-link {{ (request()->is('admin/attendance/report*')) ? 'active' : '' }}">
                                <i class="far fa-file-alt nav-icon"></i>
                                <p style="white-space: nowrap;">Report</p>
                            </a>
                        </li>
                    </ul>
                </li> -->

                <!-- <li class="nav-header">WHEREABOUTS</li>
                Whereabouts Section
                <li class="nav-item {{ request()->is('admin/whereabouts*') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('admin/whereabouts*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                        <p>
                            Teacher
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('admin/whereabouts/list') }}" class="nav-link {{ request()->is('admin/whereabouts/list*') ? 'active' : '' }}">
                                <i class="far fa-list nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                    </ul>
                </li> -->

                <li class="nav-header">COMMUNICATE</li>

                <!-- Communicate Section -->
                <li class="nav-item {{ (request()->is('admin/communicate*')) ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link {{ (request()->is('admin/communicate*') && !request()->is('admin/communicate/notice_board/add*')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-bullhorn"></i>
                        <p>
                            Notice Board
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/communicate/notice_board" class="nav-link {{ (request()->is('admin/communicate/notice_board*') && !request()->is('admin/communicate/notice_board/add*')) ? 'active' : '' }}">
                                <i class="far fa-list nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/communicate/notice_board/add" class="nav-link {{ (request()->is('admin/communicate/notice_board/add*')) ? 'active' : '' }}">
                                <i class="far fa-plus nav-icon"></i>
                                <p>Add</p>
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
                <!-- End Admin -->

                <!-- Teacher -->

                @elseif(Auth::user()->user_type == 2)
                <li class="nav-item">
                    <a href="/teacher/dashboard" class="nav-link {{ (request()->is('teacher/dashboard')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-header">ATTENDANCE</li>
                <!-- Attendance Section -->
                <li class="nav-item {{ (request()->is('teacher/attendance*')) ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link {{ (request()->is('teacher/attendance*')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-graduate"></i>
                        <p>
                            Student
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/teacher/attendance/student" class="nav-link {{ (request()->is('teacher/attendance/student*')) ? 'active' : '' }}">
                                <i class="far fa-calendar-check nav-icon"></i> <!-- Change the icon class here -->
                                <p>Attendance</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/teacher/attendance/report" class="nav-link {{ (request()->is('teacher/attendance/report*')) ? 'active' : '' }}">
                                <i class="far fa-file-alt nav-icon"></i>
                                <p style="white-space: nowrap;">Report</p>
                            </a>
                        </li>
                    </ul>

                <li class="nav-header">WHEREABOUTS</li>
                <!-- Whereabouts Section -->
                <li class="nav-item {{ request()->is('teacher/whereabouts*') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('teacher/whereabouts*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                        <p>
                            Teacher
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('teacher/whereabouts/list') }}" class="nav-link {{ request()->is('teacher/whereabouts/list*') ? 'active' : '' }}">
                                <i class="far fa-list nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('teacher/whereabouts/add') }}" class="nav-link {{ request()->is('teacher/whereabouts/add*') ? 'active' : '' }}">
                                <i class="far fa-plus nav-icon"></i>
                                <p>Add</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-header">COMMUNICATE</li>
                <!-- Communicate Section -->
                <li class="nav-item">
                    <a href="/teacher/my_notice_board" class="nav-link {{ (request()->is('teacher/my_notice_board')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-bullhorn"></i>
                        <p>Notice Board</p>
                    </a>
                </li>

                <li class="nav-header">STUDENT</li>

                <li class="nav-item">
                    <a href="/teacher/my_student" class="nav-link {{ (request()->is('teacher/my_student')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-graduate"></i>
                        <p>My Student</p>
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
                <!-- End Teacher -->

                <!-- Headmaster -->
                @elseif(Auth::user()->user_type == 4)

                <li class="nav-item">
                    <a href="/headmaster/dashboard" class="nav-link {{ (request()->is('headmaster/dashboard')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-header">WHEREABOUTS</li>
                <!-- Whereabouts Section -->
                <li class="nav-item {{ request()->is('headmaster/whereabouts*') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('headmaster/whereabouts*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                        <p>
                            Teacher
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('headmaster/whereabouts/list') }}" class="nav-link {{ request()->is('headmaster/whereabouts/list*') ? 'active' : '' }}">
                                <i class="far fa-list nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-header">COMMUNICATE</li>
                <!-- Communicate Section -->
                <li class="nav-item">
                    <a href="/headmaster/my_notice_board" class="nav-link {{ (request()->is('headmaster/my_notice_board')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-bullhorn"></i>
                        <p>Notice Board</p>
                    </a>
                </li>


                <li class="nav-header">MY ACCOUNT</li>
                <!-- My Account Section -->
                <li class="nav-item {{ (request()->is('headmaster/account*') || request()->is('headmaster/change_password*')) ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link {{ (request()->is('headmaster/account*') || request()->is('headmaster/change_password*')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-circle"></i>
                        <p>
                            Profile
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/headmaster/account" class="nav-link {{ (request()->is('headmaster/account')) ? 'active' : '' }}">
                                <i class="far fa-id-card nav-icon"></i>
                                <p>My Profile</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/headmaster/change_password" class="nav-link {{ (request()->is('headmaster/change_password')) ? 'active' : '' }}">
                                <i class="far fa-key nav-icon"></i>
                                <p>Change Password</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- End Headmaster -->

                <!-- STAD -->
                @elseif(Auth::user()->user_type == 5)

                <li class="nav-item">
                    <a href="/stad/dashboard" class="nav-link {{ (request()->is('stad/dashboard')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-header">ATTENDANCE</li>
                <!-- Communicate Section -->
                <li class="nav-item">
                    <a href="/stad/attendance_report" class="nav-link {{ (request()->is('/stad/attendance_report')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-bullhorn"></i>
                        <p>Report</p>
                    </a>
                </li>

                <li class="nav-header">COMMUNICATE</li>
                <!-- Communicate Section -->
                <li class="nav-item">
                    <a href="/stad/my_notice_board" class="nav-link {{ (request()->is('stad/my_notice_board')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-bullhorn"></i>
                        <p>Notice Board</p>
                    </a>
                </li>

                <li class="nav-header">MY ACCOUNT</li>
                <!-- My Account Section -->
                <li class="nav-item {{ (request()->is('stad/account*') || request()->is('stad/change_password*')) ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link {{ (request()->is('stad/account*') || request()->is('stad/change_password*')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-circle"></i>
                        <p>
                            Profile
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/stad/account" class="nav-link {{ (request()->is('stad/account')) ? 'active' : '' }}">
                                <i class="far fa-id-card nav-icon"></i>
                                <p>My Profile</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/stad/change_password" class="nav-link {{ (request()->is('stad/change_password')) ? 'active' : '' }}">
                                <i class="far fa-key nav-icon"></i>
                                <p>Change Password</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- End STAD -->

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

    </div>

</aside>