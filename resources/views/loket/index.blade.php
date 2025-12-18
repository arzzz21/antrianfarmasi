@extends('layouts.index')
@section('content')
<h3>Loket {{ $loketId }}</h3>


@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif


<form method="POST" action="/loket/{{ $loketId }}/panggil">
@csrf
<button class="btn btn-danger btn-lg w-100 py-4">
🔔 Panggil Antrian Berikutnya
</button>
</form>
@endsection
