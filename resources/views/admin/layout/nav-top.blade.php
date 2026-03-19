<nav class="app-header navbar navbar-expand navbar-dark" style="background-color:#2C3046;">
          <!--begin::Container-->
          <div class="container-fluid">
              <!--begin::Start Navbar Links-->
              <ul class="navbar-nav">
                  <li class="nav-item">
                      <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                          <i class="bi bi-list"></i>
                      </a>
                  </li>
                  <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Home</a></li>
                  {{-- <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Contact</a></li> --}}
              </ul>
              <!--end::Start Navbar Links-->
              <!--begin::End Navbar Links-->
              <ul class="navbar-nav ms-auto">
                  <!--begin::Navbar Search-->

                  <!--end::Navbar Search-->
                  <!--begin::Messages Dropdown Menu-->

                  <!--end::Messages Dropdown Menu-->
                  <!--begin::Notifications Dropdown Menu-->

                  <!--end::Notifications Dropdown Menu-->
                  <!--begin::Fullscreen Toggle-->
                  <li class="nav-item">
                      <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                          <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                          <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
                      </a>
                  </li>
                  <!--end::Fullscreen Toggle-->
                  <!--begin::User Menu Dropdown-->
                  <li class="nav-item dropdown user-menu">
                      <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                          <img src="{{ asset('admin/dist/assets/img/user2-160x160.jpg') }}"
                              class="user-image rounded-circle shadow" alt="User Image" />
                          <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                      </a>
                      <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                          <!--begin::User Image-->
                          <li class="user-header text-bg-primary">
                              <img src="admin/dist/assets/img/user2-160x160.jpg" class="rounded-circle shadow"
                                  alt="User Image" />
                              <p>
                                  {{ Auth::user()->name }} - Web Developer
                                  <small>Member since Nov. 2023</small>
                              </p>
                          </li>
                          <!--end::User Image-->
                          <!--begin::Menu Body-->

                          <!--end::Menu Body-->
                          <!--begin::Menu Footer-->
                          <li class="user-footer">
                              {{-- <a href="#" class="btn btn-success btn-flat">Profile</a> --}}
                              <a href="{{ route('change.password.now') }}" class="btn btn-success btn-flat">Change
                                  password</a>

                              <a href="{{ route('logout.now') }}"  data-bs-toggle="modal" data-bs-target="#logoutModal" class="btn btn-danger btn-flat float-end">
                                  Sign out &rarr;
                              </a>
                          </li>
                          <!--end::Menu Footer-->
                      </ul>
                  </li>
                  <!--end::User Menu Dropdown-->
              </ul>
              <!--end::End Navbar Links-->
          </div>
          <!--end::Container-->
      </nav>





<!-- For confomration before logout -->
      <div class="modal fade" id="logoutModal" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">

                  <div class="modal-header">
                      <h5 class="modal-title">Logout Confirmation</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>

                  <div class="modal-body">
                      Are you sure you want to logout?
                  </div>

                  <div class="modal-footer">
                      <button type="button" class="btn btn-success" data-bs-dismiss="modal">
                          Cancel
                      </button>

                      <a href="{{ route('logout.now') }}" class="btn btn-danger">
                          Yes, Logout
                      </a>
                  </div>

              </div>
          </div>
      </div>
