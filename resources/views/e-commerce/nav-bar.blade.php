<head>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('admin2/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin2/dist/css/adminlte.min.css') }}">
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
        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar collapse -->
        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ route('e-commerce-page') }}" class="nav-link" style="color: white">Home</a>
                </li>

                @include('e-commerce.category-select')
            </ul>

            <!-- Search -->
            <form class="form-inline ml-0 ml-md-3">
                <div class="input-group input-group-sm " style="width: 25vw">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search">
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

            @auth
                <li class="nav-item">
                    <a class="nav-link" href="#" id="sellerSidebarToggle">
                        <i class="fas fa-bars fa-lg"></i>
                    </a>
                </li>
            @endauth

            @if (Gate::denies('isUser') && Gate::denies('isSeller'))
                <li class="nav-item mr-2">
                    <a href="{{ route('LoginPage') }}" class="btn btn-danger">Sign In</a>
                </li>
            @endif

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

                        <!-- UPDATED LOGOUT -->
                        <a href="{{ route('logout.now') }}" class="dropdown-item logout-btn">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </a>
                    </div>
                </li>
            @endif
        </ul>
    </div>
</nav>

@auth
<div id="sellerSidebar" class="position-fixed bg-light text-dark p-4 shadow"
    style="top: 56px; right: -270px; width: 270px; height: 100vh; transition: right 0.3s; z-index: 1050; border-left: 1px solid #ddd; border-radius: 0 0 0 8px;">

    @can('isSeller')
        <h5 class="mb-4">Seller Menu</h5>
    @endcan

    @can('isUser')
        <h5 class="mb-4">User Menu</h5>
    @endcan

    <ul class="nav flex-column">
        <li class="nav-item mb-2">
            <a href="{{ route('view.cart.page') }}" class="nav-link text-dark d-flex align-items-center rounded hover-bg">
                <i class="fas fa-shopping-cart mr-2"></i> My Cart
            </a>
        </li>

        @can('isUser')
            <li class="nav-item mb-2">
                <a href="{{ route('user.order.page') }}" class="nav-link text-dark d-flex align-items-center rounded hover-bg">
                    <i class="fas fa-list-alt mr-2"></i> My Orders
                </a>
            </li>
        @endcan

        @can('isSeller')
            <li class="nav-item mb-2">
                <a href="{{ route('order.page', Auth::id()) }}" class="nav-link text-dark d-flex align-items-center rounded hover-bg">
                    <i class="fas fa-list-alt mr-2"></i> My Orders
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="{{ route('view.seller.product') }}" class="nav-link text-dark d-flex align-items-center rounded hover-bg">
                    <i class="fas fa-box-open mr-2"></i> My Products
                </a>
            </li>
        @endcan

        <li class="nav-item mb-2">
            <a href="{{ route('change.password') }}" class="nav-link text-dark d-flex align-items-center rounded hover-bg">
                <i class="fas fa-key mr-2"></i> Change Password
            </a>
        </li>

        <!-- UPDATED LOGOUT -->
        <li class="nav-item">
            <a href="{{ route('logout.now') }}" class="nav-link text-dark d-flex align-items-center rounded hover-bg logout-btn">
                <i class="fas fa-sign-out-alt mr-2"></i> Logout
            </a>
        </li>
    </ul>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    let cartCount = localStorage.getItem("cartCount") || 0;
    $('#cart-count').text(cartCount);

    $(document).on('click', '.addCart', function() {
        cartCount++;
        localStorage.setItem("cartCount", cartCount);
        $('#cart-count').text(cartCount);
    });

    // LOGOUT CONFIRMATION
    $(document).on('click', '.logout-btn', function(e) {
        e.preventDefault();
        let link = $(this).attr('href');

        if (confirm("Are you sure you want to logout?")) {
            window.location.href = link;
        }
    });
</script>

<style>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggle = document.getElementById('sellerSidebarToggle');
        const sidebar = document.getElementById('sellerSidebar');

        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            sidebar.style.right = (sidebar.style.right === '0px') ? '-270px' : '0px';
        });
    });
</script>
@endauth
