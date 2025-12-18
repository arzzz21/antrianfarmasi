@extends('layouts.index')

@section('content')
    <h2 class="text-center mb-4">Ambil Antrian Farmasi</h2>


<div class="row">
@foreach($jenis as $j)
<div class="col-md-4 mb-3">
<form method="POST">
@csrf
<input type="hidden" name="jenis_antrian_id" value="{{ $j->id }}">
<button class="btn btn-lg btn-success w-100 py-4">
{{ $j->nama }}
</button>
</form>
</div>
@endforeach
</div>
@endsection
