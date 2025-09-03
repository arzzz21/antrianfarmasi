@extends('layouts.index')

@section('content')
<!-- [ breadcrumb ] start -->
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="ti ti-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Setting</a></li>
                    <li class="breadcrumb-item" aria-current="page">Jabatan</li>
                </ul>
            </div>
            <div class="col-md-12">
                <div class="page-header-title">
                    <h2 class="mb-0">Jabatan Pengguna</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ breadcrumb ] end -->

<!-- [ Main Content ] start -->
<div class="row">
    <div class="col-12">
        <div class="card table-card">
            <div class="card-header">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <h5 class="mb-3 mb-sm-0">Tabel</h5>
                    <div>
                        <button class="btn btn-warning me-2" id="btn-refresh" onclick="refresh()"><i class="fas fa-sync-alt me-1"></i> Refresh</button>
                        <button class="btn btn-secondary" disabled><i class="fas fa-plus-square me-1"></i> Tambah Pengguna</button>
                    </div>
                </div>
            </div>
            <div class="card-body pt-3">
                <div class="table-responsive">
                    <table class="table table-hover" id="vantable">
                        <thead>
                            <tr>
                                <th style="width: 5%;" class="text-center">#ID</th>
                                <th style="width: 45%;">Nama Lengkap</th>
                                <th style="width: 15%;" class="text-end">Username</th>
                                <th style="width: 15%;" class="text-end">Jabatan</th>
                                <th style="width: 10%;">Status</th>
                                <th style="width: 10%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tampil-tbody">
                            <tr>
                                <td colspan="3">
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
    </div>
</div>

{{-- MODAL STARTED --}}
<div id="ubah" class="modal animate__animated animate__rubberBand fade" tabindex="-1" role="dialog" aria-labelledby="showTindakanLabel">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span class="badge text-bg-secondary">ID#<a id="show-id-ubah" class="text-light"></a></span> | Perbarui Jabatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <input type="text" id="id_edit" hidden>
                <div class="form-group">
                    <label class="form-label">Jabatan <a class="text-danger">*</a></label>
                    <select id="jabatan" class="form-control"></select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn-submit" onclick="prosesUbah()"><i class="fa fa-save me-1"></i> Submit</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times me-1"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>
