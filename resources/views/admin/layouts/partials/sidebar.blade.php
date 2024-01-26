<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item sidebar-category">
            <p>Navigation</p>
            <span></span>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('admin/dashboard')}}">
                <i class="mdi mdi-view-quilt menu-icon"></i>
                <span class="menu-title">Dashboard</span>

            </a>
        </li>
        @if (auth()->user()->hasAnyPermission(['permission-list','role-list']))
            <li class="nav-item sidebar-category">
                <p>Admin</p>
                <span></span>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/permission*') || request()->is('admin/role*') ? 'active' : '' }}
                    " data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                    <i class="mdi mdi-palette menu-icon"></i>
                    <span class="menu-title">Admin</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                        @can('role-list')
                            <li class="nav-item {{ request()->is('admin/permission') ? 'active' : '' }}"> 
                                <a class="nav-link " href="{{ url('admin/permission') }}"> Permission</a>
                            </li>
                        @endcan
                        @can('permission-list')
                            <li class="nav-item {{ request()->is('admin/role') ? 'active' : '' }}">
                                <a class="nav-link " href="{{ url('admin/role') }}">Role</a>
                            </li>
                        @endcan
                    </ul>
                </div>
            </li>
        @endif
        @can('employee-list')
            <li class="nav-item {{ request()->is('admin/employee*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('admin/employee') }}">
                    <i class="mdi mdi-account-multiple-plus menu-icon"></i>
                    <span class="menu-title">Employee</span>
                </a>
            </li>
        @endcan
        <li class="nav-item {{ request()->is('admin/calendar*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('admin/calendar') }}">
                <i class="mdi mdi-calendar menu-icon"></i>
                <span class="menu-title">Calendar View</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                <i class="mdi mdi-logout menu-icon"></i>
                <span class="menu-title">Logout</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</nav>
