@extends('layouts.index')
@section('content')
<div class="card">
  <div class="card-header"><h5>Pilih Jenis Antrian untuk Display</h5></div>
  <div class="card-body">
    <form method="POST" action="{{ route('antrian.display.simpan') }}">
      @csrf
      <div class="form-group">
        <label>Jenis Antrian</label>
        <select name="jenis_id" class="form-control" required>
          @foreach($jenis as $j)
            <option value="{{ $j->id }}">{{ $j->id }}{{ $j->nama }}</option>
          @endforeach
        </select>
      </div>
      <button type="submit" class="btn btn-primary mt-3">Tampilkan Display</button>
    </form>
  </div>
</div>
@endsection
