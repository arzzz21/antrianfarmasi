@extends('layouts.index')
@section('content')
<div class="text-center">
<h1 class="display-1">{{ $jenis->prefix }}{{ str_pad($nomor,3,'0',STR_PAD_LEFT) }}</h1>
<h4>Silakan Menunggu</h4>
<a href="/ambil-antrian" class="btn btn-secondary mt-4">Kembali</a>
</div>
@endsection
