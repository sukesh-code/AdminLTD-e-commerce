  <aside class="app-sidebar " style="background-color:#32354B;" data-bs-theme="white">
      <!--begin::Sidebar Brand-->
      <div class="sidebar-brand">
          <!--begin::Brand Link-->
          <a href="{{ asset('admin/index.html') }}" class="brand-link">
              <!--begin::Brand Image-->
              <img src="admin/dist/assets/img/AdminLTELogo.png" alt="AdminLTE Logo"
                  class="brand-image opacity-75 shadow" />
              <!--end::Brand Image-->
              <!--begin::Brand Text-->
              <span class="brand-text fw-light">AdminLTE 4</span>
              <!--end::Brand Text-->
          </a>
          <!--end::Brand Link-->
      </div>
      <!--end::Sidebar Brand-->





      <!--begin::Sidebar Wrapper-->
      <div class="sidebar-wrapper">
          <nav class="mt-2">
              <!--begin::Sidebar Menu-->
              <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                  <li class="nav-item menu-open">
                      <a href="{{ route('dashboard.page') }}" class="nav-link active">
                          <i class="nav-icon bi bi-grid"></i>
                          <p>
                              Dashboard
                              <i class="nav-arrow bi bi-chevron-right"></i>
                          </p>
                      </a>
                  </li>

                  {{-- User Mangement --}}
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon bi bi-people"></i>
                          <p>
                              User Management
                              <i class="nav-arrow bi bi-chevron-right"></i>
                          </p>
                      </a>

                      <ul class="nav nav-treeview">

                          <li class="nav-item">
                              <a href="{{ route('view-All-User.now') }}" class="nav-link">
                                  <i class="nav-icon bi bi-list"></i>
                                  <p>All Users</p>
                              </a>
                          </li>

                          <li class="nav-item">
                              <a href="{{ route('add.user.now') }}" class="nav-link">
                                  <i class="nav-icon bi bi-person-plus"></i>
                                  <p>Add User</p>
                              </a>
                          </li>

                      </ul>
                  </li>


                  {{-- Category Magement --}}

                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon bi bi-tags"></i>
                          <p>
                              Category Management
                              <i class="nav-arrow bi bi-chevron-right"></i>
                          </p>
                      </a>

                      <ul class="nav nav-treeview">

                          <li class="nav-item">
                              <a href="{{ route('all.category.now') }}" class="nav-link">
                                  <i class="nav-icon bi bi-list"></i>
                                  <p>All Categories</p>
                              </a>
                          </li>

                          <li class="nav-item">
                              <a href="{{ route('show.category.now') }}" class="nav-link">
                                  <i class="nav-icon bi bi-plus-circle"></i>
                                  <p>Add Category</p>
                              </a>
                          </li>

                      </ul>
                  </li>


              </ul>
              <!--end::Sidebar Menu-->
          </nav>
      </div>
      <!--end::Sidebar Wrapper-->
  </aside>
