<!doctype html>
<html lang="en">
<head>

    <title>Sistem Informasi Rekam Medis</title>

    @include('inc.meta')

    @include('inc.css')

    {{-- DATA PC THEME START --}}
    <script>
        // Terapkan tema seawal mungkin (sebelum render)
        (function () {
            const savedTheme = localStorage.getItem('pc-theme') || 'light';
            if (savedTheme) {
                // Set attribute theme ke <html> atau <body>
                document.documentElement.setAttribute('data-pc-theme', savedTheme);

                // Atur logo sesuai theme
                window.addEventListener("DOMContentLoaded", function () {
                    const logoLight = document.getElementById('logo-light');
                    const logoDark  = document.getElementById('logo-dark');

                    if (savedTheme === 'light') {
                        logoLight.style.display = 'inline';
                        logoDark.style.display  = 'none';
                    } else {
                        logoLight.style.display = 'none';
                        logoDark.style.display  = 'inline';
                    }
                });
            }
        })();
    </script>
    {{-- <style>
        /* default: dark mode */
        #logo-light { display: none; }
        #logo-dark { display: inline; }

        /* jika pakai data-pc-theme="light" di body */
        body[data-pc-theme="light"] #logo-light { display: inline; }
        body[data-pc-theme="light"] #logo-dark { display: none; }
        body[data-pc-theme="dark"] #logo-light { display: none; }
        body[data-pc-theme="dark"] #logo-dark { display: inline; }
    </style> --}}
    {{-- DATA PC THEME END --}}

