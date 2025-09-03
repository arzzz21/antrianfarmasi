<div class="card table-card border shadow-none">
    <div class="card-header pb-0 pt-2">
        <ul class="nav nav-tabs profile-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#formlayanankfr" type="button"
                    role="tab" aria-controls="formlayanankfr" aria-selected="true">Form Layanan KFR</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#formjadwalpelayanan" type="button"
                    role="tab" aria-controls="formjadwalpelayanan" aria-selected="true">Jadwal Pelayanan</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#formkonsulkfr" type="button" role="tab"
                    aria-controls="formkonsulkfr" aria-selected="false">Rekomendasi Dokter</button>
            </li>
        </ul>
    </div>
    <div class="card-body p-3">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade active show" id="formlayanankfr" role="tabpanel" aria-labelledby="home-tab">
                <div id="loading-kfr"></div>
                <div id="previewformkfr" hidden></div>
                <div id="allformkfr" hidden>
                    <div id="formLamaKfr" hidden>
                        {{-- <div class="form-floating">
                            <select class="form-select" id="filterformLamaKfr"
                                aria-label="Floating label select example" disabled>
                                <option selected="">...</option>
                            </select>
                            <label for="floatingSelect">Formulir Layanan KFR Yang Tersedia</label>
                        </div> --}}
                        <select class="form-control" data-trigger id="filterformLamaKfr"></select>
                        <div class="mb-2 ms-1 mt-1">
                            <small>Urutan = <mark>NO.RM | TGL. DILAYANI | NO.SEP | NAMA DOKTER DPJP</mark></small>
                        </div>
                        <div class="mt-2 mb-3" id="loading-kfr-detail" hidden>
                            <div class="spinner-grow align-middle me-2" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            Memuat Riwayat Form KFR...
                        </div>
                        <div class="row" id="formLamaKfrPick" hidden>
                            <div class="col-md-12">
                                <hr class="mt-2 mb-2">
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="anamnesa">Anamnesa <a class="text-danger">*</a></label>
                                    <textarea class="form-control" id="anamnesa_pick" style="height: 100px" disabled></textarea>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="fisik">Pemeriksaan Fisik dan Uji Fungsi <a class="text-danger">*</a></label>
                                    <textarea class="form-control" id="fisik_pick" style="height: 100px" disabled></textarea>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="penunjang">Pemeriksaan Penunjang <a class="text-danger">*</a></label>
                                    <textarea class="form-control" id="penunjang_pick" style="height: 100px" disabled></textarea>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="tatalaksana">Tata Laksana KFR (ICD 9 CM) <a class="text-danger">*</a></label>
                                    <textarea class="form-control" id="tatalaksana_pick" style="height: 100px" disabled></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr class="mt-0">
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="anjuran">Anjuran <a class="text-danger">*</a></label>
                                    <input type="text" class="form-control" id="anjuran_pick" placeholder="" disabled>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="evaluasi">Evaluasi <a class="text-danger">*</a></label>
                                    <input type="text" class="form-control" id="evaluasi_pick" placeholder="" disabled>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="target">Target <a class="text-danger">*</a></label>
                                    <input type="text" class="form-control" id="target_pick" placeholder="" disabled>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="suspekya">Suspek Penyakit Akibat Kerja <a class="text-danger">*</a></label>
                                    <input type="text" class="form-control" id="suspekya_pick" placeholder="" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <button class="btn btn-secondary" onclick="showformBaruKfr()">
                                <i class="fas fa-file-signature me-2"></i> Buat Formulir Baru
                            </button>
                            <div>
                                <button class="btn btn-success" id="btn-detail-formkfr-lama" hidden>
                                    <i class="fab fa-wpforms me-2"></i> Lihat Kunjungan Terpilih
                                </button>
                                <button class="btn btn-primary" onclick="simpanFormulirKfrLama()" id="btn-penetapan-formkfr">
                                    <i class="fas fa-lock me-2"></i> Tetapkan Formulir Terpilih
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="formBaruKfr" hidden>
                        <div class="col-md-12 d-flex justify-content-between align-items-center mb-2">
                            <h5 class="mb-0">Formulir Ini Diisi Oleh Dokter Sp.KFR</h5>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <div class="form-floating mb-0">
                                    <input type="text" class="form-control" id="diagmedis_add" placeholder="">
                                    <label for="diagmedis_add">Diagnosis Medis (ICD-10) <a class="text-danger">*</a></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <div class="form-floating mb-0">
                                    <input type="text" class="form-control" id="diagfungsi_add" placeholder="">
                                    <label for="diagfungsi_add">Diagnosis Fungsi (ICD-10) <a
                                            class="text-danger">*</a></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <hr class="mt-0">
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <div class="form-floating">
                                    <textarea class="form-control" id="anamnesa_add" style="height: 100px"></textarea>
                                    <label for="anamnesa_add">Anamnesa <a class="text-danger">*</a></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <div class="form-floating">
                                    <textarea class="form-control" id="fisik_add" style="height: 100px"></textarea>
                                    <label for="fisik_add">Pemeriksaan Fisik dan Uji Fungsi <a
                                            class="text-danger">*</a></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <div class="form-floating">
                                    <textarea class="form-control" id="penunjang_add" style="height: 100px"></textarea>
                                    <label for="penunjang_add">Pemeriksaan Penunjang <a class="text-danger">*</a></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <div class="form-floating">
                                    <textarea class="form-control" id="tatalaksana_add" style="height: 100px"></textarea>
                                    <label for="tatalaksana_add">Tata Laksana KFR (ICD 9 CM) <a
                                            class="text-danger">*</a></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <hr class="mt-0">
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <div class="form-floating mb-0">
                                    <input type="text" class="form-control" id="anjuran_add" placeholder="">
                                    <label for="anjuran_add">Anjuran <a class="text-danger">*</a></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <div class="form-floating mb-0">
                                    <input type="text" class="form-control" id="evaluasi_add" placeholder="">
                                    <label for="evaluasi_add">Evaluasi <a class="text-danger">*</a></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group mb-3">
                                <div class="form-floating mb-0">
                                    <input type="text" class="form-control" id="target_add" placeholder="">
                                    <label for="target_add">Target <a class="text-danger">*</a></label>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-2">Suspek Penyakit Akibat Kerja <a
                                        class="text-danger">*</a></label>
                                <div class="row">
                                    <div class="col-md-1">
                                        <div class="form-check mt-3 mb-3">
                                            <input class="form-check-input" type="radio" name="suspek"
                                                value="1" id="suspek1">
                                            <label class="form-check-label" for="flexCheckDefault"> Ya </label>
                                        </div>
                                    </div>
                                    <div class="col-md-11" id="showsuspekya" hidden>
                                        <div class="form-floating mb-0">
                                            <input type="text" class="form-control" id="suspekya"
                                                placeholder="">
                                            <label for="suspekya">Penjelasan <a class="text-danger">*</a></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="radio" name="suspek" value="0"
                                        id="suspek0" checked>
                                    <label class="form-check-label" for="flexCheckDefault"> Tidak </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group" id="padkfr">
                                <div class="position-relative overflow-hidden" style="width:100%; max-width:500px; height:200px;">
                                    <canvas id="signature-pad-kfr" class="w-100 h-100 border rounded"></canvas>
                                    <div id="placeholder-ttd-kfr"
                                        class="position-absolute top-50 start-50 translate-middle text-muted"
                                        style="pointer-events: none; opacity: 0.3;">
                                        Tanda tangan KFR
                                    </div>
                                    <button id="clear-kfr"
                                        class="btn btn-sm btn-danger position-absolute align-middle"
                                        style="top: 10px; right: 10px; z-index: 10;">
                                        <i class="ti ti-writing-sign"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row align-items-center justify-content-between g-3">
                                <div class="col-sm-auto">
                                    <button class="btn btn-warning me-2" onclick="kosongiKfr()">
                                        <i  class="fas fa-edit me-1"></i> Kosongkan Formulir
                                    </button>
                                    <button class="btn btn-secondary" onclick="showformLamaKfr()" id="btn-form-lama">
                                        <i class="fab fa-wpforms me-1"></i> Lihat Formulir Yang Ada
                                    </button>
                                </div>
                                <div class="col-sm-auto btn-page">
                                    <button class="btn btn-primary" onclick="simpanFormulirKfrBaru()">
                                        <i class="fas fa-save me-1"></i> Simpan Formulir Baru
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="formjadwalpelayanan" role="tabpanel" aria-labelledby="profile-tab">
                <div id="loading-jp"></div>
                <div id="hideFormJp" class="text-center mt-2" hidden>
                    <h5>Formulir <b class="text-primary">Jadwal Program Layanan KFR</b> tidak ditemukan pada kunjungan ini. Silakan melakukan Pengisian pada Menu Form Layanan KFR terlebih dahulu.</h5>
                </div>
                <div id="showFormJp" hidden>
                    <h5 class="text-start">Form <b class="text-primary">Program Pelayanan</b></h5>
                    <input type="text" class="form-control" id="groupid" hidden>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <div class="form-floating mb-0">
                                    <textarea class="form-control" id="diagmedis_jp" style="height: 50px" placeholder="Terisi Otomatis" readonly>Terisi Otomatis oleh Sistem</textarea>
                                    <label for="diagmedis">Diagnosis Medis (ICD-10) <a class="text-danger">*</a></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <div class="form-floating">
                                    <textarea class="form-control" id="tatalaksana_jp" style="height: 50px" placeholder="Terisi Otomatis" readonly>Terisi Otomatis oleh Sistem</textarea>
                                    <label for="tatalaksana">Permintaan Terapi <a class="text-danger">*</a></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="mt-0">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label class="form-label">Tanggal Pelayanan <a class="text-danger">*</a></label>
                                        <div class="input-group">
                                            <input type="text" id="filter_tgl_jp" class="form-control flatpickr-input-jp" placeholder="Pilih Tanggal">
                                            <span class="input-group-text"><i class="feather icon-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <div class="form-floating">
                                            <textarea class="form-control" id="program_jp" style="height: 100px" placeholder=""></textarea>
                                            <label for="tatalaksana">Program Pelayanan <a class="text-danger">*</a></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row justify-center items-center text-center">
                                <div class="col-6 mb-3 justify-center items-center text-center">
                                    <div class="form-group" id="padjpp">
                                        <!-- responsive wrapper -->
                                        <div class="position-relative overflow-hidden" style="width:100%; max-width:500px; height:200px;">

                                            <!-- canvas ikut parent -->
                                            <canvas id="signature-pad-jpp" class="border rounded w-100 h-100"></canvas>

                                            <!-- placeholder di tengah -->
                                            <div id="placeholder-ttd-jpp"
                                                class="position-absolute top-50 start-50 translate-middle text-muted"
                                                style="pointer-events: none; opacity: 0.3;">
                                                Tanda tangan Pasien <a class="text-danger">*</a>
                                            </div>

                                            <!-- tombol clear dalam kotak -->
                                            <button id="clear-jpp"
                                                class="btn btn-sm btn-danger position-absolute"
                                                style="top: 10px; right: 10px; z-index: 10;">
                                                <i class="ti ti-writing-sign"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 mb-3 justify-center items-center text-center">
                                    <div class="form-group" id="padjpt">
                                        <!-- responsive wrapper -->
                                        <div class="position-relative overflow-hidden" style="width:100%; max-width:500px; height:200px;">

                                            <!-- canvas ikut parent -->
                                            <canvas id="signature-pad-jpt" class="border rounded w-100 h-100"></canvas>

                                            <!-- placeholder di tengah -->
                                            <div id="placeholder-ttd-jpt"
                                                class="position-absolute top-50 start-50 translate-middle text-muted"
                                                style="pointer-events: none; opacity: 0.3;">
                                                Tanda tangan Terapis <a class="text-danger">*</a>
                                            </div>

                                            <!-- tombol clear pojok kanan atas -->
                                            <button id="clear-jpt"
                                                class="btn btn-sm btn-danger position-absolute"
                                                style="top: 10px; right: 10px; z-index: 10;">
                                                <i class="ti ti-writing-sign"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row align-items-center justify-content-between g-3">
                                <div class="col-sm-auto btn-page">
                                    <button class="btn btn-warning me-2" onclick="kosongiJp()">
                                        <i class="fas fa-edit me-1"></i> Kosongkan Form
                                    </button>
                                    <button class="btn btn-light-secondary" onclick="refreshRiwayatJp()" id="btn-refresh-riwayatjp" hidden>
                                        <i class="fas fa-sync me-1"></i> Refresh Riwayat
                                    </button>
                                </div>
                                <div class="col-sm-auto btn-page">
                                    <button class="btn btn-success me-2" id="btn-preview-form-jp" hidden>
                                        <i class="fas fa-file-contract me-1"></i> Preview Form
                                    </button>
                                    <button class="btn btn-primary" onclick="simpanFormulirJp()">
                                        <i class="fas fa-save me-1"></i> Simpan Form Program
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive mt-3" id="show_table_jp" hidden>
                    <hr class="mt-0">
                    <h5 class="text-center">Riwayat <b class="text-primary">Program Pelayanan</b></h5>
                    <table class="table mb-0 table-hover table-display" id="vantable_jp">
                        <thead>
                            <tr>
                                <th style="width: 5%;">AKSI</th>
                                <th style="width: 5%;">NO</th>
                                <th style="width: 15%;">KUNJUNGAN PASIEN</th>
                                <th style="width: 55%;">PROGRAM PELAYANAN</th>
                                <th style="width: 10%;" class="text-center">TANGGALPELAYANAN</th>
                                <th style="width: 10%;" class="text-end">DITAMBAHKAN OLEH</th>
                            </tr>
                        </thead>
                        <tbody id="tampil-tbody-jp">
                            <tr style='font-size:13px'>
                                <td colspan="5">
                                    <center>
                                        <div class="spinner-border spinner-border-sm" role="status"></div>
                                    </center>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="formkonsulkfr" role="tabpanel" aria-labelledby="profile-tab">
                <div id="loading-ks"></div>
                <div id="hideFormKs" class="text-center mt-2" hidden>
                    <h5>Formulir <b class="text-primary">Rekomendasi Dokter</b> tidak ditemukan pada kunjungan ini. Silakan melakukan Pengisian pada Menu Form Layanan KFR terlebih dahulu.</h5>
                </div>
                <div id="showFormKsUtama" class="text-center mt-2" hidden></div>
                <div id="showFormKs" hidden>
                    <input type="text" class="form-control" id="groupidks" hidden>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label">Diagnosa Medis (<b class="text-danger">Terisi Otomatis oleh Sistem</b>)</label>
                                <input type="text" class="form-control" id="diagmedis_ks" placeholder="Terisi Otomatis oleh Sistem" readonly>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label">Diagnosa Fungsi (<b class="text-danger">Terisi Otomatis oleh Sistem</b>)</label>
                                <input type="text" class="form-control" id="diagfungsi_ks" placeholder="Terisi Otomatis oleh Sistem" readonly>
                            </div>
                        </div>
                        <hr class="m-2 mb-3">
                        <h6>Tindak lanjut yang dianjurkan : (<b class="text-success">Diisi oleh DPJP</b>)</h6>
                        <div class="col-md-6 mb-3">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label class="form-label">Kontrol kembali ke Rumah Sakit pada <a class="text-danger">*</a></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="feather icon-calendar me-2"></i> Tanggal</span>
                                            <input type="text" id="filter_tgl_ks" class="form-control flatpickr-input-ks" placeholder="Pilih Tanggal">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-floating">
                                            <textarea class="form-control" id="alasan_ks" style="height: 100px" placeholder=""></textarea>
                                            <label for="alasan_ks">Alasan :</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label">Konsultasi selesai / Rujuk Balik</label>
                                <div class="form-floating">
                                    <textarea class="form-control" id="terapi_ks" style="height: 165px" placeholder=""></textarea>
                                    <label for="terapi_ks">Terapi Rujuk Balik :</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row align-items-center justify-content-between g-3">
                                <div class="col-sm-auto btn-page">
                                    <button class="btn btn-warning me-2" id="btn-kosongi-ks" onclick="kosongiKs()" disabled>
                                        <i class="fas fa-edit me-1"></i> Kosongkan Form
                                    </button>
                                </div>
                                <div class="col-sm-auto btn-page">
                                    <button class="btn btn-success me-2" id="btn-preview-form-ks" hidden>
                                        <i class="fas fa-file-contract me-1"></i> Preview Form
                                    </button>
                                    <button class="btn btn-primary" id="btn-simpan-ks" onclick="simpanFormulirKs()">
                                        <i class="fas fa-save me-1"></i> Simpan Form Rekomendasi
                                    </button>
                                    <button class="btn btn-danger" id="btn-hapus-ks" onclick="hapusFormulirKs()" hidden>
                                        <i class="fas fa-trash me-1"></i> Hapus Form Rekomendasi
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="previewKs" hidden></div>
            </div>
        </div>
    </div>
