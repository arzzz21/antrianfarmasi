@extends('layouts.index')

@section('content')
<!-- [ breadcrumb ] start -->
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="ti ti-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Electronic</a></li>
                    <li class="breadcrumb-item" aria-current="page">EMR</li>
                </ul>
            </div>
            <div class="col-md-12">
                <div class="page-header-title">
                    <h2 class="mb-0">Electronic <b class="text-primary">Medical Record</b></h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ breadcrumb ] end -->

<!-- [ Main Content ] start -->
<div class="row gy-4">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header p-2">
                <div class="d-sm-flex align-items-center justify-content-between ms-2">
                    <h5 class="mb-0"><i class="ti ti-table text-primary me-1"></i> Table Kunjungan Pasien <span class="ms-2 f-14 px-2 badge bg-light-secondary">Total : <a id="jumlah_data">0 Data</a></span></h5>
                    <a class="btn btn-link-info btn-sm text-end" href="javascript: void(0);" onclick="tataCara()"><i class="fas fa-info-circle text-info me-2"></i> <s>Tata Cara Penggunaan</s></a>
                    {{-- <button class="btn btn-link-info btn-sm rounded me-1 mb-1 mt-1" type="button" data-bs-toggle="collapse" data-bs-target="#filter-collapse" aria-expanded="false" aria-controls="collapseExample">Filter <i class="ph-duotone ph-caret-down ms-1"></i></button> --}}
                </div>
            </div>
            <div class="card-body p-0">
                <div class="row p-3">
                    <div class="col-md-2 mb-3">
                        <div class="form-group">
                            <label class="form-label">Jenis Perawatan</label>
                            <select id="filter_rawat" class="form-control" onchange="getRuangan()">
                                <option value="5">Semua Perawatan</option>
                                <option value="1" selected>Rawat Jalan</option>
                                <option value="2">Rawat Darurat (Tanpa Inap)</option>
                                <option value="3">Rawat Inap</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <div class="form-group">
                            <label class="form-label">Ruangan</label>
                            <select id="filter_ruang" class="form-control" disabled><option value="5" selected>...</option></select>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <div class="form-group">
                            <label class="form-label">Status Kunjungan</label>
                            <select class="form-control" id="filter_status">
                                <option value="5">Semua Kunjungan</option>
                                <option value="0">Batal Kunjungan</option>
                                <option value="1" selected>Sedang Dilayani</option>
                                <option value="2">Selesai Kunjungan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label class="form-label">Rentang Tgl Kunjungan</label>
                            <div class="input-group">
                                <input type="text" id="filter_tgl" class="form-control flatpickr-input active" placeholder="Pilih Rentang Tanggal" readonly="readonly">
                                <span class="input-group-text"><i class="feather icon-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label class="form-label">DPJP</label>
                            <select class="form-control" id="filter_dpjp">
                                <option value="">Pilih Dokter</option>
                                @if ($list['dr'])
                                    @foreach ($list['dr'] as $item)
                                        <option value="{{ $item->NIP }}">{{ $item->NAMADOKTER }} ({{ $item->DESKRIPSI }})</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <button class="btn btn-light-secondary" href="javascript: void(0);" id="clear_text" onclick="clearFilter()"><i class="ph-duotone ph-eraser me-1"></i> Reset</button>
                            <button class="btn btn-primary" id="tombol-tampilkan" onclick="filter()" disabled><i class="ph-duotone ph-sort-ascending me-1"></i> Refresh Table</button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive border-top" id="show_table" hidden>
                    <table class="table mb-0 table-hover table-display" id="vantable">
                        <thead>
                            <tr>
                                <th style="width: 90%;">KUNJUNGAN PASIEN</th>
                                <th style="width: 30%;" class="text-end">TGL KUNJUNGAN</th>
                            </tr>
                        </thead>
                        <tbody id="tampil-tbody">
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
        </div>
        {{-- <div class="text-end">
            <a href="ecom_product.html" class="btn btn-link-secondary d-inline-flex align-items-center"><i class="ti ti-chevron-left me-2"></i> Back to Shopping</a>
        </div> --}}
    </div>
