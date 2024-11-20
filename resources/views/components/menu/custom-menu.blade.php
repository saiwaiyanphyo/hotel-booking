<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">

        <div class="navbar-nav theme-brand flex-row  text-center">
            <div class="nav-logo">

                <div class="nav-item theme-text">
                    <a href="{{ route('admin.home') }}" class="nav-link"> Hotel Booking </a>
                </div>
            </div>
            <div class="nav-item sidebar-toggle">
                <div class="btn-toggle sidebarCollapse">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-chevrons-left">
                        <polyline points="11 17 6 12 11 7"></polyline>
                        <polyline points="18 17 13 12 18 7"></polyline>
                    </svg>
                </div>
            </div>
        </div>
        @if (!Request::is('collapsible-menu/*'))
        <div class="profile-info">
            <div class="user-info">
                <div class="profile-content">
                    <h6 class="">{{ Auth::user()->name }}</h6>
                </div>
            </div>
        </div>
        @endif
        <ul class="list-unstyled menu-categories" id="accordionExample">

            <li class="menu {{ Request::routeIs('admin.home') ? 'active' : '' }}">
                <a href="{{ route('admin.home') }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-grid">
                            <rect x="3" y="3" width="7" height="7"></rect>
                            <rect x="14" y="3" width="7" height="7"></rect>
                            <rect x="14" y="14" width="7" height="7"></rect>
                            <rect x="3" y="14" width="7" height="7"></rect>
                        </svg>

                        <span>Dashboard</span>
                    </div>
                </a>
            </li>
            <li class="menu {{ Request::is('admin/employees*') ? 'active' : '' }}">
                <a href="{{ route('admin.employees.index') }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-users">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        <span>employees</span>
                    </div>
                </a>
            </li>
            <li class="menu {{ Request::is('admin/room-types*') ? 'active' : '' }}">
                <a href="{{ route('admin.room-types.index') }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-bed">
                            <path
                                d="M3 7v10M21 7v10M5 7h14a2 2 0 0 1 2 2v6H3v-6a2 2 0 0 1 2-2zM7 7V5a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2">
                            </path>
                        </svg>
                        <span>Room Types</span>
                    </div>
                </a>
            </li>
            <li class="menu {{ Request::is('admin/rooms*') ? 'active' : '' }}">
                <a href="{{ route('admin.rooms.index') }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-door">
                            <rect x="6" y="2" width="12" height="20"></rect>
                            <circle cx="15" cy="12" r="1"></circle>
                        </svg>
                        <span>Rooms</span>
                    </div>
                </a>
            </li>

        </ul>

    </nav>

</div>