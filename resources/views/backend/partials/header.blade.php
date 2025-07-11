<div class="header">
    <!-- navbar -->
    <div class="navbar-custom navbar navbar-expand-lg">
        <div class="container-fluid px-0">
            <a class="navbar-brand d-block d-md-none" href="index.html">
                <img src="assets/images/brand/logo/logo-2.svg" alt="Image" />
            </a>

            <a id="nav-toggle" href="#!" class="ms-auto ms-md-0 me-0 me-lg-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor"
                    class="bi bi-text-indent-left text-muted" viewBox="0 0 16 16">
                    <path
                        d="M2 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm.646 2.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L4.293 8 2.646 6.354a.5.5 0 0 1 0-.708zM7 6.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
                </svg>
            </a>

            <div class="d-none d-md-none d-lg-block">
                <!-- Form -->
                <form action="#">
                    <div class="input-group">
                        <input class="form-control rounded-3 bg-transparent ps-9" type="search" value=""
                            id="searchInput" placeholder="Search" />
                        <span class="">
                            <button class="btn position-absolute start-0" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-search text-dark">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg>
                            </button>
                        </span>
                    </div>
                </form>
            </div>
            <!--Navbar nav -->
            <ul class="navbar-nav navbar-right-wrap ms-lg-auto d-flex nav-top-wrap align-items-center ms-4 ms-lg-0">
                <li>
                    <div class="dropdown">
                        <button class="btn btn-ghost btn-icon rounded-circle" type="button" aria-expanded="false"
                            data-bs-toggle="dropdown" aria-label="Toggle theme (auto)">
                            <i class="bi theme-icon-active"></i>
                            <span class="visually-hidden bs-theme-text">Toggle theme</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bs-theme-text">
                            <li>
                                <button type="button" class="dropdown-item d-flex align-items-center"
                                    data-bs-theme-value="light" aria-pressed="false">
                                    <i class="bi theme-icon bi-sun-fill"></i>
                                    <span class="ms-2">Light</span>
                                </button>
                            </li>
                            <li>
                                <button type="button" class="dropdown-item d-flex align-items-center"
                                    data-bs-theme-value="dark" aria-pressed="false">
                                    <i class="bi theme-icon bi-moon-stars-fill"></i>
                                    <span class="ms-2">Dark</span>
                                </button>
                            </li>
                            <li>
                                <button type="button" class="dropdown-item d-flex align-items-center active"
                                    data-bs-theme-value="auto" aria-pressed="true">
                                    <i class="bi theme-icon bi-circle-half"></i>
                                    <span class="ms-2">Auto</span>
                                </button>
                            </li>
                        </ul>
                    </div>
                </li>


                <!-- List -->
                <li class="dropdown ms-2">
                    <a class="rounded-circle" href="#!" role="button" id="dropdownUser" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <div class="avatar avatar-md avatar-indicators avatar-online">
                            <img alt="avatar" src="{{ asset('backend') }}/assets/images/avatar/avatar-11.jpg"
                                class="rounded-circle" />
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                        <div class="px-4 pb-0 pt-2">
                            <div class="lh-1">
                                <h5 class="mb-1">John E. Grainger</h5>
                                <a href="#!" class="text-inherit fs-6">View my profile</a>
                            </div>
                            <div class="dropdown-divider mt-3 mb-2"></div>
                        </div>

                        <ul class="list-unstyled">
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.index') }}">
                                    <i class="me-2 icon-xxs dropdown-item-icon" data-feather="user"></i>
                                    Edit Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#!">
                                    <i class="me-2 icon-xxs dropdown-item-icon" data-feather="activity"></i>
                                    Activity Log
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="#!">
                                    <i class="me-2 icon-xxs dropdown-item-icon" data-feather="settings"></i>
                                    Settings
                                </a>
                            </li>
                            <li>

                                <a class="dropdown-item" href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="me-2 icon-xxs dropdown-item-icon" data-feather="power"></i>
                                    Sign Out
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('POST')
                                </form>
                            </li>
                </li>
            </ul>
        </div>
        </li>
        </ul>
    </div>
</div>
</div>
