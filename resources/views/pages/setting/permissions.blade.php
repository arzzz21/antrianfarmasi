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
                    <li class="breadcrumb-item" aria-current="page">Akses</li>
                </ul>
            </div>
            <div class="col-md-12">
                <div class="page-header-title">
                    <h2 class="mb-0">Setelan Akses</h2>
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
                    <h5 class="mb-3 mb-sm-0">Tabel Jabatan x Akses</h5>
                    <div class="btn-group">
                        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#tambahJabatan">
                            <span class="pc-micon">
                                <i class="ph-duotone ph-tree-structure me-1"></i>
                            </span>Tambah Jabatan
                        </button>
                        <button class="btn btn-warning" id="btn-refresh" onclick="refresh()"><i class="fas fa-sync-alt me-1"></i> Refresh</button>
                        <button class="btn btn-primary" onclick="referensiAkses()">
                            <span class="pc-micon">
                                <i class="ph-duotone ph-user-gear me-1"></i>
                            </span>Referensi Akses
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body pt-3 pb-0">
                <div class="table-responsive">
                    <table class="table table-hover" id="vantable">
                        <thead>
                            <tr>
                                <th style="width: 5%;" class="text-center">#ID</th>
                                <th style="width: 15%;" class="text-center">Jabatan</th>
                                <th style="width: 70%;" class="text-start">Akses</th>
                                <th style="width: 10%;" class="text-center">Aksi</th>
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
<div id="dataAkses" class="modal animate__animated animate__rubberBand fade" tabindex="-1" role="dialog" aria-labelledby="showTindakanLabel">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <span class="pc-micon">
                        <i class="ph-duotone ph-user-gear me-1"></i>
                    </span>Data Akses
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-2 pb-1">
                <div class="table-responsive">
                    <table class="table table-hover" id="vantableAkses">
                        <thead>
                            <tr>
                                <th style="width: 10%;" class="text-start">#ID</th>
                                <th style="width: 65%;" class="text-start">Akses</th>
                                <th style="width: 15%;" class="text-start">Guard</th>
                                <th style="width: 15%;" class="text-start">Diperbarui</th>
                                <th style="width: 10%;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tampil-tbody-akses">
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times me-1"></i> Tutup</button>
                <button type="button" class="btn btn-warning" onclick="referensiAkses()" id="btn-refresh-akses"><i class="fa fa-sync me-1"></i> Refresh</button>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahAkses">Tambah Akses <i class="fa fa-arrow-right ms-1"></i></button>
            </div>
        </div>
    </div>
</div>
<div id="tambahJabatan" class="modal animate__animated animate__rubberBand fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <span class="pc-micon">
                        <i class="ph-duotone ph-tree-structure me-1"></i>
                    </span>Tambah Jabatan <a class="text-danger">*</a>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <div class="form-floating mb-0">
                    <input type="text" class="form-control" id="jabatan_add" placeholder="Tuliskan Jabatan Anda Disini">
                    <label for="jabatan_add">Tuliskan Jabatan Anda Disini</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btn-tambah-roles" onclick="prosesTambahJabatan()"><i class="fa fa-save me-1"></i> Tambah</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times me-1"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>
<div id="ubahJabatan" class="modal animate__animated animate__rubberBand fade" tabindex="-1" role="dialog" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <span class="pc-micon">
                        <i class="ph-duotone ph-tree-structure me-1"></i>
                    </span>
                    <span class="badge text-bg-secondary">ID#<a id="show-id-edit-jabatan" class="text-light"></a></span> | Ubah Jabatan <a class="text-danger">*</a>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <input type="text" id="id_edit_jabatan" hidden>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="form-floating mb-0">
                            <input type="text" class="form-control" id="jabatan_edit" placeholder="Ubah Jabatan Disini">
                            <label for="jabatan_edit">Ubah Jabatan Disini</label>
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-12">
                        <center><label class="form-label">Perbarui Akses Jabatan</label></center>
                        <select class="form-control select2" name="akses_jabatan_edit[]" id="akses_jabatan_edit" style="width: 100%" multiple></select>
                        {{-- <input type="text" class="form-control" id="akses_jabatan_edit" placeholder="Perbarui Akses Jabatan Disini"> --}}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btn-ubah-roles" onclick="prosesUbahJabatan()"><i class="fa fa-save me-1"></i> Submit</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times me-1"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>
