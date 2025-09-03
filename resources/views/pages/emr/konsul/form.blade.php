<div class="card table-card border shadow-none">
    <div class="card-header pb-0 pt-2">
        <ul class="nav nav-tabs profile-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#jawabkonsul" type="button"
                    role="tab" aria-controls="jawabkonsul" aria-selected="false">Konsul Masuk</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#riwayatkonsul" type="button"
                    role="tab" aria-controls="riwayatkonsul" aria-selected="true">Daftar Konsul</button>
            </li>
        </ul>
    </div>
    <div class="card-body p-3">
        <div class="tab-content" id="myTabContent">

            <!-- Tab Riwayat Konsul -->
            <div class="tab-pane fade" id="riwayatkonsul" role="tabpanel" aria-labelledby="riwayat-tab">
                <div class="row">
                    <!-- Kolom Kiri: Riwayat Konsul -->
                    <div class="col-md-7">
                        <div class="card border-0">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <strong>Riwayat Konsul</strong>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahKonsul">
                                    + Tambah Konsul
                                </button>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table mb-0 table-hover">
                                        <thead>
                                            <tr>
                                                <th>Nomor</th>
                                                <th>Tanggal</th>
                                                <th>Alasan</th>
                                                <th>Konsul Yg. Diminta</th>
                                                <th>Tujuan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody-konsul">
                                            <tr>
                                                <td colspan="" class="text-center">Memuat data...</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Kanan: Jawaban Konsul -->
                    <div class="col-md-5">
                        <div class="card shadow-sm border-0">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <strong>Jawaban Konsul</strong>
                            </div>
                            <div class="card-body bg-light px-4 py-4">
                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Jawaban:</label>
                                    <textarea id="input-jawaban" class="form-control rounded" rows="3" readonly></textarea>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Anjuran:</label>
                                    <textarea id="input-anjuran" class="form-control rounded" rows="3" readonly></textarea>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Tanggal & Waktu:</label>
                                    <input id="input-tgljawab" type="text" class="form-control rounded" readonly>
                                </div>
                                <div>
                                    <label class="form-label fw-semibold">Dokter yg Menjawab:</label>
                                    <input id="input-dokterjawab" type="text" class="form-control rounded" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end row -->
            </div>

            <!-- Tab Daftar Konsul (default) -->
            <div class="tab-pane fade active show" id="jawabkonsul" role="tabpanel" aria-labelledby="home-tab">
                <div class="col-md-12 d-flex justify-content-between align-items-center mb-2">
                    <h5 class="mb-0">Daftar Konsul</h5>
                </div>
                <div class="table-responsive border-top">
                    <table class="table mb-0 table-hover table-display">
                        <thead>
                            <tr>
                                <th>Asal Konsul</th>
                                <th>Tanggal</th>
                                <th>Alasan</th>
                                <th>Konsul Yg. Diminta</th>
                                <th>Ruang Tujuan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-konsulmasuk">
                            <tr>
                                <td colspan="8" class="text-center">Memuat data...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modalTambahKonsul" tabindex="-1" aria-labelledby="modalTambahKonsulLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="formTambahKonsul">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Konsul Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-md-12">
                        <label class="form-label">Layanan yang Diminta</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="layanan_konsultasi" id="layanan_konsultasi" value="1">
                            <label class="form-check-label" for="layanan_konsultasi">Konsultasi</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="layanan_rawat_bersama" id="layanan_rawat_bersama" value="1">
                            <label class="form-check-label" for="layanan_rawat_bersama">Rawat Bersama</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="layanan_alih_rawat" id="layanan_alih_rawat" value="1">
                            <label class="form-check-label" for="layanan_alih_rawat">Alih Rawat</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Alasan Konsul</label>
                        <textarea name="alasan" class="form-control" required></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Permintaan Tindakan</label>
                        <textarea name="permintaan" class="form-control" required></textarea>
                    </div>
                    <!-- Ruangan Tujuan -->
                    <div class="col-md-6">
                        <label class="form-label">Ruang Tujuan</label>
                        <select name="tujuan" id="select-ruangan" class="form-select" required>
                            <option value="">-- Pilih Ruangan --</option>
                            <!-- Diisi lewat JS -->
                        </select>
                    </div>

                    <!-- Dokter Tujuan -->
                    <div class="col-md-6">
                        <label class="form-label">Dokter Tujuan</label>
                        <select name="dokter" id="select-dokter" class="form-select" required>
                            <option value="">-- Pilih Dokter --</option>
                            <!-- Diisi berdasarkan ruangan -->
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="modalJawabKonsul" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form id="formJawabKonsul">
        @csrf
        <input type="hidden" name="nomor" id="jawab-nomor">
        <input type="hidden" id="aktif-kunjungan" value="{{ $list['KUNJUNGAN'] }}">
        <input type="hidden" name="KUNJUNGAN" id="jawab-kunjungan">
        <input type="hidden" name="oleh" value="{{ auth()->id() }}">

        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Jawab Konsul</h5>
            </div>
            <div class="modal-body">
            <div class="form-group">
                <label>Jawaban</label>
                <textarea class="form-control" name="jawaban" id="jawaban"></textarea>
            </div>
            <div class="form-group">
                <label>Anjuran</label>
                <textarea class="form-control" name="anjuran" id="anjuran"></textarea>
            </div>
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
        </div>
        </form>
    </div>
