  <!-- navbar vertical -->
  <div class="app-menu"><!-- Sidebar -->

      <div class="navbar-vertical navbar nav-dashboard">
          <div class="h-100" data-simplebar>
              <!-- Brand logo -->
              <a class="navbar-brand" href="index.html">
                  <img src="{{ asset('backend') }}/assets/images/brand/logo/logo-2.svg" alt="Dash Ui" />
              </a>
              <!-- Navbar nav -->


              <ul class="navbar-nav flex-column" id="sideNavbar">

                  <li class="nav-item">
                      <a class="nav-link " href="{{ route('dashboard') }}">
                          <i data-feather="home" class="nav-icon me-2 icon-xxs"></i>
                          Dashboard
                      </a>
                  </li>

                  <!-- Nav item -->
                  {{-- <li class="nav-item {{ request()->routeIs('dashboard.*') ? 'active' : '' }}">
                      <a class="nav-link has-arrow " href="" data-bs-toggle="collapse"
                          data-bs-target="#navDashboard" aria-expanded="false" aria-controls="navDashboard">
                          <i data-feather="home" class="nav-icon me-2 icon-xxs"></i>
                          Product
                      </a>

                      <div id="navDashboard" class="collapse  show " data-bs-parent="#sideNavbar">
                          <ul class="nav flex-column">
                              <li class="nav-item">
                                  <a class="nav-link " href="">Analytics</a>
                              </li>
                          </ul>
                      </div>
                      <div id="navDashboard" class="collapse  show " data-bs-parent="#sideNavbar">
                          <ul class="nav flex-column">
                              <li class="nav-item">
                                  <a class="nav-link " href="">Products</a>
                              </li>
                          </ul>
                      </div>
                  </li> --}}
              </ul>
              <!-- Navbar nav -->
              <ul class="navbar-nav flex-column" id="settingId">
                  <!-- Nav item -->
                  <li class="nav-item {{ request()->routeIs('profile.*', 'mail.*','system.*','admin.*') ? 'active' : '' }}">
                      <a class="nav-link has-arrow" href="#!" data-bs-toggle="collapse"
                          data-bs-target="#settingBtnId"
                          aria-expanded="{{ request()->routeIs('profile.*', 'mail.*','system.*','admin.*') ? 'true' : 'false' }}"
                          aria-controls="settingBtnId">
                          <i data-feather="settings" class="nav-icon me-2 icon-xxs"></i>Settings
                      </a>

                      <div id="settingBtnId"
                          class="collapse {{ request()->routeIs('profile.*', 'mail.*','system.*','admin.*') ? 'show' : '' }}"
                          data-bs-parent="#settingId">
                          <ul class="nav flex-column">
                              <li class="nav-item">
                                  <a class="nav-link {{ request()->routeIs('profile.index') ? 'active' : '' }}"
                                      href="{{ route('profile.index') }}">
                                      Profile Setting
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a class="nav-link {{ request()->routeIs('system.index') ? 'active' : '' }}"
                                      href="{{route('system.index') }}">
                                      System Setting
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a class="nav-link {{ request()->routeIs('admin.setting.index') ? 'active' : '' }}"
                                      href="{{ route('admin.setting.index') }}">
                                      Admin Setting
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a class="nav-link {{ request()->routeIs('mail.index') ? 'active' : '' }}"
                                      href="{{ route('mail.index') }}">
                                      Mail Setting
                                  </a>
                              </li>
                          </ul>
                      </div>
                  </li>



                  <li class="nav-item">
                      <a class="nav-link " href="">
                          <i data-feather="folder-plus" class="nav-icon me-2 icon-xxs"></i>
                          Others

                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#"
                          onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                          <i data-feather="log-out" class="nav-icon me-2 icon-xxs"></i>
                          Logout
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                          @method('POST')
                      </form>
                  </li>


              </ul>

          </div>
      </div>
  </div>
