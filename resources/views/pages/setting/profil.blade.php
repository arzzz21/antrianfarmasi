@extends('layouts.index')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.6/dist/signature_pad.umd.min.js"></script>
<style>
    canvas {
    width: 200px;
    height: 200px;
    touch-action: none; /* penting untuk mencegah scroll saat tanda tangan */
}
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="ti ti-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Setting</a></li>
                        <li class="breadcrumb-item" aria-current="page">Profil Pengguna</li>
                    </ul>
                </div>
                <div class="col-md-12 mt-2">
                    <div class="page-header-title">
                        <h2 class="mb-0">Profil Akun <b class="text-primary">{{ Auth::user()->LOGIN }}</b></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->

    <!-- [ Main Content ] start -->
    <div class="row">
        <div class="col-sm-12">
            {{-- <div class="card bg-primary">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 me-3">
                            <h3 class="text-white">Email Verification</h3>
                            <p class="text-white text-opacity-75 text-opa mb-0">Your email is not confirmed.
                                Please check your inbox.
                                <a href="#" class="link-light"><u>Resend confirmation</u></a>
                            </p>
                        </div>
                        <div class="flex-shrink-0">
                            <img src="{{ asset('/images/application/img-accout-alert.png') }}" alt="img"
                                class="img-fluid wid-80" />
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="row">
                <div class="col-lg-5 col-xxl-3">
                    <div class="card overflow-hidden">
                        <div class="card-body position-relative">
                            <div class="text-center mt-3">
                                <div class="chat-avtar d-inline-flex mx-auto">
                                    <img class="rounded-circle img-fluid wid-90 img-thumbnail"
                                        src="{{ asset('/images/user.png') }}" alt="User image" />
                                    <i class="chat-badge bg-success me-2 mb-2"></i>
                                </div>
                                <h5 class="mb-0"> </h5>
                                <p class="text-muted text-sm">
                                    <h5>{{ Auth::user()->NAMA }}</h5>
                                    <span class="badge bg-light-primary text-uppercase">{{ auth()->user()->getRoleNames()->first() ?? 'USER' }}</span>
                                </p>
                                {{-- <ul class="list-inline mx-auto my-4">
                                    <li class="list-inline-item">
                                        <a href="#" class="avtar avtar-s text-white bg-dribbble">
                                            <i class="ti ti-brand-dribbble f-24"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" class="avtar avtar-s text-white bg-amazon">
                                            <i class="ti ti-brand-figma f-24"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" class="avtar avtar-s text-white bg-pinterest">
                                            <i class="ti ti-brand-pinterest f-24"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" class="avtar avtar-s text-white bg-behance">
                                            <i class="ti ti-brand-behance f-24"></i>
                                        </a>
                                    </li>
                                </ul> --}}
                                <div class="row g-3 mt-3">
                                    <div class="col-7">
                                        <h5 class="mb-0">{{ Auth::user()->NIK }}</h5>
                                        <small class="text-muted">NIK</small>
                                    </div>
                                    <div class="col-5 border border-top-0 border-bottom-0 border-end-0">
                                        <h5 class="mb-0">{{ Auth::user()->NIP }}</h5>
                                        <small class="text-muted">NIP</small>
                                    </div>
                                    {{-- <div class="col-4">
                                        <h5 class="mb-0">4.5K</h5>
                                        <small class="text-muted">Members</small>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="nav flex-column nav-pills list-group list-group-flush account-pills mb-0"
                            id="user-set-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link list-group-item list-group-item-action active" id="user-set-profile-tab"
                                data-bs-toggle="pill" href="#user-set-profile" role="tab"
                                aria-controls="user-set-profile" aria-selected="true">
                                <span class="f-w-500"><i class="ph-duotone ph-user-circle m-r-10"></i>Biodata Akun</span>
                            </a>
                            {{-- <a class="nav-link list-group-item list-group-item-action" id="user-set-information-tab"
                                data-bs-toggle="pill" href="#user-set-information" role="tab"
                                aria-controls="user-set-information" aria-selected="false">
                                <span class="f-w-500"><i class="ph-duotone ph-clipboard-text m-r-10"></i>Personal
                                    Information</span>
                            </a>
                            <a class="nav-link list-group-item list-group-item-action" id="user-set-account-tab"
                                data-bs-toggle="pill" href="#user-set-account" role="tab"
                                aria-controls="user-set-account" aria-selected="false">
                                <span class="f-w-500"><i class="ph-duotone ph-notebook m-r-10"></i>Account
                                    Information</span>
                            </a> --}}
                            <a class="nav-link list-group-item list-group-item-action" id="user-set-passwort-tab"
                                data-bs-toggle="pill" href="#user-set-passwort" role="tab"
                                aria-controls="user-set-passwort" aria-selected="false">
                                <span class="f-w-500"><i class="ph-duotone ph-key m-r-10"></i>Ubah Password</span>
                            </a>
                            {{-- <a class="nav-link list-group-item list-group-item-action" id="user-set-email-tab"
                                data-bs-toggle="pill" href="#user-set-email" role="tab"
                                aria-controls="user-set-email" aria-selected="false">
                                <span class="f-w-500"><i class="ph-duotone ph-envelope-open m-r-10"></i>Email
                                    settings</span>
                            </a> --}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-xxl-9">
                    <div class="tab-content" id="user-set-tabContent">
                        <div class="tab-pane fade show active" id="user-set-profile" role="tabpanel" aria-labelledby="user-set-profile-tab">
                            {{-- <div class="card">
                                <div class="card-header">
                                    <h5>About me</h5>
                                </div>
                                <div class="card-body">
                                    <p class="mb-0">Hello, I’m Anshan Handgun Creative Graphic Designer & User
                                        Experience Designer based in Website, I create digital
                                        Products a more Beautiful and usable place. Morbid accusant ipsum. Nam
                                        nec tellus at.</p>
                                </div>
                            </div> --}}
                            <div class="card">
                                <div class="card-header">
                                    <h5>Identitas Diri</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0 pt-0">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <p class="mb-1 text-muted">Username</p>
                                                    <p class="mb-0">{{ Auth::user()->LOGIN }}</p>
                                                </div>
                                                <div class="col-md-8">
                                                    <p class="mb-1 text-muted">Nama Lengkap</p>
                                                    <p class="mb-0">{{ $list['show']->NAMALENGKAP ?? $list['show']->NAMA }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <p class="mb-1 text-muted">Nomor Handphone</p>
                                                    <p class="mb-0">{{ $list['show']->NOHP }} {{ $list['show']->JENISNOHP ? '('.$list['show']->JENISNOHP.')' : '' }}</p>
                                                </div>
                                                <div class="col-md-8">
                                                    <p class="mb-1 text-muted">Tempat, Tanggal Lahir</p>
                                                    <p class="mb-0">{{ $list['show']->TEMPAT_LAHIR }}{{ $list['show']->TANGGAL_LAHIR ? ', ' . \Carbon\Carbon::parse($list['show']->TANGGAL_LAHIR)->translatedFormat('d F Y') : '' }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item px-0 pb-0">
                                            <p class="mb-1 text-muted">Alamat Lengkap</p>
                                            <p class="mb-0">{{ $list['show']->ALAMAT }}</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header p-3">
                                    <div class="d-sm-flex align-items-center justify-content-between ms-2">
                                        <h5>Tanda Tangan Pegawai</h5>
                                        <button class="btn btn-link-warning" onclick="showTTDpeg({{ Auth::user()->NIP }})"><i class="fas fa-sync"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <input type="hidden" id="idstorettd" value="">

                                    <div id="loading-ttd">
                                        <div class="spinner-grow align-middle me-2" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        Mengambil Data...
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6" id="show-petunjuk" hidden>
                                            <strong>Keterangan:</strong><br>
                                            <p>Tanda tangan ini digunakan sebagai ganti tanda tangan basah untuk dokumen pasien</p>
                                            <strong>Petunjuk:</strong><br>
                                            1. Gunakan layar sentuh atau mouse.<br>
                                            2. Gambar tanda tangan pada canvas.<br>
                                            3. Klik "<span class="badge text-bg-danger"><i class="ti ti-writing-sign"></i></span>" untuk menghapus.<br>
                                            4. Klik "<span class="badge text-bg-primary"><i class="ti ti-writing-sign me-1"></i> Simpan Tanda Tangan</span>" untuk menyimpan.<br>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3" id="preview-wrapper" hidden>
                                                <img id="preview-ttd-peg" src="" alt="Belum ada tanda tangan" style="max-width: 300px; border: 1px solid #ccc;" />
                                                <div class="mt-3">
                                                    <button type="button" id="btn-ubah-ttd" class="btn btn-warning me-2"><i class="fa fa-pen me-1"></i> Ubah TTD</button>
                                                    <a id="date-updated"></a>
                                                </div>
                                            </div>

                                            <div class="form-group" id="paduser" hidden>
                                                <!-- responsive wrapper -->

                                                <div class="position-relative overflow-hidden mb-3" style="width:100%; max-width:500px; height:200px;">
                                                    <!-- canvas ikut parent -->
                                                    <canvas id="signature-pad-user" class="border rounded w-100 h-100"></canvas>

                                                    <!-- placeholder di tengah -->
                                                    <div id="placeholder-ttd-user"
                                                        class="position-absolute top-50 start-50 translate-middle text-muted"
                                                        style="pointer-events: none; opacity: 0.3;">
                                                        Tanda tangan Pegawai <a class="text-danger">*</a>
                                                    </div>

                                                    <!-- tombol clear dalam kotak -->
                                                    <button id="clear-user"
                                                        class="btn btn-sm btn-danger position-absolute"
                                                        style="top: 10px; right: 10px; z-index: 10;">
                                                        <i class="ti ti-writing-sign"></i>
                                                    </button>
                                                </div>
                                                <button class="btn btn-primary" onclick="storeTTDpeg()" id="btn-save-ttd">
                                                    <i class="fas fa-save me-1"></i> Simpan Tanda Tangan
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0 pt-0">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <p class="mb-1 text-muted">Username</p>
                                                    <p class="mb-0">{{ Auth::user()->LOGIN }}</p>
                                                </div>
                                                <div class="col-md-8">
                                                    <p class="mb-1 text-muted">Nama Lengkap</p>
                                                    <p class="mb-0">{{ $list['show']->NAMALENGKAP }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <p class="mb-1 text-muted">Nomor Handphone</p>
                                                    <p class="mb-0">{{ $list['show']->NOHP }} {{ $list['show']->JENISNOHP ? '('.$list['show']->JENISNOHP.')' : '' }}</p>
                                                </div>
                                                <div class="col-md-8">
                                                    <p class="mb-1 text-muted">Tempat, Tanggal Lahir</p>
                                                    <p class="mb-0">{{ $list['show']->TEMPAT_LAHIR }}{{ $list['show']->TANGGAL_LAHIR ? ', ' . \Carbon\Carbon::parse($list['show']->TANGGAL_LAHIR)->translatedFormat('d F Y') : '' }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item px-0 pb-0">
                                            <p class="mb-1 text-muted">Alamat Lengkap</p>
                                            <p class="mb-0">{{ $list['show']->ALAMAT }}</p>
                                        </li>
                                    </ul> --}}
                                </div>
                            </div>
                        </div>
                        {{-- <div class="tab-pane fade" id="user-set-information" role="tabpanel"
                            aria-labelledby="user-set-information-tab">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Personal Information</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">First Name</label>
                                                <input type="text" class="form-control" value="Anshan" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Last Name</label>
                                                <input type="text" class="form-control" value="Handgun" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Country</label>
                                                <input type="text" class="form-control" value="New York" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Zip code</label>
                                                <input type="text" class="form-control" value="956754" />
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label">Bio</label>
                                                <textarea class="form-control">Hello, I’m Anshan Handgun</textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="mb-0">
                                                <label class="form-label">Experience</label>
                                                <select class="form-control">
                                                    <option>Startup</option>
                                                    <option>2 year</option>
                                                    <option>3 year</option>
                                                    <option selected>4 year</option>
                                                    <option>5 year</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5>Social Network</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="flex-grow-1 me-3">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <div class="avtar avtar-xs btn-light-twitter">
                                                        <i class="fab fa-twitter f-16"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-0">Twitter</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <button class="btn btn-link-primary">Connect</button>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="flex-grow-1 me-3">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <div class="avtar avtar-xs btn-light-facebook">
                                                        <i class="fab fa-facebook-f f-16"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-0">Facebook <small class="text-muted f-w-400">/Anshan
                                                            Handgun</small>
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <button class="btn btn-link-danger">Remove</button>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 me-3">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <div class="avtar avtar-xs btn-light-linkedin">
                                                        <i class="fab fa-linkedin-in f-16"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-0">Linkedin</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <button class="btn btn-link-primary">Connect</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5>Contact Information</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Contact Phone</label>
                                                <input type="text" class="form-control" value="(+99) 9999 999 999" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                                <input type="email" class="form-control" value="demo@sample.com" />
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label">Portfolio Url</label>
                                                <input type="text" class="form-control" value="https://demo.com/" />
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="mb-0">
                                                <label class="form-label">Address</label>
                                                <textarea class="form-control">3379  Monroe Avenue, Fort Myers, Florida(33912)</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end btn-page">
                                <div class="btn btn-outline-secondary">Cancel</div>
                                <div class="btn btn-primary">Update Profile</div>
                            </div>
                        </div> --}}
                        {{-- <div class="tab-pane fade" id="user-set-account" role="tabpanel"
                            aria-labelledby="user-set-account-tab">
                            <div class="card">
                                <div class="card-header">
                                    <h5>General Settings</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0 pt-0">
                                            <div class="row mb-0">
                                                <label class="col-form-label col-md-4 col-sm-12 text-md-end">Username
                                                    <span class="text-danger">*</span></label>
                                                <div class="col-md-8 col-sm-12">
                                                    <input type="text" class="form-control" value="Ashoka_Tano_16" />
                                                    <div class="form-text">
                                                        Your Profile URL: <a href="#"
                                                            class="link-primary">https://pc.com/Ashoka_Tano_16</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <div class="row mb-0">
                                                <label class="col-form-label col-md-4 col-sm-12 text-md-end">Account
                                                    Email <span class="text-danger">*</span></label>
                                                <div class="col-md-8 col-sm-12">
                                                    <input type="text" class="form-control" value="demo@sample.com" />
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <div class="row mb-0">
                                                <label
                                                    class="col-form-label col-md-4 col-sm-12 text-md-end">Language</label>
                                                <div class="col-md-8 col-sm-12">
                                                    <select class="form-control">
                                                        <option>Washington</option>
                                                        <option>India</option>
                                                        <option>Africa</option>
                                                        <option>New York</option>
                                                        <option>Malaysia</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item px-0 pb-0">
                                            <div class="row mb-0">
                                                <label class="col-form-label col-md-4 col-sm-12 text-md-end">Sign
                                                    in Using <span class="text-danger">*</span></label>
                                                <div class="col-md-8 col-sm-12">
                                                    <select class="form-control">
                                                        <option>Password</option>
                                                        <option>Face Recognition</option>
                                                        <option>Thumb Impression</option>
                                                        <option>Key</option>
                                                        <option>Pin</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5>Advance Settings</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0 pt-0">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div>
                                                    <p class="mb-1">Secure Browsing</p>
                                                    <p class="text-muted text-sm mb-0">Browsing Securely ( https
                                                        ) when it's necessary</p>
                                                </div>
                                                <div class="form-check form-switch p-0">
                                                    <input class="form-check-input h4 position-relative m-0"
                                                        type="checkbox" role="switch" checked="" />
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div>
                                                    <p class="mb-1">Login Notifications</p>
                                                    <p class="text-muted text-sm mb-0">Notify when login
                                                        attempted from other place</p>
                                                </div>
                                                <div class="form-check form-switch p-0">
                                                    <input class="form-check-input h4 position-relative m-0"
                                                        type="checkbox" role="switch" checked="" />
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item px-0 pb-0">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div>
                                                    <p class="mb-1">Login Approvals</p>
                                                    <p class="text-muted text-sm mb-0">Approvals is not required
                                                        when login from unrecognized devices.</p>
                                                </div>
                                                <div class="form-check form-switch p-0">
                                                    <input class="form-check-input h4 position-relative m-0"
                                                        type="checkbox" role="switch" checked="" />
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5>Recognized Devices</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0 pt-0">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="me-2">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avtar bg-light-primary">
                                                            <i class="ph-duotone ph-desktop f-24"></i>
                                                        </div>
                                                        <div class="ms-2">
                                                            <p class="mb-1">Celt Desktop</p>
                                                            <p class="mb-0 text-muted">4351 Deans Lane</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <div class="text-success d-inline-block me-2">
                                                        <i class="fas fa-circle f-10 me-2"></i>
                                                        Active
                                                    </div>
                                                    <a href="#!" class="text-danger"><i
                                                            class="feather icon-x-circle"></i></a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="me-2">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avtar bg-light-primary">
                                                            <i class="ph-duotone ph-device-tablet-camera f-24"></i>
                                                        </div>
                                                        <div class="ms-2">
                                                            <p class="mb-1">Imco Tablet</p>
                                                            <p class="mb-0 text-muted">4185 Michigan Avenue</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <div class="text-muted d-inline-block me-2">
                                                        <i class="fas fa-circle f-10 me-2"></i>
                                                        5 days
                                                    </div>
                                                    <a href="#!" class="text-danger"><i
                                                            class="feather icon-x-circle"></i></a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item px-0 pb-0">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="me-2">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avtar bg-light-primary">
                                                            <i class="ph-duotone ph-device-mobile-camera f-24"></i>
                                                        </div>
                                                        <div class="ms-2">
                                                            <p class="mb-1">Albs Mobile</p>
                                                            <p class="mb-0 text-muted">3462 Fairfax Drive</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <div class="text-muted d-inline-block me-2">
                                                        <i class="fas fa-circle f-10 me-2"></i>
                                                        1 month
                                                    </div>
                                                    <a href="#!" class="text-danger"><i
                                                            class="feather icon-x-circle"></i></a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5>Active Sessions</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0 pt-0">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="me-2">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avtar bg-light-primary">
                                                            <i class="ph-duotone ph-desktop f-24"></i>
                                                        </div>
                                                        <div class="ms-2">
                                                            <p class="mb-1">Celt Desktop</p>
                                                            <p class="mb-0 text-muted">4351 Deans Lane</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn btn-link-danger">Logout</button>
                                            </div>
                                        </li>
                                        <li class="list-group-item px-0 pb-0">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="me-2">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avtar bg-light-primary">
                                                            <i class="ph-duotone ph-device-tablet-camera f-24"></i>
                                                        </div>
                                                        <div class="ms-2">
                                                            <p class="mb-1">Moon Tablet</p>
                                                            <p class="mb-0 text-muted">4185 Michigan Avenue</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn btn-link-danger">Logout</button>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body text-end">
                                    <button class="btn btn-outline-dark me-2">Clear</button>
                                    <button class="btn btn-primary">Update Profile</button>
                                </div>
                            </div>
                        </div> --}}
                        <div class="tab-pane fade" id="user-set-passwort" role="tabpanel"
                            aria-labelledby="user-set-passwort-tab">
                            <div class="card alert alert-warning p-0">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 me-3">
                                            <h4 class="alert-heading">Perhatian!</h4>
                                            <p class="mb-2">Password Anda akan kadaluarsa setiap tahunnya. Disarankan untuk melakukan perubahan secara periodik.</p>
                                            <a href="#" class="alert-link"><u>Jangan memberikan password Anda kepada orang lain.</u></a>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset('/images/application/img-accout-password-alert.png') }}"
                                                alt="img" class="img-fluid wid-80" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header d-flex align-items-center justify-content-between py-3">
                                    <h5 class="mb-0">Ubah Password</h5>
                                    <h6 class="mb-0">{!! Auth::user()->TERAKHIR_UBAH_PASSWOD
                                        ? '<span class="badge text-bg-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Terakhir Ubah Password">'
                                            . \Carbon\Carbon::parse(Auth::user()->TERAKHIR_UBAH_PASSWOD)->translatedFormat('d F Y \P\u\k\u\l H:i') . ' WIB' . '</span>'
                                        : '' !!}
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item pt-0 px-0">
                                            <div class="row mb-0">
                                                <label class="col-form-label col-md-4 col-sm-12 text-md-end">Password Sekarang <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-md-8 col-sm-12">
                                                    <input type="password" class="form-control" id="password_lama"/>
                                                    {{-- <div class="form-text"> Lupa Password? <a href="#" class="link-primary">Klik Disini</a> </div> --}}
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <div class="row mb-0">
                                                <label class="col-form-label col-md-4 col-sm-12 text-md-end">Password Baru <span class="text-danger">*</span></label>
                                                <div class="col-md-8 col-sm-12">
                                                    <input type="password" class="form-control" id="password_baru"/>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item pb-0 px-0">
                                            <div class="row mb-0">
                                                <label class="col-form-label col-md-4 col-sm-12 text-md-end">Konfirmasi Password Baru <span class="text-danger">*</span></label>
                                                <div class="col-md-8 col-sm-12">
                                                    <input type="password" class="form-control" id="password_baru_confirm"/>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-footer text-end p-3">
                                    <button class="btn btn-link-secondary me-2" disabled>Kosongkan</button>
                                    <button class="btn btn-primary" disabled>Perbarui Password</button>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="tab-pane fade" id="user-set-email" role="tabpanel"
                            aria-labelledby="user-set-email-tab">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Email Settings</h5>
                                </div>
                                <div class="card-body">
                                    <h6 class="mb-3">Setup Email Notification</h6>
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <div>
                                            <p class="text-muted mb-0">Email Notification</p>
                                        </div>
                                        <div class="form-check form-switch p-0">
                                            <input class="m-0 form-check-input h5 position-relative" type="checkbox"
                                                role="switch" checked="" />
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-0">
                                        <div>
                                            <p class="text-muted mb-0">Send Copy To Personal Email</p>
                                        </div>
                                        <div class="form-check form-switch p-0">
                                            <input class="m-0 form-check-input h5 position-relative" type="checkbox"
                                                role="switch" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5>Activity Related Emails</h5>
                                </div>
                                <div class="card-body">
                                    <h6 class="mb-3">When to email?</h6>
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <div>
                                            <p class="text-muted mb-0">Have new notifications</p>
                                        </div>
                                        <div class="form-check form-switch p-0">
                                            <input class="m-0 form-check-input h5 position-relative" type="checkbox"
                                                role="switch" checked="" />
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <div>
                                            <p class="text-muted mb-0">You're sent a direct message</p>
                                        </div>
                                        <div class="form-check form-switch p-0">
                                            <input class="m-0 form-check-input h5 position-relative" type="checkbox"
                                                role="switch" />
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <div>
                                            <p class="text-muted mb-0">Someone adds you as a connection</p>
                                        </div>
                                        <div class="form-check form-switch p-0">
                                            <input class="m-0 form-check-input h5 position-relative" type="checkbox"
                                                role="switch" checked="" />
                                        </div>
                                    </div>
                                    <hr class="my-2 border border-secondary-subtle" />
                                    <h6 class="mb-3">When to escalate emails?</h6>
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <div>
                                            <p class="text-muted mb-0">Upon new order</p>
                                        </div>
                                        <div class="form-check form-switch p-0">
                                            <input class="m-0 form-check-input h5 position-relative" type="checkbox"
                                                role="switch" checked="" />
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <div>
                                            <p class="text-muted mb-0">New membership approval</p>
                                        </div>
                                        <div class="form-check form-switch p-0">
                                            <input class="m-0 form-check-input h5 position-relative" type="checkbox"
                                                role="switch" />
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-0">
                                        <div>
                                            <p class="text-muted mb-0">Member registration</p>
                                        </div>
                                        <div class="form-check form-switch p-0">
                                            <input class="m-0 form-check-input h5 position-relative" type="checkbox"
                                                role="switch" checked="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5>Updates from System Notification</h5>
                                </div>
                                <div class="card-body">
                                    <h6 class="mb-3">Email you with?</h6>
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <div>
                                            <p class="text-muted mb-0">News about PCT-themes products and
                                                feature updates</p>
                                        </div>
                                        <div class="form-check form-switch p-0">
                                            <input class="m-0 form-check-input h5 position-relative" type="checkbox"
                                                role="switch" checked="" />
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <div>
                                            <p class="text-muted mb-0">Tips on getting more out of PCT-themes
                                            </p>
                                        </div>
                                        <div class="form-check form-switch p-0">
                                            <input class="m-0 form-check-input h5 position-relative" type="checkbox"
                                                role="switch" checked="" />
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <div>
                                            <p class="text-muted mb-0">Things you missed since you last logged
                                                into PCT-themes</p>
                                        </div>
                                        <div class="form-check form-switch p-0">
                                            <input class="m-0 form-check-input h5 position-relative" type="checkbox"
                                                role="switch" />
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <div>
                                            <p class="text-muted mb-0">News about products and other services
                                            </p>
                                        </div>
                                        <div class="form-check form-switch p-0">
                                            <input class="m-0 form-check-input h5 position-relative" type="checkbox"
                                                role="switch" />
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-0">
                                        <div>
                                            <p class="text-muted mb-0">Tips and Document business products</p>
                                        </div>
                                        <div class="form-check form-switch p-0">
                                            <input class="m-0 form-check-input h5 position-relative" type="checkbox"
                                                role="switch" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body text-end btn-page">
                                    <div class="btn btn-outline-secondary">Cancel</div>
                                    <div class="btn btn-primary">Update Profile</div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <!-- [ sample-page ] end -->
    </div>
    <!-- [ Main Content ] end -->
    <script>
        $(document).ready(function() {
            // showLoader();
            // refresh();
            const pegawaiNIP = "{{ Auth::user()->NIP }}"; // Dikirim dari controller ke blade
            if (pegawaiNIP) {
                showTTDpeg(pegawaiNIP);
            }
        });

        let padUser = null;

        function showTTDpeg(NIP) {
            $('#paduser').prop('hidden',true);
            $('#show-petunjuk').prop('hidden',true);
            $('#preview-wrapper').prop('hidden',true);
            $('#loading-ttd').empty().append(`
                <div class="spinner-grow align-middle me-2" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                Memproses Tanda Tangan...
            `);
            $('#show-id-ttd-peg').text(NIP);
            $('#idstorettd').val(NIP);

            $.ajax({
                url: `/api/pegawai/${NIP}/ttdPeg`,
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    $('#loading-ttd').empty();
                    console.log(res);

                    if (res.dbttd && res.dbttd.signature_path) {
                        // tampilkan gambar TTD
                        $('#preview-ttd-peg').attr('src', `/storage/${res.dbttd.signature_path}`);
                        $('#paduser').prop('hidden',true);
                        $('#show-petunjuk').prop('hidden',true);
                        $('#preview-wrapper').prop('hidden',false);
                        $('#date-updated').text('Diperbarui pada ' + res.dbttd.signature_date);

                        // jika tombol "ubah" diklik, munculkan canvas
                        $('#btn-ubah-ttd').off('click').on('click', function () {
                            $('#preview-wrapper').prop('hidden',true); // sembunyikan gambar
                            $('#show-petunjuk').prop('hidden',false);
                            $('#paduser').prop('hidden',false);
                            tampilkanCanvasTTD();         // munculkan canvas
                        });

                        return; // selesai, tidak munculkan canvas langsung
                    } else {
                        $('#paduser').prop('hidden',false);
                        $('#show-petunjuk').prop('hidden',false);
                        tampilkanCanvasTTD(); // kalau belum ada TTD, langsung tampilkan canvas
                    }
                }
            });
        }

        function tampilkanCanvasTTD() {
            // $('#canvas').html(`
            //     <div class="row">
            //         <div class="col-md-5 mb-3">
            //             <canvas id="signature-pad" style="border:1px solid #ccc; width: 100%; height: 200px;"></canvas>
            //         </div>
            //         <div class="col-md-7">
            //             <strong>Petunjuk:</strong><br>
            //             1. Gunakan layar sentuh atau mouse.<br>
            //             2. Gambar tanda tangan pada canvas.<br>
            //             3. Klik "Kosongkan" untuk menghapus.<br>
            //             4. Klik "Simpan" untuk menyimpan.<br>

            //             <div class="mt-3 d-flex gap-2">
            //                 <button type="button" id="clear" class="btn btn-danger"><i class="fa fa-erase me-1"></i> Kosongkan</button>
            //                 <button type="button" class="btn btn-primary" onclick="storeTTDpeg()"><i class="fa fa-save me-1"></i> Simpan</button>
            //             </div>
            //         </div>
            //     </div>
            // `);

            if (padUser) return; // Sudah inisiasi
            const canvas = document.getElementById('signature-pad-user');
            padUser = new SignaturePad(canvas);

            resizeCanvasResponsive(canvas);

            $('#clear-user').on('click', function() {
                padUser.clear();
                $('#placeholder-ttd-user').show();
            });

            padUser.onBegin = function() {
                $('#placeholder-ttd-user').hide();
            };

            $(window).on('resize.user', function() {
                resizeCanvasResponsive(canvas);
            });
            // canvas = document.getElementById('signature-pad');
            // signaturePad = new SignaturePad(canvas);
            // resizeCanvas();

            // $('#clear').on('click', function () {
            //     signaturePad.clear();
            // });

            // $(window).off('resize').on('resize', resizeCanvas);
        }

        function resizeCanvasResponsive(canvas) {
            const ratio = Math.max(window.devicePixelRatio || 1, 1);

            // ambil lebar parent (max 500px)
            const parentWidth = canvas.parentElement.offsetWidth;
            const width = parentWidth > 500 ? 500 : parentWidth;
            const height = 200;

            // CSS size (tampilan)
            canvas.style.width = width + "px";
            canvas.style.height = height + "px";

            // buffer internal (supaya tajam & koordinat sesuai)
            canvas.width = width * ratio;
            canvas.height = height * ratio;
            canvas.getContext("2d").scale(ratio, ratio);
        }

        function storeTTDpeg() {
            const nip = document.getElementById('idstorettd').value.trim();
            const signature = padUser.toDataURL('image/png');
            $('#btn-save-ttd').prop('disabled',true);
            $('#btn-save-ttd').find('i').removeClass('fa-save').addClass('fa-sync fa-spin');

            if (!nip || padUser.isEmpty()) {
                alert("Tanda tangan wajib diisi.");
                return;
            }

            $.ajax({
                url: "{{ route('api.pegawai.storeTtdPeg') }}",
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: JSON.stringify({ nip: nip, signature: signature }),
                contentType: 'application/json',
                success: function(data) {
                    if (data.success) {
                        iziToast.success({
                            title: 'Yeayy!',
                            message: 'TTE telah berhasil disimpan.',
                            position: 'topRight'
                        });
                        // Ganti canvas dengan gambar tanda tangan
                        const nip = document.getElementById('idstorettd').value.trim();
                        showTTDpeg(nip);
                        $('#btn-save-ttd').prop('disabled',false);
                        $('#btn-save-ttd').find('i').removeClass('fa-sync fa-spin').addClass('fa-save');
                    } else {
                        alert("Gagal menyimpan data");
                        $('#btn-save-ttd').prop('disabled',false);
                        $('#btn-save-ttd').find('i').removeClass('fa-sync fa-spin').addClass('fa-save');
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Gagal Memproses Data!',
                        text: error.message || 'Dokumen telah ditandatangani.',
                    });
                    $('#btn-save-ttd').prop('disabled',false);
                    $('#btn-save-ttd').find('i').removeClass('fa-sync fa-spin').addClass('fa-save');
                }
            });
        }
    </script>
@endsection
