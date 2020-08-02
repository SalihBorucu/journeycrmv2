<ul class="nav nav-pills nav-justified" role="tablist">
    <li class="nav-item waves-effect waves-light">
        <a class="nav-link {{ Request::is('admin') ? 'active' : '' }}" href="{{ Request::is('admin') ? 'javascript: void(0)' : '/admin' }}">
            <span class="d-none d-md-block {{ Request::is('admin') ? 'text-white' : 'text-primary' }}">New Account</span>
        </a>
    </li>
    <li class="nav-item waves-effect waves-light">
        <a class="nav-link {{ Request::is('admin/account*') ? 'active' : '' }}" href="{{ Request::is('admin/account') ? 'javascript: void(0)' : '/admin/account' }}">
            <span class="d-none d-md-block {{ Request::is('admin/account*') ? 'text-white' : 'text-primary' }}">Edit Account</span><span class="d-block d-md-none">
        </a>
    </li>
    <li class="nav-item waves-effect waves-light">
        <a class="nav-link {{ Request::is('admin/user/create') ? 'active' : '' }}" href="{{ Request::is('admin/user/create') ? 'javascript: void(0)' : '/admin/user/create' }}">
            <span class="d-none d-md-block {{ Request::is('admin/user/create') ? 'text-white' : 'text-primary' }}">New User</span><span class="d-block d-md-none">
        </a>
    </li>
    <li class="nav-item waves-effect waves-light">
        <a class="nav-link {{ Request::is('admin/user') ? 'active' : '' }}" href="{{ Request::is('admin/user') ? 'javascript: void(0)' : '/admin/user' }}">
            <span class="d-none d-md-block {{ Request::is('admin/user') ? 'text-white' : 'text-primary' }}">Edit User</span><span class="d-block d-md-none">
        </a>
    </li>
</ul>