<div id="hapus" class="modal animate__animated animate__rubberBand fade" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span class="badge text-bg-secondary">ID#<a id="show-id-hapus" class="text-light"></a></span> | Hapus Jabatan</h5>
            </div>
            <div class="modal-body">
                <input type="text" id="id_hapus" hidden>
                <p style="text-align: justify;">Anda akan melakukan penghapusan Jabatan pegawai tersebut. Tindakan ini tidak akan menghapus pegawai, melainkan hanya menghilangkan
                    akses dan jabatan yang sudah ditetapkan. Lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan penghapusan.</p>
                <label class="switch">
                    <input type="checkbox" class="switch-input" id="setujuhapus">
                    <span class="switch-toggle-slider">
                    <span class="switch-on"></span>
                    <span class="switch-off"></span>
                    </span>
                    <span class="switch-label">Anda siap menerima Risiko</span>
                </label>
            </div>
            <div class="col-12 text-center mb-4">
                <button type="submit" class="btn btn-danger me-sm-3 me-1" id="btn-hapus" onclick="prosesHapus()"><i class="fa fa-trash me-1" style="font-size:13px"></i> Hapus</button>
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>
{{-- MODAL ENDED --}}

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        refresh();
    });

    // function-function
    function refresh() {
        $('#btn-refresh').prop('disabled',true).find('i').addClass('fa-spin');
        if (window.dataTable) {
            window.dataTable.destroy();
        }
        $("#tampil-tbody").empty().append(`<tr style='font-size:13px'><td colspan="15"><center><div class="spinner-border spinner-border-sm" role="status"></div></center></td></tr>`);
        $.ajax({
            url: `/api/roles/user/data`,
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                if (res.show && Array.isArray(res.show)) {
                    content = ``;
                    res.show.forEach(item => {
                        if (item.STATUS == 1) {
                            color = 'text-success';
                            stt = 'Aktif';
                        } else {
                            color = 'text-secondary';
                            stt = 'Non Aktif';
                        }
                        content += `<tr>
                                        <td class="text-center">${item.ID_PENGGUNA}</td>
                                        <td><b class="text-primary">${item.NAMALENGKAP?item.NAMALENGKAP:item.APNAMA}</b> <span class="text-muted text-sm d-block"><b>NIP. </b>${item.NIP?item.NIP:item.APNIP}</span></td>
                                        <td class="text-end">${item.USERNAME}</td>
                                        <td class="text-end">${item.ROLE_NAMES?'<span class="badge text-bg-secondary">'+item.ROLE_NAMES+'</span>':''}</td>
                                        <td class="${color}"><i class="fas fa-circle f-10 m-r-10"></i> ${stt}</td>
                                        <td>`;
                                if (item.STATUS == 1) {
                                    content += `<a href="javascript:void(0);" onclick="ubah(${item.ID_PENGGUNA})" class="avtar avtar-xs btn-link-warning">
                                                    <i class="ti ti-edit f-20"></i>
                                                </a>`;
                                } else {
                                    content += `<a href="javascript:void(0);" class="avtar avtar-xs btn-link-secondary">
                                                    <i class="ti ti-edit f-20"></i>
                                                </a>`;
                                }
                                if (item.ROLE_NAMES) {
                                    content += `<a href="javascript:void(0);" onclick="hapus(${item.ID_PENGGUNA})" class="avtar avtar-xs btn-link-danger">
                                                    <i class="ti ti-trash f-20"></i>
                                                </a>`;
                                } else {
                                    content += `<a href="javascript:void(0);" class="avtar avtar-xs btn-link-secondary">
                                                    <i class="ti ti-trash f-20"></i>
                                                </a>`;
                                }
                            content += `</td>
                                    </tr>`;
                    })
                    $('#tampil-tbody').empty().append(content);
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
                        placeholder: "Cari data Pengguna...",
                        perPage: "Jumlah baris per halaman",
                        noRows: "Tidak ada record data yang tersedia",
                        info: "Menampilkan {start} - {end} dari {rows} data",
                    },
                    columns: [
                        { select: 0, sort: "asc" },   // Kolom ke-0, di-sort ascending
                        // { select: 1, sort: "desc" },  // Kolom ke-1, descending
                        { select: 5, sortable: false }, // Kolom ke-2 tidak bisa di-sort
                        // { select: 1, sort: 'desc' }, // Kolom ke-2 tidak bisa di-sort
                        // { select: 2, sortable: false } // Kolom ke-2 tidak bisa di-sort
                    ]
                });
                // Showing Tooltip
                $('[data-bs-toggle="tooltip"]').tooltip({
                    trigger : 'hover'
                })
                $('#btn-refresh').prop('disabled',false).find('i').removeClass('fa-spin');
            }, error: function(xhr, status, error) {
                // Gagal: tangani error di sini
                console.error('Terjadi kesalahan:', error);
                // Bisa juga tampilkan alert
                alert('Gagal mengambil data. Coba lagi.');
                $('#btn-refresh').prop('disabled',false).find('i').removeClass('fa-spin');
            }
        })
    }

    function ubah(id) {
        $.ajax(
        {
            url: "/api/roles/user/"+id+"/show",
            type: 'GET',
            xhrFields: {
                withCredentials: true
            },
            dataType: 'json',
            success: function(res) {
                // console.log(res);
                $('#id_edit').val(id);
                $("#show-id-ubah").text(id);
                $("#jabatan").find('option').remove();
                $("#jabatan").append(`<option value="" hidden selected>Pilih Jabatan</option>`);
                res.role.forEach(item => {
                    $("#jabatan").append(`
                        <option value="${item.id}">${item.name}</option>
                    `);
                });
                if (res.id) {
                    $("#jabatan").val(res.id).change();
                }
                $('#ubah').modal('show');
            }
        })
    }

    function prosesUbah() {
        $('#btn-submit').prop('disabled',true);
        var save = new FormData();
        var id = $('#id_edit').val();
        save.append('id',id);
        save.append('jabatan',$('#jabatan').val());
        // save.append('jabatan',JSON.stringify($('#kendaraan_pegawai_edit').val()));

        if (
            save.get('jabatan') == ""
        ) {
            iziToast.warning({
                title: 'Pesan Ambigu!',
                message: 'Pastikan Anda tidak mengosongi semua isian Wajib',
                position: 'topRight'
            });
        } else {
            // AJAX request
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/api/roles/user/update",
                method: 'post',
                data: save,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(res){
                    iziToast.success({
                        title: 'Pesan Sukses!',
                        message: 'Jabatan pegawai telah berhasil diperbarui pada '+res,
                        position: 'topRight'
                    });
                    $('#ubah').modal('hide');
                    refresh();
                    $('#btn-submit').prop('disabled',false);
                }, error: function(xhr, status, error) {
                    // Gagal: tangani error di sini
                    iziToast.error({
                        title: 'Terjadi Kesalahan!',
                        message: error,
                        position: 'topRight'
                    });
                    $('#btn-submit').prop('disabled',false);
                }
            });
        }
    }

    function hapus(id) {
        $("#id_hapus").val(id);
        $("#show-id-hapus").text(id);
        var inputs = document.getElementById('setujuhapus');
        inputs.checked = false;
        $('#hapus').modal('show');
    }

    function prosesHapus() {
        $('#btn-hapus').prop('disabled',true);
        // SWITCH BTN HAPUS
        var checkboxHapus = $('#setujuhapus').is(":checked");
        if (checkboxHapus == false) {
            iziToast.error({
                title: 'Pesan Galat!',
                message: 'Mohon menyetujui untuk dilakukan penghapusan jabatan tersebut',
                position: 'topRight'
            });
        } else {
            // PROSES HAPUS
            var id = $("#id_hapus").val();
            $.ajax({
                url: "/api/roles/user/"+id+"/delete",
                type: 'DELETE',
                success: function(res) {
                    iziToast.success({
                        title: 'Pesan Sukses!',
                        message: 'Penghapusan Jabatan pegawai telah berhasil dilakukan pada '+res,
                        position: 'topRight'
                    });
                    $('#hapus').modal('hide');
                    refresh();
                    $('#btn-hapus').prop('disabled',false);
                }, error: function(xhr, status, error) {
                    // Gagal: tangani error di sini
                    iziToast.error({
                        title: 'Terjadi Kesalahan!',
                        message: error,
                        position: 'topRight'
                    });
                    $('#btn-hapus').prop('disabled',false);
                }
            });
        }
    }
</script>
@endsection
