@extends('layouts.index')

@section('content')
    <h3>Master Jenis Antrian</h3>

    <form method="POST" class="row g-2 mb-4">
    @csrf
    <div class="col-md-4">
    <input name="nama" class="form-control" placeholder="Nama Jenis" required>
    </div>
    <div class="col-md-3">
    <input name="kode" class="form-control" placeholder="Kode" required>
    </div>
    <div class="col-md-2">
    <input name="prefix" class="form-control" placeholder="Prefix" required>
    </div>
    <div class="col-md-3">
    <button class="btn btn-primary w-100">Tambah</button>
    </div>
    </form>


    <table class="table table-bordered">
    <tr>
    <th>Nama</th><th>Kode</th><th>Prefix</th><th>Status</th><th>Aksi</th>
    </tr>
    @foreach($data as $d)
    <tr>
    <td>{{ $d->nama }}</td>
    <td>{{ $d->kode }}</td>
    <td>{{ $d->prefix }}</td>
    <td>{{ $d->aktif ? 'Aktif' : 'Nonaktif' }}</td>
    <td>
    <form method="POST" action="/jenis-antrian/{{ $d->id }}/toggle">
    @csrf @method('PATCH')
    <button class="btn btn-sm btn-warning">Toggle</button>
    </form>
    </td>
    </tr>
    @endforeach
    </table>
@endsection
