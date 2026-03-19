<head>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('admin2/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin2/dist/css/adminlte.min.css') }}">
    <style>
        /* Seller Sidebar CSS */
        #sellerSidebar {
            position: fixed;
            top: 56px;               /* navbar height */
            right: -270px;           /* hidden by default */
            width: 270px;
            height: calc(100vh - 56px);
            z-index: 1050;
            border-left: 1px solid #ddd;
            border-radius: 0 0 0 8px;
            background-color: #f8f9fa;
            padding: 20px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
            transition: right 0.3s;
        }

        #sellerSidebar .hover-bg:hover {
            background-color: #f0f0f0;
            transition: background-color 0.2s;
        }

        #sellerSidebar ul {
            max-height: calc(100vh - 80px);
            overflow-y: auto;
            padding-right: 4px;
        }
    </style>
</head>

<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
        <!-- Brand -->
        <a href="{{ asset('admin2/index3.html') }}" class="navbar-brand">
            <h1 class="m-0">
                <i class="fas fa-store" style="color: greenyellow"></i> Envato Market
            </h1>
        </a>

        <!-- Navbar toggler for mobile -->
        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar collapse -->
        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <!-- Left links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ asset('admin2/index3.html') }}" class="nav-link" style="color: white">Home</a>
                </li>
                @include('e-commerce.category-select')
            </ul>

            <!-- Search -->
            <form class="form-inline ml-0 ml-md-3">
                <div class="input-group input-group-sm" style="width: 25vw">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search"
                           aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Right navbar -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto align-items-center">

            @can('isSeller')
                <!-- Sidebar toggle -->
                <li class="nav-item">
                    <a class="nav-link" href="#" id="sellerSidebarToggle">
                        <i class="fas fa-bars fa-lg"></i>
                    </a>
                </li>
            @endcan

            <!-- Sign In -->
            @if (Gate::denies('isUser') && Gate::denies('isSeller'))
                <li class="nav-item mr-2">
                    <a href="{{ route('LoginPage') }}" class="btn btn-danger">Sign In</a>
                </li>
            @endif

            <!-- User dropdown -->
            @if (Gate::allows('isUser') || Gate::allows('isSeller'))
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-user-circle fa-lg"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <span class="dropdown-item-text">{{ Auth::user()->name }}</span>
                        <div class="dropdown-divider"></div>

                        @can('isUser')
                            <a href="{{ route('view.user.profile') }}" class="dropdown-item">
                                <i class="fas fa-user mr-2"></i> Profile
                            </a>
                        @endcan

                        @can('isSeller')
                            <a href="" class="dropdown-item">
                                <i class="fas fa-user mr-2"></i> Dashboard
                            </a>
                        @endcan

                        <a href="{{ route('logout.now') }}" class="dropdown-item">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </a>
                    </div>
                </li>
            @endif

            <!-- Cart Icon -->
            <li class="nav-item">
                <a href="#" class="nav-link position-relative">
                    <i class="fas fa-shopping-cart fa-lg"></i>
                    <span id="cart-count" class="badge badge-pill badge-danger position-absolute"
                          style="top: -8px; right: -10px;">0</span>
                </a>
            </li>
        </ul>
    </div>
</nav>

<!-- Seller Sidebar -->
@can('isSeller')
<div id="sellerSidebar">
    <h5 class="mb-4">Seller Menu</h5>
    <ul class="nav flex-column">
        <li class="nav-item mb-2">
            <a href="#" class="nav-link text-dark d-flex align-items-center rounded hover-bg">
                <i class="fas fa-shopping-cart mr-2"></i> My Cart
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="#" class="nav-link text-dark d-flex align-items-center rounded hover-bg">
                <i class="fas fa-list-alt mr-2"></i> My Orders
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('view.seller.product') }}" class="nav-link text-dark d-flex align-items-center rounded hover-bg">
                <i class="fas fa-box-open mr-2"></i> My Products
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="#" class="nav-link text-dark d-flex align-items-center rounded hover-bg">
                <i class="fas fa-dollar-sign mr-2"></i> Revenue
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="#" class="nav-link text-dark d-flex align-items-center rounded hover-bg">
                <i class="fas fa-key mr-2"></i> Change Password
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('logout.now') }}" class="nav-link text-dark d-flex align-items-center rounded hover-bg">
                <i class="fas fa-sign-out-alt mr-2"></i> Logout
            </a>
        </li>
    </ul>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggle = document.getElementById('sellerSidebarToggle');
        const sidebar = document.getElementById('sellerSidebar');

        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            sidebar.style.right = (sidebar.style.right === '0px') ? '-270px' : '0px';
        });
    });
</script>
@endcan
