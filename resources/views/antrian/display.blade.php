<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Display Antrian</title>
  <style>
    body { font-family: sans-serif; text-align: center; background: #f0f0f0; }
    h1 { font-size: 80px; margin: 20px 0; }
    h2 { margin: 10px 0; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    td, th { padding: 10px; border-bottom: 1px solid #ddd; font-size: 24px; }
  </style>
</head>
<body>
  <h1>ANTRIAN</h1>
  <table id="tbl-antrian">
    <thead>
      <tr><th>Nomor</th><th>Jenis</th><th>Waktu</th></tr>
    </thead>
    <tbody></tbody>
  </table>

<script>
function loadData() {
  fetch("{{ route('antrian.display.data') }}")
    .then(res => res.json())
    .then(data => {
      let tbody = document.querySelector("#tbl-antrian tbody");
      tbody.innerHTML = "";
      data.forEach(a => {
        let tr = `<tr>
          <td style="font-size:50px;">${a.nomor}</td>
          <td>${a.sub_jenis}</td>
          <td>${a.updated_at}</td>
        </tr>`;
        tbody.innerHTML += tr;
      });
    });
}
setInterval(loadData, 3000);
loadData();
</script>
</body>
</html>