</div>

{{-- MODAL STARTED --}}
{{-- <div id="catatan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="catatanLabel">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="catatanLabel"><span class="badge text-bg-secondary">CATATAN</span> | IDKUNJUNGAN : <a id="show-id-catatan" class="text-primary"></a></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <small><i class="fas fa-sort-amount-down me-1"></i> <a><b>Tabel di bawah diurutkan berdasarkan <mark>TANGGAL</mark> catatan pertama kali ditambahkan</b></a></small>
                <div class="table-responsive mt-2">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10%;" class="text-center">AKSI</th>
                                <th style="width: 25%;">NAMA PENGGUNA</th>
                                <th style="width: 65%;">DESKRIPSI CATATAN</th>
                            </tr>
                        </thead>
                        <tbody id="tampil-catatan">
                            <tr>
                                <td colspan="15">
                                    <center>
                                        <div class="spinner-border spinner-border-sm" role="status"></div>
                                    </center>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <div id="btn-refresh-catatan"></div>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div> --}}
{{-- MODAL ENDED --}}

<script>
    $(document).ready(function() {
        // BUTTON FILTER READY
        $('#tombol-tampilkan').prop('disabled', false);

        // FLATPICKR DATE
        const today = new Date(); // Hari ini
        const fiveYearsAgo = new Date();
        fiveYearsAgo.setFullYear(today.getFullYear() - 5); // 5 tahun ke belakang
        $("#filter_tgl").flatpickr(
            {
                // enableTime: true,
                // dateFormat: "Y-m-d H:i",
                mode: 'range',
                minDate: fiveYearsAgo, // Mulai dari 5 tahun yang lalu
                maxDate: today,        // Sampai hari ini
                dateFormat: 'Y-m-d',
                defaultDate: [today,today]
            }
        );

        // SELECT CHOICES
        elm = $('#filter_dpjp')[0];
        choices = new Choices(elm);

        // // ENTER TAMPILKAN
        // $('#filter_rawat, #filter_bulan, #filter_dpjp').on('keydown', function (e) {
        //     if (e.key === 'Enter') {
        //         e.preventDefault(); // mencegah aksi default
        //         filter(); // panggil fungsi filter
        //     }
        // });

        // filter();
        getRuangan();
    });

    // function-function
    function getRuangan() {
        idRuang = $('#filter_rawat').val();
        if (idRuang == 5) {
            $('#filter_ruang').prop('disabled',true);
            $("#filter_ruang").find('option').remove();
            $("#filter_ruang").append(`
                <option value="5" selected>Semua Ruangan</option>
            `);
        } else {
            $.ajax({
                url: `/api/emr/ruangan/${idRuang}`,
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    $('#filter_ruang').prop('disabled',false);
                    $("#filter_ruang").find('option').remove();
                    $("#filter_ruang").append(`
                        <option value="5" selected>Semua Ruangan</option>
                    `);
                    res.forEach(pouch => {
                        $("#filter_ruang").append(`
                            <option value="${pouch.ID}">${pouch.DESKRIPSI}</option>
                        `);
                    });
                    // $("#filter_ruang").val(up).change();
                }
            })
        }
    }

    function filter() {
        if (window.dataTable) {
            window.dataTable.destroy();
        }
        $('#tombol-tampilkan').prop('disabled',true).find('i').removeClass('ph-duotone ph-sort-ascending').addClass('fas fa-sync fa-spin').css('font-size', '15px');
        $('#show_table').prop('hidden',false);
        $("#tampil-tbody").empty().append(`<tr style='font-size:13px'><td colspan="15"><center><div class="spinner-border spinner-border-sm" role="status"></div></center></td></tr>`);
        // Initialize
        var rawat = $("#filter_rawat").val();
        var ruang = $("#filter_ruang").val();
        var status = $("#filter_status").val();
        var tgl = $("#filter_tgl").val();
        var dpjp = $("#filter_dpjp").val() ? $("#filter_dpjp").val() : '0'; // JIKA DPJP KOSONG = 0
        var exTgl = tgl.split(' to ');
        if (exTgl.length == 2) { // SPLIT FROM = "2024-01-01 to 2025-01-01"
            tgls = exTgl[0];
            tgle = exTgl[1];
        } else { // SPLIT FROM = "2024-01-01"
            tgls = exTgl[0];
            tgle = exTgl[0];
        }
        // Process
        $.ajax({
            url: '/api/emr',
            type: 'POST',
            data: {
                rawat: rawat,
                ruang: ruang,
                status: status,
                tgls: tgls,
                tgle: tgle,
                dpjp: dpjp,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(res) {
                $("#tampil-tbody").empty();
                if (res.show && Array.isArray(res.show)) {
                    res.show.forEach(item => {
                        $('#jumlah_data').text(res.show.length + ' Data');
                        if (item.STATUS == 1) {
                            status = 'Pasien berada di ruangan ini / sedang dilayani';
                        } else {
                            if (item.STATUS == 2) {
                                status = 'Kunjungan Selesai';
                            } else {
                                status = 'Kunjungan Dibatalkan';
                            }
                        }
                        if (item.NOSEP) {
                            valSEP = item.NOSEP.substring(8, 12); // 0624
                            parts = item.TGLSEP.split("-"); // hasil: ['08', '06', '2024'] || e.g. 2024-01-12 00:00:00
                            valTGLSEP = parts[1]+parts[0].slice(-2); // '0624'
                            // console.log(valSEP);
                            // console.log(valTGLSEP);
                            if (valSEP == valTGLSEP) {
                                SEP = '<b class="text-purple-700">'+item.NOSEP+'</b>';
                                btnSEP = `<button type="button" class="btn btn-sm btn-icon btn-link-success" id="sep`+item.NOMOR+`" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Lihat Detail SEP" onclick="showSEP('`+item.NOMOR+`')">
                                                <i class="fas fa-check text-success"></i>
                                            </button>`;
                            } else {
                                SEP = '<b class="text-danger">Tanggal SEP Tidak Sesuai!</b>';
                                btnSEP = `<button type="button" class="btn btn-sm btn-icon btn-link-danger" id="sep`+item.NOMOR+`" data-bs-toggle="tooltip" data-bs-placement="bottom" title="No.SEP tidak sesuai dengan Tanggal SEP" onclick="showSEP('`+item.NOMOR+`')">
                                                <i class="fas fa-check fs-5 text-danger"></i>
                                            </button>`;
                            }
                        } else {
                            SEP = '<b class="text-secondary">SEP Tidak Ditemukan</b>';
                            btnSEP = `<button type="button" class="btn btn-sm btn-icon btn-link-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="SEP tidak ditemukan">
                                            <i class="fas fa-times fs-5 text-secondary"></i>
                                        </button>`;
                        }
                        content = ``;
                        content += `<tr class="clickable" data-href="/emr/${item.NOMOR}">
                                        <td class="ps-3">
                                            <h4 class="mb-1"><b data-bs-toggle="tooltip" data-bs-placement="bottom" title="Nomor Rekam Medis">RM.${item.NORM}</b> - <b class="text-primary">${item.NAMAPASIEN}</b></h4>
                                            <a class="mb-0 text-dark" href="javascript: void(0);"><b>DPJP</b> : ${item.NAMADOKTER}</a><br>
                                            <a class="mb-2 text-dark" href="javascript: void(0);">
                                                <code>
                                                    Ruangan <b class="text-pink-900">${item.NAMARUANGAN}</b> | <b class="text-teal-900" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Nomor Registrasi">${item.NOPEN}</b>
                                                    | <b class="text-indigo-900" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Nomor SEP">${SEP}</b>
                                                </code>
                                            </a><br>
                                            <a class="mb-2 text-dark" href="javascript: void(0);" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Status Kunjungan"><code>${status}</code></a>
                                        </td>
                                        <td class="text-start align-middle">
                                            <button type="button" class="btn btn-link-info btn-sm mb-0" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Waktu Pasien Diterima Di Ruangan" onclick="event.stopPropagation();">
                                                Masuk <span class="badge bg-light text-dark ms-2">${item.MASUK}</span>
                                            </button><br>
                                            <button type="button" class="btn btn-link-danger btn-sm mb-0" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Waktu Pasien Difinalkan/Dipulangkan" onclick="event.stopPropagation();">
                                                Keluar <span class="badge bg-light text-dark ms-2">${item.KELUAR?item.KELUAR:'-'}</span>
                                            </button>
                                        </td>
                                    </tr>`;
                        $('#tampil-tbody').append(content);
                    })
                    console.log('sampai sini');
                }
                // VANILLA TABLE
                window.dataTable = new simpleDatatables.DataTable("#vantable", {
                    sortable: true,
                    searchable: true,
                    perPage: 10,
                    perPageSelect: [10, 20, 50, 100, 300, 500],
                    fixedColumns: true,
                    firstLast: true,
                    layout: "both",
                    labels: {
                        placeholder: "Cari data Kunjungan...",
                        perPage: "Jumlah baris per halaman",
                        noRows: "Tidak ada data Kunjungan Pasien yang tersedia",
                        info: "Menampilkan {start} - {end} dari {rows} data",
                    },
                    columns: [
                        // { select: 0, sort: "asc" },
                        // { select: 1, sort: "desc" },
                        { select: 0, sortable: false },
                        { select: 1, sort: 'desc' },
                        // { select: 2, sortable: false },
                        // { select: 3, sortable: false }
                    ]
                });
                // Showing Tooltip
                $('[data-bs-toggle="tooltip"]').tooltip('dispose');
                $('.tooltip').remove();
                $('[data-bs-toggle="tooltip"]').tooltip({
                    trigger : 'hover'
                })
                // TOMBOL FILTER TAMPILKAN
                $('#tombol-tampilkan').prop('disabled',false).find('i').removeClass('fas fa-sync fa-spin').addClass('ph-duotone ph-sort-ascending').css('font-size', '');
                $(document).on('click', '.clickable', function() {
                    var url = $(this).data('href');
                    window.location.href = url;
                });
            }, error: function(xhr, status, error) {
                // Gagal: tangani error di sini
                console.error('Terjadi kesalahan:', error);
                // Bisa juga tampilkan alert
                alert('Gagal mengambil data. Coba lagi.');
                $('#tombol-tampilkan').prop('disabled',false).find('i').removeClass('fas fa-sync fa-spin').addClass('ph-duotone ph-sort-ascending').css('font-size', '');
            }
        })
    }

    function clearFilter() {
        // RESET COUNT
        $('#jumlah_data').text('0 Data');

        // GET TODAY DATE
        const today = new Date(); // Hari ini
        const yyyy = today.getFullYear();
        const mm = String(today.getMonth() + 1).padStart(2, '0'); // bulan dimulai dari 0
        const dd = String(today.getDate()).padStart(2, '0');

        // CHANGE FILTER VALUE
        $("#filter_status").val('1');
        $("#filter_rawat").val('5');
        $("#filter_ruang").val('5').prop('disabled',true);

        choices.removeActiveItems();      // hapus semua yang aktif
        choices.setChoiceByValue('');     // pilih option kosong (value="")

        // EMPTY TABLE AND HIDE DIV
        $("#tampil-tbody").empty();
        $('#show_table').prop('hidden',true);
    }
</script>
@endsection
