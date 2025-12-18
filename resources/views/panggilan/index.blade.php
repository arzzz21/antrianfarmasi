@extends('layouts.index')
@section('content')

<h4 class="mb-4">Pemanggilan Antrian</h4>

{{-- PILIH LOKET --}}
<form method="GET" action="{{ route('panggil.index') }}" class="mb-4">
    <select name="loket_id" class="form-select" onchange="this.form.submit()" required>
        <option value="">-- Pilih Loket --</option>
        @foreach($lokets as $l)
            <option value="{{ $l->id }}" {{ request('loket_id') == $l->id ? 'selected' : '' }}>
                {{ $l->nama_loket }}
            </option>
        @endforeach
    </select>
</form>

@if(request('loket_id'))
<div class="card">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Nomor</th>
                    <th>Jenis</th>
                    <th>Status</th>
                    <th>Panggil</th>
                </tr>
            </thead>
            <tbody id="antrianBody">
                @foreach($antrians as $a)
                <tr>
                    <td>
                        <strong>
                            {{ $a->prefix }}-{{ str_pad($a->nomor_antrian, 3, '0', STR_PAD_LEFT) }}
                        </strong>
                    </td>
                    <td>{{ $a->jenis_antrian }}</td>
                    <td>
                        @if($a->log_status == 1)
                            <span class="badge bg-warning">Dipanggil</span>
                        @elseif($a->log_status == 2)
                            <span class="badge bg-success">Ditampilkan</span>
                        @else
                            <span class="badge bg-secondary">Menunggu</span>
                        @endif
                    </td>
                    <td>
                        <form method="POST" action="{{ route('panggil.panggil', request('loket_id')) }}">
                            @csrf
                            <input type="hidden" name="antrian_id" value="{{ $a->id }}">
                            <button class="btn btn-primary btn-sm"
                                {{ $a->log_status == 1 ? 'disabled' : '' }}>
                                🔔 Panggil
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
@if(request('loket_id'))
<script>
const loketId = "{{ request('loket_id') }}";

function loadAntrian() {
    fetch("{{ route('panggil.data') }}?loket_id=" + loketId)
        .then(res => res.json())
        .then(data => {
            let html = '';

            data.forEach(a => {
                let nomor = a.prefix + '-' + String(a.nomor_antrian).padStart(3, '0');
                let statusBadge = '<span class="badge bg-secondary">Menunggu</span>';
                let disabled = '';

                if (a.log_status == 1) {
                    statusBadge = '<span class="badge bg-warning">Dipanggil</span>';
                    disabled = 'disabled';
                } else if (a.log_status == 2) {
                    statusBadge = '<span class="badge bg-success">Ditampilkan</span>';
                }

                html += `
                <tr>
                    <td><strong>${nomor}</strong></td>
                    <td>${a.jenis_antrian}</td>
                    <td>${statusBadge}</td>
                    <td>
                        <form method="POST" action="/loket/${loketId}/panggil">
                            @csrf
                            <input type="hidden" name="antrian_id" value="${a.id}">
                            <button class="btn btn-primary btn-sm" ${disabled}>
                                🔔 Panggil
                            </button>
                        </form>
                    </td>
                </tr>`;
            });

            document.getElementById('antrianBody').innerHTML = html;
        });
}

// load pertama
loadAntrian();

// refresh tiap 5 detik
setInterval(loadAntrian, 5000);
</script>
@endif

@endsection
