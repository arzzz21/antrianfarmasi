@extends('layouts.index')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="card">
  <div class="card-header">
    <h5>Ambil Nomor Antrian - {{ $jenis->nama }}</h5>
  </div>
  <div class="card-body">
    <div class="row">
      @foreach($subJenis as $s)
        <div class="col-md-4 mb-3">
          <button type="button" class="btn btn-success w-100 p-4" onclick="ambilAntrian({{ $s->id }})">
            {{ $s->nama }}
          </button>
        </div>
      @endforeach
    </div>
  </div>
</div>

<script>
function ambilAntrian(subJenisId) {
    fetch("{{ url('ambil') }}/" + subJenisId, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
            "Accept": "application/json",
            "Content-Type": "application/json"
        },
    })
    .then(res => {
        if (!res.ok) throw new Error("HTTP error " + res.status);
        return res.json();
    })
    .then(data => {
        let cetakWindow = window.open("", "_blank", "width=400,height=600");
        cetakWindow.document.write(`
            <html>
            <head>
                <title>Cetak Antrian</title>
                <style>
                    @media print {
                        @page {
                            size: 80mm auto; /* Lebar 80mm, tinggi dinamis */
                            margin: 0;
                        }

                        body {
                            margin: 0;
                            padding: 0;
                            font-family: Arial, sans-serif;
                            text-align: center;
                        }

                        .ticket {
                            width: 72mm;
                            padding: 5mm;
                            margin: auto;
                            page-break-after: always; /* Penting agar auto-cut */
                        }
                    }

                    body {
                        font-family: Arial, sans-serif;
                        text-align: center;
                    }

                    .ticket {
                        width: 280px;
                        margin: auto;
                    }

                    .nomor {
                        font-size: 40px;
                        font-weight: bold;
                        margin: 10px 0;
                    }

                    .jenis {
                        font-size: 30px;
                    }

                    .sub {
                        font-size: 16px;
                        font-weight: bold;
                        color: #555;
                    }

                    .time {
                        font-size: 12px;
                    }
                </style>
            </head>
            <body onload="window.print(); setTimeout(() => window.close(), 500);">
                <div class="ticket">
                    <div class="time"><b>RS PKU Muhammadiyah Sukoharjo</b></div>
                    <div class="sub">{{$jenis->nama}} - ${data.sub_jenis}</div>
                    <div class="nomor">${data.nomor}</div>
                    <div class="time">${data.tanggal}</div>
                    <div class="time">Silahkan Menunggu Antrian, Semoga Lekas Sembuh</div>
                    <div>-</div>
                </div>

                <div class="ticket">
                    <div class="time"><b>RS PKU Muhammadiyah Sukoharjo</b></div>
                    <div class="sub">{{$jenis->nama}} - ${data.sub_jenis}</div>
                    <div class="nomor">${data.nomor}</div>
                    <div class="time">${data.tanggal}</div>
                    <div class="time">Silahkan Menunggu Antrian, Semoga Lekas Sembuh</div>
                    <div>-</div>
                </div>
            </body>
            </html>
        `);
        cetakWindow.document.close();
    })
    .catch(err => {
        alert("Gagal ambil antrian: " + err.message);
        console.error(err);
    });
}
</script>

@endsection


