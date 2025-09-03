<li class="dropdown pc-h-item header-user-profile">
    <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
        role="button" aria-haspopup="false" data-bs-auto-close="outside" aria-expanded="false">
        <img src="{{ asset('/images/user.png') }}" alt="user-image" class="user-avtar" />
    </a>
    <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
        <div class="dropdown-header d-flex align-items-center justify-content-between">
            <h5 class="m-0">Setting</h5>
        </div>
        <div class="dropdown-body">
            <div class="profile-notification-scroll position-relative"
                style="max-height: calc(100vh - 225px)">
                <ul class="list-group list-group-flush w-100">
                    <li class="list-group-item">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <img src="{{ asset('/images/user.png') }}" alt="user-image"
                                    class="wid-50 rounded-circle" />
                            </div>
                            <div class="flex-grow-1 mx-3">
                                <h5 class="mb-0">Hai, @if (Auth::check()) <a class="text-primary">{{ Auth::user()->NAMA }}</a> @else User @endif</h5>
                                <a class="link-dark" href="javascript:void(0);">@if (Auth::check()) <a data-bs-toggle="tooltip" data-bs-placement="bottom" title="NIP Anda">{{ Auth::user()->NIP }}</a> | <a data-bs-toggle="tooltip" data-bs-placement="bottom" title="NIK Anda">{{ Auth::user()->NIK }}</a> @else - @endif</a>
                            </div>
                            {{-- <span class="badge bg-primary">PRO</span> --}}
                        </div>
                    </li>
                    <li class="list-group-item">
                        {{-- <a href="{{ route('profil') }}" class="dropdown-item">
                            <span class="d-flex align-items-center">
                                <i class="ph-duotone ph-user-circle"></i>
                                <span>Akun Pengguna</span>
                            </span>
                        </a> --}}
                        {{-- <a href="#" class="dropdown-item">
                            <span class="d-flex align-items-center">
                                <i class="ph-duotone ph-key"></i>
                                <span><s>Ubah Password</s></span>
                            </span>
                        </a> --}}
                        {{-- <a href="{{ route('clear.cache') }}" class="dropdown-item" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Bersihkan Sampah!">
                            <span class="d-flex align-items-center">
                                <i class="ph-duotone ph-plugs"></i>
                                <span>Clear Cache System</span>
                            </span>
                        </a> --}}
                        <a href="" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                            <span class="d-flex align-items-center">
                                <i class="ph-duotone ph-power"></i>
                                <span>Logout</span>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</li>
