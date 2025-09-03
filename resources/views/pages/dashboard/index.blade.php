@extends('layouts.index')

@section('content')
<!-- [ breadcrumb ] start -->
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Publik</a></li>
                    <li class="breadcrumb-item" aria-current="page">Rilis </li>
                </ul>
            </div>
            <div class="col-md-12">
                <div class="page-header-title text-secondary">
                    <h2 class="mb-0"><span class="pc-micon me-1 text-primary">
                        <i class="ph-duotone ph-gauge align-middle"></i>
                    </span>Dashboard <b class="text-primary">Interaktif</b></h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ breadcrumb ] end -->
<!-- [ Main Content ] end -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Data Record Smart Claim</h5>
                    <div>
                        <div class="input-group">
                            <input type="date" class="form-control form-control-sm w-auto border-0 shadow-none2" data-bs-toggle="tooltip" id="inp_tgl_fresh" onchange="refresh()"
                            data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Filter Berdasarkan Tanggal-Bulan-Tahun" value="2025-04-04"> <!-- {{ $list['yearMonth'] }} -->
                            {{-- <input type="month" class="form-control form-control-sm w-auto border-0 shadow-none2" data-bs-toggle="tooltip" id="inp_tgl_fresh" onchange="refresh()"
                            data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Filter Berdasarkan Bulan dan Tahun" value="2024-04"> <!-- {{ $list['yearMonth'] }} --> --}}
                            <button class="btn btn-sm btn-link-secondary" onclick="refresh()" id="btn-refresh"><i class="fas fa-sync fa-spin" style="font-size: 13px"></i></button>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-body pb-0">
                <div class="row g-3">
                    <div class="col-sm-3 col-xl-2">
                        <div class="card overflow-hidden">
                            <div class="card-body pb-4 pt-4">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <p class="text-muted mb-0">Belum Diverifikasi</p>
                                        <div class="d-flex align-items-end mt-1">
                                            <h4 class="mb-0" id="belum_verif" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Jumlah Klaim IRJ dan IRD yang belum Diverifikasi">
                                                <div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div>
                                            </h4>
                                            <span class="badge bg-light-secondary ms-2">Berkas</span>
                                        </div>
                                    </div>
                                    <div class="avtar bg-brand-color-2 text-white">
                                        <i class="ph-duotone ph-x-square f-26"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 col-xl-2">
                        <div class="card overflow-hidden">
                            <div class="card-body pb-4 pt-4">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <p class="text-muted mb-0">Telah Diverifikasi</p>
                                        <div class="d-flex align-items-end mt-1">
                                            <h4 class="mb-0" id="sudah_verif" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Jumlah Klaim IRJ dan IRD yang telah Diverifikasi">
                                                <div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div>
                                            </h4>
                                            <span class="badge bg-light-secondary ms-2">Berkas</span>
                                        </div>
                                    </div>
                                    <div class="avtar bg-brand-color-3 text-white">
                                        <i class="ph-duotone ph-check-square f-26"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 col-xl-2">
                        <div class="card overflow-hidden">
                            <div class="card-body pb-4 pt-4">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <p class="text-muted mb-0">Masih Ada Catatan</p>
                                        <div class="d-flex align-items-end mt-1">
                                            <h4 class="mb-0" id="masih_catatan" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Jumlah Klaim IRJ dan IRD yang masih ada Catatan (Belum Diverifikasi)">
                                                <div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div>
                                            </h4>
                                            <span class="badge bg-light-secondary ms-2">Berkas</span>
                                        </div>
                                    </div>
                                    <div class="avtar bg-brand-color-1 text-white">
                                        <i class="ph-duotone ph-note f-26"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 col-xl-3">
                        <div class="card overflow-hidden">
                            <div class="card-body pb-3 pt-4">
                                <div class="d-flex">
                                    <!-- Kolom kiri: Total Berkas -->
                                    <div class="d-flex align-items-center justify-content-center me-3">
                                        <p class="text-muted mb-0 text-start">Total Berkas Klaim<br><b class="text-primary" id="text_th">...</b></p>
                                    </div>

                                    <!-- Kolom kanan: IRJ (atas) dan IRD (bawah) -->
                                    <div class="d-flex flex-column justify-content-between ms-auto align-items-end">
                                        <!-- IRJ -->
                                        <div class="d-flex align-items-center mb-2" data-bs-toggle="tooltip" data-bs-offset="0,4"
                                            data-bs-placement="bottom" data-bs-html="true" title="Rawat Jalan Tanpa Rawat Inap (Sudah Verifikasi Maupun Belum Diverifikasi) Dalam 1 Bulan">
                                            <h4 class="mb-0" id="kunj_irj_th"><div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div></h4>
                                            <span class="badge bg-light-primary ms-2">IRJ</span>
                                        </div>
                                        <!-- IRD -->
                                        <div class="d-flex align-items-center" data-bs-toggle="tooltip" data-bs-offset="0,4"
                                            data-bs-placement="bottom" data-bs-html="true" title="Rawat Darurat Tanpa Rawat Inap (Sudah Verifikasi Maupun Belum Diverifikasi) Dalam 1 Bulan">
                                            <h4 class="mb-0" id="kunj_ird_th"><div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div></h4>
                                            <span class="badge bg-light-danger ms-2">IRD</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 col-xl-3">
                        <div class="card overflow-hidden">
                            <div class="card-body pb-3 pt-4">
                                <div class="d-flex">
                                    <!-- Kolom kiri: Total Berkas -->
                                    <div class="d-flex align-items-center justify-content-center me-3">
                                        <p class="text-muted mb-0 text-start">Total Berkas Klaim<br><b class="text-info" id="text_bln_th">...</b></p>
                                    </div>

                                    <!-- Kolom kanan: IRJ (atas) dan IRD (bawah) -->
                                    <div class="d-flex flex-column justify-content-between ms-auto align-items-end">
                                        <!-- IRJ -->
                                        <div class="d-flex align-items-center mb-2" data-bs-toggle="tooltip" data-bs-offset="0,4"
                                            data-bs-placement="bottom" data-bs-html="true" title="Rawat Jalan Tanpa Rawat Inap (Sudah Verifikasi Maupun Belum Diverifikasi) Dalam 1 Tahun">
                                            <h4 class="mb-0" id="kunj_irj_bln"><div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div></h4>
                                            <span class="badge bg-light-primary ms-2">IRJ</span>
                                        </div>
                                        <!-- IRD -->
                                        <div class="d-flex align-items-center" data-bs-toggle="tooltip" data-bs-offset="0,4"
                                            data-bs-placement="bottom" data-bs-html="true" title="Rawat Darurat Tanpa Rawat Inap (Sudah Verifikasi Maupun Belum Diverifikasi) Dalam 1 Tahun">
                                            <h4 class="mb-0" id="kunj_ird_bln"><div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div></h4>
                                            <span class="badge bg-light-danger ms-2">IRD</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div id="chart"></div> --}}
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        refresh();
    })

    // FUNCTION-FUNCTION
    function refresh() {
        // INITIALIZE
        $('#btn-refresh').find('i').removeClass('fa-spin').addClass('fa-spin');
        $('#belum_verif').empty().append(`<div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div>`);
        $('#sudah_verif').empty().append(`<div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div>`);
        $('#masih_catatan').empty().append(`<div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div>`);
        $('#kunj_irj_bln').empty().append(`<div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div>`);
        $('#kunj_ird_bln').empty().append(`<div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div>`);
        $('#kunj_irj_th').empty().append(`<div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div>`);
        $('#kunj_ird_th').empty().append(`<div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div>`);
        $('#text_bln_th').empty().text('...');
        $('#text_th').empty().text('...');
        var tgl = $('#inp_tgl_fresh').val();

        // PROCESS
        $.ajax({
            url: `/api/dashboard/dataDiag/${tgl}`,
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                console.log(res);
                $('#belum_verif').empty().text(res.unverified);
                $('#sudah_verif').empty().text(res.verified);
                $('#masih_catatan').empty().text(res.unsolved);
                $('#kunj_irj_bln').empty().text(res.kunjirjbln);
                $('#kunj_ird_bln').empty().text(res.kunjirdbln);
                $('#kunj_irj_th').empty().text(res.kunjirjth);
                $('#kunj_ird_th').empty().text(res.kunjirdth);
                $('#text_bln_th').empty().text('Bulan '+res.textTgl);
                $('#text_th').empty().text('Tahun '+res.tgl[0]);
                diagram();
                $('#btn-refresh').find('i').removeClass('fa-spin');
            },
            error: function(xhr, status, error) {
                console.error(error);
                Swal.fire({
                    icon: 'error',
                    title: 'Pesan Error!',
                    text: error.message,
                });
                $('#btn-refresh').find('i').removeClass('fa-spin');
            }
        })
    }

    function diagram() {
        var options_invoice = {
            chart: {
                height: 300,
                type: 'line',
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    columnWidth: '50%'
                }
            },
            legend: {
                show: false
            },
            stroke: {
                width: [0, 2],
                curve: 'smooth'
            },
            dataLabels: {
                enabled: false
            },
            series: [{
                    name: 'TEAM A',
                    type: 'column',
                    data: [23, 11, 22, 27, 13, 22, 37, 21, 44, 22, 30, 25]
                },
                {
                    name: 'TEAM B',
                    type: 'line',
                    data: [30, 25, 36, 30, 45, 35, 64, 52, 59, 36, 39, 35]
                }
            ],
            stroke: {
                width: [0, 2],
                curve: 'smooth'
            },
            fill: {
                type: 'gradient',
                gradient: {
                    inverseColors: false,
                    shade: 'light',
                    type: 'vertical',
                    opacityFrom: [0, 1],
                    opacityTo: [0.5, 1],
                    stops: [0, 100],
                    hover: {
                        inverseColors: false,
                        shade: 'light',
                        type: 'vertical',
                        opacityFrom: 0.15,
                        opacityTo: 0.65,
                        stops: [0, 96, 100]
                    }
                }
            },
            markers: {
                size: 3,
                colors: '#fFF',
                strokeColors: '#f4c22b',
                strokeWidth: 2,
                shape: 'circle',
                hover: {
                    size: 5
                }
            },
            colors: ['#f4c22b', '#f4c22b'],
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            yaxis: {
                tickAmount: 3
            },
            grid: {
                show: true,
                borderColor: '#00000010'
            },
            xaxis: {
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                tickAmount: 11
            }
        };
        var chart = new ApexCharts(document.querySelector('#chart'), options_invoice);
        chart.render();
    }
</script>
@endsection
