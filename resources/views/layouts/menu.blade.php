<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>

{{-- jika buka role admin --}}
@if (Auth::user()->hasRole('super-admin'))
    <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>Admin<i class="fas fa-angle-left right"></i></p>
        </a>
        <ul class="nav nav-treeview ml-3"> <!-- Tambahkan kelas ml-3 untuk submenu -->
            <li class="nav-item">
                <a href="{{ route('permissions.index') }}"
                    class="nav-link {{ Request::is('permissions*') ? 'active' : '' }}">
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
@endif



<li class="nav-item">
    <a href="{{ route('projects.index') }}" class="nav-link {{ Request::is('projects*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-project-diagram"></i>
        <p>Projects</p>
    </a>
</li>

{{-- jika project memiliki  --}}

@if (Auth::user()->sessionProjecthasBackwardChainingMethod())
    <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>Backward Chaining<i class="fas fa-angle-left right"></i></p>
        </a>
        <ul class="nav nav-treeview ml-3">
            <li class="nav-item">
                <a href="{{ route('bcFacts.index') }}" class="nav-link {{ Request::is('bcFacts*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-list-alt"></i>
                    <p>Bc Facts</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('bcResults.index') }}"
                    class="nav-link {{ Request::is('bcResults*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>Bc Results</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('bcQuestions.index') }}"
                    class="nav-link {{ Request::is('bcQuestions*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-question-circle"></i>
                    <p>Bc Questions</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('trybc.selectResult') }}"
                    class="nav-link {{ Request::is('trybc*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-cogs"></i>
                    <p>Bc Try</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('bcSetting') }}" class="nav-link {{ Request::is('bcSetting*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-gear"></i>
                    <p>Bc Setting</p>
                </a>
            </li>
        </ul>
    </li>
@endif
