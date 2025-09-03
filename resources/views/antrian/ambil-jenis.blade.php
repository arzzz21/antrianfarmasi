@extends('layouts.index')
@section('content')
<div class="card">
  <div class="card-header"><h5>Pilih Jenis Antrian</h5></div>
  <div class="card-body">
    <div class="row">
      @foreach($jenis as $j)
        <div class="col-md-3 mb-3">
          <a href="{{ route('antrian.page.ambil.subjenis', $j->id) }}" class="btn btn-primary w-100 p-4">
            {{ $j->nama }}
          </a>
        </div>
      @endforeach
    </div>
  </div>
</div>
@endsection
