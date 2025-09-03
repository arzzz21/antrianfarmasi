<!doctype html>
<html lang="en">
<head>

    <title>Error 404 - Not Found | SIRMED</title>

    <!-- [Meta] -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Sistem Manajemen Rumah Sakit PKU Muhammadiyah Sukoharjo" />
    <meta name="keywords" content="simrs, simrsmu, sim rspkuskh, pkuskh, rspkuskh, sistem pku, sistem informasi majemen rumah sakit, rumah sakit pku, pku muhammadiyah sukoharjo, pku sukoharjo">
    <meta name="author" content="TIM IT - RS PKU Muhammadiyah Sukoharjo" />
    <link rel="shortcut icon" href="{{ asset('images/logo/logo.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/logo/logo.png') }}">
    <link rel="icon" href="{{ asset('images/logo/logo.png') }}" type="image/x-icon" />

    <!-- [Google Font : Public Sans] icon -->
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&amp;display=swap"
        rel="stylesheet" />
    <!-- [phosphor Icons] https://phosphoricons.com/ -->
    <link rel="stylesheet" href="{{ asset('fonts/phosphor/duotone/style.css') }}" />
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="{{ asset('fonts/tabler-icons.min.css') }}" />
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="{{ asset('fonts/feather.css') }}" />
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="{{ asset('fonts/fontawesome.css') }}" />
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="{{ asset('fonts/material.css') }}" />
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" id="main-style-link" />
    <link rel="stylesheet" href="{{ asset('css/style-preset.css') }}" />

    <script src="{{ asset('js/jquery.min.js') }}"></script>
</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr"
    data-pc-theme="light">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->

    <div class="auth-main v1">
        <div class="auth-wrapper">
            <div class="auth-form">
                <div class="error-card">
                    <div class="card-body">
                        <div class="error-image-block">
                            <img class="img-fluid" src="{{ asset('/images/pages/img-error-404.png') }}" alt="img" />
                        </div>
                        <div class="text-center">
                            <h1 class="mt-2">Oops! Terjadi Kesalahan</h1>
                            <p class="mt-2 mb-4 text-muted f-20">Kami tidak dapat menemukan halaman yang Anda cari. Silakan kembali ke beranda.</p>
                            <a class="btn btn-primary d-inline-flex align-items-center mb-3"
                                href="{{ route('antrian.index') }}"><i class="ph-duotone ph-house me-2"></i> Kembali ke Dashboard</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="auth-sidefooter">
                <h5 class="m-0 text-light"><span class="badge text-bg-primary me-1">SIRMED v1.0</span> <b class="text-secondary align-middle">Sistem Informasi Rekam Medis Elektronik</b></h5>
                <hr class="mb-3 mt-4" />
                <div class="row">
                    <div class="col my-1">
                        <p class="m-0">Dibuat dengan <a href="javascript: void(0);" class="text-danger">&#9829;</a> oleh <b>Tim Programmer RS PKU Muhammadiyah Sukoharjo</b></p>
                    </div>
                    <div class="col-auto my-1">
                        <ul class="list-inline footer-link mb-0">
                            <li class="list-inline-item"><a href="javascript: void(0);" target="_blank">Butuh Bantuan?</a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- [ Main Content ] end -->
    <!-- Required Js -->
    <script src="{{ asset('js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('js/plugins/simplebar.min.js') }}"></script>
    <script src="{{ asset('js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins/i18next.min.js') }}"></script>
    <script src="{{ asset('js/plugins/i18nextHttpBackend.min.js') }}"></script>
    <script src="{{ asset('js/icon/custom-font.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/theme.js') }}"></script>
    {{-- <script src="{{ asset('js/multi-lang.js') }}"></script> --}}
    <script src="{{ asset('js/plugins/feather.min.js') }}"></script>

    <script>
        layout_change('light');
    </script>

    <script>
        layout_sidebar_change('light');
    </script>

    <script>
        change_box_container('false');
    </script>

    <script>
        layout_caption_change('true');
    </script>

    <script>
        layout_rtl_change('false');
    </script>

    <script>
        preset_change('preset-1');
    </script>

</body>
</html>
