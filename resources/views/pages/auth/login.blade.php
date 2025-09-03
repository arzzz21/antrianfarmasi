<!doctype html>
<html lang="en">
<head>

    <title>Sistem Informasi Rekam Medis</title>

    <!-- [Meta] -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Sistem Manajemen Rumah Sakit PKU Muhammadiyah Sukoharjo" />
    <meta name="keywords" content="simrs, simrsmu, sim rspkuskh, pkuskh, rspkuskh, sistem pku, sistem informasi majemen rumah sakit, rumah sakit pku, pku muhammadiyah sukoharjo, pku sukoharjo">
    <meta name="author" content="Yussuf Faisal" />
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

<body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->

    <div class="auth-main v2">
        <div class="bg-overlay bg-dark"></div>
        <div class="auth-wrapper">
            <div class="auth-sidecontent">
                <div class="auth-sidefooter">
                    <h5 class="m-0 text-light"><span class="badge text-bg-primary me-1">SIRMED v1.0</span> Sistem Informasi Rekam Medis Elektronik</h5>
                    {{-- <img src="{{ asset('images/pku/bg.png') }}" class="img-brand img-fluid" alt="images" /> --}}
                    <hr class="mb-2 mt-3" />
                    <div class="row">
                        <div class="col my-1">
                            <p class="m-0">Dibuat dengan <a href="javascript: void(0);" class="text-danger">&#9829;</a> oleh <b>Tim Programmer RS PKU Muhammadiyah Sukoharjo</b></p>
                        </div>
                        {{-- <div class="col-auto my-1">
                            <ul class="list-inline footer-link mb-0">
                                <li class="list-inline-item"><a href="#">Support</a></li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="auth-form">
                <div class="card my-5 mx-3">
                    <div class="card-body">
                        <center><img class="mb-3" src="{{ asset('images/pku/logo-kop-blue.png') }}" width="300" alt=""></center>
                        <hr class="mb-4" />
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <h4 class="f-w-500 mb-1">Login | SIRMED</h4>
                        <p class="mb-3">Belum memiliki Akun? <a href="javascript: void(0);"class="link-primary ms-1">Minta Akun</a></p>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                        <div class="mb-3" data-validate="Username is required">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Username" value="{{ old('name') }}" autocomplete="name" autofocus required/>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3" data-validate="Password is required">
                            <div class="input-group">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" autocomplete="current-password" required/>
                                <button href="javascript:void(0);" type="button" class="btn btn-outline-primary" id="open-password" style="border-color: #ced4da;border-top-right-radius:8px;border-bottom-right-radius:8px">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="d-flex mt-1 justify-content-between align-items-center">
                            <div class="form-check">
                                <input class="form-check-input input-primary {{ old('remember') ? 'checked' : '' }}" type="checkbox" id="remember" name="remember"/>
                                <label class="form-check-label text-muted" for="customCheckc1">Ingat Saya?</label>
                            </div>
                            <a href="javascript: void(0);">
                                <h6 class="text-secondary f-w-400 mb-0">Lupa Password?</h6>
                            </a>
                        </div>
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary align-middle" id="show-loader">Masuk <i data-feather="log-in" class="ms-1" style="width:13px;height:13px;margin-top:-2px"></i></button>
                        </div>
                        {{-- <div class="saprator my-3">
                            <span>Or continue with</span>
                        </div>
                        <div class="text-center">
                            <ul class="list-inline mx-auto mt-3 mb-0">
                                <li class="list-inline-item">
                                    <a href="https://www.facebook.com/" class="avtar avtar-s rounded-circle bg-facebook"
                                        target="_blank">
                                        <i class="fab fa-facebook-f text-white"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="https://twitter.com/" class="avtar avtar-s rounded-circle bg-twitter"
                                        target="_blank">
                                        <i class="fab fa-twitter text-white"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="https://myaccount.google.com/"
                                        class="avtar avtar-s rounded-circle bg-googleplus" target="_blank">
                                        <i class="fab fa-google text-white"></i>
                                    </a>
                                </li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#open-password").on("click", function() {
                var x = $("#password");
                if (x[0].type === "password") {
                    x[0].type = "text";
                    $('#open-password').find("i").toggleClass("fa-eye fa-eye-slash");
                } else {
                    x[0].type = "password";
                    $('#open-password').find("i").toggleClass("fa-eye-slash fa-eye");
                }
            });

            // $("#btn-login").on("click", function() {
            //     console.log('masuk');
            // });
        })
    </script>

    <div class="loader">
        <div class="p-4 text-center">
            <div class="custom-loader"></div>
            <h2 class="my-3 f-w-400">Authentikasi Pengguna..</h2>
            <p class="mb-0">Mohon tunggu sementara kami mendapatkan informasi dari Akun Anda</p>
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

    <script>
        var control = document.querySelector('#show-loader');
        var elem = document.querySelector('.loader'),
            fadeInInterval,
            fadeOutInterval;

        if (control) {
            control.addEventListener('click', function () {
                $('#show-loader').props('disabled',true);
                if (!elem.classList.contains('is-active')) {
                    clearInterval(fadeInInterval);
                    clearInterval(fadeOutInterval);
                    elem.fadeIn = function (timing) {
                        var newValue = 0;
                        elem.style.display = 'flex';
                        elem.style.opacity = 0;
                        fadeInInterval = setInterval(function () {
                            if (newValue < 1) {
                                newValue += 0.01;
                            } else if (newValue === 1) {
                                clearInterval(fadeInInterval);
                            }
                            elem.style.opacity = newValue;
                        }, timing);
                    };
                    elem.fadeIn(3);
                    setTimeout(function () {
                        clearInterval(fadeInInterval);
                        clearInterval(fadeOutInterval);
                        elem.fadeOut = function (timing) {
                            var newValue = 1;
                            elem.style.opacity = 1;
                            fadeOutInterval = setInterval(function () {
                                if (newValue > 0) {
                                    newValue -= 0.01;
                                } else if (newValue < 0) {
                                    elem.style.opacity = 0;
                                    elem.style.display = 'none';
                                    clearInterval(fadeOutInterval);
                                }
                                elem.style.opacity = newValue;
                            }, timing);
                        };
                        elem.fadeOut(3);
                    }, 4000);
                }
            });
        }
    </script>

</body>
</html>
