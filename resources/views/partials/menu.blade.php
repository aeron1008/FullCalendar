<aside class="main-sidebar sidebar-dark-primary elevation-4"
    style="height: 100vh; width: fit-content; background-color: #2A85FF;">
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <!-- Sidebar Menu -->
        <nav class="mt-4">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                @can('user_management_access')
                    <li
                        class="nav-item has-treeview {{ request()->is('admin/permissions*') ? 'menu-open' : '' }} {{ request()->is('admin/roles*') ? 'menu-open' : '' }} {{ request()->is('admin/users*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is('admin/permissions*') ? 'active' : '' }} {{ request()->is('admin/roles*') ? 'active' : '' }} {{ request()->is('admin/users*') ? 'active' : '' }}"
                            href="#">
                            <i class="fa-fw nav-icon fas fa-users"> </i>
                            {{-- <i class="right fa fa-fw fa-angle-left nav-icon"></i> --}}
                        </a>
                        <ul class="nav nav-treeview">
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route('admin.permissions.index') }}"
                                        class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-unlock-alt"> </i>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route('admin.roles.index') }}"
                                        class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase"> </i>
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route('admin.users.index') }}"
                                        class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-user"> </i>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                <li class="nav-item">
                    <a href="{{ route('admin.systemCalendar') }}"
                        class="nav-link {{ request()->is('admin/system-calendar') || request()->is('admin/system-calendar/*') ? 'active' : '' }}">
                        <i class="fas fa-fw fa-calendar nav-icon"> </i>
                    </a>
                </li>
                @can('zaposlenici_access')
                    <li class="nav-item">
                        <a href="{{ route('admin.zaposlenicis.index') }}"
                            class="nav-link {{ request()->is('admin/zaposlenicis') || request()->is('admin/zaposlenicis/*') ? 'active' : '' }}">
                            <i class="fa-fw nav-icon fas fa-user-md"> </i>
                        </a>
                    </li>
                @endcan
                @can('pacjenti_access')
                    <li class="nav-item">
                        <a href="{{ route('admin.pacjentis.index') }}"
                            class="nav-link {{ request()->is('admin/pacjentis') || request()->is('admin/pacjentis/*') ? 'active' : '' }}">
                            <i class="fa-fw nav-icon fas fa-id-card"></i>
                        </a>
                    </li>
                @endcan
                @can('terminu_access')
                    <li class="nav-item">
                        <a href="{{ route('admin.terminus.index') }}"
                            class="nav-link {{ request()->is('admin/terminus') || request()->is('admin/terminus/*') ? 'active' : '' }}">
                            <i class="fa-fw nav-icon fas fa-book"> </i>
                        </a>
                    </li>
                @endcan

                @if (!appUser()->isAdmin)
                    <li class="nav-item">
                        <a href="{{ route('admin.plans') }}"
                            class="nav-link {{ request()->is('admin/plan') || request()->is('admin/plan/*') ? 'active' : '' }}">
                            <i class="fa-fw nav-icon fas fa-shopping-cart"></i>
                        </a>
                    </li>
                @endif
                @if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                    @can('profile_password_edit')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}"
                                href="{{ route('profile.password.edit') }}">
                                <i class="fa-fw fas fa-key nav-icon"> </i>
                            </a>
                        </li>
                    @endcan
                @endif
                <li class="nav-item">
                    <a href="#" class="nav-link"
                        onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <p>
                            <i class="fas fa-fw fa-sign-out-alt nav-icon"></i>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
