@extends('layouts.index')

@section('content')
<div class="container-fluid p-3">
    <div id="display-gate" class="display-gate">
        <div class="gate-card">
            <h2 class="mb-3">Layar Antrian Farmasi</h2>
            <p class="text-muted mb-4">
                Klik untuk menampilkan informasi antrian
            </p>
            <button class="btn btn-dark btn-lg px-5" onclick="startDisplay()">
                Tampilkan Layar
            </button>
        </div>
    </div>

    <div class="container-fluid p-3 position-relative">
        <button class="btn btn-dark btn-sm position-absolute top-0 end-0 m-2"
            onclick="toggleFullscreen()">
            ⛶ Full Screen
        </button>
    </div>

    {{-- AREA DISPLAY (INI YANG DI FULLSCREEN) --}}
    <div id="display-area">

        {{-- HEADER + FULLSCREEN --}}
        <div class="card shadow-sm mb-3 mt-4">
            <div class="d-flex justify-content-between align-items-center p-3">
                <h5 class="mb-0" id="clock"></h5>
            </div>
        </div>

        <div class="row">
            {{-- ANTRIAN AKTIF --}}
            <div class="col-md-8">
                <div class="card shadow-lg text-center p-4">
                    <h2 class="fw-bold mb-3">Antrian Farmasi</h2>

                    <div class="display-1 fw-bold" id="nomor">---</div>

                    <h4 class="mt-2" id="loket">Menunggu</h4>

                    {{-- RIWAYAT --}}
                    <div class="row mt-4" id="history"></div>

                    <h4 class="text-danger mt-4" id="sisa"></h4>
                </div>
            </div>

            {{-- PANEL SAMPING --}}
            <div class="col-md-4">
                <div class="card shadow-lg p-4 h-100">
                    <h5>Informasi</h5>
                    <p class="text-muted">
                        Mohon menunggu hingga nomor Anda dipanggil.
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
#display-area:fullscreen {
    background: #f5f7fb;
    padding: 30px;
}

#display-area:-webkit-full-screen {
    background: #f5f7fb;
}

.history-card {
    background: #f1f3f5;
    border-radius: 15px;
}

.display-gate {
    position: fixed;
    inset: 0;
    background: linear-gradient(135deg, #f5f7fb, #e9ecf3);
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
}

.gate-card {
    background: white;
    padding: 40px 50px;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0,0,0,.15);
    text-align: center;
    max-width: 420px;
}

</style>

<script>
    let audioEnabled = false;
    let interval = null;
    let isCalling = false;

    /* ================= StartDisplay ================= */
    function startDisplay() {
        const area = document.getElementById('display-area');

        /* FULLSCREEN */
        if (!document.fullscreenElement) {
            area.requestFullscreen().catch(() => {});
        }

        /* AUDIO TRIGGER (silent) */
        const unlock = new SpeechSynthesisUtterance(' ');
        unlock.lang = 'id-ID';
        unlock.volume = 0;
        unlock.onend = () => {
            audioEnabled = true;
            document.getElementById('display-gate').remove();
            startPolling();
        };

        speechSynthesis.speak(unlock);
    }

    /* ================= FULLSCREEN ================= */
    function toggleFullscreen() {
        const el = document.getElementById('display-area');

        if (!document.fullscreenElement) {
            el.requestFullscreen();
        } else {
            document.exitFullscreen();
        }
    }

    /* ================= POLLING ================= */
    function startPolling() {
        interval = setInterval(fetchData, 3000);
    }

    function stopPolling() {
        clearInterval(interval);
    }

    function fetchData() {
        if (isCalling) return;

        fetch('{{ url("/display/data") }}')
            .then(r => r.json())
            .then(res => {
                if (!res.current) return;

                isCalling = true;
                stopPolling();

                let nomor =
                    res.current.prefix + '-' +
                    String(res.current.nomor_antrian).padStart(3, '0');

                document.getElementById('nomor').innerText = nomor;
                document.getElementById('loket').innerText =
                    'Loket ' + res.current.nama_loket;

                renderHistory(res.history);

                playAudio(nomor, res.current.nama_loket, () => {
                    fetch('{{ url("/display") }}/' + res.current.log_id + '/tampil', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }).then(() => {
                        isCalling = false;
                        startPolling();
                    });
                });
            });
    }

    /* ================= HISTORY ================= */
    function renderHistory(history) {
        let html = '';
        history.forEach(h => {
            let nomor =
                h.prefix + '-' +
                String(h.nomor_antrian).padStart(3, '0');

            html += `
            <div class="col-md-6 mb-2">
                <div class="history-card p-3 text-center">
                    <h5>${nomor}</h5>
                    <small>Loket ${h.nama_loket}</small>
                </div>
            </div>`;
        });

        document.getElementById('history').innerHTML = html;
    }

    /* ================= AUDIO ================= */
    function playAudio(nomor, loket, callback) {
        if (!audioEnabled) {
            callback();
            return;
        }

        let msg = new SpeechSynthesisUtterance(
            'Nomor antrian ' + nomor + ', silakan ke ' + loket
        );
        msg.lang = 'id-ID';
        msg.rate = 0.9;
        msg.onend = callback;
        speechSynthesis.speak(msg);
    }

    /* ================= CLOCK ================= */
    setInterval(() => {
        document.getElementById('clock').innerText =
            new Date().toLocaleString('id-ID', {
                weekday: 'long',
                day: 'numeric',
                month: 'long',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            }) + ' WIB';
    }, 1000);

    // startPolling();
</script>
@endsection
