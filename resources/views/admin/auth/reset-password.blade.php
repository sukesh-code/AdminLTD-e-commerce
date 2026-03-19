<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>AdminLTE 4 | Reset Password Page</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" />

    <!-- OverlayScrollbars -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css" />

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />

    <!-- AdminLTE -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.css') }}" />
</head>

<body class="register-page bg-body-secondary">

    <div class="register-box">

        <div class="register-logo">
            <a href="#"><b>Admin</b>LTE</a>
        </div>

        <div class="card">

            <div class="card-body register-card-body">

                <h4 class="register-box-msg">Reset Password Now</h4>

                <form action="{{ route('reset.password.now') }}" method="post">
                    @csrf

                    <input type="hidden" name="email" value="{{ session('email') }}">

                    <div class="input-group mb-3">
                        <input type="password" name="password_New" class="form-control" placeholder="New Password" />
                        <div class="input-group-text">
                            <span class="bi bi-lock-fill"></span>
                        </div>
                    </div>




                    <!-- Row -->
                    <div class="row">

                        <div class="col-8">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="flexCheckDefault" />
                                <label class="form-check-label" for="flexCheckDefault">
                                    I agree to the <a href="#">terms</a>
                                </label>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="d-flex gap-2 justify-content-end">
                                <button type="submit" class="btn btn-success">Save</button>
                                <a href="{{ route('LoginPage') }}" class="btn btn-primary">Back</a>
                            </div>
                        </div>

                    </div>

                </form>


            </div>

        </div>

    </div>

    <!-- OverlayScrollbars -->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js">
    </script>

    <!-- Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

    <!-- AdminLTE -->
    <script src="{{ asset('admin/dist/js/adminlte.js') }}"></script>

    <script>
        const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
        const Default = {
            scrollbarTheme: 'os-theme-light',
            scrollbarAutoHide: 'leave',
            scrollbarClickScroll: true,
        };

        document.addEventListener('DOMContentLoaded', function() {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);

            if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });
    </script>

</body>

</html>
