@extends('layouts.index')
@section('content')
<div class="card">
  <div class="card-header"><h5>Panggilan Antrian</h5></div>
  <div class="card-body">

    <div class="row mb-3 text-center">
      <div class="col-md-3"><div class="p-3 border rounded">Jumlah Antrian<br><b>{{ $jumlah }}</b></div></div>
      <div class="col-md-3"><div class="p-3 border rounded">Antrian Sekarang<br><b>{{ $sekarang->nomor ?? '-' }}</b></div></div>
      <div class="col-md-3"><div class="p-3 border rounded">Antrian Selanjutnya<br><b>{{ $selanjutnya->nomor ?? '-' }}</b></div></div>
      <div class="col-md-3"><div class="p-3 border rounded">Sisa Antrian<br><b>{{ $sisa }}</b></div></div>
    </div>

    <div class="table-responsive">
    <table class="table table-bordered" id="tabel-antrian">
      <thead>
        <tr>
          <th>Nomor Antrian</th>
          <th>Jenis</th>
          <th>Sub Jenis</th>
          <th>Loket</th>
          <th>Status</th>
          <th>Panggil</th>
        </tr>
      </thead>
      <tbody id="tbody-antrian">
        @include('antrian._tabel', ['dataAntrian' => $dataAntrian])
      </tbody>
    </table>
    </div>
  </div>
</div>

<script>
const loketId = "{{ session('loket_id') }}";
function bindPanggilButtons(){
    document.querySelectorAll('.btn-panggil').forEach(btn => {
        btn.onclick = function () {
            document.querySelectorAll('.btn-panggil').forEach(b => b.disabled = true);
            document.querySelectorAll('.btn-panggil-ulang').forEach(b => b.disabled = true);
            let id = this.dataset.id;
            let nomor = this.dataset.nomor;
            let jenis = this.dataset.jenis;
            let sub   = this.dataset.sub;
            let loket = this.dataset.loket;

            fetch(`/antrian/panggil/${id}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            }).then(res => res.json()).then(data => {
                if(data.success){
                    let row = document.querySelector(`#row-${id}`);
                    row.querySelector('td:nth-child(5)').innerText = 'Dipanggil';
                    this.classList.remove('btn-primary');
                    this.classList.add('btn-secondary');
                    this.disabled = true;

                    // // 🔊 Suara panggilan otomatis (pakai loket juga)
                    // let msg = new SpeechSynthesisUtterance(
                    //     `Nomor antrian ${nomor}, ${jenis} ${sub}, silakan menuju loket ${loketId}`
                    // );
                    // msg.lang = 'id-ID';
                    // window.speechSynthesis.speak(msg);
                    // setTimeout(() => {
                    //     btn.disabled = false;
                    // }, 5000);
                }
            })
            .catch(err => {
                console.error("Fetch error:", err);
                alert("⚠️ Terjadi kesalahan saat memanggil antrian.");
                setTimeout(() => {
                    btn.disabled = false;
                }, 5000);
            });
        }
    });
    document.querySelectorAll('.btn-panggil-ulang').forEach(btn => {
        btn.onclick = function () {
            document.querySelectorAll('.btn-panggil').forEach(b => b.disabled = true);
            document.querySelectorAll('.btn-panggil-ulang').forEach(b => b.disabled = true);
            let id = this.dataset.id;
            let nomor = this.dataset.nomor;
            let jenis = this.dataset.jenis;
            let sub   = this.dataset.sub;
            let loket = this.dataset.loket;

            // 🔹 Update status di server
            fetch(`/antrian/panggil/${id}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            }).then(res => res.json())
            .then(data => {
                if(data.success){

                    // // 🔹 Suara panggilan
                    // let msg = new SpeechSynthesisUtterance(
                    //     `Nomor antrian ${nomor}, ${jenis} ${sub}, silakan menuju loket ${loket}`
                    // );
                    // msg.lang = 'id-ID';
                    // window.speechSynthesis.speak(msg);
                    // setTimeout(() => {
                    //     document.querySelectorAll('.btn-panggil').forEach(b => b.disabled = false);
                    //     document.querySelectorAll('.btn-panggil-ulang').forEach(b => b.disabled = false);
                    // }, 10000);
                }
            })
            .catch(err => {
                console.error("Fetch error:", err);
                alert("⚠️ Terjadi kesalahan saat memanggil antrian.");
                setTimeout(() => {
                    document.querySelectorAll('.btn-panggil').forEach(b => b.disabled = false);
                    document.querySelectorAll('.btn-panggil-ulang').forEach(b => b.disabled = false);
                }, 10000);
            });
        }
    });

    // document.querySelectorAll('.btn-panggil-ulang').forEach(btn => {
    //     btn.onclick = function () {
    //         let nomor = this.dataset.nomor;
    //         let jenis = this.dataset.jenis;
    //         let sub   = this.dataset.sub;
    //         let loket = this.dataset.loket;

    //         let msg = new SpeechSynthesisUtterance(
    //             `Nomor antrian ${nomor}, ${jenis} ${sub}, silakan menuju loket ${loket}`
    //         );
    //         msg.lang = 'id-ID';
    //         window.speechSynthesis.speak(msg);
    //     }
    // });
}

// 🔄 Auto refresh tabel setiap 5 detik
function refreshTable(){
    fetch(`{{ route('antrian.data') }}`)
        .then(res => res.text())
        .then(html => {
            document.querySelector('#tbody-antrian').innerHTML = html;
            bindPanggilButtons(); // rebind tombol panggil
        });
}

document.addEventListener('DOMContentLoaded', function () {
    bindPanggilButtons();
    setInterval(refreshTable, 5000); // refresh tiap 5 detik
});
</script>
@endsection