</div>

<div class="modal animate__animated animate__rubberBand fade" id="modalPreviewJp" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Preview Jadwal Program Pelayanan (<kbd id="showTxModalPJP"></kbd>)
                </h4>
            </div>
            <div class="modal-body">
                <div id="previewFormJadwalPelayanan"></div>
            </div>
            <div class="col-12 text-center p-4 pt-0" id="btn-footer-preview-jp">
                <button type="reset" class="btn btn-light-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal animate__animated animate__rubberBand fade" id="modalPreviewKs" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Preview Form Rekomendasi Dokter <kbd class="ms-1" id="showTxModalKs"><i class="fas fa-sync fa-spin"></i></kbd>
                </h4>
            </div>
            <div class="modal-body">
                <div id="previewFormKs"></div>
            </div>
            <div class="col-12 text-center p-4 pt-0" id="btn-footer-preview-ks">
                <button type="reset" class="btn btn-light-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal animate__animated animate__rubberBand fade" id="modalHapusJp" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Form Hapus Program Pelayanan
                </h4>
            </div>
            <div class="modal-body">
                <input type="text" id="id_hapus_jp" hidden>
                <p style="text-align: justify;">Anda akan melakukan penghapusan Program Pelayanan tersebut, lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan penghapusan.</p>
                <label class="switch">
                    <input type="checkbox" class="switch-input" id="setujuhapusjp">
                    <span class="switch-toggle-slider">
                    <span class="switch-on"></span>
                    <span class="switch-off"></span>
                    </span>
                    <span class="switch-label">Anda siap menerima Risiko</span>
                </label>
            </div>
            <div class="col-12 text-center mb-4">
                <button type="submit" class="btn btn-danger me-sm-3 me-1" onclick="prosesHapusJp()"><i class="fa fa-trash me-1" style="font-size:13px"></i> Hapus</button>
                <button type="reset" class="btn btn-light-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Batal</button>
            </div>
        </div>
    </div>
