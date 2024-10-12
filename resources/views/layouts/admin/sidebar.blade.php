<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav" style="text-align: center; overflow-x: auto;">
        <li class="nav-item sidebar-category">
            <!-- You can add a title or any content here if needed -->
        </li>

        <li class="nav-item sidebar-category" style="margin-left: 3rem; margin-top: 1px;">
            <div class="profile-image">
                <div class="image-container" style="width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;">
                    <img src="https://lavishride.com/images/lavishLogo.webp" alt="lavishLogo" style="width: 100%; height: 100%;">
                </div>
            </div>
        </li>

        <li class="nav-item sidebar-category">
            <p>Pages</p>
            <span></span>
        </li>

        <li class="nav-item mb-5">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="mdi mdi-view-quilt menu-icon" style="color: #a3a4a5;"></i>
                <span class="menu-title" title="Dashnord">Dashboard</span>
            </a>
        </li>

        <li class="nav-item mb-5">
            <a class="nav-link" href="{{ url('profile') }}">
                <i class="mdi mdi-view-quilt menu-icon" style="color: #a3a4a5;"></i>
                <span class="menu-title" title="Dashnord">profile</span>
            </a>
        </li>

        @can('view user')
        <li class="nav-item mb-5">
            <a class="nav-link" href="{{ url('users') }}">
                <i class="mdi mdi-view-quilt menu-icon" style="color: #a3a4a5;"></i>
                <span class="menu-title" title="Users">User</span>
            </a>
        </li>
        @endcan

        @can('view role')
        <li class="nav-item mb-5">
            <a class="nav-link" href="{{ url('roles') }}">
                <i class="mdi mdi-view-quilt menu-icon" style="color: #a3a4a5;"></i>
                <span class="menu-title" title="Roles">Role</span>
            </a>
        </li>
        @endcan

        @can('view permission')
        <li class="nav-item mb-5">
            <a class="nav-link" href="{{ url('permissions') }}">
                <i class="mdi mdi-view-quilt menu-icon" style="color: #a3a4a5;"></i>
                <span class="menu-title" title="Permissions">Permissions</span>
            </a>
        </li>
        @endcan

        <li class="mt-3">
            <a class="dropdown-item" href="{{ route('logout') }}" style="font-size: 17px;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" title="Log out">
                <i class="mdi mdi-logout text-primary"></i>
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</nav>
