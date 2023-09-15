<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>

<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p>Admin<i class="fas fa-angle-left right"></i></p>
    </a>
    <ul class="nav nav-treeview ml-3"> <!-- Tambahkan kelas ml-3 untuk submenu -->
        <li class="nav-item">
            <a href="{{ route('permissions.index') }}" class="nav-link {{ Request::is('permissions*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-lock"></i>
                <p>Permissions</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('roles.index') }}" class="nav-link {{ Request::is('roles*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-user-tag"></i>
                <p>Roles</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('methods.index') }}" class="nav-link {{ Request::is('methods*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-cogs"></i>
                <p>Methods</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('users.index') }}" class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-user"></i>
                <p>Users</p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item">
    <a href="{{ route('projects.index') }}" class="nav-link {{ Request::is('projects*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-project-diagram"></i>
        <p>Projects</p>
    </a>
</li>

<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p>Backward Chaining<i class="fas fa-angle-left right"></i></p>
    </a>
    <ul class="nav nav-treeview ml-3"> 
        <li class="nav-item">
            <a href="{{ route('backwardChainings.index') }}" class="nav-link {{ Request::is('backwardChainings*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-home"></i>
                <p>Backward Chainings</p>
            </a>
        </li>
    </ul>
</li>