</div>

<div class="modal animate__animated animate__rubberBand fade" id="modalHapusKfr" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Form Hapus Layanan KFR <kbd>NOKUNJ#{{ $list['KUNJUNGAN'] }}</kbd>
                </h4>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" id="group_hapus_form_kfr" hidden>
                <p style="text-align: justify;">Anda akan melakukan penghapusan Form Layanan KFR tersebut, lakukanlah dengan hati-hati.
                    <br>Tersedia 2 pilihan tombol hapus, guna penghapusan <b>berdasarkan Kunjungan</b>
                    dan <b>berdasarkan Group Kunjungan (Penghapusan Serentak)</b>.
                </p>
                <h6>Keterangan Penghapusan :</h6>
                <ul>
                    <li>Hapus <b>by Group</b> adalah penghapusan untuk semua form layanan KFR, jadwal program layanan, dan rekomendasi dokter yang terikat dengan kunjungan ini (dari kunjungan pertama sampai selesai)</li>
                    <li>Hapus <b>by Kunjungan</b> adalah penghapusan hanya khusus untuk form layanan KFR, jadwal program layanan, dan rekomendasi dokter di kunjungan pasien ini saja (tidak berlaku untuk penghapusan form pada kunjungan lainnya)</li>
                </ul>
                <p>Ceklis dibawah untuk melanjutkan penghapusan atau klik tombol Batal untuk membatalkan proses penghapusan</p>
                <label class="switch">
                    <input type="checkbox" class="switch-input" id="setujuhapuskfr">
                    <span class="switch-toggle-slider">
                    <span class="switch-on"></span>
                    <span class="switch-off"></span>
                    </span>
                    <span class="switch-label">Anda siap menerima Risiko</span>
                </label>
            </div>
            <div class="col-12 text-center mb-4">
                <button type="submit" class="btn btn-light-danger me-sm-3 me-1" onclick="prosesHapusKfrAll()"><i class="fas fa-trash-alt me-1" style="font-size:13px"></i> Hapus (Group/Serentak)</button>
                <button type="submit" class="btn btn-danger me-sm-3 me-1" onclick="prosesHapusKfr()"><i class="fa fa-trash me-1" style="font-size:13px"></i> Hapus (Kunjungan)</button>
                <button type="reset" class="btn btn-light-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Batal</button>
            </div>
        </div>
    </div>
</div>