</head>
<body id="main-body" data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr"> <!-- data-pc-theme="dark" -->

    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->

    <!-- Logout Form -->
    <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>

    @include('inc.navbar.navbar')
    @include('inc.header.header')

    <!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content">

            @yield('content')

        </div>
    </div>
    <!-- [ Main Content ] end -->

    @include('inc.footer')
    @include('inc.js')

    {{-- OFFCANVAS --}}
        {{-- <div class="offcanvas border-0 pct-offcanvas offcanvas-end" tabindex="-1" id="offcanvas_pc_layout">
            <div class="offcanvas-header justify-content-between">
                <h5 class="offcanvas-title">Settings</h5>
                <button type="button" class="btn btn-icon btn-link-danger" data-bs-dismiss="offcanvas" aria-label="Close"><i
                        class="ti ti-x"></i></button>
            </div>
            <div class="pct-body customizer-body">
                <div class="offcanvas-body py-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="pc-dark">
                                <h6 class="mb-1">Theme Mode</h6>
                                <p class="text-muted text-sm">Choose light or dark mode or Auto</p>
                                <div class="row theme-color theme-layout">
                                    <div class="col-4">
                                        <div class="d-grid">
                                            <button class="preset-btn btn active" data-value="true"
                                                onclick="layout_change('light');">
                                                <span class="btn-label">Light</span>
                                                <span
                                                    class="pc-lay-icon"><span></span><span></span><span></span><span></span></span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="d-grid">
                                            <button class="preset-btn btn" data-value="false"
                                                onclick="layout_change('dark');">
                                                <span class="btn-label">Dark</span>
                                                <span
                                                    class="pc-lay-icon"><span></span><span></span><span></span><span></span></span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="d-grid">
                                            <button class="preset-btn btn" data-value="default"
                                                onclick="layout_change_default();" data-bs-toggle="tooltip"
                                                title="Automatically sets the theme based on user's operating system's color scheme.">
                                                <span class="btn-label">Default</span>
                                                <span class="pc-lay-icon d-flex align-items-center justify-content-center">
                                                    <i class="ph-duotone ph-cpu"></i>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item pc-sidebar-color">
                            <h6 class="mb-1">Sidebar Theme</h6>
                            <p class="text-muted text-sm">Choose Sidebar Theme</p>
                            <div class="row theme-color theme-sidebar-color">
                                <div class="col-6">
                                    <div class="d-grid">
                                        <button class="preset-btn btn" data-value="true"
                                            onclick="layout_sidebar_change('dark');">
                                            <span class="btn-label">Dark</span>
                                            <span
                                                class="pc-lay-icon"><span></span><span></span><span></span><span></span></span>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-grid">
                                        <button class="preset-btn btn active" data-value="false"
                                            onclick="layout_sidebar_change('light');">
                                            <span class="btn-label">Light</span>
                                            <span
                                                class="pc-lay-icon"><span></span><span></span><span></span><span></span></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <h6 class="mb-1">Accent color</h6>
                            <p class="text-muted text-sm">Choose your primary theme color</p>
                            <div class="theme-color preset-color">
                                <a href="#!" class="active" data-value="preset-1"><i class="ti ti-check"></i></a>
                                <a href="#!" data-value="preset-2"><i class="ti ti-check"></i></a>
                                <a href="#!" data-value="preset-3"><i class="ti ti-check"></i></a>
                                <a href="#!" data-value="preset-4"><i class="ti ti-check"></i></a>
                                <a href="#!" data-value="preset-5"><i class="ti ti-check"></i></a>
                                <a href="#!" data-value="preset-6"><i class="ti ti-check"></i></a>
                                <a href="#!" data-value="preset-7"><i class="ti ti-check"></i></a>
                                <a href="#!" data-value="preset-8"><i class="ti ti-check"></i></a>
                                <a href="#!" data-value="preset-9"><i class="ti ti-check"></i></a>
                                <a href="#!" data-value="preset-10"><i class="ti ti-check"></i></a>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <h6 class="mb-1">Sidebar Caption</h6>
                            <p class="text-muted text-sm">Sidebar Caption Hide/Show</p>
                            <div class="row theme-color theme-nav-caption">
                                <div class="col-6">
                                    <div class="d-grid">
                                        <button class="preset-btn btn active" data-value="true"
                                            onclick="layout_caption_change('true');">
                                            <span class="btn-label">Caption Show</span>
                                            <span
                                                class="pc-lay-icon"><span></span><span></span><span><span></span><span></span></span><span></span></span>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-grid">
                                        <button class="preset-btn btn" data-value="false"
                                            onclick="layout_caption_change('false');">
                                            <span class="btn-label">Caption Hide</span>
                                            <span
                                                class="pc-lay-icon"><span></span><span></span><span><span></span><span></span></span><span></span></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="pc-rtl">
                                <h6 class="mb-1">Theme Layout</h6>
                                <p class="text-muted text-sm">LTR/RTL</p>
                                <div class="row theme-color theme-direction">
                                    <div class="col-6">
                                        <div class="d-grid">
                                            <button class="preset-btn btn active" data-value="false"
                                                onclick="layout_rtl_change('false');">
                                                <span class="btn-label">LTR</span>
                                                <span
                                                    class="pc-lay-icon"><span></span><span></span><span></span><span></span></span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-grid">
                                            <button class="preset-btn btn" data-value="true"
                                                onclick="layout_rtl_change('true');">
                                                <span class="btn-label">RTL</span>
                                                <span
                                                    class="pc-lay-icon"><span></span><span></span><span></span><span></span></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item pc-box-width">
                            <div class="pc-container-width">
                                <h6 class="mb-1">Layout Width</h6>
                                <p class="text-muted text-sm">Choose Full or Container Layout</p>
                                <div class="row theme-color theme-container">
                                    <div class="col-6">
                                        <div class="d-grid">
                                            <button class="preset-btn btn active" data-value="false"
                                                onclick="change_box_container('false')">
                                                <span class="btn-label">Full Width</span>
                                                <span
                                                    class="pc-lay-icon"><span></span><span></span><span></span><span><span></span></span></span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-grid">
                                            <button class="preset-btn btn" data-value="true"
                                                onclick="change_box_container('true')">
                                                <span class="btn-label">Fixed Width</span>
                                                <span
                                                    class="pc-lay-icon"><span></span><span></span><span></span><span><span></span></span></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-grid">
                                <button class="btn btn-light-danger" id="layoutreset">Reset Layout</button>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div> --}}
    {{-- OFFCANVAS --}}


</body>
</html>
