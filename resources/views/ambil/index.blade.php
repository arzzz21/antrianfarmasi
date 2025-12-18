@extends('layouts.index')

@section('content')
    <div class="container-fluid">

    <div id="menu" class="row text-center">
        <h2 class="mb-4 fw-bold">Silakan Pilih Layanan</h2>

        @foreach($jenis as $j)
        <div class="col-md-4 mb-4">
            <button class="card shadow border-0 w-100 py-5 btn-ambil"
                    data-id="{{ $j->id }}">
                <i class="ph-clipboard-text display-4 text-primary"></i>
                <h3 class="mt-3">{{ $j->nama }}</h3>
            </button>
        </div>
        @endforeach
    </div>

    {{-- TAMPIL NOMOR --}}
    <div id="hasil" class="text-center d-none">
        <h1 class="display-1 fw-bold" id="nomor">---</h1>
        <h4 id="jenis"></h4>
        <p class="text-muted mt-3">Silakan menunggu panggilan</p>
    </div>

    </div>

    {{-- TEMPLATE PRINT --}}
    <div id="print-area" class="print-only">
        <div class="struk">
            <h6 style="text-align:center">ANTRIAN FARMASI</h6>
            <p style="text-align:center;font-size:8px">RS PKU MUHAMMADIYAH SUKOHARJO</p>
            <h1 style="text-align:center;font-size:60px" id="print-nomor"></h1>
            <p style="text-align:center" id="print-jenis"></p>
            <p style="text-align:center">{{ now()->format('d-m-Y H:i') }}</p>
        </div>
        <div class="struk">
            <h6 style="text-align:center">ANTRIAN FARMASI</h6>
            <p style="text-align:center;font-size:8px">RS PKU MUHAMMADIYAH SUKOHARJO</p>
            <h1 style="text-align:center;font-size:60px" id="print-nomor-copy"></h1>
            <p style="text-align:center" id="print-jenis-copy"></p>
            <p style="text-align:center">{{ now()->format('d-m-Y H:i') }}</p>
        </div>
    </div>

<style>
    /* SEMBUNYI SAAT LAYAR */
    .print-only {
        display: none;
    }

    /* KHUSUS PRINT */
    @media print {
        body * {
            visibility: hidden;
        }

        .print-only,
        .print-only * {
            visibility: visible;
        }

        .print-only {
            display: block;
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
    }
</style>

<script>
    const buttons = document.querySelectorAll('.btn-ambil');

    buttons.forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.id;

            fetch('{{ route("ambil.ajax") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    jenis_antrian_id: id
                })
            })
            .then(r => r.json())
            .then(d => {
                if (!d.success) return;

                document.getElementById('menu').classList.add('d-none');
                document.getElementById('hasil').classList.remove('d-none');

                document.getElementById('nomor').innerText = d.nomor;
                document.getElementById('jenis').innerText = d.jenis;

                // SET PRINT
                document.getElementById('print-nomor').innerText = d.nomor;
                document.getElementById('print-jenis').innerText = d.jenis;
                document.getElementById('print-nomor-copy').innerText = d.nomor;
                document.getElementById('print-jenis-copy').innerText = d.jenis;


                setTimeout(() => {
                    window.print();
                }, 500);

                // KEMBALI KE MENU
                setTimeout(() => {
                    location.reload();
                }, 5000);
            });
        });
    });
</script>
@endsection
