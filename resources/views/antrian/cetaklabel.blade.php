<!DOCTYPE html>
<html>
<head>
    <title>Cetak Antrian</title>
    <style>
        @media print {
            @page {
                size: 80mm auto; /* Lebar 80mm, tinggi otomatis */
                margin: 0;
            }

            body {
                margin: 0;
                padding: 0;
                font-family: Arial, sans-serif;
                text-align: center;
            }

            .ticket {
                width: 72mm; /* Biar tidak mentok ke pinggir */
                padding: 5mm;
                margin: auto;
            }
        }

        /* Untuk tampilan di layar juga bagus */
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }

        .ticket {
            width: 280px;
            margin: auto;
        }

        .nomor {
            font-size: 30px;
            font-weight: bold;
        }

        .jenis {
            font-size: 20px;
            margin-top: 5px;
        }

        .sub {
            font-size: 16px;
            color: #555;
        }

        .time {
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
    <script>
        window.onload = function () {
            window.print();
            setTimeout(() => window.close(), 500);
        };
    </script>
</head>
<body>
    <div class="ticket">
        <div class="jenis">{{ $antrian->jenis_nama }}</div>
        <div class="sub">{{ $antrian->sub_nama }} tes</div>
        <div class="nomor">{{ $antrian->nomor }}</div>
        <div class="time">{{ \Carbon\Carbon::parse($antrian->created_at)->format('d-m-Y H:i') }}</div><br>
    </div>
</body>
</html>