</div>


<script>
    // Contoh panggil saat halaman siap
    $(document).ready(function () {
        tampilKonsul("{{ $list['KUNJUNGAN'] }}");
        konsulMasuk("{{ $list['KUNJUNGAN'] }}");

        $(document).on('click', '.baris-konsul', function () {
            const nomor = $(this).data('nomor');
            if (nomor) {
                $('.baris-konsul').removeClass('table-active');
                $(this).addClass('table-active');

                tampilJawabanKonsul(nomor);
                $('button[data-bs-target="#riwayatkonsul"]').tab('show');
            }
        });

        $(document).on('click', '.btn-jawab', function() {
            const nomor = $(this).data('nomor');
            const kunjungan = $('#aktif-kunjungan').val(); // Ambil kunjungan aktif

            $('#formJawabKonsul')[0].reset();
            $('#jawab-nomor').val(nomor);
            $('#jawab-kunjungan').val(kunjungan); // Set input hidden untuk form submit

            openJawabKonsul(nomor);
            $('#modalJawabKonsul').modal('show');
        });

        $(document).on('click', '.btn-batal', function () {
            const nomor = $(this).data('nomor');
            if (confirm('Apakah Anda yakin ingin membatalkan konsul ini?')) {
                batalKonsul(nomor);
            }
        });

        $(document).on('click', '.btn-cetak', function () {
            const nomor = $(this).data('nomor');
            if (nomor) {
                window.open(`/api/emr/konsulkonsul/cetak/${nomor}`, '_blank');
            }
        });

        function toggleLayanan() {
            const konsultasiChecked = $('#layanan_konsultasi').is(':checked');
            const rawatBersamaChecked = $('#layanan_rawat_bersama').is(':checked');
            const alihRawatChecked = $('#layanan_alih_rawat').is(':checked');

            if (konsultasiChecked || rawatBersamaChecked) {
                // Disable Alih Rawat
                $('#layanan_alih_rawat').prop('checked', false).prop('disabled', true);
            } else {
                $('#layanan_alih_rawat').prop('disabled', false);
            }

            if (alihRawatChecked) {
                // Disable Konsultasi dan Rawat Bersama
                $('#layanan_konsultasi, #layanan_rawat_bersama')
                    .prop('checked', false)
                    .prop('disabled', true);
            } else {
                $('#layanan_konsultasi, #layanan_rawat_bersama')
                    .prop('disabled', false);
            }
        }

        // Jalankan fungsi saat salah satu checkbox berubah
        $('#layanan_konsultasi, #layanan_rawat_bersama, #layanan_alih_rawat').on('change', function () {
            toggleLayanan();
        });

        // Inisialisasi saat modal dibuka
        $('#modalTambahKonsul').on('shown.bs.modal', function () {
            toggleLayanan();
        });

    });

    function tampilKonsul(nomor) {
        $('#tbody-konsul').html('<tr><td colspan="8" class="text-center">Memuat data...</td></tr>');

        $.ajax({
            url: `/api/emr/konsul/${nomor}`,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                if (Array.isArray(data) && data.length > 0) {
                    let html = '';
                    data.forEach(function(item) {
                        const tombolCetak = (item.JAWABAN) ?`
                            <button class="btn btn-info btn-sm btn-cetak" data-nomor="${item.NOMOR}">
                                Cetak
                            </button>
                        `:'';
                        const tombolBatal = (!item.JAWABAN) ?
                        `<button class="btn btn-danger btn-sm btn-batal" data-nomor="${item.NOMOR}">
                            Batal
                        </button>` : '';

                        html += `
                            <tr class="baris-konsul" data-nomor="${item.NOMOR}">
                                <td>
                                    <span><strong>${item.NOMOR}</strong></span><br>
                                    <span><small>Dokter Asal : ${item.NAMADOKTER}</small></span>
                                </td>
                                <td>${formatTanggal(item.TANGGAL)}</td>
                                <td>${item.ALASAN}</td>
                                <td>${item.PERMINTAAN_TINDAKAN}</td>
                                <td>${item.NAMARUANGAN}</td>
                                <td>${tombolBatal} ${tombolCetak}</td>
                            </tr>
                        `;
                    });
                    $('#tbody-konsul').html(html);
                } else {
                    $('#tbody-konsul').html('<tr><td colspan="8" class="text-center">Data tidak ditemukan</td></tr>');
                }
            },
            error: function () {
                $('#tbody-konsul').html('<tr><td colspan="8" class="text-center text-danger">Gagal memuat data</td></tr>');
            }
        });
    }

    function konsulMasuk(nomor) {
        $('#tbody-konsulmasuk').html('<tr><td colspan="8" class="text-center">Memuat data...</td></tr>');

        $.ajax({
            url: `/api/emr/konsul/masuk/${nomor}`,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                if (Array.isArray(data) && data.length > 0) {
                    let html = '';
                    data.forEach(function(item) {
                        let layananList = [];
                        if (item.KONSULTASI == 1) layananList.push('<span class="badge bg-success me-1">Konsultasi</span>');
                        if (item.RAWAT_BERSAMA == 1) layananList.push('<span class="badge bg-primary me-1">Rawat Bersama</span>');
                        if (item.ALIH_RAWAT == 1) layananList.push('<span class="badge bg-warning text-dark me-1">Alih Rawat</span>');

                        let layananHtml = layananList.join(' ');
                        html += `
                            <tr>
                                <td>
                                    <h4 class="mb-1 text-primary"><b data-bs-toggle="tooltip" data-bs-placement="bottom">${item.NAMARUANGAN}</b></h4>
                                    <span><strong>${item.NOMOR}</strong></span><br>
                                    <span><small>Dokter Asal : ${item.NAMADOKTER}</small></span><br>
                                    ${layananHtml}
                                </td>
                                <td>${formatTanggal(item.TANGGAL)}</td>
                                <td>${item.ALASAN}</td>
                                <td>${item.PERMINTAAN_TINDAKAN}</td>
                                <td>
                                    <span><strong>${item.TUJUAN_NAMA}</strong></span><br>
                                    <span><small>Dokter Asal : ${item.DOKTER}</small></span>
                                </td>
                                <td>
                                    <button class="btn btn-success btn-sm btn-jawab" data-nomor="${item.NOMOR}">
                                        Jawab
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                    $('#tbody-konsulmasuk').html(html);
                } else {
                    $('#tbody-konsulmasuk').html('<tr><td colspan="8" class="text-center">Data tidak ditemukan</td></tr>');
                }
            },
            error: function () {
                $('#tbody-konsulmasuk').html('<tr><td colspan="8" class="text-center text-danger">Gagal memuat data</td></tr>');
            }
        });
    }

    function tampilJawabanKonsul(nomor) {
        $.ajax({
            url: `/api/emr/konsulkons/jawaban/${nomor}`,
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                if (res && res.data) {
                    $('#input-jawaban').val(res.data.JAWABAN || '-');
                    $('#input-anjuran').val(res.data.ANJURAN || '-');
                    $('#input-tgljawab').val(formatTanggal(res.data.TANGGAL) || '-');
                    $('#input-dokterjawab').val(`${res.data.NIP || ''} - ${res.data.JAWABDOKTER || ''}`);
                } else {
                    kosongkanJawabanKonsul();
                }
            }
        });
    }

    function kosongkanJawabanKonsul() {
        $('#input-jawaban').val('-');
        $('#input-anjuran').val('-');
        $('#input-tgljawab').val('-');
        $('#input-dokterjawab').val('-');
    }

    $('#formTambahKonsul').submit(function (e) {
        e.preventDefault();

        const formData = {
            layanan_konsultasi: $('#layanan_konsultasi').is(':checked') ? 1 : 0,
            layanan_rawat_bersama: $('#layanan_rawat_bersama').is(':checked') ? 1 : 0,
            layanan_alih_rawat: $('#layanan_alih_rawat').is(':checked') ? 1 : 0,
            alasan: $('textarea[name="alasan"]').val(),
            permintaan: $('textarea[name="permintaan"]').val(),
            tujuan: $('select[name="tujuan"]').val(),
            dokter: $('select[name="dokter"]').val(),
            kunjungan: "{{ $list['KUNJUNGAN'] }}",
            oleh: "{{ Auth::user()->ID }}"
        };

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/api/emr/konsulko/tambah', // Ganti sesuai endpoint API yang kamu buat
            type: 'POST',
            data: JSON.stringify(formData),
            contentType: 'application/json',
            success: function (response) {
                $('#modalTambahKonsul').modal('hide');
                $('#formTambahKonsul')[0].reset();
                konsulMasuk(formData.kunjungan); // Refresh data tabel
                alert('Konsul berhasil ditambahkan');
            },
            error: function (xhr) {
                // alert('Gagal menyimpan data. Silakan coba lagi.');
                console.error('Error:', xhr.responseText);
                alert('Gagal menyimpan data: ' + xhr.responseText);
            }
        });
    });

    function formatTanggal(dateTime) {
        if (!dateTime) return '-';
        const date = new Date(dateTime);
        return isNaN(date.getTime())
            ? '-'
            : date.toLocaleString('id-ID', {
                day: '2-digit',
                month: 'short',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
    }

    // Load data ruangan saat modal dibuka
    $('#modalTambahKonsul').on('show.bs.modal', function () {
        loadRuangan();
        $('#select-dokter').html('<option value="">-- Pilih Dokter --</option>'); // Reset dokter
    });

    // Saat ruangan dipilih, ambil dokter
    $('#select-ruangan').on('change', function () {
        const ruanganId = $(this).val();
        loadDokterByRuangan(ruanganId);
    });

    function loadRuangan() {
        $.ajax({
            url: '/api/emr/konsulk/ruangan',
            type: 'GET',
            success: function (data) {
                let options = '<option value="">-- Pilih Ruangan --</option>';
                data.forEach(function (ruangan) {
                    options += `<option value="${ruangan.ID}">${ruangan.DESKRIPSI}</option>`;
                });
                $('#select-ruangan').html(options);
            },
            error: function () {
                alert('Gagal memuat data ruangan');
            }
        });
    }

    function loadDokterByRuangan(ruanganId) {
        if (!ruanganId) return;

        $.ajax({
            url: `/api/emr/konsulk/ruangan/dokter/${ruanganId}`,
            type: 'GET',
            success: function (data) {
                let options = '<option value="">-- Pilih Dokter --</option>';
                data.forEach(function (dokter) {
                    options += `<option value="${dokter.ID}">${dokter.NAMADOKTER}</option>`;
                });
                $('#select-dokter').html(options);
            },
            error: function () {
                $('#select-dokter').html('<option value="">-- Tidak ada dokter --</option>');
            }
        });
    }
    function openJawabKonsul(nomorKonsul) {
        $.ajax({
            url: '/api/emr/konsulkons/jawaban/' + nomorKonsul,
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                // Tidak perlu reset lagi di sini
                if (res.data) {
                    $('#jawaban').val(res.data.JAWABAN);
                    $('#anjuran').val(res.data.ANJURAN);

                    // Jangan timpa kunjungan jika sebelumnya sudah diset
                    if (res.data.KUNJUNGAN) {
                        $('#jawab-kunjungan').val(res.data.KUNJUNGAN);
                    }
                } else {
                    $('#jawaban').val('');
                    $('#anjuran').val('');
                    // Tidak sentuh #jawab-kunjungan
                }
            }
        });
    }

    $('#formJawabKonsul').on('submit', function(e) {
        e.preventDefault();
        if (!$('#jawab-kunjungan').val()) {
            $('#jawab-kunjungan').val($('#aktif-kunjungan').val());
        }
        $.ajax({
            url: '/api/emr/konsulkon/jawaban',
            type: 'POST',
            data: $(this).serialize(),
            success: function(res) {
                alert(res.message);
                $('#modalJawabKonsul').modal('hide');
            },
                error: function(xhr) {
                alert('Gagal menyimpan jawaban konsul: ' + xhr.responseText);
            }
        });
    });

    function batalKonsul(nomor) {
        $.ajax({
            url: `/api/emr/konsulkonsu/batal/${nomor}`,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(res) {
                alert('Konsul berhasil dibatalkan.');
                tampilKonsul("{{ $list['KUNJUNGAN'] }}"); // Refresh riwayat
            },
            error: function(xhr) {
                console.error(xhr.responseText);
                alert('Gagal membatalkan konsul.');
            }
        });
    }

</script>