<div class="modal animate__animated animate__rubberBand fade" id="modalHapusKs" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Form Hapus Rekomendasi Dokter
                </h4>
            </div>
            <div class="modal-body">
                <input type="text" id="id_hapus_ks" hidden>
                <p style="text-align: justify;">Anda akan melakukan penghapusan Form Rekomendasi Dokter tersebut, lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan penghapusan.</p>
                <label class="switch">
                    <input type="checkbox" class="switch-input" id="setujuhapusks">
                    <span class="switch-toggle-slider">
                    <span class="switch-on"></span>
                    <span class="switch-off"></span>
                    </span>
                    <span class="switch-label">Anda siap menerima Risiko</span>
                </label>
            </div>
            <div class="col-12 text-center mb-4">
                <button type="submit" class="btn btn-danger me-sm-3 me-1" onclick="prosesHapusKs()"><i class="fa fa-trash me-1" style="font-size:13px"></i> Hapus</button>
                <button type="reset" class="btn btn-light-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Batal</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Variabel Global
    let padKfr = null,
        padJpP = null,
        padJpT = null,
        filterTglJp = null,
        filterTglKs = null,
        choices = null;

    $(document).ready(function() {
        // aktifkan saat pertama kali load
        aktifkanTabsDariHash();

        // SELECT FUNCTION FILTER FORM LAMA KFR
        var selectFormKFRLama = document.getElementById('filterformLamaKfr');
        choices = new Choices(selectFormKFRLama, {
            searchEnabled: true,      // aktifkan search
            itemSelectText: 'contoh',       // teks saat hover (bisa kosong)
            removeItemButton: true,    // tombol x untuk hapus pilihan
            placeholderValue: 'Pilih Kunjungan Pasien', // teks placeholder
            searchPlaceholderValue: 'Ketik untuk mencari kunjungan...' // opsional
        });

        // contoh ambil value saat berubah
        $('#filterformLamaKfr').on('change', function() {
            console.log("Kamu pilih: " + $(this).val());
        });

        // contoh set value via jQuery
        // $('#setValueBtn').on('click', function() {
        //     choices.setChoiceByValue('Paris'); // otomatis select Paris
        // });

        const today = new Date(); // Hari ini
        const fiveYearsAgo = new Date();
        fiveYearsAgo.setFullYear(today.getFullYear() - 5); // 5 tahun ke belakang
        filterTglJp = $(".flatpickr-input-jp").flatpickr(
            {
                // enableTime: true,
                // dateFormat: "Y-m-d H:i",
                minDate: fiveYearsAgo, // Mulai dari 5 tahun yang lalu
                maxDate: today,        // Sampai hari ini
                dateFormat: 'Y-m-d',
                defaultDate: today
            }
        );
        filterTglKs = $(".flatpickr-input-ks").flatpickr(
            {
                // enableTime: true,
                // dateFormat: "Y-m-d H:i",
                minDate: fiveYearsAgo, // Mulai dari 5 tahun yang lalu
                maxDate: today,        // Sampai hari ini
                dateFormat: 'Y-m-d',
                // defaultDate: today
            }
        );

        $('input[type=radio][name=suspek]').change(function() {
            var selectedValue = $(this).val();
            $('#suspekya').val('');
            if (selectedValue == 1) {
                $('#showsuspekya').prop('hidden', false);
            } else {
                $('#showsuspekya').prop('hidden', true);
            }
        });

        $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
            const target = $(e.target).data('bsTarget');

            if (target === '#frehab' || target === '#formlayanankfr') {
                validPageFormKfr();
                console.log('jalan kfr');
            } else if (target === '#formjadwalpelayanan') {
                validPageFormJp();
                console.log('jalan jp');
            } else if (target === '#formkonsulkfr') {
                validPageFormKs();
                console.log('jalan ks');
            }
        });
    });

    function aktifkanTabsDariHash() {
        const hash = window.location.hash; // contoh: #frehab#formlayanankfr
        if (!hash) return;

        // pecah jadi array ['frehab', 'formlayanankfr']
        const ids = hash.split('#').filter(Boolean);

        ids.forEach((id, index) => {
            const selector = '#' + id;
            const $tabBtn = $('[data-bs-target="' + selector + '"]');

            if ($tabBtn.length) {
                const tab = new bootstrap.Tab($tabBtn[0]);
                tab.show();

                // jalankan validasi sesuai target
                if (selector === '#frehab' || selector === '#formlayanankfr') {
                    validPageFormKfr();
                    console.log('jalan kfr');
                } else if (selector === '#formjadwalpelayanan') {
                    validPageFormJp();
                    console.log('jalan jp');
                } else if (selector === '#formkonsulkfr') {
                    validPageFormKs();
                    console.log('jalan ks');
                }
            }
        });
    }

    function resizeCanvasPixelRatio(canvas, width = 500, height = 200) {
        const ratio = Math.max(window.devicePixelRatio || 1, 1);

        // ukuran tampilan (CSS)
        canvas.style.width = width + "px";
        canvas.style.height = height + "px";

        // ukuran internal buffer (pixel real)
        canvas.width = width * ratio;
        canvas.height = height * ratio;

        // scale context biar koordinat sinkron
        canvas.getContext("2d").scale(ratio, ratio);
    }

    function initPadKfr() {
        if (padKfr) return; // Sudah inisiasi
        const canvas = document.getElementById('signature-pad-kfr');
        padKfr = new SignaturePad(canvas);

        resizeCanvasResponsive(canvas);

        $('#clear-kfr').on('click', function() {
            padKfr.clear();
            $('#placeholder-ttd-kfr').show();
        });

        padKfr.onBegin = function() {
            $('#placeholder-ttd-kfr').hide();
        };

        $(window).on('resize.kfr', function() {
            resizeCanvasResponsive(canvas);
        });
    }

    function initPadJp() {
        if (!padJpP) {
            const canvasP = document.getElementById('signature-pad-jpp');
            padJpP = new SignaturePad(canvasP);

            // panggil pertama kali
            resizeCanvasResponsive(canvasP);

            // tombol clear
            $('#clear-jpp').on('click', function() {
                padJpP.clear();
                $('#placeholder-ttd-jpp').show();
            });

            // sembunyikan placeholder saat menulis
            padJpP.onBegin = function() {
                $('#placeholder-ttd-jpp').hide();
            };

            // resize kalau layar berubah
            $(window).on('resize.jpp', function() {
                resizeCanvasResponsive(canvasP);
            });
        }

        if (!padJpT) {
            const canvasT = document.getElementById('signature-pad-jpt');
            padJpT = new SignaturePad(canvasT);

            // pertama kali set
            resizeCanvasResponsive(canvasT);

            // tombol clear
            $('#clear-jpt').on('click', function() {
                padJpT.clear();
                $('#placeholder-ttd-jpt').show();
            });

            // sembunyikan placeholder ketika mulai menulis
            padJpT.onBegin = function() {
                $('#placeholder-ttd-jpt').hide();
            };

            // resize kalau layar berubah
            $(window).on('resize.jpt', function() {
                resizeCanvasResponsive(canvasT);
            });
        }
    }

    function resizeCanvas(canvas) {
        const ratio = Math.max(window.devicePixelRatio || 1, 1);
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = canvas.offsetHeight * ratio;
        canvas.getContext('2d').scale(ratio, ratio);
    }

    // FORMULIR LAYANAN KFR
    function showformBaruKfr() {
        $('#formLamaKfr').prop('hidden', true);
        $('#formBaruKfr').prop('hidden', false);
        kosongiKfr();
    }

    function showformLamaKfr() {
        $('#formLamaKfr').prop('hidden', false);
        $('#formBaruKfr').prop('hidden', true);
        kosongiKfr();
    }

    function validPageFormKfr() {
        $('#loading-kfr').empty().append(`
            <div class="spinner-grow align-middle me-2" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            Memuat Formulir...
        `);
        $('#previewformkfr').prop('hidden', true);
        $('#allformkfr').prop('hidden', true);
        $.ajax({
            url: `/api/emr/{{ $list['show']->NORM }}/fkfr/{{ $list['KUNJUNGAN'] }}`,
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                $('#formLamaKfrPick').prop('hidden', true);
                $('#loading-kfr').empty();
                console.log(res.form);
                console.log(res.show);
                if (res.form) {
                    showPreviewFormKfr(res.form.group,res.formutama.nomor);
                    $('#previewformkfr').prop('hidden', false);
                    $('#allformkfr').prop('hidden', true);
                } else {
                    $('#previewformkfr').prop('hidden', true);
                    $('#allformkfr').prop('hidden', false);
                    if (res.show.length != 0) {
                        $('#filterformLamaKfr').prop('disabled', false);
                        $("#filterformLamaKfr").empty();

                        // Kelompokkan berdasarkan nama_dokter
                        let grouped = {};
                        res.show.forEach(item => {
                            if (!grouped[item.nama_dokter]) {
                                grouped[item.nama_dokter] = [];
                            }
                            grouped[item.nama_dokter].push(item);
                        });

                        // Convert ke format Choices
                        let dataChoices = Object.keys(grouped).map(dokter => ({
                            label: `Nama Dokter DPJP : ${dokter}`,
                            id: dokter,
                            choices: grouped[dokter].map(item => {
                                let label = `RM. ${item.rm} | TGL. ${item.tgl} | SEP. ${item.nosep}`;
                                return { value: item.group, label: label }; // pakai item.group sebagai ID
                            })
                        }));

                        // 🔥 Reset dan isi ulang tanpa new Choices lagi
                        console.log(choices);
                        choices.clearStore();
                        choices.clearChoices();
                        choices.removeActiveItems();
                        choices.setChoices(dataChoices, 'value', 'label', false);

                        $('#btn-form-lama').prop('hidden',false);
                        showformLamaKfr();
                    } else {
                        // $('#filterformLamaKfr').prop('disabled', true);
                        // $("#filterformLamaKfr").find('option').remove();
                        // $("#filterformLamaKfr").append(`
                        // <option value="" selected>Tidak Ditemukan</option>
                        // `);
                        choices.clearStore();
                        choices.clearChoices();
                        choices.removeActiveItems();
                        choices.setChoices([{ value: '', label: 'Tidak Ditemukan', disabled: true }], 'value', 'label', true);
                        $('#btn-form-lama').prop('hidden',true);
                        showformBaruKfr();
                    }
                }

                $('#filterformLamaKfr').change(function() {
                    $('#formLamaKfrPick').prop('hidden', true);
                    $('#loading-kfr-detail').prop('hidden',false);
                    $.ajax({
                        url: `/api/emr/fkfr/${$(this).val()}`,
                        type: 'GET',
                        dataType: 'json',
                        success: function(res) {
                            console.log(res);
                            $('#loading-kfr-detail').prop('hidden',true);
                            $('#formLamaKfrPick').prop('hidden', false);
                            // show value
                            $('#diagmedis_pick').val(res.diagnosa_medis);
                            $('#diagfungsi_pick').val(res.diagnosa_fungsi);
                            $('#anamnesa_pick').val(res.anamnesa);
                            $('#fisik_pick').val(res.pemeriksaan_fisik);
                            $('#penunjang_pick').val(res.pemeriksaan_penunjang);
                            $('#tatalaksana_pick').val(res.tata_laksana_kfr);
                            $('#anjuran_pick').val(res.anjuran);
                            $('#evaluasi_pick').val(res.evaluasi);
                            $('#target_pick').val(res.target);
                            if (res.spak_index == 1) {
                                $('#suspekya_pick').val(res.spak);
                            } else {
                                $('#suspekya_pick').val('-');
                            }
                            $('#btn-detail-formkfr-lama').prop('hidden',false);
                            $('#btn-detail-formkfr-lama').attr('onclick', `window.location.href='/emr/${res.nomor}#frehab#formkonsulkfr'`);
                        },
                        error: function(xhr, status, error) {
                            console.error('Terjadi kesalahan:', error);
                            $('#loading-kfr-detail').prop('hidden',true);
                            $('#formLamaKfrPick').prop('hidden', true);
                        }
                    })
                })
                // JALANKAN FUNCTION TTE
                initPadKfr();
                // showTTEKFR();

            },
            error: function(xhr, status, error) {
                console.error('Terjadi kesalahan:', error);
            }
        })
    }

    function showPreviewFormKfr(GROUP,NOMOR) {
        $('#previewformkfr').empty().append(`
            <div class="spinner-grow align-middle me-2" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            Memuat Data...
        `);

        fetch("/api/emr/fkfr/{{ $list['KUNJUNGAN'] }}/preview/" + GROUP)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Formulir tidak ditemukan atau gagal diambil.');
                }
                return response.blob();
            })
            .then(blob => {
                // Buat object URL dari blob
                const fileURL = URL.createObjectURL(blob);

                // Tampilkan ke iframe dalam modal
                $('#previewformkfr').prop('hidden', false);
                $('#previewformkfr').empty().html(
                    `<iframe src="${fileURL}" width="100%" height="500px" frameborder="0" class="rounded"></iframe>`
                );
                if (NOMOR != "{{ $list['KUNJUNGAN'] }}") {
                    pushBtn = `<button class="btn btn-success" onclick="window.location.href='/emr/${NOMOR}#frehab#formlayanankfr'">
                                    <i class="fab fa-wpforms me-1"></i> Lihat Kunjungan terpilih
                                </button>`;
                } else {
                    pushBtn = ``;
                }
                $('#previewformkfr').append(`
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <button class="btn btn-warning" onclick="showPreviewFormKfr(${GROUP})">
                            <i class="fas fa-sync me-1"></i> Muat Ulang Laporan
                        </button>
                        <div>
                            ${pushBtn}
                            <button class="btn btn-danger" onclick="hapusFormKfr(${GROUP})">
                                <i class="fas fa-trash me-1"></i> Hapus Formulir
                            </button>
                        </div>
                    </div>
                `);
            })
            .catch(error => {
                iziToast.error({
                    title: 'Maaf!',
                    message: 'Data Formulir tidak ditemukan atau gagal diproses.',
                    position: 'topRight'
                });
                console.error(error);
            });
    }

    function simpanFormulirKfrBaru() {
        const save = new FormData();

        save.append('nomor', "{{ $list['KUNJUNGAN'] }}");
        save.append('rm', "{{ $list['show']->NORM }}");
        save.append('diagmedis', $('#diagmedis_add').val().trim());
        save.append('diagfungsi', $('#diagfungsi_add').val().trim());
        save.append('anamnesa', $('#anamnesa_add').val().trim());
        save.append('fisik', $('#fisik_add').val().trim());
        save.append('penunjang', $('#penunjang_add').val().trim());
        save.append('tatalaksana', $('#tatalaksana_add').val().trim());
        save.append('anjuran', $('#anjuran_add').val().trim());
        save.append('evaluasi', $('#evaluasi_add').val().trim());
        save.append('target', $('#target_add').val().trim());
        save.append('suspek', $('input[name="suspek"]:checked').val());

        if ($('input[name="suspek"]:checked').val() == '1') {
            save.append('suspekya', $('#suspekya').val().trim());
        }

        if (padKfr && !padKfr.isEmpty()) {
            save.append('tte', padKfr.toDataURL('image/png'));
        } else {
            iziToast.warning({
                title: 'Tanda Tangan Kosong!',
                message: 'Silakan tanda tangan terlebih dahulu.',
                position: 'topRight'
            });
            return;
        }

        save.append('dokter', "{{ Auth::user()->ID }}");
        save.append('user', "{{ Auth::user()->NIP }}");

        let isFormValid = validateInput([{
                selector: '#diagmedis_add'
            },
            {
                selector: '#diagfungsi_add'
            },
            {
                selector: '#anamnesa_add'
            },
            {
                selector: '#fisik_add'
            },
            {
                selector: '#penunjang_add'
            },
            {
                selector: '#tatalaksana_add'
            },
            {
                selector: '#anjuran_add'
            },
            {
                selector: '#evaluasi_add'
            },
            {
                selector: '#target_add'
            },
        ]);

        $('#suspekya').removeClass('is-invalid is-valid');
        if ($('input[name="suspek"]:checked').val() === '1') {
            if ($('#suspekya').val().trim() === '') {
                $('#suspekya').addClass('is-invalid');
                isFormValid = false;
            } else {
                $('#suspekya').addClass('is-valid');
            }
        }

        if (!isFormValid) {
            iziToast.warning({
                title: 'Form Belum Lengkap!',
                message: 'Pastikan isian wajib tidak ada yang kosong.',
                position: 'topRight'
            });
            return;
        }

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('api.emr.fkfr.simpanformbaru') }}",
            method: 'POST',
            data: save,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(res) {
                if (res.code === 200) {
                    iziToast.success({
                        title: 'Berhasil!',
                        message: res.message,
                        position: 'topRight'
                    });
                    validPageFormKfr();
                } else {
                    iziToast.warning({
                        title: 'API Error!',
                        message: res.message,
                        position: 'topRight'
                    });
                }
            },
            error: function(xhr, status, error) {
                iziToast.error({
                    title: 'Gagal!',
                    message: error,
                    position: 'topRight'
                });
            }
        });
    }

    function simpanFormulirKfrLama() {
        var group = $('#filterformLamaKfr').val();
        var nomor = "{{ $list['KUNJUNGAN'] }}";
        $('#btn-penetapan-formkfr').prop('disabled',true);
        $('#btn-penetapan-formkfr').find('i').removeClass('fa-lock').addClass('fa-sync fa-spin');

        const save = new FormData();
        save.append('group', group);
        save.append('nomor', nomor);

        if (group == '') {
            iziToast.warning({
                title: 'Maaf!',
                message: 'Mohon untuk memilih formulir layanan KFR yang tersedia',
                position: 'topRight'
            });
            $('#btn-penetapan-formkfr').prop('disabled',false);
            $('#btn-penetapan-formkfr').find('i').removeClass('fa-sync fa-spin').addClass('fa-lock');
        } else {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('api.emr.fkfr.simpanformlama') }}",
                method: 'POST',
                data: save,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(res) {
                    if (res.code === 200) {
                        iziToast.success({
                            title: 'Berhasil!',
                            message: res.message,
                            position: 'topRight'
                        });
                        validPageFormKfr();
                    } else {
                        iziToast.warning({
                            title: 'API Error!',
                            message: res.message,
                            position: 'topRight'
                        });
                    }
                    $('#btn-penetapan-formkfr').prop('disabled',false);
                    $('#btn-penetapan-formkfr').find('i').removeClass('fa-sync fa-spin').addClass('fa-lock');
                },
                error: function(xhr, status, error) {
                    iziToast.error({
                        title: 'Gagal!',
                        message: error,
                        position: 'topRight'
                    });
                    $('#btn-penetapan-formkfr').prop('disabled',false);
                    $('#btn-penetapan-formkfr').find('i').removeClass('fa-sync fa-spin').addClass('fa-lock');
                }
            });
        }
    }

    function hapusFormKfr(GROUP) {
        $('#group_hapus_form_kfr').val(GROUP);
        var inputs = document.getElementById('setujuhapuskfr');
        inputs.checked = false;
        $('#modalHapusKfr').modal('show');
    }

    function prosesHapusKfr() {
        var nomor = "{{ $list['KUNJUNGAN'] }}";
        var id_user = "{{ Auth::user()->ID }}";

        // SWITCH BTN HAPUS
        var checkboxHapus = $('#setujuhapuskfr').is(":checked");
        if (checkboxHapus == false) {
            iziToast.error({
                title: 'Pesan Galat!',
                message: 'Mohon menyetujui untuk dilakukan penghapusan form KFR tersebut',
                position: 'topRight'
            });
        } else {
            // PROSES HAPUS
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: `/api/emr/fkfr/${nomor}/hapus/${id_user}`,
                type: 'DELETE',
                dataType: 'json',
                success: function(res) {
                    iziToast.success({
                        title: 'Pesan Berhasil!',
                        message: `Formulir Layanan KFR kunjungan ini berhasil dihapus dari Grup Berkas Klaim pada `+res,
                        position: 'topRight'
                    });
                    $('#modalHapusKfr').modal('hide');
                    validPageFormKfr();
                },
                error: function(xhr, status, error) {
                    iziToast.error({
                        title: 'Gagal!',
                        message: error,
                        position: 'topRight'
                    });
                }
            });
        }
    }

    function prosesHapusKfrAll() {
        var nomor = "{{ $list['KUNJUNGAN'] }}";
        var id_user = "{{ Auth::user()->ID }}";
        var group = $('#group_hapus_form_kfr').val();

        // SWITCH BTN HAPUS
        var checkboxHapus = $('#setujuhapuskfr').is(":checked");
        if (checkboxHapus == false) {
            iziToast.error({
                title: 'Pesan Galat!',
                message: 'Mohon menyetujui untuk dilakukan penghapusan form KFR tersebut',
                position: 'topRight'
            });
        } else {
            // PROSES HAPUS
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: `/api/emr/fkfr/${nomor}/hapus/${id_user}/all/${group}`,
                type: 'DELETE',
                dataType: 'json',
                success: function(res) {
                    iziToast.success({
                        title: 'Pesan Berhasil!',
                        message: `Seluruh Formulir Layanan KFR Group Kunjungan ini berhasil dihapus dari Grup Berkas Klaim pada `+res,
                        position: 'topRight'
                    });
                    $('#modalHapusKfr').modal('hide');
                    validPageFormKfr();
                },
                error: function(xhr, status, error) {
                    iziToast.error({
                        title: 'Gagal!',
                        message: error,
                        position: 'topRight'
                    });
                }
            });
        }
    }

    function kosongiKfr() {
        $('#diagmedis').val('');
        $('#diagfungsi').val('');
        $('#anamnesa').val('');
        $('#fisik').val('');
        $('#penunjang').val('');
        $('#tatalaksana').val('');
        $('#anjuran').val('');
        $('#evaluasi').val('');
        $('#target').val('');
        // $('#suspek1').prop('checked', false);
        $('#suspek0').prop('checked', true);
        $('#suspekya').val('');
        $('#showsuspekya').prop('hidden', true);
        if (padKfr) {
            padKfr.clear();
        }
        $('.form-control').removeClass('is-valid is-invalid');
    }

    // ----------------------------------------------------------------------------  FORM JADWAL PELAYANAN  -------------------------------------------------------------------
    function validPageFormJp() {
        $('#loading-jp').empty().append(`
            <div class="spinner-grow align-middle me-2" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            Memuat Formulir...
        `);
        $('#hideFormJp').prop('hidden',true);
        $('#showFormJp').prop('hidden',true);
        $('#show_table_jp').prop('hidden',true);
        if (window.dataTable) {
            window.dataTable.destroy();
        }
        $.ajax({
            url: `/api/emr/{{ $list['show']->NORM }}/jp/{{ $list['KUNJUNGAN'] }}`,
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                var nomorKunj = "{{ $list['KUNJUNGAN'] }}";
                $('#loading-jp').empty();
                if (res.form_kfr) {
                    // showPreviewFormJp(res.form.group);
                    $('#hideFormJp').prop('hidden',true);
                    $('#showFormJp').prop('hidden',false);
                    $('#groupid').val(res.form_kfr.group);
                    $('#diagmedis_jp').val(res.form_kfr.diagnosa_medis);
                    $('#tatalaksana_jp').val(res.form_kfr.tata_laksana_kfr);

                    // JALANKAN FUNCTION TTE
                    initPadJp();

                    if (!res.form_jp || res.form_jp.length === 0) {
                        $('#btn-preview-form-jp').prop('hidden',true);
                        $('#btn-refresh-riwayatjp').prop('hidden',true);
                        $('#show_table_jp').prop('hidden',true);
                    } else {
                        $('#btn-preview-form-jp').attr('onclick', `showPreviewFormJp(${res.form_kfr.group})`);
                        $('#btn-preview-form-jp').prop('hidden',false);
                        $('#btn-refresh-riwayatjp').prop('hidden',false);
                        $('#show_table_jp').prop('hidden',false);
                        $("#tampil-tbody-jp").empty();
                        if (res.form_jp && Array.isArray(res.form_jp)) {
                            res.form_jp.forEach((item, index) => {
                                $("#tampil-tbody-jp").append(`
                                    <tr id="jpid_${item.id}">
                                        <td>
                                            ${item.nomor == nomorKunj?
                                                `<button class="btn btn-icon btn-danger avtar-s mb-0" onclick="hapusJp(${item.id})"
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus Program (ID:${item.id})">
                                                    <i class="fas fa-trash" style="font-size: 13px;"></i>
                                                </button>`
                                            :
                                                `<button class="btn btn-icon btn-secondary avtar-s mb-0" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    title="Hapus Program (ID:${item.id})">
                                                    <i class="fas fa-trash" style="font-size: 13px;"></i>
                                                </button>`
                                            }

                                        </td>
                                        <td>${index + 1}</td>
                                        <td style='white-space: normal !important;word-wrap: break-word;'>
                                            <div class='d-flex justify-content-start align-items-center'>
                                                <div class='d-flex flex-column'>
                                                    <h6 class='mb-0 text-truncate text-primary'>
                                                        <a href='javascript:void(0);' data-bs-toggle='tooltip' data-bs-placement='bottom' data-bs-html='true' title='Nomor SEP Kunjungan Pasien'>${item.NOSEP}</a>
                                                    </h6>
                                                    <small class='text-truncate text-muted'>
                                                        <strong><u>Masuk Ruangan</u> : ${item.MASUK}</strong>
                                                    </small>
                                                    <small class='text-truncate text-muted'>
                                                        <strong><u>Keluar Ruangan</u> : ${item.KELUAR}</strong>
                                                    </small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>${item.program}</td>
                                        <td class="text-center">${formatTanggal(item.tgl)}</td>
                                        <td class="text-end">${item.nama_user}</td>
                                    </tr>
                                `);
                            })
                        }
                        // VANILLA TABLE
                        window.dataTable = new simpleDatatables.DataTable("#vantable_jp", {
                            sortable: true,
                            searchable: true,
                            perPage: 10,
                            perPageSelect: [10, 20, 50, 100, 300, 500],
                            fixedColumns: true,
                            firstLast: true,
                            layout: "both",
                            labels: {
                                placeholder: "Cari Program Kunjungan...",
                                perPage: "Jumlah baris per halaman",
                                noRows: "Tidak ada data Jadwal Pelayanan yang tersedia",
                                info: "Menampilkan {start} - {end} dari {rows} data",
                            },
                            columns: [
                                { select: 0, sortable: false },
                                { select: 1, sortable: false },
                                { select: 2, sortable: false },
                                { select: 3, sortable: false },
                                { select: 4, sort: 'ASC' },
                                { select: 5, sortable: false },
                            ]
                        });
                        // Showing Tooltip
                        $('[data-bs-toggle="tooltip"]').tooltip('dispose');
                        $('.tooltip').remove();
                        $('[data-bs-toggle="tooltip"]').tooltip({
                            trigger : 'hover'
                        })
                    }
                } else {
                    $('#hideFormJp').prop('hidden',false);
                    $('#groupid').val('');
                    $('#diagmedis_jp').val('');
                    $('#tatalaksana_jp').val('');
                    $('#showFormJp').prop('hidden',true);
                }
            },
            error: function(xhr, status, error) {
                console.error('Terjadi kesalahan:', error);
            }
        })
    }

    function refreshRiwayatJp() {
        $('#btn-refresh-riwayatjp').find('i').addClass('fa-spin');
        $('#show_table_jp').prop('hidden',false);
        if (window.dataTable) {
            window.dataTable.destroy();
        }
        $("#tampil-tbody-jp").empty().append(`
            <tr style='font-size:13px'>
                <td colspan="15">
                    <center>
                        <div class="spinner-border spinner-border-sm" role="status"></div>
                    </center>
                </td>
            </tr>
        `);
        validPageFormJp();
        $('#btn-refresh-riwayatjp').find('i').removeClass('fa-spin');
    }

    function showPreviewFormJp(GROUP) {
        $('#modalPreviewJp').modal('show');
        $('#previewFormJadwalPelayanan').empty().append(`
            <div class="spinner-grow align-middle me-2" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            Memuat Formulir...
        `);

        fetch("/api/emr/jp/{{ $list['KUNJUNGAN'] }}/preview/" + GROUP)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Formulir tidak ditemukan atau gagal diambil.');
                }
                return response.blob();
            })
            .then(blob => {
                // Buat object URL dari blob
                const fileURL = URL.createObjectURL(blob);
                $('#showTxModalPJP').text("{{ $list['KUNJUNGAN'] }}#"+GROUP);

                // Tampilkan ke iframe dalam modal
                $('#previewFormJadwalPelayanan').empty().html(
                    `<iframe src="${fileURL}" width="100%" height="500px" frameborder="0" class="rounded"></iframe>`
                );
                $('#btn-footer-preview-jp').empty().append(`
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <button class="btn btn-warning" onclick="showPreviewFormJp(${GROUP})">
                            <i class="fas fa-sync me-1"></i> Muat Ulang Laporan
                        </button>
                        <button type="reset" class="btn btn-light-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Tutup</button>
                    </div>
                `);
            })
            .catch(error => {
                iziToast.error({
                    title: 'Maaf!',
                    message: 'Data Formulir tidak ditemukan atau gagal diproses.',
                    position: 'topRight'
                });
                console.error(error);
            });
    }

    function simpanFormulirJp() {
        var group = $('#groupid').val();
        var nomor = "{{ $list['KUNJUNGAN'] }}";
        var tgl = $('#filter_tgl_jp').val();
        var program = $('#program_jp').val();
        var id_user = "{{ Auth::user()->ID }}";

        const save = new FormData();
        save.append('group', group);
        save.append('nomor', nomor);
        save.append('tgl', tgl);
        save.append('program', program);
        save.append('id_user', id_user);

        if (padJpP && !padJpP.isEmpty()) {
            save.append('tte_p', padJpP.toDataURL('image/png'));
        } else {
            iziToast.warning({
                title: 'Tanda Tangan Pasien Kosong!',
                message: 'Silakan tanda tangan terlebih dahulu.',
                position: 'topRight'
            });
            return;
        }

        if (padJpT && !padJpT.isEmpty()) {
            save.append('tte_t', padJpT.toDataURL('image/png'));
        } else {
            iziToast.warning({
                title: 'Tanda Tangan Terapis Kosong!',
                message: 'Silakan tanda tangan terlebih dahulu.',
                position: 'topRight'
            });
            return;
        }

        if (group == '') {
            iziToast.warning({
                title: 'Maaf, Terjadi Error!',
                message: 'ID Group tidak ditemukan! Mohon refresh Browser Anda.',
                position: 'topRight'
            });
        } else {
            if (program == '' || tgl == '') {
                iziToast.warning({
                    title: 'Isian Program masih kosong!',
                    message: 'Mohon untuk mengisi Program Pelayanan Pasien dan Tanggal Program pada kunjungan saat ini terlebih dahulu.',
                    position: 'topRight'
                });
            } else {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('api.emr.jp.simpanJp') }}",
                    method: 'POST',
                    data: save,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(res) {
                        if (res.code === 200) {
                            iziToast.success({
                                title: 'Berhasil!',
                                message: res.message,
                                position: 'topRight'
                            });
                            kosongiJp();
                            validPageFormJp();
                        } else {
                            iziToast.warning({
                                title: 'API Error!',
                                message: res.message,
                                position: 'topRight'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        iziToast.error({
                            title: 'Gagal!',
                            message: error,
                            position: 'topRight'
                        });
                    }
                });
            }
        }
    }

    function hapusJp(id) {
        $("#id_hapus_jp").val(id);
        var inputs = document.getElementById('setujuhapusjp');
        inputs.checked = false;
        $('#modalHapusJp').modal('show');
    }

    function prosesHapusJp() {
        // SWITCH BTN HAPUS
        var checkboxHapus = $('#setujuhapusjp').is(":checked");
        if (checkboxHapus == false) {
            iziToast.error({
                title: 'Pesan Galat!',
                message: 'Mohon menyetujui untuk dilakukan penghapusan berkas tersebut',
                position: 'topRight'
            });
        } else {
            // PROSES HAPUS
            var id = $("#id_hapus_jp").val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/api/emr/jp/hapus/"+id,
                type: 'DELETE',
                success: function(res) {
                    iziToast.success({
                        title: 'Pesan Berhasil!',
                        message: 'Program Pelayanan telah berhasil dihapus pada '+res,
                        position: 'topRight'
                    });
                    $('#modalHapusJp').modal('hide');
                    kosongiJp();
                    validPageFormJp();
                },
                error: function(res) {
                    iziToast.error({
                        title: 'API Error!',
                        message: 'Program Pelayanan Anda gagal dihapus',
                        position: 'topRight'
                    });
                }
            });
        }
    }

    function kosongiJp() {
        if (filterTglJp) {
            filterTglJp.setDate(new Date(), true);
        }
        $('#program_jp').val('');
        if (padJpP) {
            padJpP.clear();
        }
        if (padJpT) {
            padJpT.clear();
        }
        $('.form-control').removeClass('is-valid is-invalid');
    }

    // ----------------------------------------------------------------------------  FORM JADWAL PELAYANAN  -------------------------------------------------------------------
    function validPageFormKs() {
        $('#loading-ks').empty().append(`
            <div class="spinner-grow align-middle me-2" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            Memuat Formulir...
        `);
        $('#hideFormKs').prop('hidden', true);
        $('#showFormKsUtama').prop('hidden', true);
        $('#showFormKs').prop('hidden', true);
        $('#previewKs').prop('hidden', true);
        $.ajax({
            url: `/api/emr/{{ $list['show']->NORM }}/ks/{{ $list['KUNJUNGAN'] }}`,
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                var nomorKunj = "{{ $list['KUNJUNGAN'] }}";
                $('#loading-ks').empty();
                kosongiKs();
                if (res.form_kfr) {
                    // showPreviewFormJp(res.form.group);
                    // console.log(nomorKunj);
                    console.log(res.form_ks);
                    $('#hideFormKs').prop('hidden',true);
                    if (nomorKunj == res.form_kfr_group.nomor) {
                        if (res.form_ks) {
                            $('#btn-preview-form-ks').attr('onclick', `showPreviewFormKsModal(${res.form_ks.group})`);
                            $('#btn-preview-form-ks').prop('hidden',false);
                            $('#filter_tgl_ks').val(res.form_ks.tgl).prop('disabled',true);
                            $('#alasan_ks').val(res.form_ks.alasan).prop('disabled',true);
                            $('#terapi_ks').val(res.form_ks.terapi).prop('disabled',true);
                            $('#btn-kosongi-ks').prop('disabled',true);
                            $('#btn-simpan-ks').prop('hidden',true);
                            $('#btn-hapus-ks').prop('hidden',false);
                        } else {
                            $('#btn-preview-form-ks').prop('hidden',true);
                            $('#alasan_ks').val('').prop('disabled',false);
                            $('#terapi_ks').val('').prop('disabled',false);
                            $('#btn-kosongi-ks').prop('disabled',false);
                            $('#btn-simpan-ks').prop('hidden',false);
                            $('#btn-hapus-ks').prop('hidden',true);
                        }
                        $('#groupidks').val(res.form_kfr.group);
                        $('#diagmedis_ks').val(res.form_kfr.diagnosa_medis);
                        $('#diagfungsi_ks').val(res.form_kfr.diagnosa_fungsi);
                        $('#showFormKs').prop('hidden',false);
                        $('#showFormKsUtama').empty().prop('hidden',true);
                        $('#previewKs').empty().prop('hidden',true);
                    } else {
                        if (res.form_ks) {
                            $('#showFormKs').prop('hidden',true);
                            $('#showFormKsUtama').empty().prop('hidden',true);
                            $('#previewKs').empty().prop('hidden',false);
                            showPreviewFormKs(res.form_ks.group);
                            // alert('muncul preview KS');
                        } else {
                            $('#showFormKs').prop('hidden',true);
                            $('#showFormKsUtama').empty().append(`
                                <h5>Formulir <b class="text-primary">Rekomendasi Dokter</b> tidak dapat dimasukkan pada kunjungan saat ini dikarenakan form tersebut sudah pernah dimasukkan pada kunjungan sebelumnya.
                                    <br>Silakan melakukan Pengisian pada Kunjungan yang sama dengan form yang sudah ditetapkan pada <a data-bs-toggle="tab" data-bs-target="#formlayanankfr" type="button"
                                    role="tab" aria-controls="formlayanankfr" aria-selected="true">Menu Form Layanan KFR</a> sebelumnya terlebih dahulu. <br>Untuk menuju Kunjungan yang dimaksud, dapat melalui tombol di bawah ini
                                </h5>
                                <button class="btn btn-primary" onclick="window.location='{{ url("emr") }}/${res.form_kfr_group.nomor}'">
                                    Kunjungan Pertama Layanan KFR
                                </button>
                            `);
                            $('#showFormKsUtama').prop('hidden',false);
                            $('#previewKs').empty().prop('hidden',true);
                        }
                    }
                } else {
                    $('#hideFormKs').prop('hidden',false);

                    $('#groupidks').val('');
                    $('#diagmedis_ks').val('');
                    $('#diagfungsi_ks').val('');

                    $('#showFormKs').prop('hidden',true);
                    $('#previewKs').prop('hidden',true);
                    $('#showFormKsUtama').prop('hidden',true);
                }

                // Showing Tooltip
                $('[data-bs-toggle="tooltip"]').tooltip('dispose');
                $('.tooltip').remove();
                $('[data-bs-toggle="tooltip"]').tooltip({
                    trigger : 'hover'
                })
            },
            error: function(xhr, status, error) {
                console.error('Terjadi kesalahan:', error);
            }
        })
    }

    function showPreviewFormKsModal(GROUP) {
        $('#modalPreviewKs').modal('show');
        $('#previewFormKs').empty().append(`
            <div class="spinner-grow align-middle me-2" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            Memuat Formulir...
        `);

        fetch("/api/emr/ks/{{ $list['KUNJUNGAN'] }}/preview/" + GROUP)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Formulir tidak ditemukan atau gagal diambil.');
                }
                return response.blob();
            })
            .then(blob => {
                // Buat object URL dari blob
                const fileURL = URL.createObjectURL(blob);
                $('#showTxModalKs').text("{{ $list['KUNJUNGAN'] }}#GROUP"+GROUP);

                // Tampilkan ke iframe dalam modal
                $('#previewFormKs').empty().html(
                    `<iframe src="${fileURL}" width="100%" height="500px" frameborder="0" class="rounded"></iframe>`
                );
                $('#btn-footer-preview-ks').empty().append(`
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <button class="btn btn-warning" onclick="showPreviewFormKsModal(${GROUP})">
                            <i class="fas fa-sync me-1"></i> Muat Ulang Laporan
                        </button>
                        <button type="reset" class="btn btn-light-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Tutup</button>
                    </div>
                `);
            })
            .catch(error => {
                iziToast.error({
                    title: 'Maaf!',
                    message: 'Data Formulir tidak ditemukan atau gagal diproses.',
                    position: 'topRight'
                });
                console.error(error);
            });
    }

    function showPreviewFormKs(GROUP) {
        $('#previewKs').empty().append(`
            <div class="spinner-grow align-middle me-2" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            Memuat Formulir...
        `);

        fetch("/api/emr/ks/{{ $list['KUNJUNGAN'] }}/preview/" + GROUP)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Formulir tidak ditemukan atau gagal diambil.');
                }
                return response.blob();
            })
            .then(blob => {
                // Buat object URL dari blob
                const fileURL = URL.createObjectURL(blob);

                // Tampilkan ke iframe dalam modal
                $('#previewKs').empty().html(
                    `<iframe src="${fileURL}" width="100%" height="500px" frameborder="0" class="rounded"></iframe>`
                );
                $('#previewKs').append(`
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <button class="btn btn-warning" onclick="showPreviewFormKs(${GROUP})">
                            <i class="fas fa-sync me-1"></i> Muat Ulang Laporan
                        </button>
                    </div>
                `);
            })
            .catch(error => {
                iziToast.error({
                    title: 'Maaf!',
                    message: 'Data Formulir tidak ditemukan atau gagal diproses.',
                    position: 'topRight'
                });
                console.error(error);
            });
    }

    function simpanFormulirKs() {
        var group = $('#groupidks').val();
        var nomor = "{{ $list['KUNJUNGAN'] }}";
        var tgl = $('#filter_tgl_ks').val();
        var alasan = $('#alasan_ks').val();
        var terapi = $('#terapi_ks').val();
        var id_user = "{{ Auth::user()->ID }}";

        const save = new FormData();
        save.append('group', group);
        save.append('nomor', nomor);
        save.append('tgl', tgl);
        save.append('alasan', alasan);
        save.append('terapi', terapi);
        save.append('id_user', id_user);

        var error = 0;
        var message = null;

        if (tgl != '') {
            if (alasan == '') {
                error = 1;
                message = 'Isian Alasan masih kosong.';
            }
        } else {
            if (alasan != '') {
                error = 1;
                message = 'Isian Tanggal Kontrol Kembali masih kosong.';
            }
        }

        if (error != 0) {
            iziToast.warning({
                title: message,
                message: 'Periksa kembali isian pada form Anda.',
                position: 'topRight'
            });
        } else {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('api.emr.ks.simpan') }}",
                method: 'POST',
                data: save,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(res) {
                    if (res.code === 200) {
                        iziToast.success({
                            title: 'Berhasil!',
                            message: res.message,
                            position: 'topRight'
                        });
                        kosongiKs();
                        validPageFormKs();
                    } else {
                        iziToast.warning({
                            title: 'API Error!',
                            message: res.message,
                            position: 'topRight'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    iziToast.error({
                        title: 'Gagal!',
                        message: error,
                        position: 'topRight'
                    });
                }
            });
        }
    }

    function hapusJp(id) {
        $("#id_hapus_ks").val(id);
        var inputs = document.getElementById('setujuhapusks');
        inputs.checked = false;
        $('#modalHapusKs').modal('show');
    }

    function prosesHapusJp() {
        // SWITCH BTN HAPUS
        var checkboxHapus = $('#setujuhapusks').is(":checked");
        if (checkboxHapus == false) {
            iziToast.error({
                title: 'Pesan Galat!',
                message: 'Mohon menyetujui untuk dilakukan penghapusan berkas tersebut',
                position: 'topRight'
            });
        } else {
            // PROSES HAPUS
            var id = $("#id_hapus_ks").val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/api/emr/ks/hapus/"+id,
                type: 'DELETE',
                success: function(res) {
                    iziToast.success({
                        title: 'Pesan Berhasil!',
                        message: 'Form Rekomendasi Dokter telah berhasil dihapus pada '+res,
                        position: 'topRight'
                    });
                    $('#modalHapusKs').modal('hide');
                    kosongiKs();
                    validPageFormKs();
                },
                error: function(res) {
                    iziToast.error({
                        title: 'API Error!',
                        message: 'Form Rekomendasi Dokter Anda gagal dihapus',
                        position: 'topRight'
                    });
                }
            });
        }
    }

    function kosongiKs() {
        if (filterTglKs) {
            filterTglKs.setDate(new Date(), true);
        }
        $('#alasan_ks').val('');
        $('#terapi_ks').val('');
        $('.form-control').removeClass('is-valid is-invalid');
    }

    /**
     * Cek field satu atau banyak, kalau kosong tambah class is-invalid.
     * @param {Array} fields - Array selector ID atau name
     * @returns {Boolean} true = valid, false = ada yang kosong
     */

    // FUNCTION PUBLIC
    function validateInput(fields) {
        var isValid = true;

        fields.forEach(f => {
            if (f.type === 'radio') {
                var val = $(`input[name="${f.selector}"]:checked`).val();
                var radios = $(`input[name="${f.selector}"]`);
                radios.removeClass('is-invalid is-valid');

                if (!val) {
                    radios.addClass('is-invalid');
                    isValid = false;
                } else {
                    radios.addClass('is-valid');
                }

            } else {
                var el = $(f.selector);
                var val = el.val();
                el.removeClass('is-invalid is-valid');

                if (!val || val.trim() === '') {
                    el.addClass('is-invalid');
                    isValid = false;
                } else {
                    el.addClass('is-valid');
                }
            }
        });

        return isValid;
    }

    function formatTanggal(tanggal) {
        const bulanIndo = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        const parts = tanggal.split('-'); // ["2025","08","12"]
        const tahun = parts[0];
        const bulan = parseInt(parts[1], 10) - 1; // index array
        const hari = parts[2];

        return `${parseInt(hari, 10)} ${bulanIndo[bulan]} ${tahun}`;
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
</script>
