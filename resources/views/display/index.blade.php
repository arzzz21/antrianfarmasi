@extends('layouts.index')

@section('title', 'Display Antrian')

@section('content')
<style>
#fullscreenContainer:fullscreen {
    margin: 0 !important;
    padding: 1rem !important;
    background: white !important;
    width: 100vw;
    height: 100vh;
    box-sizing: border-box;
    overflow: auto;
}
</style>

<div class="d-flex align-items-center justify-content-end flex-wrap gap-2">
    <button onclick="enableSpeech()">Aktifkan Suara</button>
    <button id="openFullscreenBtn" class="btn btn-teal-light btn-wave waves-effect waves-light"
        data-bs-toggle="tooltip" data-bs-custom-class="tooltip-dark"
        data-bs-placement="bottom" aria-label="Terapkan Display Layar Penuh"
        data-bs-original-title="Terapkan Display Layar Penuh">
        <i class="ti ti-arrows-maximize align-middle"></i>
    </button>
</div>

<div id="fullscreenContainer">
    <div class="row mb-1">
        <div class="col-12 text-center">
            <div class="card text-center p-3">
                <div id="tanggalWaktu" style="font-size: 24px; font-weight:bold; color: #333;">
                <!-- Hari, tanggal, jam akan diupdate via JS -->
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-1">
        <div class="col-md-8">
            <!-- Bagian Antrian -->
            <div class="card text-center p-4">
            <div class="main-jenis" id="jenis">-</div>
            <div class="main-number" id="nomor">-</div>
            <div class="loket" id="loket">Loket -</div>

            <div class="previous d-flex justify-content-center gap-3 mb-4" id="sebelumnya">
                <div class="previous-box">
                <h2>-</h2>
                <small>Loket -</small>
                </div>
                <div class="previous-box">
                <h2>-</h2>
                <small>Loket -</small>
                </div>
            </div>

            <div class="sisa">Sisa Antrian: <span id="sisa">0</span></div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Bagian Video -->
            <div class="card">
            <video autoplay loop muted style="width: 100%; border-radius: .5rem;">
                <source src="{{ asset('storage/video/edukasi.mp4') }}" type="video/mp4">
            </video>
            </div>
        </div>
    </div>
</div>