<div id="hapusJabatan" class="modal animate__animated animate__rubberBand fade" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span class="badge text-bg-secondary">ID#<a id="show-id-hapus-jabatan" class="text-light"></a></span> | Hapus Jabatan</h5>
            </div>
            <div class="modal-body">
                <input type="text" id="id_hapus_jabatan" hidden>
                <p style="text-align: justify;">Anda akan melakukan penghapusan Jabatan tersebut. Tindakan ini akan menghapus jabatan pengguna terkait dan
                    melepaskan semua akses yang terdapat pada jabatan tersebut. Lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan penghapusan.</p>
                <label class="switch">
                    <input type="checkbox" class="switch-input" id="setujuhapusjabatan">
                    <span class="switch-toggle-slider">
                    <span class="switch-on"></span>
                    <span class="switch-off"></span>
                    </span>
                    <span class="switch-label">Anda siap menerima Risiko</span>
                </label>
            </div>
            <div class="col-12 text-center mb-4">
                <button type="submit" class="btn btn-danger me-1" id="btn-hapus-jabatan" onclick="prosesHapusJabatan()"><i class="fa fa-trash me-1" style="font-size:13px"></i> Hapus</button>
                <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>
<div id="tambahAkses" class="modal animate__animated animate__rubberBand fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <span class="pc-micon">
                        <i class="ph-duotone ph-user-gear me-1"></i>
                    </span>Tambah Akses <a class="text-danger">*</a>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <div class="form-floating mb-0">
                    <input type="text" class="form-control" id="akses_add" placeholder="Tuliskan Akses Anda Disini">
                    <label for="akses_add">Tuliskan Akses Anda Disini</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dataAkses"><i class="fa fa-arrow-left me-1"></i> Data Akses</button>
                <button type="button" class="btn btn-success" id="btn-tambah-permissions" onclick="prosesAkses()"><i class="fa fa-save me-1"></i> Tambah</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times me-1"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>
<div id="hapusAkses" class="modal animate__animated animate__rubberBand fade" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span class="badge text-bg-secondary">ID#<a id="show-id-hapus-akses" class="text-light"></a></span> | Hapus Akses</h5>
            </div>
            <div class="modal-body">
                <input type="text" id="id_hapus_akses" hidden>
                <p style="text-align: justify;">Anda akan melakukan penghapusan Akses tersebut. Tindakan ini tidak akan menghapus jabatan yang sudah ada, melainkan dapat menghilangkan
                    akses yang sudah ditetapkan pada jabatan yang berkaitan. Lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan penghapusan.</p>
                <label class="switch">
                    <input type="checkbox" class="switch-input" id="setujuhapusakses">
                    <span class="switch-toggle-slider">
                    <span class="switch-on"></span>
                    <span class="switch-off"></span>
                    </span>
                    <span class="switch-label">Anda siap menerima Risiko</span>
                </label>
            </div>
            <div class="col-12 text-center mb-4">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dataAkses"><i class="fa fa-arrow-left me-1"></i> Kembali</button>
                <button type="submit" class="btn btn-danger ms-1 me-1" id="btn-hapus-akses" onclick="prosesHapusAkses()"><i class="fa fa-trash me-1" style="font-size:13px"></i> Hapus</button>
                <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>
{{-- MODAL ENDED --}}

