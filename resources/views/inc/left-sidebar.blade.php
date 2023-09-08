<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

    {{-- Sidebar brand logo --}}
    @if(config('adminlte.logo_img_xl'))
        @include('adminlte::partials.common.brand-logo-xl')
    @else
        @include('adminlte::partials.common.brand-logo-xs')
    @endif

    {{-- Sidebar menu --}}
    <div class="sidebar">
        <nav class="pt-2">
            <ul class="nav nav-pills nav-sidebar flex-column {{ config('adminlte.classes_sidebar_nav', '') }}"
                data-widget="treeview" role="menu"
                @if(config('adminlte.sidebar_nav_animation_speed') != 300)
                    data-animation-speed="{{ config('adminlte.sidebar_nav_animation_speed') }}"
                @endif
                @if(!config('adminlte.sidebar_nav_accordion'))
                    data-accordion="false"
                @endif>
                {{-- Configured sidebar links --}}

                @can('dashboard')
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link @if(request()->is('dashboard'))) {{ "active" }} @endif">
                      <i class="nav-icon fas fa-tachometer-alt"></i>
                      <p>Dashboard</p>
                    </a>
                </li>
                @endcan

                @can('manage-users')
                <li class="nav-item @if(request()->is('manage') || request()->is('manage/*')) {{ "menu-open" }} @endif">
                    <a href="#" class="nav-link @if(request()->is('*/manage/*') || request()->is('*/manage/*')) {{ "active" }} @endif">
                      <i class="nav-icon fas fa-users"></i>
                      <p>
                        Users management
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item @if(request()->is('*/user/*')) {{ "menu-open" }} @endif">
                            <a href="#" class="nav-link @if(request()->is('*/user/*') || request()->is('*/user/*')) {{ "active" }} @endif">
                              <i class="fas fa-user nav-icon"></i>
                              <p>
                                Users
                                <i class="right fas fa-angle-left"></i>
                              </p>
                            </a>
                            <ul class="nav nav-treeview">
                              <li class="nav-item">
                                <a href="{{ route('admins.index') }}" class="nav-link @if(request()->is('*/admins') || request()->is('*/admins/*')) {{ "active" }} @endif">
                                  <i class="far fa-user nav-icon"></i>
                                  <p>Admins</p>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="{{ route('users.index') }}" class="nav-link @if(request()->is('*/users') || request()->is('*/users/*')) {{ "active" }} @endif">
                                  <i class="far fa-user nav-icon"></i>
                                  <p>Users</p>
                                </a>
                              </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('roles.index') }}" class="nav-link @if(request()->is('*/roles') || request()->is('*/roles/*')) {{ "active" }} @endif">
                                <i class="fas fa-users nav-icon"></i>
                                <p>Roles</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('permissions.index') }}" class="nav-link @if(request()->is('*/permissions') || request()->is('*/permissions/*')) {{ "active" }} @endif">
                                <i class="fas fa-key nav-icon"></i>
                                <p>Permissions</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan

                {{-- <li class="nav-item @if(request()->is('*/media/*')) {{ "menu-open" }} @endif">
                    <a href="#" class="nav-link @if(request()->is('*/media/*') || request()->is('*/media/*')) {{ "active" }} @endif">
                      <i class="nav-icon fas fa-cloud-upload-alt"></i>
                      <p>
                        Media Files
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.new-media.index') }}" class="nav-link @if(request()->is('*/new-media') || request()->is('*/new-media/*')) {{ "active" }} @endif">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>New Media Files</p>
                            </a>
                        </li>
                    </ul>
                </li>



                @can('settings')
                <li class="nav-item">
                    <a href="{{ route('admin.settings.index') }}" class="nav-link @if(request()->is('*/settings') || request()->is('*/settings/*')) {{ "active" }} @endif">
                      <i class="nav-icon fas fa-cog"></i>
                      <p>{{ __('admin.menu.settings') }}</p>
                    </a>
                </li>
                @endcan --}}

            </ul>
        </nav>
    </div>

</aside>
