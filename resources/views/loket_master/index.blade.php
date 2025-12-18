@extends('layouts.index')

@section('content')

<h4 class="mb-4">Master Loket</h4>

{{-- Flash Message --}}
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show auto-hide">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

{{-- CARD : TAMBAH LOKET --}}
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Tambah Loket</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('loket.master') }}">
            @csrf

            <div class="row g-3">
                {{-- Nama Loket --}}
                <div class="col-md-4">
                    <label class="form-label">Nama Loket</label>
                    <input type="text"
                           name="nama_loket"
                           class="form-control"
                           placeholder="Contoh: Loket Farmasi 1"
                           required>
                </div>

                {{-- Jenis Antrian --}}
                <div class="col-md-8">
                    <label class="form-label d-block">Jenis Antrian yang Dilayani</label>

                    <div class="row">
                        @foreach($jenisAntrians as $j)
                        <div class="col-md-4 col-sm-6">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="jenis_antrian_ids[]"
                                       value="{{ $j->id }}"
                                       id="jenis{{ $j->id }}">
                                <label class="form-check-label" for="jenis{{ $j->id }}">
                                    {{ $j->nama }}
                                </label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="text-end mt-4">
                <button class="btn btn-primary">
                    <i class="ph-plus-circle me-1"></i> Simpan Loket
                </button>
            </div>
        </form>
    </div>
</div>

{{-- CARD : LIST LOKET --}}
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Daftar Loket</h5>
    </div>
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Nama Loket</th>
                    <th>Jenis Antrian</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($lokets as $i => $l)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $l->nama_loket }}</td>
                    <td>
                        @php
                            $jenis = $relasi[$l->id] ?? collect();
                        @endphp

                        @forelse($jenis as $r)
                            @php
                                $j = $jenisAntrians->firstWhere('id', $r->jenis_antrian_id);
                            @endphp
                            @if($j)
                                <span class="badge bg-info me-1">{{ $j->nama }}</span>
                            @endif
                        @empty
                            <span class="text-muted">Belum diatur</span>
                        @endforelse
                    </td>
                    <td>
                        @if($l->aktif)
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-secondary">Nonaktif</span>
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-sm btn-info mb-1" data-bs-toggle="modal" data-bs-target="#editLoket{{ $l->id }}">
                            Edit
                        </button>
                        <form method="POST" action="{{ route('loket.toggle', $l->id) }}">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-sm btn-warning">
                                {{ $l->aktif ? 'Nonaktifkan' : 'Aktifkan' }}
                            </button>
                        </form>
                    </td>
                </tr>
                <div class="modal fade" id="editLoket{{ $l->id }}" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <form method="POST" action="{{ route('loket.update', $l->id) }}">
                                @csrf
                                @method('PATCH')

                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Loket</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Loket</label>
                                        <input type="text"
                                            name="nama_loket"
                                            class="form-control"
                                            value="{{ $l->nama_loket }}"
                                            required>
                                    </div>

                                    <label class="form-label">Jenis Antrian</label>
                                    <div class="row">
                                        @foreach($jenisAntrians as $j)
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input"
                                                    type="checkbox"
                                                    name="jenis_antrian_ids[]"
                                                    value="{{ $j->id }}"
                                                    id="edit{{ $l->id }}{{ $j->id }}"
                                                    {{ ($relasi[$l->id] ?? collect())->contains('jenis_antrian_id', $j->id) ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="edit{{ $l->id }}{{ $j->id }}">
                                                    {{ $j->nama }}
                                                </label>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button class="btn btn-primary">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">
                        Belum ada data loket
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<script>
setTimeout(() => {
    document.querySelectorAll('.auto-hide').forEach(alert => {
        new bootstrap.Alert(alert).close();
    });
}, 3000);
</script>
@endsection
