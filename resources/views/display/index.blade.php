<!DOCTYPE html>
<html>
<head>
<title>Display Antrian</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body { background:#000; color:#fff }
</style>
</head>
<body>
<div class="container text-center mt-5">
<h1 class="display-1" id="nomor">---</h1>
<h3 id="loket">Menunggu</h3>
</div>


<script>
setInterval(() => {
fetch('/display/data')
.then(r => r.json())
.then(d => {
if (!d) return;


document.getElementById('nomor').innerText =
d.prefix + String(d.nomor_antrian).padStart(3, '0');


document.getElementById('loket').innerText =
'Silakan ke ' + d.nama_loket;


fetch('/display/' + d.log_id + '/tampil', {
method: 'POST',
headers: {
'X-CSRF-TOKEN': '{{ csrf_token() }}'
}
});
});
}, 2000);
</script>
</body>
</html>