<script>
    $(document).ready(function() {
        // SELECT2
        var t = $(".select2");
        t.length && t.each(function() {
            var e = $(this);
            e.wrap('<div class="position-relative"></div>').select2({
                placeholder: "Pilih",
                allowClear: true,
                dropdownParent: e.parent()
            })
        });

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
            url: `/api/roles/data`,
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                console.log(res);
                content = ``;
                res.show.forEach(item => {
                    content += `<tr>
                                    <td class="text-center align-middle">${item.id}</td>
                                    <td class="text-center align-middle">${item.name?'<span class="badge text-bg-secondary">'+item.name+'</span>':''}</td>`;
                        if (item.permissions) {
                            content += `<td class="text-start">`;
                            item.permissions.forEach(val => {
                                content += `<b>${val.name}</b>; `;
                            })
                            content += `</td>`;
                        } else {
                            content += `<td></td>`;
                        }
                        content += `<td class="text-center align-middle">
                                        <a href="javascript:void(0);" onclick="ubahJabatan(${item.id})" class="avtar avtar-xs btn-link-warning">
                                            <i class="ti ti-edit f-20"></i>
                                        </a>
                                        <a href="javascript:void(0);" onclick="hapusJabatan(${item.id})" class="avtar avtar-xs btn-link-danger">
                                            <i class="ti ti-trash f-20"></i>
                                        </a>
                                    </td>
                                </tr>`;
                })
                $('#tampil-tbody').empty().append(content);
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
                        placeholder: "Cari data ...",
                        perPage: "Jumlah baris per halaman",
                        noRows: "Tidak ada record data yang tersedia",
                        info: "Menampilkan {start} - {end} dari {rows} data",
                    },
                    columns: [
                        { select: 0, sort: "asc" },
                        { select: 3, sortable: false },
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
                $('#btn-refresh').prop('disabled',false).find('i').removeClass('fa-spin');
            }
        })
    }

    function prosesTambahJabatan() {
        $('#btn-tambah-roles').prop('disabled',true);
        var save = new FormData();
        save.append('jabatan',$('#jabatan_add').val());
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
                url: "/api/roles/create",
                method: 'post',
                data: save,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(res){
                    iziToast.success({
                        title: 'Pesan Sukses!',
                        message: 'Referensi Jabatan telah berhasil ditambahkan pada '+res,
                        position: 'topRight'
                    });
                    $('#tambahJabatan').modal('hide');
                    $('#jabatan_add').val('');
                    $('#btn-tambah-roles').prop('disabled',false);
                    refresh();
                }, error: function(xhr, status, error) {
                    // Gagal: tangani error di sini
                    iziToast.error({
                        title: 'Terjadi Kesalahan!',
                        message: error,
                        position: 'topRight'
                    });
                    $('#btn-tambah-roles').prop('disabled',false);
                }
            });
        }
    }

    function ubahJabatan(id) {
        $("#id_edit_jabatan").val(id);
        $("#show-id-edit-jabatan").text(id);
        $.ajax({
            url: `/api/permissions/${id}/show`,
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                console.log(res.permissions);
                $("#jabatan_edit").val(res.role.name);
                $("#akses_jabatan_edit").find('option').remove();
                // $("#akses_jabatan_edit").append(`<option value="" hidden selected>Pilih Akses</option>`);
                content = ``;
                res.show.forEach(item => {
                    content += `<option value="${item.id}"`;
                    res.permissions.forEach(val => {
                        if (item.id==val.id) {
                            content += `selected`;
                        }
                    })
                    content += `>${item.name}</option>`;
                });
                $("#akses_jabatan_edit").empty().append(content);
                // $("#akses_jabatan_edit").val().change();
            }
        })
        $('#ubahJabatan').modal('show');
    }

    function prosesUbahJabatan() {
        $('#btn-ubah-roles').prop('disabled',true);
        var save = new FormData();
        var id = $('#id_edit_jabatan').val();
        save.append('id',id);
        save.append('jabatan',$('#jabatan_edit').val());
        save.append('akses_jabatan',JSON.stringify($('#akses_jabatan_edit').val()));

        if (
            save.get('akses') == "" || save.get('jabatan') == ""
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
                url: "/api/permissions/update",
                method: 'post',
                data: save,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(res){
                    iziToast.success({
                        title: 'Pesan Sukses!',
                        message: 'Jabatan dan Akses telah berhasil diperbarui pada '+res,
                        position: 'topRight'
                    });
                    $('#ubahJabatan').modal('hide');
                    $('#btn-ubah-roles').prop('disabled',false);
                    refresh();
                }, error: function(xhr, status, error) {
                    // Gagal: tangani error di sini
                    iziToast.error({
                        title: 'Terjadi Kesalahan!',
                        message: error,
                        position: 'topRight'
                    });
                    $('#btn-ubah-roles').prop('disabled',false);
                }
            });
        }
    }

    function hapusJabatan(id) {
        $("#id_hapus_jabatan").val(id);
        $("#show-id-hapus-jabatan").text(id);
        var inputs = document.getElementById('setujuhapusjabatan');
        inputs.checked = false;
        $('#hapusJabatan').modal('show');
    }

    function prosesHapusJabatan() {
        $('#btn-hapus-jabatan').prop('disabled',true);
        // SWITCH BTN HAPUS
        var checkboxHapus = $('#setujuhapusjabatan').is(":checked");
        if (checkboxHapus == false) {
            iziToast.error({
                title: 'Pesan Galat!',
                message: 'Mohon menyetujui untuk dilakukan penghapusan Jabatan tersebut',
                position: 'topRight'
            });
            $('#btn-hapus-jabatan').prop('disabled',false);
        } else {
            // PROSES HAPUS
            var id = $("#id_hapus_jabatan").val();
            $.ajax({
                url: "/api/roles/"+id+"/delete",
                type: 'DELETE',
                success: function(res) {
                    iziToast.success({
                        title: 'Pesan Sukses!',
                        message: 'Penghapusan Jabatan telah berhasil dilakukan pada '+res,
                        position: 'topRight'
                    });
                    $('#hapusJabatan').modal('hide');
                    $('#btn-hapus-jabatan').prop('disabled',false);
                    refresh();
                }, error: function(xhr, status, error) {
                    // Gagal: tangani error di sini
                    iziToast.error({
                        title: 'Terjadi Kesalahan!',
                        message: error,
                        position: 'topRight'
                    });
                    $('#btn-hapus-jabatan').prop('disabled',false);
                }
            });
        }
    }

    function referensiAkses() {
        $('#btn-refresh-akses').prop('disabled',true).find('i').addClass('fa-spin');
        if (window.vanTableAkses) {
            window.vanTableAkses.destroy();
        }
        $("#tampil-tbody-akses").empty().append(`<tr style='font-size:13px'><td colspan="15"><center><div class="spinner-border spinner-border-sm" role="status"></div></center></td></tr>`);
        $.ajax({
            url: `/api/permissions/data`,
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                console.log(res);
                content = ``;
                res.show.forEach(item => {
                    content += `<tr>
                                    <td class="text-center">${item.id}</td>
                                    <td>${item.name}</td>
                                    <td class="text-center">${item.guard_name}</td>
                                    <td>${new Date(item.updated_at).toLocaleString("sv-SE")}</td>
                                    <td class="text-center align-middle">
                                        <a href="javascript:void(0);" onclick="ubahAkses(${item.id})" class="avtar avtar-xs btn-link-secondary">
                                            <i class="ti ti-edit f-20"></i>
                                        </a>
                                        <a href="javascript:void(0);" onclick="hapusAkses(${item.id})" class="avtar avtar-xs btn-link-danger">
                                            <i class="ti ti-trash f-20"></i>
                                        </a>
                                    </td>
                                </tr>`;
                })
                $('#tampil-tbody-akses').empty().append(content);
                // VANILLA TABLE
                window.vanTableAkses = new simpleDatatables.DataTable("#vantableAkses", {
                    sortable: true,
                    searchable: true,
                    perPage: 10,
                    perPageSelect: [10, 20, 50, 100, 300, 500],
                    fixedColumns: true,
                    firstLast: true,
                    layout: "both",
                    labels: {
                        placeholder: "Cari data ...",
                        perPage: "Jumlah baris per halaman",
                        noRows: "Tidak ada record data yang tersedia",
                        info: "Menampilkan {start} - {end} dari {rows} data",
                    },
                    columns: [
                        { select: 0, sort: "asc" },
                        { select: 3, sortable: false },
                    ]
                });
                $('#btn-refresh-akses').prop('disabled',false).find('i').removeClass('fa-spin');
            }, error: function(xhr, status, error) {
                // Gagal: tangani error di sini
                console.error('Terjadi kesalahan:', error);
                // Bisa juga tampilkan alert
                $('#btn-refresh-akses').prop('disabled',false).find('i').removeClass('fa-spin');
            }
        })
        $('#dataAkses').modal('show');
    }

    function prosesAkses() {
        $('#btn-tambah-permissions').prop('disabled',true);
        var save = new FormData();
        save.append('akses',$('#akses_add').val());
        // save.append('jabatan',JSON.stringify($('#kendaraan_pegawai_edit').val()));

        if (
            save.get('akses') == ""
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
                url: "/api/permissions/create",
                method: 'post',
                data: save,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(res){
                    iziToast.success({
                        title: 'Pesan Sukses!',
                        message: 'Referensi Akses telah berhasil ditambahkan pada '+res,
                        position: 'topRight'
                    });
                    $('#tambahAkses').modal('hide');
                    $('#tambahAkses').on('hidden.bs.modal', function () {
                        referensiAkses();
                        $('#dataAkses').modal('show');
                        $('#akses_add').val('');
                        // Hapus event listener agar tidak double trigger ke depannya
                        $(this).off('hidden.bs.modal');
                    });
                    $('#btn-tambah-permissions').prop('disabled',false);
                    refresh();
                }, error: function(xhr, status, error) {
                    // Gagal: tangani error di sini
                    iziToast.error({
                        title: 'Terjadi Kesalahan!',
                        message: error,
                        position: 'topRight'
                    });
                    $('#btn-tambah-permissions').prop('disabled',false);
                }
            });
        }
    }

    function hapusAkses(id) {
        $('#dataAkses').modal('hide');
        $('#dataAkses').on('hidden.bs.modal', function () {
            $("#id_hapus_akses").val(id);
            $("#show-id-hapus-akses").text(id);
            var inputs = document.getElementById('setujuhapusakses');
            inputs.checked = false;
            $('#hapusAkses').modal('show');
            // Hapus event listener agar tidak double trigger ke depannya
            $(this).off('hidden.bs.modal');
        });
    }

    function prosesHapusAkses() {
        $('#btn-hapus-akses').prop('disabled',true);
        // SWITCH BTN HAPUS
        var checkboxHapus = $('#setujuhapusakses').is(":checked");
        if (checkboxHapus == false) {
            iziToast.error({
                title: 'Pesan Galat!',
                message: 'Mohon menyetujui untuk dilakukan penghapusan akses tersebut',
                position: 'topRight'
            });
            $('#btn-hapus-akses').prop('disabled',false);
        } else {
            // PROSES HAPUS
            var id = $("#id_hapus_akses").val();
            $.ajax({
                url: "/api/permissions/"+id+"/delete",
                type: 'DELETE',
                success: function(res) {
                    iziToast.success({
                        title: 'Pesan Sukses!',
                        message: 'Penghapusan Akses telah berhasil dilakukan pada '+res,
                        position: 'topRight'
                    });
                    $('#hapusAkses').modal('hide');
                    $('#hapusAkses').on('hidden.bs.modal', function () {
                        referensiAkses();
                        $('#dataAkses').modal('show');
                        $('#btn-hapus-akses').prop('disabled',false);
                        refresh();
                        // Hapus event listener agar tidak double trigger ke depannya
                        $(this).off('hidden.bs.modal');
                    });
                }, error: function(xhr, status, error) {
                    // Gagal: tangani error di sini
                    iziToast.error({
                        title: 'Terjadi Kesalahan!',
                        message: error,
                        position: 'topRight'
                    });
                    $('#btn-hapus-akses').prop('disabled',false);
                }
            });
        }
    }
</script>
@endsection