<script>
    let audioQueue = [];
    let isSpeaking = false;
    let lastCalledId = '';
    let currentId = '';

    // function enqueueAnnouncement(data) {
    //     audioQueue.push(data);
    //     playNext();
    // }
    function enableSpeech() {
        const dummy = new SpeechSynthesisUtterance('');
        window.speechSynthesis.speak(dummy);

        // Setelah aktif, baru mulai polling data dan play audio
        loadData();
        setInterval(loadData, 2000);

        // Opsional: sembunyikan tombol setelah diklik
        document.querySelector('[onclick="enableSpeech()"]').style.display = 'none';
    }

    function playNext(data) {
        audioQueue.push(data);
        if (isSpeaking || audioQueue.length === 0) return;
        window.speechSynthesis.cancel();

        const item = audioQueue.shift();

        if (item) {
            document.getElementById('jenis').innerText = 'Antrian ' + item.jenis;
            document.getElementById('nomor').innerText = item.nomor;
            document.getElementById('loket').innerText = 'Loket ' + item.loket;

            isSpeaking = true;

            const msg = new SpeechSynthesisUtterance(item.text);
            msg.lang = 'id-ID';
            // 👇 Atur kecepatan bicara (0.1 - 10)
            msg.rate = 0.8; // lebih pelan dari normal

            // (opsional) atur pitch dan volume juga
            msg.pitch = 1;   // default
            msg.volume = 1;  // maksimal

            msg.onend = function () {
                isSpeaking = false;
                playNext(); // lanjutkan ke antrian berikutnya
            };

            // selalu clear queue sebelum bicara
            window.speechSynthesis.speak(msg);
        }
    }

    function loadData(){
        fetch(`{{ route('antrian.display.data') }}`)
        .then(res => res.json())
        .then(data => {
            // antrian utama
            if (data.sekarang) {
                document.getElementById('jenis').innerText = 'Antrian ' + data.sekarang.jenis ;
                // Suara otomatis (jika belum dipanggil sebelumnya)
                currentId = data.sekarang.nomor + '-' + data.sekarang.loket;
                // console.log(currentId);
                if (currentId !== lastCalledId) {
                    const announcement = `Nomor antrian ${data.sekarang.nomor}, silakan menuju loket ${data.sekarang.loket}`;
                    playNext({
                        text: announcement,
                        jenis: data.sekarang.jenis,
                        nomor: data.sekarang.nomor,
                        loket: data.sekarang.loket
                    });
                    // console.log(data.sekarang.jenis);
                    lastCalledId = currentId;
                }
            } else {
                document.getElementById('jenis').innerText = '-';
                document.getElementById('nomor').innerText = '-';
                document.getElementById('loket').innerText = 'Loket -';
            }

            // antrian sebelumnya
            let prevBox = document.getElementById('sebelumnya');
            let html = '';
            for(let i=0; i<2; i++){
            if(data.sebelumnya[i]){
                html += `
                <div class="previous-box">
                    <h4>Sudah Dipanggil</h4>
                    <h2>${data.sebelumnya[i].nomor}</h2>
                    <small>Loket ${data.sebelumnya[i].loket}</small>
                </div>
                `;
            } else {
                html += `
                <div class="previous-box">
                    <h4>Sudah Dipanggil</h4>
                    <h2>-</h2>
                    <small>Loket -</small>
                </div>
                `;
            }
            }
            prevBox.innerHTML = html;

            // sisa
            document.getElementById('sisa').innerText = data.sisa ?? 0;
        });
    }


    function updateTanggalWaktu() {
        const now = new Date();
        const hariArr = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
        const bulanArr = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

        const hari = hariArr[now.getDay()];
        const tanggal = now.getDate();
        const bulan = bulanArr[now.getMonth()];
        const tahun = now.getFullYear();
        const jam = String(now.getHours()).padStart(2,'0');
        const menit = String(now.getMinutes()).padStart(2,'0');
        const detik = String(now.getSeconds()).padStart(2,'0');

        document.getElementById('tanggalWaktu').innerText =
            `${hari}, ${tanggal} ${bulan} ${tahun} - Pukul ${jam}:${menit}:${detik} WIB`;
    }

    // update setiap detik
    setInterval(updateTanggalWaktu, 1000);
    updateTanggalWaktu();

    const btnFullscreen = document.getElementById('openFullscreenBtn');

    btnFullscreen.addEventListener('click', () => {
        const elem = document.getElementById('fullscreenContainer'); // ganti dari document.documentElement
        if (!document.fullscreenElement) {
            if (elem.requestFullscreen) {
                elem.requestFullscreen();
            } else if (elem.webkitRequestFullscreen) { /* Safari */
                elem.webkitRequestFullscreen();
            } else if (elem.msRequestFullscreen) { /* IE11 */
                elem.msRequestFullscreen();
            }
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.webkitExitFullscreen) { /* Safari */
                document.webkitExitFullscreen();
            } else if (document.msExitFullscreen) { /* IE11 */
                document.msExitFullscreen();
            }
        }
    });
</script>
<style>
  .main-number {
    font-size: 100px;
    font-weight: bold;
    margin-bottom: 5px;
    color: black;
  }
  .main-jenis {
    font-size: 50px;
    font-weight: bold;
    color: navy;
  }
  .loket {
    font-size: 36px;
    margin-bottom: 30px;
  }
  .previous-box {
    flex: 1 1 100px;     /* flex-grow, flex-shrink, flex-basis */
    min-width: 100px;    /* lebar minimum */
    height: 150px;       /* tinggi pasti */
    background: #f1f3f5;
    border-radius: 12px;
    padding: 10px;
    text-align: center;

    display: flex;        /* untuk centering isi */
    flex-direction: column;
    justify-content: center;
    align-items: center;
    box-sizing: border-box;
  }
  .previous-box h2 {
    margin: 0;
    font-size: 50px;
  }
  .previous-box small {
    display: block;
    margin-top: 5px;
    font-size: 18px;
    color: #6c757d;
  }
  .sisa {
    font-size: 28px;
    font-weight: bold;
    color: #dc3545;
  }
</style>
@endsection

