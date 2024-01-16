<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-info elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link bg-info">
        @if (!empty($setting->logo))
            <img src="{{ asset('public/storage/logo/' . $setting->logo) }}" alt="AdminLTE Logo"
                class="brand-image img-circle elevation-3" style="opacity: .8">
        @endif
        @if (!empty($setting->title))
            <strong class="brand-text">{{ $setting->title }}</strong>
        @endif
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-gauge"></i>
                        <p>
                            Dashboard
                            <span class="right badge badge-light text-dark">New</span>
                        </p>
                    </a>
                </li>
                @if (auth()->user()->hasPermission('role.index'))
                    <li class="nav-item">
                        <a href="{{ route('role.index') }}"
                            class="nav-link {{ request()->routeIs('role.*') ? 'active' : '' }}">
                            <i class="nav-icon fa-solid fa-people-arrows"></i>
                            <p>
                                Role
                            </p>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->hasPermission('user.index'))
                    <li class="nav-item">
                        <a href="{{ route('user.index') }}"
                            class="nav-link {{ request()->routeIs('user.*') ? 'active' : '' }}">
                            <i class="nav-icon fa-solid fa-users-gear"></i>
                            <p>
                                User
                            </p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
