@extends('layouts.index')
@section('content')
<div class="card">
  <div class="card-header"><h5>Pilih Jenis & Loket</h5></div>
  <div class="card-body">
    <form method="POST" action="{{ route('antrian.panggil.simpan') }}">
      @csrf
      <div class="mb-3">
        <label>Jenis Antrian</label>
        <select name="jenis_id" id="jenis_id" class="form-control" required>
          <option value="">-- Pilih --</option>
          @foreach($jenis as $j)
            <option value="{{ $j->id }}">{{ $j->nama }}</option>
          @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label>Loket</label>
        <select name="loket_id" id="loket_id" class="form-control" required>
          <option value="">-- Pilih Jenis Dulu --</option>
        </select>
      </div>

      <button type="submit" class="btn btn-primary">Lanjut</button>
    </form>
  </div>
</div>

{{-- script ajax --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $('#jenis_id').on('change', function() {
    var jenisId = $(this).val();
    $('#loket_id').html('<option value="">Memuat...</option>');

    if(jenisId) {
      $.get("{{ url('/antrian/get-loket') }}/" + jenisId, function(data) {
        var options = '<option value="">-- Pilih Loket --</option>';
        $.each(data, function(key, val) {
          options += `<option value="${val.id}">${val.nama}</option>`;
        });
        $('#loket_id').html(options);
      });
    } else {
      $('#loket_id').html('<option value="">-- Pilih Jenis Dulu --</option>');
    }
  });
</script>
@endsection
