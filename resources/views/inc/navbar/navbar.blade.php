<!-- [ Sidebar Menu ] start -->
<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="javascript:void(0);" class="b-brand text-primary">
                <img id="logo-light" src="{{ asset('images/logo/logoname.png') }}" alt="logo light" style="height: 24px" />
                <img id="logo-dark" src="{{ asset('images/logo/logoname_w.png') }}" alt="logo dark" style="height: 24px" />
                <span class="badge bg-brand-color-3 rounded-pill ms-1 theme-version">v1.0</span>
            </a>
        </div>

        <script>
            (function () {
                const savedTheme = localStorage.getItem('pc-theme');
                if (savedTheme) {
                    if (savedTheme == 'light') {
                        document.getElementById('logo-light').style.display = 'inline';
                        document.getElementById('logo-dark').style.display = 'none';
                    } else {
                        document.getElementById('logo-light').style.display = 'none';
                        document.getElementById('logo-dark').style.display = 'inline';
                    }
                }
            })();
        </script>

        <div class="navbar-content">
            <ul class="pc-navbar">
                <li class="pc-item pc-caption">
                    <label data-i18n="Navigation">Publik</label>
                    <i class="ph-duotone ph-gauge"></i>
                </li>
                {{-- Dashboard --}}
                <li class="pc-item {{ request()->routeIs('antrian.index') ? 'active' : '' }}">
                    <a href="{{ route('antrian.index') }}" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-gauge"></i>
                        </span>
                        <span class="pc-mtext" data-i18n="Dashboard">Dashboard</span>
                    </a>
                </li>

                <li class="pc-item {{ request()->routeIs('jenis.*') ? 'active' : '' }}">
                    <a href="{{ route('jenis.index') }}" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-list-dashes"></i>
                        </span>
                        <span class="pc-mtext">Jenis Antrian</span>
                    </a>
                </li>

                <li class="pc-item {{ request()->routeIs('loket.*') ? 'active' : '' }}">
                    <a href="{{ route('loket.master') }}" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-lockers"></i>
                        </span>
                        <span class="pc-mtext">Loket Antrian</span>
                    </a>
                </li>

                <li class="pc-item {{ request()->routeIs('ambil.*') ? 'active' : '' }}">
                    <a href="{{ route('ambil.index') }}" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-ticket"></i>
                        </span>
                        <span class="pc-mtext">Ambil Antrian</span>
                    </a>
                </li>

                <li class="pc-item {{ request()->routeIs('panggil.*') ? 'active' : '' }}">
                    <a href="{{ route('panggil.index') }}" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-bell-ringing"></i>
                        </span>
                        <span class="pc-mtext">Pemanggilan Antrian</span>
                    </a>
                </li>

                <li class="pc-item {{ request()->routeIs('display.*') ? 'active' : '' }}">
                    <a href="{{ route('display.index') }}" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-monitor-play"></i>
                        </span>
                        <span class="pc-mtext">Display Antrian</span>
                    </a>
                </li>


                {{-- <li class="pc-item {{ request()->routeIs('antrian.ambil', 'antrian.store') ? 'active' : '' }}">
                    <a href="{{ route('antrian.page.ambil.jenis') }}" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-ticket"></i>
                        </span>
                        <span class="pc-mtext" data-i18n="Ambil Antrian">Ambil Antrian</span>
                    </a>
                </li>
                <li class="pc-item {{ request()->routeIs('antrian.panggil.pilih') ? 'active' : '' }}">
                    <a href="{{ route('antrian.panggil.pilih') }}" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-megaphone"></i>
                        </span>
                        <span class="pc-mtext" data-i18n="Pemanggilan Antrian">Pemanggilan Antrian</span>
                    </a>
                </li>

                <li class="pc-item {{ request()->routeIs('antrian.display.pilih') ? 'active' : '' }}">
                    <a href="{{ route('antrian.display.pilih')}}" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-monitor-play"></i>
                        </span>
                        <span class="pc-mtext" data-i18n="Display Antrian">Display Antrian</span>
                    </a>
                </li> --}}

                {{-- <li class="pc-item {{ request()->routeIs('videos.*') ? 'active' : '' }}">
                    <a href="{{ route('videos.index') }}" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-video-camera"></i>
                        </span>
                        <span class="pc-mtext" data-i18n="Upload Video">Upload Video</span>
                    </a>
                </li> --}}


                {{-- <li class="pc-item {{ request()->routeIs('rilis.index') ? 'active' : '' }}">
                    <a href="{{ route('rilis.index') }}" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-rocket-launch"></i>
                        </span>
                        <span class="pc-mtext" data-i18n="Release">Catatan Rilis</span>
                    </a>
                </li> --}}
                {{-- @if(auth()->user()->can('setting_jabatan') || auth()->user()->can('setting_akses'))
                    <li class="pc-item pc-caption">
                        <label data-i18n="Navigation">Setting</label>
                        <i class="ph-duotone ph-gauge"></i>
                    </li>
                @endif
                @can('setting_jabatan')
                    <li class="pc-item {{ request()->routeIs('roles') ? 'active' : '' }}">
                        <a href="{{ route('roles') }}" class="pc-link">
                            <span class="pc-micon">
                                <i class="ph-duotone ph-tree-structure"></i>
                            </span>
                            <span class="pc-mtext" data-i18n="Jabatan">Jabatan</span>
                        </a>
                    </li>
                @endcan
                @can('setting_akses')
                    <li class="pc-item {{ request()->routeIs('permissions') ? 'active' : '' }}">
                        <a href="{{ route('permissions') }}" class="pc-link">
                            <span class="pc-micon">
                                <i class="ph-duotone ph-user-gear"></i>
                            </span>
                            <span class="pc-mtext" data-i18n="Akses">Akses</span>
                        </a>
                    </li>
                @endcan --}}

                {{-- <li class="pc-item pc-caption">
                    <label>Pelayanan</label>
                    <i class="ph-duotone ph-chart-pie"></i>
                </li>
                <li class="pc-item">
                    <a href="{{ route('pelayanan.pasien') }}" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-users-three"></i>
                        </span>
                        <span class="pc-mtext">Kunjungan Pasien</span>
                    </a>
                </li> --}}

                {{-- <li class="pc-item pc-hasmenu">
                    <a href="javascript:void(0);" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-gauge"></i>
                        </span>
                        <span class="pc-mtext">Pendaftaran</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                        <span class="pc-badge">2</span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="javascript:void(0);">a</a></li>
                        <li class="pc-item"><a class="pc-link" href="javascript:void(0);">b</a></li>
                        <li class="pc-item"><a class="pc-link" href="javascript:void(0);">c</a></li>
                        <li class="pc-item"><a class="pc-link" href="javascript:void(0);">d</a></li>
                        <li class="pc-item"><a class="pc-link" href="javascript:void(0);">e</a></li>
                    </ul>
                </li> --}}
                {{-- @role('admin')
                    <li class="pc-item pc-caption">
                        <label>Electronic</label>
                        <i class="ph-duotone ph-chart-pie"></i>
                    </li>
                    <li class="pc-item {{ request()->routeIs('emr.index') ? 'active' : '' }}">
                        <a href="{{ route('emr.index') }}" class="pc-link">
                            <span class="pc-micon">
                                <i class="ph-duotone ph-activity"></i>
                            </span>
                            <span class="pc-mtext">Medical Record</span>
                        </a>
                    </li>
                @endrole
                @if(auth()->user()->can('monitoring') || auth()->user()->can('smart_claim'))
                    <li class="pc-item pc-caption">
                        <label>Digital</label>
                        <i class="ph-duotone ph-chart-pie"></i>
                    </li>
                @endif
                @can('monitoring')
                    <li class="pc-item {{ request()->routeIs('monitoring.index') ? 'active' : '' }}">
                        <a href="{{ route('monitoring.index') }}" class="pc-link">
                            <span class="pc-micon">
                                <i class="ph-duotone ph-projector-screen-chart"></i>
                            </span>
                            <span class="pc-mtext">Monitoring</span>
                        </a>
                    </li>
                @endcan
                @can('smart_claim')
                    <li class="pc-item {{ request()->routeIs('klaim.index') || request()->routeIs('klaim.show') ? 'active' : '' }}">
                        <a href="{{ route('klaim.index') }}" class="pc-link">
                            <span class="pc-micon">
                                <i class="ph-duotone ph-file-lock"></i>
                            </span>
                            <span class="pc-mtext">Smart Claim</span>
                        </a>
                    </li>
                @endcan --}}
                {{-- <li class="pc-item pc-hasmenu">
                    <a href="javascript:void(0);" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-file-lock"></i>
                        </span>
                        <span class="pc-mtext">Smart Klaim</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                        <span class="pc-badge">2</span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="javascript:void(0);">Rawat Jalan</a></li>
                        <li class="pc-item"><a class="pc-link" href="javascript:void(0);">Rawat Inap</a></li>
                        <li class="pc-item"><a class="pc-link" href="javascript:void(0);">Rawat Darurat</a></li>
                    </ul>
                </li> --}}
            {{-- </ul> --}}
            {{-- <div class="card nav-action-card bg-brand-color-4">
                <div class="card-body" style="background-image: {{ url('images/layout/nav-card-bg.svg') }}">
                    <h5 class="text-dark">Tambahan Fitur?</h5>
                    <p class="text-dark text-opacity-75">Silakan melakukan permintaan fitur melalui tombol di bawah ini.</p>
                    <a href="javascript:void(0);" class="btn btn-primary" target="_blank">Form Pengajuan</a>
                </div>
            </div> --}}
        </div>
    </div>
</nav>
<script>
    // if ($('body').attr('class') == 'layout-nested') {
    //     $('#logo_simrs').empty().append(`<a href="javascript:void(0);" class="b-brand text-primary"><img src="{{ asset('images/logo/logoname_w.png') }}" alt="logo image" class="" style="height: 24px" />
    //                             <span class="badge bg-brand-color-3 rounded-pill ms-1 theme-version">v1.0</span></a>`);
    // } else {
    //     $('#logo_simrs').empty().append(`<a href="javascript:void(0);" class="b-brand text-primary"><img src="{{ asset('images/logo/logoname.png') }}" alt="logo image" class="" style="height: 24px" />
    //                             <span class="badge bg-brand-color-3 rounded-pill ms-1 theme-version">v1.0</span></a>`);
    // }
</script>
<!-- [ Sidebar Menu ] end -->
