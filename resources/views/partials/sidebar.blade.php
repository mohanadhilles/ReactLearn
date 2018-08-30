@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

             

            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">@lang('quickadmin.qa_dashboard')</span>
                </a>
            </li>

            @can('user_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>@lang('quickadmin.user-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('role_access')
                    <li>
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span>@lang('quickadmin.roles.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('user_access')
                    <li>
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-user"></i>
                            <span>@lang('quickadmin.users.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            
            @can('permissions_managment_access')
            <li>
                <a href="{{ route('admin.permissions_managments.index') }}">
                    <i class="fa fa-gears"></i>
                    <span>@lang('quickadmin.permissions-managment.title')</span>
                </a>
            </li>@endcan
            
            @can('leave_access')
            <li>
                <a href="{{ route('admin.leaves.index') }}">
                    <i class="fa fa-gears"></i>
                    <span>@lang('quickadmin.leave.title')</span>
                </a>
            </li>@endcan


            @can('leave_access')
                <li>
                    <a href="{{ route('admin.presence.index') }}">
                        <i class="fa fa-gears"></i>
                        <span>إدارة حضور الموظفين</span>
                    </a>
                </li>@endcan

           @can('employee')
            <li>
                <a href="">
                    <i class="fa fa-gears"></i>
                    <span>  تسجيل الحضور</span>
                </a>
            </li>


                <li>
                    <a href="{{ route('employee.permissions.index') }}">
                        <i class="fa fa-gears"></i>
                        <span>تقديم طلب مغادرة أذن</span>
                    </a>
                </li>


                <li>
                    <a href="{{ route('employee.leaves.index') }}">
                        <i class="fa fa-gears"></i>
                        <span>تقديم طلب اجازة</span>
                    </a>
                </li>
            @else

            @endcan

            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">@lang('quickadmin.qa_change_password')</span>
                </a>
            </li>

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('quickadmin.qa_logout')</span>
                </a>
            </li>
        </ul>
    </section>
</aside>

