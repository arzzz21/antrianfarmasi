<!-- [ Sidebar Menu ] start -->
<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="card pc-user-card">
            <div class="card-body">
                <div class="d-flex align-items-center btn btn-link-secondary" onclick="window.location='{{ route('pelayanan.pasien') }}'">
                    <div class="flex-shrink-0 me-3">
                        <i class="ph-duotone ph-caret-double-left"></i>
                        {{-- <div class="btn btn-icon btn-link-secondary avtar">
                        </div> --}}
                    </div>
                    <div class="flex-grow-1 align-items-left">
                        <small>Kembali ke Halaman</small>
                        <h6 class="mb-0">My Pasien</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar">
                <li class="pc-item pc-caption">
                    <label data-i18n="Navigation">Publik</label>
                    <i class="ph-duotone ph-gauge"></i>
                </li>
                <li class="pc-item {{ request()->routeIs('pelayanan.pasien.identitas.index') ? 'active' : '' }}">
                    <a href="{{ route('pelayanan.pasien.identitas.index',['KUNJUNGAN' => $list['KUNJUNGAN']]) }}" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-gauge"></i>
                        </span>
                        <span class="pc-mtext" data-i18n="Dashboard">Identitas</span>
                    </a>
                </li>
                <li class="pc-item pc-caption">
                    <label>ERM</label>
                    <i class="ph-duotone ph-chart-pie"></i>
                </li>
                <li class="pc-item {{ request()->routeIs('pelayanan.pasien.resume.index') ? 'active' : '' }}">
                    <a href="{{ route('pelayanan.pasien.resume.index',['KUNJUNGAN' => $list['KUNJUNGAN']]) }}" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-projector-screen-chart"></i>
                        </span>
                        <span class="pc-mtext">Resume Medis</span>
                    </a>
                </li>
                {{-- <li class="pc-item pc-caption">
                    <label>Billing</label>
                    <i class="ph-duotone ph-chart-pie"></i>
                </li>
                <li class="pc-item pc-hasmenu">
                    <a href="javascript:void(0);" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-gauge"></i>
                        </span>
                        <span class="pc-mtext">Smart Klaim</span>
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
            </ul>
        </div>
    </div>
</nav>
<!-- [ Sidebar Menu ] end -->
