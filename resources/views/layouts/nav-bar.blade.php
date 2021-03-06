@if(Auth::user())
<div class="header-bg">
    <!-- Navigation Bar-->
    <header id="topnav">
        <div class="topbar-main">
            <div class="container-fluid">

                <!-- Logo-->
                <div>

                    <a href="/" class="logo">
                        <img src="{{ asset('assets/images/jcrmlogogray.png') }}" alt="" height="50">
                    </a>

                </div>
                <!-- End Logo-->

                <div class="menu-extras topbar-custom navbar p-0">
                    <ul class="navigation-menu">

                        <li class="has-submenu">
                            <a href="/"><i class="dripicons-home"></i> Dashboard</a>
                        </li>

                        <li class="has-submenu">
                            <a href="/activities"><i class="dripicons-checklist"></i> Activities</a>
                        </li>

                        <li class="has-submenu">
                            <a href="/lead"><i class="dripicons-user-id"></i> Lead Creation</a>
                        </li>

                        <li class="has-submenu">
                            <a href="/reporting"><i class="dripicons-graph-line"></i> Reporting</a>
                        </li>

                        {{-- Admin Choices --}}
                        @if(Auth::user()->user_role_id === 2)
                        <li class="has-submenu">
                            <a href="/admin"><i class="dripicons-pamphlet"></i> Admin Activities</a>
                        </li>
                        @endif
                    </ul>
                    <ul class="list-inline ml-auto mb-0">

                        <!-- User-->
                        <li class="list-inline-item dropdown notification-list nav-user">
                            <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="{{ asset('assets/images/users/avatar-6.jpg') }}" alt="user" class="rounded-circle">
                                @if(Auth::user())
                                <span class="d-none d-md-inline-block ml-1">{{ Auth::user()->name}} <i class="mdi mdi-chevron-down"></i> </span>
                                @else
                                <span class="d-none d-md-inline-block ml-1">User Name <i class="mdi mdi-chevron-down"></i> </span>
                                @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown">
                                <a class="dropdown-item" href="/user/{{ Auth::id() }}"><i class="dripicons-user text-muted"></i>Profile</a>
                                <a class="small-bar-item dropdown-item" href="/"><i class="text-muted dripicons-home"></i> Dashboard</a>
                                <a class="small-bar-item dropdown-item" href="/activities"><i class="text-muted dripicons-checklist"></i> Activities</a>
                                <a class="small-bar-item dropdown-item" href="/lead"><i class="text-muted dripicons-user-id"></i> Lead Creation</a>
                                <a class="small-bar-item dropdown-item" href="/reporting"><i class="text-muted dripicons-graph-line"></i> Reporting</a>
                                @if(Auth::user()->user_role_id === 2)
                                <a class="small-bar-item dropdown-item" href="/admin"><i class="text-muted dripicons-pamphlet"></i> Admin Activities</a>
                                @endif
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/logout" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    <i class="dripicons-exit text-muted"></i> Logout</a>
                                </a>
                                <form id="logout-form" action="/logout" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </header>

</div>
@endif
