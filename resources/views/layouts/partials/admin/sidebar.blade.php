<!-- Sidebar  -->
<nav id="sidebar">
    <div id="dismiss">
        <i class="fas fa-chevron-left"></i>
    </div>

    <div class="sidebar-header">
        <a href="#" class="navbar-brand d-block mx-auto text-center py-3 mb-4 bottom-border">
            {{ config('app.name', 'RD-BACKEND') }}
        </a>
    </div>

    <div class="bottom-border pb-3">
        <img src="/images/default-avatar.png" width="50" class="rounded-circle mr-3">
        <a href="#" class="text-white">{{ auth()->user()->name }}</a>
    </div>

    <ul class="list-unstyled mt-4">

        <li class="active">
            <a href="{{ route('dashboard') }}">
                <i class="fas fa-home fa-lg mr-3"></i>
                Dashboard
            </a>
        </li>

        <li>
            <a href="#adminSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fas fa-users-cog fa-lg mr-3"></i>
                Admin
            </a>
            <ul class="collapse list-unstyled" id="adminSubmenu">
                @can('list-users')
                <li>
                    <a href="{{ route('users.index') }}">
                        <i class="fas fa-users fa-lg mr-3"></i>
                        Users
                    </a>
                </li>
                @endcan

                @can('list-roles')
                <li>
                    <a href="{{ route('roles.index') }}">
                        <i class="fas fa-user-tag fa-lg mr-3"></i>
                        Roles
                    </a>
                </li>
                @endcan

                @can('list-permissions')
                <li>
                    <a href="{{ route('permissions.index') }}">
                        <i class="fas fa-user-lock fa-lg mr-3"></i>
                        Permissions
                    </a>
                </li>
                @endcan

                <li>
                    <a href="#">
                        <i class="fas fa-wrench fa-lg mr-3"></i>
                        Settings
                    </a>
                </li>
            </ul>
        </li>
    </ul>

    <ul class="list-unstyled CTAs">
        <li>
            <a class="nav-link download" href="#" data-toggle="modal" data-target="#sign-out">
                <i class="fas fa-sign-out-alt fa-lg"></i>
                Sign out
            </a>
        </li>
    </ul>
</nav>
